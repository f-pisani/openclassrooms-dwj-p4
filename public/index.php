<?php
require_once '../autoload.php';
require_once '../bootstrap.php';

use Lib\Route;

/***********************************************************************************************************************
 * Blog
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
Route::any('/admin/settings', 'AdminController@settings'); // Settings
Route::any('/admin/logout', 'AdminController@logout'); // Logout

// Admin : Articles
Route::any('/admin/articles', 'AdminArticleController@index'); // Articles dashboard
Route::any('/admin/articles/create', 'AdminArticleController@create'); // Create a new article
Route::any('/admin/articles/edit/{id}', 'AdminArticleController@edit')->where(['id' => '[0-9]+']); // Edit an article
Route::any('/admin/articles/delete/{id}', 'AdminArticleController@delete')->where(['id' => '[0-9]+']); // Delete an article

// Admin : Commentaires
Route::any('/admin/comments', 'AdminCommentController@index'); // Comments dashboard
//Route::any('/admin/comments/delete/{id}', 'AdminCommentController@delete')->where(['id' => '[0-9]+']); // Delete a comment

Route::execute();
