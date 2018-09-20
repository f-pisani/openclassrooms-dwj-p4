<?php
namespace Controllers;

use Lib\{Configuration, Controller, View};
use Models\{User, Article, Comment};

class HomeController extends Controller
{
	public function index()
	{
		$request = $this->request;
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

		return View::view('home', compact('request', 'list_articles'));
	}
}
