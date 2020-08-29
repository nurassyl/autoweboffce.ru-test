<?php

/**
 * Database seeder
 *
 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */

require_once(__DIR__ . '/src/db.php');


/**
 * Create `users` table
 */

$db->query(
<<<QUERY
CREATE TABLE IF NOT EXISTS users
(
id BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(15) NOT NULL,
username VARCHAR(36) NOT NULL,
password CHAR(64) NOT NULL,
is_admin BOOLEAN NOT NULL DEFAULT FALSE,
created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
client_ip VARCHAR(50),
remote_addr VARCHAR(50)
)
QUERY
);


/**
 * Create `feedbacks` table
 */

$db->query(
<<<QUERY
CREATE TABLE IF NOT EXISTS feedbacks
(
id BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(15) NOT NULL,
email VARCHAR(120) NOT NULL,
message VARCHAR(1000) NOT NULL,
created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
client_ip VARCHAR(50),
remote_addr VARCHAR(50)
)
QUERY
);


/**
 * Create admin
 */

$db->query(
<<<QUERY
INSERT INTO users (name, username, password, is_admin, client_ip, remote_addr) VALUES ('Admin', 'admin', SHA2('admin1234567890', 256), TRUE, '127.0.0.1', '127.0.0.1');
QUERY
);

