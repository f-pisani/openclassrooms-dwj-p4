<?php
namespace Controllers;

use Lib\{Config, Controller, View};
use Models\User;

class AdminController extends Controller
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
			$title = "Jean Forteroche - Administration du blog";

			// Display admin dashboard
			return View::view('admin/dashboard', compact('request', 'title'));
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
			$title = "Jean Forteroche - Connexion";
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
			return View::view('admin/login', compact('request', 'title', 'errors'));
		}
		else
		{
			// Admin is already logged, redirect to admin dashboard
			header('Location: '.Config::get('BASE_URL').'admin');
			exit();
		}
	}


	/*******************************************************************************************************************
	 * public function settings()
	 *
	 * Display settings view
	 */
	public function settings()
	{
		if(User::isLogged())
		{
			$request = $this->request;
			$title = "Jean Forteroche - Mon profil";
			$success = array();
			$errors = array();
			$user = new User();
			$user_id = $_SESSION['user_id'];

			// Form : Changes password
			if($request->hasPost('pwd_current') && $request->hasPost('pwd_new') && $request->hasPost('pwd_new_conf'))
			{
				$pwd_current = $user->escape_string($request->post('pwd_current'));
				$pwd_new = $user->escape_string($request->post('pwd_new'));
				$pwd_new_conf = $user->escape_string($request->post('pwd_new_conf'));

				// Test if current password is the good password
				if(password_verify($pwd_current, $_SESSION['user_password']))
				{
					// Check if new password match new password confirmation
					if($pwd_new === $pwd_new_conf)
					{
						$pwd_new = password_hash($pwd_new, PASSWORD_BCRYPT);

						// Update password
						if($user->updatePassword($user_id, $pwd_new))
						{
							// Success : Register a success message
							$_SESSION['user_password'] = $pwd_new;
							$success["Mot de passe modifié !"] = "Votre mot de passe a bien été modifié. Ne l'oubliez pas lors
							de votre prochaine connexion.";
						}
						else
							$errors["Erreur"] = "Une erreur est survenue, impossible de modifier le mot de passe. Veuillez
							réessayer.";
					}
					else
						$errors["Mot de passe différent !"] = "Les deux mots de passe ne correspondent pas.";
				}
				else
					$errors["Mot de passe erroné !"] = "Le mot de passe actuel ne correspond pas au mot de passe saisi.";
			}

			// Form : Changes display name
			if($request->hasPost('display_name') && $request->post('display_name') !== $_SESSION['user_displayName'])
			{
				$display_name = $request->post('display_name');
				if(preg_match("/^[A-Za-z0-9\- ]+$/", $display_name) && strlen($display_name) <= 256)
				{
					$display_name = $user->escape_string($display_name);
					if($user->updateDisplayName($user_id, $display_name))
					{
						$_SESSION['user_displayName'] = $display_name;
						$success["Nom d'auteur modifié !"] = "Votre nom d'auteur a bien été modifié.";
					}
					else
						$errors["Erreur"] = "Une erreur est survenue, impossible de modifier le nom d'auteur. Veuillez
						réessayer.";
				}
				else
					$errors["Nom d'auteur invalide !"] = "Le nom d'auteur ne peut contenir que des caractères alphanumériques,
					 des espaces ou des tirets. De plus il ne peut être plus grand que 256 caractères.";
			}

			// Display settings view
			return View::view('admin/settings', compact('request', 'title', 'success', 'errors'));
		}
		else
		{
			header('Location: '.Config::get('BASE_URL').'admin/login');
			exit();
		}
	}


	/*******************************************************************************************************************
	 * public function logout()
	 *
	 * Logout
	 */
	public function logout()
	{
		if(User::isLogged())
		{
			session_unset();
			session_destroy();
		}

		header('Location: '.Config::get('BASE_URL').'admin/login');
		exit();
	}
}
