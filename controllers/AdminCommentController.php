<?php
namespace Controllers;

use Lib\{Config, Controller, View};
use Models\{User, Article, Comment};

class AdminCommentController extends Controller
{
	/*******************************************************************************************************************
	 * public function index()
	 *
	 * Comments dashboard
	 */
	public function index()
	{
		if(User::isLogged() && in_array(User::role(), ['admin', 'mod']))
		{
			$request = $this->request;
			$title = "Billet simple pour l'Alaska - Gestion des commentaires";

			$articles = new Article();
			$comments = new Comment();

			$q_articles = $articles->getAll();

			$articles_list = array();
			foreach($q_articles as $article)
			{
				$i = count($articles_list);
				$articles_list[$i] = array_map('strip_tags', $article);

				$articles_list[$i]['comments'] = 0;
				$articles_list[$i]['comments_reported'] = 0;
				if($counter_comments = $comments->countCommentsByArticle($article['id']))
					$articles_list[$i]['comments'] = $counter_comments->fetch_assoc()['counter'];

				if($counter_reports = $comments->countCommentsReportedByArticle($article['id']))
					$articles_list[$i]['comments_reported'] = $counter_reports->fetch_assoc()['counter'];
			}

			return View::view('admin/comments_dashboard', compact('request', 'title', 'articles_list'));
		}

		header('Location: '.Config::get('BASE_URL').'login');
		exit();
	}


	/*******************************************************************************************************************
	 * public function list()
	 *
	 * List comments for an article
	 */
	public function list()
	{
		$request = $this->request;
		if(User::isLogged() && in_array(User::role(), ['admin', 'mod']) && $request->hasParameter('id'))
		{
			$title = "Billet simple pour l'Alaska - Gestion des commentaires";

			$articles = new Article();
			$comments = new Comment();
			$q_articles = $articles->get($request->parameter('id'));

			if($q_articles == null || $q_articles->num_rows == 0)
			{
				header('Location: '.Config::get('BASE_URL').'admin/comments');
				exit();
			}

			$articles_list = array();
			foreach($q_articles as $article)
			{
				$i = count($articles_list);
				$articles_list[$i] = $article;

				$articles_list[$i]['comments'] = array();
				$q_comments = $comments->getAll($article['id']);
				foreach($q_comments as $comment)
					$articles_list[$i]['comments'][] = $comment;
			}

			if(count($articles_list[0]['comments']) == 0)
			{
				header('Location: '.Config::get('BASE_URL').'admin/comments');
				exit();
			}

			return View::view('admin/comments_listing', compact('request', 'title', 'articles_list'));
		}

		header('Location: '.Config::get('BASE_URL').'login');
		exit();
	}


	/*******************************************************************************************************************
	 * public function delete()
	 *
	 * Delete a comment
	 */
	public function delete()
	{
		$request = $this->request;
		if(User::isLogged() && in_array(User::role(), ['admin', 'mod']) && $request->hasParameter('id') && $request->hasParameter('article_id'))
		{
			$comment_id = $request->parameter('id');

			$comments = new Comment();
			$comments->delete($comment_id);

			header('Location: '.Config::get('BASE_URL').'admin/comments/list/'.$request->parameter('article_id'));
			exit();
		}

		header('Location: '.Config::get('BASE_URL').'login');
		exit();
	}
}
