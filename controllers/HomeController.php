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
	 * Show an article
	 */
	public function show()
	{
		$request = $this->request;
		if($request->hasParameter('id'))
		{
			$users = new User();
			$articles = new Article();
			$comments = new Comment();

			$success = array();

			$q_articles = $articles->get($request->parameter('id'));
			if($q_articles->num_rows == 0)
			{
				header('Location: '.Config::get('BASE_URL'));
				exit();
			}

			// Form : Comment
			if(User::isLogged() && $request->hasPost('comment'))
			{
				$comment = htmlentities(strip_tags(trim($request->post('comment'))), ENT_COMPAT | ENT_QUOTES | ENT_HTML5);

				if(strlen($comment) > 0)
				{
					if($comments->create($request->parameter('id'), $comment, User::id()))
					{
						$success["Commentaire ajouté !"] = "Votre commentaire a bien été ajouté ! Merci pour votre retour.";
					}
				}
			}

			$user_reports = array();
			if(User::isLogged())
			{
				$result = $users->getReportedComments(User::id());
				foreach($result as $report)
					$user_reports[] = $report['comment_id'];
			}

			$list_articles = array();
			foreach($q_articles as $article)
			{
				$article['comments'] = array();
				$result_comments = $comments->getAll($article['id']);

				foreach($result_comments as $comment)
					$article['comments'][] = $comment;

				$list_articles[] = $article;
			}

			$title = "Billet simple pour l'Alaska - ".$list_articles[0]['title'];
			return View::view('article', compact('request', 'title', 'list_articles', 'user_reports', 'success'));
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

		if(User::isLogged() && $request->hasParameter('article_id') && $request->hasParameter('comment_id'))
		{
			$success = array();
			$comments = new Comment();

			$result = $comments->get($request->parameter('article_id'), $request->parameter('comment_id'));
			$comment = $result->fetch_assoc();

			if(count($comment) == 0 || (count($comment) == 1 && $comment[0]['user_id'] == User::id()))
			{
				header('Location: '.Config::get('BASE_URL')."articles/".$request->parameter('article_id'));
				exit();
			}

			if($request->hasPost('confirm'))
			{
				if($comments->report(User::id(), $request->parameter('comment_id')))
					$success["Le commentaire a été signalé !"] = "Merci pour votre signalement.";
				else
					$errors["Commentaire déjà signalé !"] = "Vous avez déjà signalé ce commentaire.";
			}

			return View::view('report', compact('request', 'title', 'comment', 'success', 'errors'));
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
