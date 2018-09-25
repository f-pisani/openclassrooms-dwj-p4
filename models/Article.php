<?php
namespace Models;

use Lib\{Configuration, Model};

class Article extends Model
{
	/*******************************************************************************************************************
	 * public function create($user_id, $title, $content, $publish)
	 *
	 * Create an article
	 */
	public function create($user_id, $title, $content, $publish)
	{
		$user_id = $this->escape_string($user_id);
		$title = $this->escape_string($title);
		$content = $this->escape_string($content);
		$time = $this->escape_string(time());

		if($publish !== null)
			$publish = 1;
		else
			$publish = 0;

		return $this->rawSQL("INSERT INTO posts VALUES(null, '$title', '$content', '$publish', '$time', '$time', '$user_id')");
	}


	/*******************************************************************************************************************
	 * public function update($user_id, $article_id, $title, $content, $publish)
	 *
	 * Update an article (edit)
	 */
	public function update($user_id, $article_id, $title, $content, $publish)
	{
		$user_id = $this->escape_string($user_id);
		$article_id = $this->escape_string($article_id);
		$title = $this->escape_string($title);
		$content = $this->escape_string($content);
		$time = $this->escape_string(time());
		if($publish !== null)
			$publish = 1;
		else
			$publish = 0;

		return $this->rawSQL("UPDATE posts SET title = '$title',
											   content = '$content',
											   published='$publish',
											   updated_at = '$time'
							 WHERE user_id = '$user_id' AND id = '$article_id'");
	}


	/*******************************************************************************************************************
	 * public function delete($user_id, $article_id)
	 *
	 * Delete an article
	 */
	public function delete($user_id, $article_id)
	{
		$user_id = $this->escape_string($user_id);
		$article_id = $this->escape_string($article_id);

		return $this->rawSQL("DELETE FROM posts WHERE user_id = '$user_id' AND id = '$article_id'");
	}


	/*******************************************************************************************************************
	 * public function lastId()
	 *
	 * Last INSERT request id auto
	 */
	public function lastId()
	{
		return $this->getMysqli()->insert_id;
	}


	/*******************************************************************************************************************
	 * public function getAllByUserId($user_id)
	 *
	 * Retrieves all articles for a specific user
	 */
	public function getAllByUserId($user_id)
	{
		$user_id = $this->escape_string($user_id);

		return $this->rawSQL("SELECT * FROM posts WHERE user_id = '$user_id' ORDER BY created_at DESC");
	}


	/*******************************************************************************************************************
	 * public function getByUserId($user_id, $article_id)
	 *
	 * Retrieves a specific article for a specific user
	 */
	public function getByUserId($user_id, $article_id)
	{
		$user_id = $this->escape_string($user_id);
		$article_id = $this->escape_string($article_id);

		return $this->rawSQL("SELECT * FROM posts WHERE user_id = '$user_id' AND id = '$article_id'");
	}


	/*******************************************************************************************************************
	 * public function getAll()
	 *
	 * Retrieves all articles published
	 */
	public function getAll()
	{
		$query = "SELECT P.*, U.display_name AS user_displayName
		          FROM posts P, users U
				  WHERE P.user_id = U.id AND P.published = 1 ORDER BY P.created_at DESC";

		return $this->rawSQL($query);
	}


	/*******************************************************************************************************************
	 * public function getAll()
	 *
	 * Retrieves a specific article published
	 */
	public function get($article_id)
	{
		$article_id = $this->escape_string($article_id);
		$query = "SELECT P.*, U.display_name AS user_displayName
		          FROM posts P, users U
				  WHERE P.user_id = U.id AND P.published = 1 AND P.id = '$article_id'";

		return $this->rawSQL($query);
	}
}
