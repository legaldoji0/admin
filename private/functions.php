<?php

function get_random_string($length) {
	$array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	$text = "";
	$length = rand(4, $length);

	for ($i=0; $i < $length; $i++) { 
		$random = rand(0, 61);
		$text .= $array[$random];
	}
	return $text;
}

function check_login($connection) {
	if (isset($_SESSION['url_address'])) {

		$id = $_SESSION['url_address'];
		$query = "select * from users where url_address = '$id' limit 1 ";

		$result = mysqli_query($connection, $query);
		if($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
 		}

	} else if ($_SESSION['url_address'] = "undefined") {
		header("Location: login.php");
		die;
	}
}