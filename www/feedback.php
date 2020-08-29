<?php

/**
 * Save feedback data
 *
 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */

require_once(__DIR__ . '/../src/bootstrap.php');


/**
 * Dont allow other methods
 */

if($_SERVER['REQUEST_METHOD'] !== 'POST') {
	http_response_code(405);
	include('405.html');
	die();
}


header('Content-Type: text/html; charset=utf-8');


/**
 * Get input data
 */

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];


/**
 * Normalize input data
 */

$name = is_string($name) ? trim($name) : '';
$email = is_string($email) ? trim($email) : '';
$message = is_string($message) ? trim($message) : '';


/**
 * Validate input data
 */

if(mb_strlen($name) <= 0 || mb_strlen($name) > 15) {
	http_response_code(400);
	echo 'Name length';
	die();
} else if(mb_strlen($email) <= 0 || mb_strlen($email) > 120) {
	http_response_code(400);
	echo 'Email length';
	die();
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	http_response_code(400);
	echo 'Email format';
	die();
} else if(mb_strlen($message) <= 0 || mb_strlen($message) > 1000) {
	http_response_code(400);
	echo 'Message length';
	die();
}


$r = $db->query("INSERT INTO feedbacks (name, email, message) VALUES ('" . $db->real_escape_string($name) . "', '" . $db->real_escape_string($email) ."', '" . $db->real_escape_string($message) . "')");

if($r === true) {
	http_response_code(201);
	echo 'Created';
	die();
}

