<?php
namespace Controllers;

use Lib\{Config, Controller, View};
use Models\{User};

class AuthController extends Controller
{
	/*******************************************************************************************************************
	 * public function register()
	 *
	 * Registration form
	 */
	public function register()
	{
		if(!User::isLogged())
		{
			$request = $this->request;
			$users = new User();

			$title = "Billet simple pour l'Alaska - Inscription";
			$data = array();
			$errors = array();
			$success = array();

			if($request->hasPost('email') && $request->hasPost('nickname') &&
			   $request->hasPost('pwd') && $request->hasPost('pwd_conf'))
			{
				$data['email'] = trim($request->post('email'));
				$data['nickname'] = trim($request->post('nickname'));
				$data['pwd'] = $request->post('pwd');
				$data['pwd_conf'] = $request->post('pwd_conf');

				if(!$users->validateEmail($data['email']))
					$errors["Email invalide !"] = "Le format de l'adresse email n'est pas valide. Format: exemple@fai.ext";

				if(!$users->validateNickname($data['nickname']))
					$errors["Pseudonyme invalide !"] = "Le pseudonyme ne peut contenir que des caractères alphanumériques,
					                                    des espaces ou des tirets. Il doit faire entre 3 et 42 caractères.";

				if($data['pwd'] != $data['pwd_conf'])
					$errors["Mots de passe différents !"] = "Les deux mots de passe saisis ne correspondent pas.";

				$result = null;
				if(count($errors) == 0)
				{
					$result = $users->create($data['email'], $data['nickname'], $data['pwd']);

					if($result == false)
						$errors["Ce compte existe déjà !"] = "L'adresse email ou le pseudonyme sont déjà utilisés.";
					else
						$success["Création réussie !"] = "Vous pouvez désormais vous connecter et déposer des commentaires.";
				}
			}

			return View::view('register', compact('request', 'title', 'data', 'success', 'errors'));
		}

		header('Location: '.Config::get('BASE_URL'));
		exit();
	}


	/*******************************************************************************************************************
	 * public function login()
	 *
	 * Login form
	 */
	public function login()
	{
		if(!User::isLogged())
		{
			$request = $this->request;
			$user = new User();

			$title = "Billet simple pour l'Alaska - Connexion";
			$data = array();
			$errors = array();
			$success = array();

			if($request->hasPost('email') && $request->hasPost('pwd'))
			{
				$data['email'] = $request->post('email');
				$data['pwd'] = $request->post('pwd');

				if($user->auth($data['email'], $data['pwd']))
				{
					if(in_array(User::role(), ['admin', 'mod']))
					{
						header('Location: '.Config::get('BASE_URL').'admin');
						exit();
					}

					header('Location: '.Config::get('BASE_URL'));
					exit();
				}
				else
					$errors["Connexion impossible !"] = "Identifiants invalides. Vérifiez que vous avez bien crée un compte
					                                     au préalable.";
			}

			return View::view('login', compact('request', 'title', 'data', 'success', 'errors'));
		}

		header('Location: '.Config::get('BASE_URL'));
		exit();
	}


	/*******************************************************************************************************************
	 * public function profil()
	 *
	 * Changes account settings
	 */
	public function profil()
	{
		if(User::isLogged())
		{
			$request = $this->request;
			$user = new User();

			$title = "Billet simple pour l'Alaska - Mon profil";
			$success = array();
			$errors = array();

			// Changes password requested
			if($request->hasPost('pwd_current') && $request->hasPost('pwd_new') && $request->hasPost('pwd_new_conf'))
			{
				$pwd_current = $user->escape_string($request->post('pwd_current'));
				$pwd_new = $request->post('pwd_new');
				$pwd_new_conf = $request->post('pwd_new_conf');

				// Test if current password is the good password
				if(password_verify($pwd_current, User::password()))
				{
					// Check if new password match new password confirmation
					if($pwd_new === $pwd_new_conf)
					{
						if($user->updatePassword(User::id(), $pwd_new))
						{
							$success["Mot de passe modifié !"] = "Votre mot de passe a bien été modifié. Ne l'oubliez pas lors
							de votre prochaine connexion.";
						}
						else
							$errors["Erreur"] = "Une erreur est survenue, impossible de modifier le mot de passe. Veuillez
							réessayer.";
					}
					else
						$errors["Mots de passe différents !"] = "Les deux mots de passe saisis ne correspondent pas.";
				}
				else
					$errors["Mot de passe erroné !"] = "Le mot de passe actuel ne correspond pas au mot de passe saisi.";
			}

			// Changes display name requested
			if($request->hasPost('display_name') && $request->post('display_name') !== User::nickname())
			{
				$display_name = trim($request->post('display_name'));
				if($users->validateNickname($display_name))
				{
					if($user->updateDisplayName(User::id(), $display_name))
						$success["Pseudonyme modifié !"] = "Votre pseudonyme a bien été mis à jour.";
					else
						$errors["Pseudonyme indisponible !"] = "Ce pseudonyme est déjà utilisé par un autre utilisateur.";
				}
				else
				$errors["Pseudonyme invalide !"] = "Le pseudonyme ne peut contenir que des caractères alphanumériques,
													des espaces ou des tirets. Il doit faire entre 3 et 42 caractères.";
			}

			return View::view('profil', compact('request', 'title', 'success', 'errors'));
		}
		else
		{
			header('Location: '.Config::get('BASE_URL').'login');
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
 			// Session is cleared
 			session_unset();
 			session_destroy();
 		}

 		header('Location: '.Config::get('BASE_URL'));
 		exit();
 	}
}
