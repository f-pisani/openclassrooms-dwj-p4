<?php
require_once '../autoload.php';
require_once '../bootstrap.php';

use Lib\Route;

/***********************************************************************************************************************
 * FRONT OFFICE
 */
Route::error404('HomeController@error404');
Route::any('/', 'HomeController@index');
Route::any('/register', 'AuthController@register');
Route::any('/login', 'AuthController@login');
Route::any('/profil', 'AuthController@profil');
Route::any('/logout', 'AuthController@logout');
Route::any('/articles/{id}', 'HomeController@show')->where(['id' => '[0-9]+']);
Route::any('/report/{article_id}/{comment_id}', 'HomeController@report')->where(['article_id' => '[0-9]+', 'comment_id' => '[0-9]+']);



/***********************************************************************************************************************
 * BACK OFFICE
 */
// Admin
Route::any('/admin', 'AdminController@index'); // Dashboard

// Admin : Articles
Route::any('/admin/articles', 'AdminArticleController@index'); // Listing
Route::any('/admin/articles/create', 'AdminArticleController@create'); // Create
Route::any('/admin/articles/edit/{id}', 'AdminArticleController@edit')->where(['id' => '[0-9]+']); // Edit
Route::any('/admin/articles/delete/{id}', 'AdminArticleController@delete')->where(['id' => '[0-9]+']); // Delete

// Admin : Comments
Route::any('/admin/comments', 'AdminCommentController@index'); // Listing
Route::any('/admin/comments/list/{id}', 'AdminCommentController@list')->where(['id' => '[0-9]+']); // List comments for an article
Route::any('/admin/comments/delete/{id}/{article_id}', 'AdminCommentController@delete')->where(['id' => '[0-9]+', 'article_id' => '[0-9]+']); // Delete

Route::execute();
