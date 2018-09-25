<?php
namespace Controllers;

use Lib\{Config, Controller, View};
use Models\User;

class AdminUserController extends Controller
{
	/*******************************************************************************************************************
	 * public function index()
	 *
	 */
	public function index()
	{
		if(User::isLogged() && User::role() == 'admin')
		{
			$request = $this->request;
			$title = "Billet simple pour l'Alaska - Administration du blog";

			$users = new User();
			$q_users = $users->getAll();

			$users_list = array();
			foreach($q_users as $user)
			{
				if($user['role'] != 'admin')
					$users_list[] = $user;
			}

			return View::view('admin/users', compact('request', 'title', 'users_list'));
		}

		header('Location: '.Config::get('BASE_URL').'login');
		exit();
	}

	public function promote()
	{
		$request = $this->request;
		if(User::isLogged() && User::role() == 'admin' && $request->hasParameter('id'))
		{
			$user_id = $request->parameter('id');

			$users = new User();
			$users->promote($user_id);

			header('Location: '.Config::get('BASE_URL').'admin/users#user-'.$user_id);
			exit();
		}

		header('Location: '.Config::get('BASE_URL').'login');
		exit();
	}

	public function demote()
	{
		$request = $this->request;
		if(User::isLogged() && User::role() == 'admin' && $request->hasParameter('id'))
		{
			$user_id = $request->parameter('id');

			$users = new User();
			$users->demote($user_id);

			header('Location: '.Config::get('BASE_URL').'admin/users#user-'.$user_id);
			exit();
		}

		header('Location: '.Config::get('BASE_URL').'login');
		exit();
	}
}
