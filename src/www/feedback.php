<?php

/**
 * Save feedback data
 *
 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */

require_once(__DIR__ . '/../bootstrap.php');


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


/**
 * Get IP address of client
 */

$client_ip = $_SERVER['HTTP_CLIENT_IP'] ? $_SERVER['HTTP_CLIENT_IP'] : ($_SERVER['HTTP_X_FORWARDED_FOR'] ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);
$remote_addr = $_SERVER['REMOTE_ADDR'];


/**
 * Check is bot?
 */

$limit = 20;

$r = $db->query("SELECT COUNT(*) FROM feedbacks WHERE ((client_ip = '" . $client_ip . "' OR remote_addr = '" . $client_ip . "') OR (client_ip = '" . $remote_addr . "' OR remote_addr = '" . $remote_addr . "')) AND created_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR) LIMIT " . $limit);

if($r->fetch_array()[0] >= $limit) {
	http_response_code(429);
	echo 'Limit';
	die();
}


/**
 * Insert into database
 */

$r = $db->query("INSERT INTO feedbacks (name, email, message, client_ip, remote_addr) VALUES ('" . $db->real_escape_string($name) . "', '" . $db->real_escape_string($email) ."', '" . $db->real_escape_string($message) . "', '" . $db->real_escape_string($client_ip) . "', '" . $db->real_escape_string($remote_addr) . "')");

if($r === true) {
	http_response_code(201);
	echo 'Created';
	die();
}

