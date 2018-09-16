<?php
namespace Controllers;

use Lib\{Configuration, Controller, View};

class AdminController extends Controller
{
	public function index()
	{

	}

	public function login()
	{
		$request = $this->request;

		return View::view('admin/login', compact('request'));
	}
}
