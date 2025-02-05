<?php

define('DB_NAME', 'litsuran_portugueseay');
define('DB_USER', 'litsuran_gueset');
define('DB_PASS', 'prakhar*596');
define('DB_HOST', 'localhost');

if(!$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)) {
	die("Failed to connect");
}else{
	// echo 'done';
}
