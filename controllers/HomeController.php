<?php
namespace Controllers;

use Lib\{Config, Controller, View};
use Models\{User, Article, Comment};

class HomeController extends Controller
{
	/*******************************************************************************************************************
	 * public function index()
	 *
	 * Show last chapter
	 */
	public function index()
	{
		$request = $this->request;
		$title = "Billet simple pour l'Alaska - Jean Forteroche";

		$users = new User();
		$articles = new Article();
		$comments = new Comment();
		$result = $articles->getAll();

		$list_articles = array();
		foreach($result as $article)
		{
			$article['user_displayName'] = $users->getDisplayName($article['user_id']);

			$article['comments'] = array();
			$result_comments = $comments->getAll($article['id']);
			foreach($result_comments as $comment)
				$article['comments'][] = $comment;

			$list_articles[] = $article;
		}

		return View::view('home', compact('request', 'title', 'list_articles'));
	}


	/*******************************************************************************************************************
	 * public function show()
	 *
	 * Show a chapter
	 */
	public function show()
	{
		$request = $this->request;
		if($request->hasParameter('id'))
		{
			$users = new User();
			$articles = new Article();
			$comments = new Comment();
			$result = $articles->get($request->parameter('id'));
			if($result->num_rows == 0)
			{
				header('Location: '.Config::get('BASE_URL'));
				exit();
			}

			// Form : Comment
			if($request->hasPost('comment'))
			{
				$nickname = htmlentities(strip_tags($request->post('nickname')), ENT_COMPAT | ENT_QUOTES | ENT_HTML5);
				$comment = htmlentities(strip_tags($request->post('comment')), ENT_COMPAT | ENT_QUOTES | ENT_HTML5);

				if($nickname == null || strlen($nickname) == 0)
					$nickname = 'Anonyme';

				if(strlen($comment) > 0)
					$comments->create($request->parameter('id'), $nickname, $comment);
			}

			$list_articles = array();
			foreach($result as $article)
			{
				$article['user_displayName'] = $users->getDisplayName($article['user_id']);

				$article['comments'] = array();
				$result_comments = $comments->getAll($article['id']);
				foreach($result_comments as $comment)
					$article['comments'][] = $comment;

				$list_articles[] = $article;
			}

			$title = "Billet simple pour l'Alaska - ".$list_articles[0]['title'];
			return View::view('article', compact('request', 'title', 'list_articles'));
		}
		else
		{
			header('Location: '.Config::get('BASE_URL'));
			exit();
		}
	}


	/*******************************************************************************************************************
	 * public function report()
	 *
	 * Report a comment
	 */
	public function report()
	{
		$request = $this->request;
		$title = "Billet simple pour l'Alaska - Signaler un commentaire";

		if($request->hasParameter('article_id') && $request->hasParameter('comment_id'))
		{
			$success = array();
			$comments = new Comment();
			$result = $comments->get($request->parameter('article_id'), $request->parameter('comment_id'));
			if($result->num_rows == 0)
			{
				header('Location: '.Config::get('BASE_URL')."articles/".$request->parameter('article_id'));
				exit();
			}

			if($request->hasPost('confirm'))
			{
				$comments->report($request->parameter('article_id'), $request->parameter('comment_id'));
				$success["Le commentaire a été signalé !"] = "Merci pour votre signalement.";
			}

			$comment = $result->fetch_assoc();
			return View::view('report', compact('request', 'title', 'comment', 'success'));
		}
		else
		{
			header('Location: '.Config::get('BASE_URL')."articles/".$request->parameter('article_id'));
			exit();
		}
	}


	/*******************************************************************************************************************
	 * public function error404()
	 *
	 * Show 404 No Found
	 */
	public function error404()
	{
		$request = $this->request;
		$title = "Billet simple pour l'Alaska - 404 No Found";

		return View::view('error404', compact('request', 'title'));
	}
}
