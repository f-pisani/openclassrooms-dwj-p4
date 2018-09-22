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

		return $this->rawSQL("INSERT INTO users VALUES(null, '$email', 'user', '$pwd', '$nickname')");
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

		if($this->rawSQL("UPDATE users SET password = '$pwd_new' WHERE id = '$user_id'"))
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
		
		if($this->rawSQL("UPDATE users SET display_name = '$display_name' WHERE id = '$user_id'"))
		{
			$_SESSION['user_displayName'] = $display_name;
			return true;
		}

		return false;
	}


	/*******************************************************************************************************************
	 * public function getDisplayName($user_id)
	 *
	 * Return user nicknam or false
	 */
	public function getDisplayName($user_id)
	{
		return $this->rawSQL("SELECT display_name FROM users WHERE id = '$user_id'")->fetch_assoc()['display_name'];
	}


	/*******************************************************************************************************************
	 * public static function auth($email, $pwd)
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

				return true;
			}
		}

		return false;
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
