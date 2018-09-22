<?php
namespace Controllers;

use Lib\{Config, Controller, View};
use Models\User;

class AdminController extends Controller
{
	/*******************************************************************************************************************
	 * public function index()
	 *
	 * Back office dashboard
	 */
	public function index()
	{
		if(User::isLogged() && in_array(User::role(), ['admin', 'mod']))
		{
			$request = $this->request;
			$title = "Jean Forteroche - Administration du blog";

			return View::view('admin/dashboard', compact('request', 'title'));
		}

		header('Location: '.Config::get('BASE_URL').'login');
		exit();
	}
}
