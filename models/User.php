<?php
namespace Models;

use Lib\{Configuration, Model};

class User extends Model
{
	/*******************************************************************************************************************
	 * public function create($email, $nickname, $pwd)
	 *
	 * Create a new user in database
	 *
	 * Return true if success; false otherwise
	 */
	public function create($email, $nickname, $pwd)
	{
		$email = $this->escape_string($email);
		$nickname = $this->escape_string($nickname);
		$pwd = password_hash($this->escape_string($pwd), PASSWORD_BCRYPT);

		return $this->rawSQL("INSERT INTO users VALUES(null, '$email', 'user', '$pwd', '$nickname', '".time()."', '".time()."')");
	}


	/*******************************************************************************************************************
	 * public function updatePassword($user_id, $pwd_new)
	 *
	 * Update user password
	 *
	 * Return true if success; false otherwise
	 */
	public function updatePassword($user_id, $pwd_new)
	{
		$pwd_new = password_hash($this->escape_string($pwd_new), PASSWORD_BCRYPT);

		if($this->rawSQL("UPDATE users SET password = '$pwd_new', updated_at = '".time()."' WHERE id = '$user_id'"))
		{
			$_SESSION['user_password'] = $pwd_new;
			return true;
		}

		return false;
	}


	/*******************************************************************************************************************
	 * public function updateDisplayName($user_id, $display_name)
	 *
	 * Update user nickname
	 *
	 * Return true if success; false otherwise
	 */
	public function updateDisplayName($user_id, $display_name)
	{
		$display_name = $this->escape_string($display_name);

		if($this->rawSQL("UPDATE users SET display_name = '$display_name', updated_at = '".time()."' WHERE id = '$user_id'"))
		{
			$_SESSION['user_displayName'] = $display_name;
			return true;
		}

		return false;
	}


	/*******************************************************************************************************************
	 * public function getReportedComments($user_id)
	 *
	 * Return user reports
	 */
	public function getReportedComments($user_id)
	{
		return $this->rawSQL("SELECT comment_id FROM comment_reports WHERE user_id = '$user_id'");
	}


	/*******************************************************************************************************************
	 * public function auth($email, $pwd)
	 *
	 * Connect an user with his $email and $pwd
	 *
	 * Return true if success; false otherwise
	 */
	public function auth($email, $pwd)
	{
		$email = $this->escape_string($email);
		$pwd = $this->escape_string($pwd);

		$result = $this->rawSQL("SELECT * FROM users WHERE email = '$email'");
		if($result->num_rows === 1)
		{
			$user_row = $result->fetch_object();
			if(password_verify($pwd, $user_row->password))
			{
				$_SESSION['user_id'] = $user_row->id;
				$_SESSION['user_email'] = $user_row->email;
				$_SESSION['user_role'] = $user_row->role;
				$_SESSION['user_password'] = $user_row->password;
				$_SESSION['user_displayName'] = $user_row->display_name;
				$_SESSION['user_createdAt'] = $user_row->created_at;
				$_SESSION['user_updatedAt'] = $user_row->updated_at;

				return true;
			}
		}

		return false;
	}


	/*******************************************************************************************************************
	 * public function getAll()
	 *
	 * Retrieves all users account data
	 */
	public function getAll()
	{
		return $this->rawSQL("SELECT U.*,
			                         (SELECT count(id) FROM comments WHERE user_id = U.id) AS comments_count,
									 (SELECT count(id) FROM comment_reports WHERE user_id = U.id) AS reports_count
		                      FROM users U
							  GROUP BY U.id");
	}


	/*******************************************************************************************************************
	 * public function promote($user_id)
	 *
	 * Promote user moderator
	 */
	public function promote($user_id)
	{
		$user_id = $this->escape_string($user_id);

		return $this->rawSQL("UPDATE users SET role = 'mod', updated_at = '".time()."' WHERE id = '$user_id'");
	}


	/*******************************************************************************************************************
	 * public function demote($user_id)
	 *
	 * Demote moderator to user
	 */
	public function demote($user_id)
	{
		$user_id = $this->escape_string($user_id);

		return $this->rawSQL("UPDATE users SET role = 'user', updated_at = '".time()."' WHERE id = '$user_id'");
	}


	/*******************************************************************************************************************
	 * public static function isLogged()
	 *
	 * Return true if user is logged; false otherwise
	 */
	public static function isLogged()
	{
		return (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']));
	}

	/*******************************************************************************************************************
	 * public static function id()
	 *
	 * Return user id; null otherwise
	 */
	public static function id()
	{
		return $_SESSION['user_id'] ?? null;
	}


	/*******************************************************************************************************************
	 * public static function email()
	 *
	 * Return user email; null otherwise
	 */
	public static function email()
	{
		return $_SESSION['user_email'] ?? null;
	}


	/*******************************************************************************************************************
	 * public static function role()
	 *
	 * Return user role; null otherwise
	 */
	public static function role()
	{
		return $_SESSION['user_role'] ?? null;
	}


	/*******************************************************************************************************************
	 * public static function password()
	 *
	 * Return user password (hash); null otherwise
	 */
	public static function password()
	{
		return $_SESSION['user_password'] ?? null;
	}


	/*******************************************************************************************************************
	 * public static function nickname()
	 *
	 * Return user nickname; null otherwise
	 */
	public static function nickname()
	{
		return $_SESSION['user_displayName'] ?? null;
	}
}
