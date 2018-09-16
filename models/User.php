<?php
namespace Models;

use Lib\{Configuration, Model};

class User extends Model
{
	public function auth($email, $pwd)
	{
		$email = $this->escape_string($email);
		$pwd = $this->escape_string($pwd);

		$result = $this->rawSQL("SELECT * FROM users WHERE email = '$email'");
		if($result->num_rows === 1)
		{
			$user_record = $result->fetch_object();
			if(password_verify($pwd, $user_record->password))
			{
				$_SESSION['user_id'] = $user_record->id;
				$_SESSION['user_email'] = $user_record->email;
				$_SESSION['user_password'] = $user_record->password;
				$_SESSION['user_displayName'] = $user_record->display_name;

				return true;
			}
		}

		return false;
	}

	public function updatePassword($user_id, $pwd_new)
	{
		return $this->rawSQL("UPDATE users SET password = '$pwd_new' WHERE id = $user_id");
	}

	public function updateDisplayName($user_id, $display_name)
	{
		return $this->rawSQL("UPDATE users SET display_name = '$display_name' WHERE id = $user_id");
	}

	public static function isLogged()
	{
		return (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']));
	}
}
