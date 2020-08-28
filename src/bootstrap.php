<?php

/**
 * Bootstrap file
 *
 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */



/**
 * Environment
 */

$env = dirname(__DIR__) . '/env.json';
$env = file_get_contents($env);
$env = json_decode($env, true);


/**
 * Error reporting
 */

if($env['env'] === 'development') {
	error_reporting(E_ALL & ~E_NOTICE);
	ini_set('display_errors', 1);
}


/**
 * Database
 */

require_once(__DIR__ . '/../src/db.php');

