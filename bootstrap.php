<?php
session_start();

use Lib\Config;

/***********************************************************************************************************************
 * Database configuration
 */
Config::set('DB_HOST', 'localhost');
Config::set('DB_USER', 'root');
Config::set('DB_PWD', '');
Config::set('DB_BASE', 'oc_blog');


/***********************************************************************************************************************
 * Base URL of the APP
 */
Config::set('BASE_URL', 'http://ocblog:8080/');
Config::set('DEFAULT_TITLE', "Jean Forteroche - Billet simple pour l'Alaska");


/***********************************************************************************************************************
 * For developpement purpose only (false on production env)
 */
Config::set('APP_DEBUG', true);
