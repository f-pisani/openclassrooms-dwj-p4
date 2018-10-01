<?php
namespace Controllers;

use Lib\{Config, Controller, View};
use Models\{User, Article};

class AdminArticleController extends Controller
{
	/*******************************************************************************************************************
	 * public function index()
	 *
	 * Articles dashboard
	 */
	public function index()
	{
		if(User::isLogged() && User::role() == 'admin')
		{
			$request = $this->request;
			$title = "Billet simple pour l'Alaska - Gestion des articles";

			$articles = new Article();
			$q_articles = $articles->getAllByUserId(User::id());

			$articles_list = array();
			foreach($q_articles as $article)
				$articles_list[] = $article;

			return View::view('admin/articles_dashboard', compact('request', 'title', 'articles_list'));
		}

		header('Location: '.Config::get('BASE_URL').'login');
		exit();
	}


	/*******************************************************************************************************************
	 * public function create()
	 *
	 * Create an article
	 */
	public function create()
	{
		if(User::isLogged() && User::role() == 'admin')
		{
			$request = $this->request;
			$title = "Billet simple pour l'Alaska - Nouvel article";

			$errors = array();

			$articles = new Article();
			if($request->hasPost('title') && $request->hasPost('article'))
			{
				$article_title = $request->post('title');
				$article_content = $request->post('article');
				$article_publish = $request->post('publish');

				if($articles->validateTitle($article_title))
				{
					if($articles->create(User::id(), $article_title, $article_content, $article_publish))
					{
						header('Location: '.Config::get('BASE_URL').'admin/articles/edit/'.$articles->lastId());
						exit();
					}
					else
						$errors["Erreur lors de la création !"] = "Une erreur est survenue, veuillez réessayer.";
				}
				else
					$errors["Format du titre invalide !"] = "Le titre de l'article ne peut pas être supérieur à 256 caractères.";
			}

			return View::view('admin/articles_edit', compact('request', 'title', 'errors', 'article_title', 'article_content', 'article_publish'));
		}

		header('Location: '.Config::get('BASE_URL').'login');
		exit();
	}


	/*******************************************************************************************************************
	 * public function edit()
	 *
	 * Edit an article
	 */
	public function edit()
	{
		$request = $this->request;
		if(User::isLogged() && User::role() == 'admin' && $request->hasParameter('id'))
		{
			$title = "Billet simple pour l'Alaska - Modifier un article";

			$errors = array();
			$success = array();

			$articles = new Article();
			$q_articles = $articles->getByUserId(User::id(), $request->parameter('id'))->fetch_object();

			if($q_articles === null)
			{
				header('Location: '.Config::get('BASE_URL').'admin/articles');
				exit();
			}

			$article_id = $q_articles->id;
			$article_title = $q_articles->title;
			$article_content = $q_articles->content;
			$article_publish = $q_articles->published;
			if($article_publish == 1)
				$article_publish = 'checked';
			else
				$article_publish = null;


			if($request->hasPost('title') && $request->hasPost('article'))
			{
				$article_title = $request->post('title');
				$article_content = $request->post('article');
				$article_publish = $request->post('publish');

				if($articles->validateTitle($article_title))
				{
					if($articles->update(User::id(), $article_id, $article_title, $article_content, $article_publish))
						$success["Article mis à jour !"] = "Les modifications ont bien effectuées.";
					else
						$errors["Erreur lors de la création !"] = "Une erreur est survenue, veuillez réessayer.";
				}
				else
					$errors["Format du titre invalide !"] = "Le titre de l'article ne peut pas être supérieur à 256 caractères.";
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
				$article_id = $request->parameter('id');

				$articles = new Article();
				$articles->delete(User::id(), $article_id);
			}

			header('Location: '.Config::get('BASE_URL').'admin/articles');
			exit();
		}

		header('Location: '.Config::get('BASE_URL').'login');
		exit();
	}
}
