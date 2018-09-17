<?php
namespace Controllers;

use Lib\{Config, Controller, View};
use Models\User;

class AdminArticleController extends Controller
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
			$title = "Jean Forteroche - Gestion des articles";

			// Display articles dashboard
			return View::view('admin/articles_dashboard', compact('request', 'title'));
		}
		else
		{
			// Admin is not logged, redirect to login form
			header('Location: '.Config::get('BASE_URL').'admin/login');
			exit();
		}
	}


	/*******************************************************************************************************************
	 * public function create()
	 *
	 * Article creation
	 */
	public function create()
	{
		if(User::isLogged())
		{
			$request = $this->request;
			$title = "Jean Forteroche - Nouvel article";

			// Display articles dashboard
			return View::view('admin/articles_edit', compact('request', 'title'));
		}
		else
		{
			// Admin is not logged, redirect to login form
			header('Location: '.Config::get('BASE_URL').'admin/login');
			exit();
		}
	}
}
