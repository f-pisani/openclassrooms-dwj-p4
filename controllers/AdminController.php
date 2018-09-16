<?php
namespace Controllers;

use Lib\{Config, Controller, View};
use Models\User;

class AdminController extends Controller
{
	public function index()
	{
		if(User::isLogged())
		{
			$request = $this->request;

			// Display admin dashboard
			return View::view('admin/dashboard', compact('request'));
		}
		else
		{
			// Admin is not logged, redirect to login form
			header('Location: '.Config::get('BASE_URL').'admin/login');
			exit();
		}
	}


	/*******************************************************************************************************************
	 * public function login()
	 *
	 * Display and handle admin login form
	 */
	public function login()
	{
		if(!User::isLogged())
		{
			$request = $this->request;
			$errors = array();

			// Traitement formulaire de connexion
			if($request->hasPost('email') && $request->hasPost('pwd'))
			{
				$email = $request->post('email');
				$pwd = $request->post('pwd');

				$user = new User();
				if($user->auth($email, $pwd))
				{
					// Auth success ; Redirect to admin dashboard
					header('Location: '.Config::get('BASE_URL').'admin');
					exit();
				}
				else
				{
					// Auth failure ; Display error message
					$errors["Connexion impossible !"] = "Identifiants invalides, vérifiez que vous avez les droits nécessaires.";
				}
			}

			// Display admin login form
			return View::view('admin/login', compact('request', 'errors'));
		}
		else
		{
			// Admin is already logged, redirect to admin dashboard
			header('Location: '.Config::get('BASE_URL').'admin');
			exit();
		}
	}
}
