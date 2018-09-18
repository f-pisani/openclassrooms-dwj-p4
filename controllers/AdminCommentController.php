<?php
namespace Controllers;

use Lib\{Config, Controller, View};
use Models\{User, Article, Comment};

class AdminCommentController extends Controller
{
	/*******************************************************************************************************************
	 * public function index()
	 *
	 * Dashboard view
	 */
	public function index()
	{
		if(User::isLogged())
		{
			$request = $this->request;
			$title = "Jean Forteroche - Gestion des commentaires";
			$articles = new Article();
			$comments = new Comment();
			$result_articles = $articles->getAll($_SESSION['user_id']);

			$list_articles = array();
			foreach($result_articles as $article)
			{
				$i = count($list_articles);
				$list_articles[$i] = array();
				$list_articles[$i]['id'] = $article['id'];
				$list_articles[$i]['title'] = strip_tags($article['title']);
				$list_articles[$i]['content'] = strip_tags($article['content']);
				$list_articles[$i]['published'] = $article['published'];
				$list_articles[$i]['created_at'] = $article['created_at'];
				$list_articles[$i]['updated_at'] = $article['updated_at'];

				$list_articles[$i]['comments'] = array();
				$result_comments = $comments->getAllOrderByReport($article['id']);
				foreach($result_comments as $comment)
				{
					$x = count($list_articles[$i]['comments']);
					$list_articles[$i]['comments'][$x]['id'] = $comment['id'];
					$list_articles[$i]['comments'][$x]['nickname'] = $comment['nickname'];
					$list_articles[$i]['comments'][$x]['content'] = $comment['content'];
					$list_articles[$i]['comments'][$x]['created_at'] = $comment['created_at'];
					$list_articles[$i]['comments'][$x]['reported_counter'] = $comment['reported_counter'];
				}
			}

			// Display comments dashboard
			return View::view('admin/comments_dashboard', compact('request', 'title', 'list_articles'));
		}
		else
		{
			// Admin is not logged, redirect to login form
			header('Location: '.Config::get('BASE_URL').'admin/login');
			exit();
		}
	}
}
