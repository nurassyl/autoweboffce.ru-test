<?php

/**
 * PHPInfo file
 *
 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */

require_once(__DIR__ . '/../src/bootstrap.php');


if($env['env'] === 'development') {
	phpinfo();
} else {
	http_response_code(403);
	include('404.html'); // provide your own HTML for the error page
	die();
}

