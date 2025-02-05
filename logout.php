<?php

session_start();
require "./private/database.php";
require "./private/functions.php";

setcookie("legaldoji_user_id", "", time() - 3600, '/');
setcookie("legaldoji_user_email", "", time() - 3600, '/');

header("Location: ./login.php");
die;