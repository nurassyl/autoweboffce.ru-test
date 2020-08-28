<?php

/**
 * Index file
 *
 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */

require_once(__DIR__ . '/../src/db.php');


$title = 'Title';
ob_start();
include(__DIR__ . '/../src/views/index.phtml');
$content = ob_get_clean();

include(__DIR__ . '/../src/views/layout/index.phtml');

