<?php
namespace Lib;

abstract class Model
{
    private static $mysqli;

    protected function rawSQL($sql)
	{
		$res = $mysqli->query($sql);

        return $res;
    }

    private static function getMysqli()
	{
        if(self::$mysqli === null)
		{
            $host = Configuration::get("db_host");
            $user = Configuration::get("db_user");
            $password = Configuration::get("db_password");
			$database = Configuration::get("db_base");

            self::$mysqli = new mysqli($host, $user, $password, $database);

			if(self::$mysqli->connect_errno)
				throw new Exception("MySQLi : (" . self::$mysqli->connect_errno . ") " . self::$mysqli->connect_error);
        }

        return self::$mysqli;
    }
}
