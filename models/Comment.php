<?php
namespace Models;

use Lib\{Configuration, Model};

class Comment extends Model
{
	/*******************************************************************************************************************
	 * public function create($article_id, $content, $user_id)
	 *
	 * Create a new comment
	 */
	public function create($article_id, $content, $user_id)
	{
		$article_id = $this->escape_string($article_id);
		$content = $this->escape_string($content);
		$user_id = $this->escape_string($user_id);

		return $this->rawSQL("INSERT INTO comments VALUES(null, '$content', '0', '". time() ."', '$article_id', '$user_id')");
	}


	/*******************************************************************************************************************
	 * public function report($user_id, $comment_id)
	 *
	 * Report a comment
	 */
	public function report($user_id, $comment_id)
	{
		$user_id = $this->escape_string($user_id);
		$comment_id = $this->escape_string($comment_id);

		return $this->rawSQL("INSERT INTO comment_reports VALUES(null, '$user_id', '$comment_id')");
	}


	/*******************************************************************************************************************
	 * public function delete($id)
	 *
	 * Delete a comment
	 */
	public function delete($id)
	{
		$id = $this->escape_string($id);
		$this->rawSQL("DELETE FROM comment_reports WHERE comment_id = '$id'");

		return $this->rawSQL("UPDATE comments SET toDelete = '1' WHERE id = '$id'");
	}


	/*******************************************************************************************************************
	 * public function get($article_id, $comment_id)
	 *
	 * Retrieves a specific comment
	 */
	public function get($article_id, $comment_id)
	{
		$article_id = $this->escape_string($article_id);
		$comment_id = $this->escape_string($comment_id);
		$query = "SELECT C.*, U.display_name AS nickname, COUNT(R.id) AS reported_counter
				  FROM comments C, users U, comment_reports R
				  WHERE C.toDelete = '0' AND C.post_id = '$article_id' AND C.id = '$comment_id' AND R.comment_id = C.id AND C.user_id = U.id";

		return $this->rawSQL($query);
	}


	/*******************************************************************************************************************
	 * public function getAll($article_id)
	 *
	 * Retrieves all comments for an article
	 */
	public function getAll($article_id)
	{
		$article_id = $this->escape_string($article_id);
		$query = "SELECT C.id, C.*, U.display_name AS nickname, (SELECT COUNT(id) FROM comment_reports WHERE comment_id = C.id) AS reported_counter
				  FROM comments C, users U
				  WHERE C.toDelete = '0'
				  AND C.post_id = '$article_id'
				  AND C.user_id = U.id
				  GROUP BY C.id
				  ORDER BY C.created_at DESC";

		return $this->rawSQL($query);
	}


	/*******************************************************************************************************************
	 * public function countCommentsByArticle($article_id)
	 *
	 * Count number of comments for an article
	 */
	public function countCommentsByArticle($article_id)
	{
		$article_id = $this->escape_string($article_id);

		return $this->rawSQL("SELECT COUNT(*) AS counter FROM comments WHERE toDelete = '0' AND post_id = '$article_id'");
	}


	/*******************************************************************************************************************
	 * public function countCommentsReportedByArticle($article_id)
	 *
	 * Count number of comments reported for an article
	 */
	public function countCommentsReportedByArticle($article_id)
	{
		$comments = $this->getAll($article_id);
		$commentsId_list = array();
		foreach($comments as $comment)
			$commentsId_list[] = "'".$comment['id']."'";

		$in = implode(',', $commentsId_list);

		return $this->rawSQL("SELECT COUNT(*) AS counter FROM comment_reports WHERE comment_id IN ($in)");
	}
}
