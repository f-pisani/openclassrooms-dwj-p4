<?php
namespace Models;

use Lib\{Configuration, Model};

class Comment extends Model
{
	public function delete($id)
	{
		$id = $this->escape_string($id);

		return $this->rawSQL("DELETE FROM comments WHERE id = '$id'");
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
