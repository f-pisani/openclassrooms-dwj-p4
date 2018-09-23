<?php
namespace Models;

use Lib\{Configuration, Model};

class Comment extends Model
{
	public function create($article_id, $content, $user_id)
	{
		$article_id = $this->escape_string($article_id);
		$content = $this->escape_string($content);
		$user_id = $this->escape_string($user_id);

		return $this->rawSQL("INSERT INTO comments VALUES(null, '$content', '". time() ."', '$article_id', '$user_id')");
	}

	public function report($user_id, $comment_id)
	{
		$user_id = $this->escape_string($user_id);
		$comment_id = $this->escape_string($comment_id);

		return $this->rawSQL("INSERT INTO comment_report VALUES(null, '$user_id', '$comment_id')");
	}

	public function delete($id)
	{
		$id = $this->escape_string($id);

		return $this->rawSQL("DELETE FROM comments WHERE id = '$id'");
	}

	public function get($article_id, $comment_id)
	{
		$article_id = $this->escape_string($article_id);
		$comment_id = $this->escape_string($comment_id);
		$query = "SELECT C.*, U.display_name AS nickname
				  FROM comments C, users U
				  WHERE C.post_id = '$article_id' AND C.id = '$comment_id' AND C.user_id = U.id";

		return $this->rawSQL($query);
	}

	public function getAll($article_id)
	{
		$article_id = $this->escape_string($article_id);
		$query = "SELECT C.*, U.display_name AS nickname
		          FROM comments C, users U
				  WHERE C.post_id = '$article_id' AND C.user_id = U.id ORDER BY created_at DESC";

		return $this->rawSQL($query);
	}

	public function getReportedComments($article_id)
	{
		$article_id = $this->escape_string($article_id);
		$comments = $this->getAll($article_id);
		foreach($comments as $comment)
		{
			$comment[]
		}

		return $comments;
	}
}
