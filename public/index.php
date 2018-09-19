<?php
require_once '../autoload.php';
require_once '../bootstrap.php';

use Lib\Route;

/***********************************************************************************************************************
 * FRONT OFFICE
 */
Route::get('/', 'HomeController@index');
//Route::get('/articles', 'ArticleController@index');
//Route::get('/articles/{id}', 'ArticleController@show')->where(['id' => '[0-9]+']);


/***********************************************************************************************************************
 * BACK OFFICE
 */
// Admin
Route::any('/admin', 'AdminController@index'); // Dashboard
Route::any('/admin/login', 'AdminController@login'); // Login
Route::any('/admin/logout', 'AdminController@logout'); // Logout
Route::any('/admin/settings', 'AdminController@settings'); // Settings

// Admin : Articles
Route::any('/admin/articles', 'AdminArticleController@index'); // Listing
Route::any('/admin/articles/create', 'AdminArticleController@create'); // Create
Route::any('/admin/articles/edit/{id}', 'AdminArticleController@edit')->where(['id' => '[0-9]+']); // Edit
Route::any('/admin/articles/delete/{id}', 'AdminArticleController@delete')->where(['id' => '[0-9]+']); // Delete

// Admin : Comments
Route::any('/admin/comments', 'AdminCommentController@index'); // Listing
Route::any('/admin/comments/delete/{id}', 'AdminCommentController@delete')->where(['id' => '[0-9]+']); // Delete

Route::execute();
