<?php
namespace Controllers;

use Lib\{Config, Controller, View};
use Models\{User, Article};

class AdminArticleController extends Controller
{
	/*******************************************************************************************************************
	 * public function index()
	 *
	 * Dashboard view
	 */
	public function index()
	{
		if(User::isLogged() && User::role() == 'admin')
		{
			$request = $this->request;
			$title = "Billet simple pour l'Alaska - Gestion des articles";
			$articles = new Article();
			$result = $articles->getAllByUserId($_SESSION['user_id']);

			$list_articles = array();
			foreach($result as $data)
			{
				$i = count($list_articles);
				$list_articles[$i] = array();
				$list_articles[$i]['id'] = $data['id'];
				$list_articles[$i]['title'] = strip_tags($data['title']);
				$list_articles[$i]['content'] = strip_tags($data['content']);
				$list_articles[$i]['published'] = $data['published'];
				$list_articles[$i]['created_at'] = $data['created_at'];
				$list_articles[$i]['updated_at'] = $data['updated_at'];
			}

			return View::view('admin/articles_dashboard', compact('request', 'title', 'list_articles'));
		}

		header('Location: '.Config::get('BASE_URL').'login');
		exit();
	}


	/*******************************************************************************************************************
	 * public function create()
	 *
	 * Allow admin to create an article
	 */
	public function create()
	{
		if(User::isLogged() && User::role() == 'admin')
		{
			$request = $this->request;
			$title = "Billet simple pour l'Alaska - Nouvel article";
			$errors = array();
			$success = array();

			// Form create
			if($request->hasPost('title') && $request->hasPost('article'))
			{
				$user_id = $_SESSION['user_id'];
				$article_title = $request->post('title');
				$article_content = $request->post('article');
				$article_publish = $request->post('publish');

				if(strlen($article_title) <= 512)
				{
					$article = new Article();
					$result = $article->create($user_id, $article_title, $article_content, $article_publish);
					if($result)
					{
						header('Location: '.Config::get('BASE_URL').'admin/articles/edit/'.$article->lastId());
						exit();
					}
					else
						$errors["Erreur lors de la création !"] = "Une erreur est survenue, veuillez réessayer.";
				}
				else
					$errors["Format du titre invalide !"] = "Le titre de l'article ne peut pas être supérieur à 512 caractères.";
			}

			return View::view('admin/articles_edit', compact('request', 'title', 'success', 'errors', 'article_title', 'article_content', 'article_publish'));
		}

		header('Location: '.Config::get('BASE_URL').'login');
		exit();
	}


	/*******************************************************************************************************************
	 * public function edit()
	 *
	 * Allow admin to edit an article
	 */
	public function edit()
	{
		$request = $this->request;
		if(User::isLogged() && User::role() == 'admin' && $request->hasParameter('id'))
		{
			$title = "Billet simple pour l'Alaska - Modifier un article";
			$errors = array();
			$success = array();

			$user_id = $_SESSION['user_id'];
			$article = new Article();
			$result = $article->getByUserId($user_id, $request->parameter('id'))->fetch_object();

			if($result === null)
			{
				header('Location: '.Config::get('BASE_URL').'admin/articles');
				exit();
			}

			$article_id = $result->id;
			$article_title = $result->title;
			$article_content = $result->content;
			$article_publish = $result->published;
			if($article_publish == 1)
				$article_publish = 'checked';
			else
				$article_publish = null;

			// Form create
			if($request->hasPost('title') && $request->hasPost('article'))
			{
				$article_title = $request->post('title');
				$article_content = $request->post('article');
				$article_publish = $request->post('publish');

				if(strlen($article_title) <= 512)
				{
					$article = new Article();
					$result = $article->update($user_id, $article_id, $article_title, $article_content, $article_publish);
					if($result)
					{
						$success["Article mis à jour !"] = "Les modifications ont bien étés prises en compte.";
					}
					else
						$errors["Erreur lors de la création !"] = "Une erreur est survenue, veuillez réessayer.";
				}
				else
					$errors["Format du titre invalide !"] = "Le titre de l'article ne peut pas être supérieur à 512 caractères.";
			}

			return View::view('admin/articles_edit', compact('request', 'title', 'success', 'errors', 'article_id', 'article_title', 'article_content', 'article_publish'));
		}

		header('Location: '.Config::get('BASE_URL').'login');
		exit();
	}


	/*******************************************************************************************************************
	 * public function delete()
	 *
	 * Delete an article
	 */
	public function delete()
	{
		if(User::isLogged() && User::role() == 'admin')
		{
			$request = $this->request;
			if($request->hasParameter('id'))
			{
				$user_id = $_SESSION['user_id'];
				$article_id = $request->parameter('id');

				$articles = new Article();
				$articles->delete($user_id, $article_id);
			}

			header('Location: '.Config::get('BASE_URL').'admin/articles');
			exit();
		}

		header('Location: '.Config::get('BASE_URL').'login');
		exit();
	}
}
