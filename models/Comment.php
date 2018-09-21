<?php
namespace Models;

use Lib\{Configuration, Model};

class Comment extends Model
{
	public function create($article_id, $nickname, $content)
	{
		$article_id = $this->escape_string($article_id);
		$nickname = $this->escape_string($nickname);
		$content = $this->escape_string($content);

		return $this->rawSQL("INSERT INTO comments VALUES(null, '$nickname', '$content', '". time() ."', '0', '$article_id')");
	}

	public function report($article_id, $comment_id)
	{
		$article_id = $this->escape_string($article_id);
		$comment_id = $this->escape_string($comment_id);

		return $this->rawSQL("UPDATE comments SET reported_counter = reported_counter+1 WHERE post_id = '$article_id' AND id = '$comment_id'");
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

		return $this->rawSQL("SELECT * FROM comments WHERE post_id = '$article_id' AND id = '$comment_id'");
	}

	public function getAll($article_id)
	{
		$article_id = $this->escape_string($article_id);

		return $this->rawSQL("SELECT * FROM comments WHERE post_id = '$article_id' ORDER BY created_at DESC");
	}

	public function getAllOrderByReport($article_id)
	{
		$article_id = $this->escape_string($article_id);

		return $this->rawSQL("SELECT * FROM comments WHERE post_id = '$article_id' ORDER BY reported_counter DESC, created_at");
	}
}
