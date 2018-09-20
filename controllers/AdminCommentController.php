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
		if(User::isLogged())
		{
			$request = $this->request;
			$title = "Jean Forteroche - Gestion des commentaires";
			$articles = new Article();
			$comments = new Comment();
			$result_articles = $articles->getAllByUserId($_SESSION['user_id']);

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
				$list_articles[$i]['comments_reported'] = 0;
				$result_comments = $comments->getAllOrderByReport($article['id']);
				foreach($result_comments as $comment)
				{
					$x = count($list_articles[$i]['comments']);
					$list_articles[$i]['comments'][$x]['id'] = $comment['id'];
					$list_articles[$i]['comments'][$x]['nickname'] = $comment['nickname'];
					$list_articles[$i]['comments'][$x]['content'] = $comment['content'];
					$list_articles[$i]['comments'][$x]['created_at'] = $comment['created_at'];
					$list_articles[$i]['comments'][$x]['reported_counter'] = $comment['reported_counter'];

					if($comment['reported_counter'] > 0)
						$list_articles[$i]['comments_reported']++;
				}
			}

			return View::view('admin/comments_dashboard', compact('request', 'title', 'list_articles'));
		}
		else
		{
			header('Location: '.Config::get('BASE_URL').'admin/login');
			exit();
		}
	}


	/*******************************************************************************************************************
	 * public function list()
	 *
	 * List comments for an article
	 */
	public function list()
	{
		$request = $this->request;
		if(User::isLogged() && $request->hasParameter('id'))
		{
			$title = "Jean Forteroche - Gestion des commentaires";
			$articles = new Article();
			$comments = new Comment();
			$result_articles = $articles->getByUserId($_SESSION['user_id'], $request->parameter('id'));

			if($result_articles == null || $result_articles->num_rows == 0)
			{
				header('Location: '.Config::get('BASE_URL').'admin/comments');
				exit();
			}

			$list_articles = array();
			$comments_counter = 0;
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
				$list_articles[$i]['comments_reported'] = 0;
				$result_comments = $comments->getAllOrderByReport($article['id']);
				foreach($result_comments as $comment)
				{
					$x = count($list_articles[$i]['comments']);
					$list_articles[$i]['comments'][$x]['id'] = $comment['id'];
					$list_articles[$i]['comments'][$x]['nickname'] = $comment['nickname'];
					$list_articles[$i]['comments'][$x]['content'] = $comment['content'];
					$list_articles[$i]['comments'][$x]['created_at'] = $comment['created_at'];
					$list_articles[$i]['comments'][$x]['reported_counter'] = $comment['reported_counter'];

					$comments_counter++;
					if($comment['reported_counter'] > 0)
						$list_articles[$i]['comments_reported']++;
				}
			}

			if($comments_counter == 0)
			{
				header('Location: '.Config::get('BASE_URL').'admin/comments');
				exit();
			}

			return View::view('admin/comments_listing', compact('request', 'title', 'list_articles'));
		}
		else
		{
			header('Location: '.Config::get('BASE_URL').'admin/login');
			exit();
		}
	}


	/*******************************************************************************************************************
	 * public function delete()
	 *
	 * Delete a comment
	 */
	public function delete()
	{
		$request = $this->request;
		if(User::isLogged() && $request->hasParameter('id') && $request->hasParameter('article_id'))
		{
			$comment_id = $request->parameter('id');

			$comments = new Comment();
			$comments->delete($comment_id);

			header('Location: '.Config::get('BASE_URL').'admin/comments/list/'.$request->parameter('article_id'));
			exit();
		}
		else
		{
			header('Location: '.Config::get('BASE_URL').'admin/login');
			exit();
		}
	}
}
