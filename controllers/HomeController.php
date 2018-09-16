<?php
namespace Controllers;

use Lib\{Configuration, Controller, View};

class HomeController extends Controller
{
	public function index()
	{
		echo "HomeController::index executed.<br>";

		$request = $this->request;
		return View::view('home', compact('request'));
	}
}
