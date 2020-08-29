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
 * String encoding
 */

mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
mb_http_input('UTF-8');
mb_regex_encoding('UTF-8');


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

