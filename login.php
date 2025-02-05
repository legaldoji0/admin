<?php 

session_start();
require "./private/database.php";
require "./private/functions.php";

$error = "";

if (isset($_COOKIE['legaldoji_user_id']) && isset($_COOKIE['legaldoji_user_email'])) {
    header("Location: ./client-dashboard/dashboard.php");
    die;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$date = date("Y-m-d H:i:s");
	$user_id = get_random_string(60);

	$user_email = addslashes($_POST['user_email']);
	$raw_password = addslashes($_POST['password']);

	sleep(1);

		$password = password_hash($raw_password, PASSWORD_DEFAULT);

		if ($error === "") {
			$query = "select * from admin_users_data where user_email = '$user_email' limit 1";
			$result = mysqli_query($connection, $query);
			if (mysqli_num_rows($result) === 0)
			{
				$error .= "<div class='error'>
					The user doesn't exists
				</div>";
			}
		}

		if($error === "") {

			$query = "select * from admin_users_data where user_email = '$user_email' limit 1";
			$result = mysqli_query($connection, $query);

			if ($result)
			{
				if ($result && mysqli_num_rows($result) > 0)
				{
					$user_data = mysqli_fetch_assoc($result);
					if (password_verify($raw_password, $user_data['password']))
					{
						setcookie("legaldoji_user_id", $user_data['user_id'], time() + (86400 * 30), '/');
						setcookie("legaldoji_user_email", $user_data['user_email'], time() + (86400 * 30), '/');
                        header("Location: ./client-dashboard/dashboard.php");
                        die;
					} else {
						$error .= "<div class='error'>
									Incorrect user credentials
									</div>";
					}
				}
			}
		}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LegalDoji | Home</title>

    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/general.css">
    <link rel="stylesheet" href="./styles/mediaq.css">
    <link rel="stylesheet" href="./styles/responsive.css">

</head>
<body>

    <!-- Header Start -->
    <header class="col-12 just-cnt-cent align-itm-cent">
        <div class="cont col-12 just-cnt-spbw align-itm-cent">
            <div class="h-logo just-cnt-spbw align-itm-cent">
                <img src="./images/h-logo-dark.png" alt="Logo" class="just-cnt-spbw align-itm-cent col-12">
            </div>
            <nav class="col-6 just-cnt-cent align-itm-cent displ-tab">
                <ul class="col-12 just-cnt-cent align-itm-cent">
                    <li class="just-cnt-cent align-itm-cent"><a class="just-cnt-cent align-itm-cent" href="#">Home</a></li>
                    <li class="just-cnt-cent align-itm-cent"><a class="just-cnt-cent align-itm-cent" href="#">About-Us</a></li>
                    <li class="just-cnt-cent align-itm-cent"><a class="just-cnt-cent align-itm-cent" href="./faq.html">FAQs</a></li>
                    <li class="just-cnt-cent align-itm-cent"><a class="just-cnt-cent align-itm-cent" href="#">Join-Us</a></li>
                </ul>
            </nav>
            <div class="h-btns align-itm-cent displ-tab">
                <a href="./login.php" class="jose">Login</a>
                <a href="./signup.php" class="jose">Signup</a>
            </div>
            <button type="button" class="toggle-side-bar displ-mob"><i class="fas fa-bars"></i></button type="button">
        </div>
    </header>
    <!-- Header End -->
    
    <!-- Main Start -->
    <main class="col-12">
        <div class="cont col-12 just-cnt-cent flx-d-col">

            <style>
                .form {
                    margin: 25px 0;
                    padding: 50px 25px;
                }
                .form form {
                    max-width: 600px;
                    min-width: 300px;
                    padding: 35px 20px;
                    margin: 10px 0;
                    height: 100%;
                    background: rgba(249, 249, 249, 0.06);
                    border: 1px solid rgba(193, 255, 211, 0.21);
                    box-shadow: 0px 11px 19px rgba(255, 255, 255, 0.1);
                    backdrop-filter: blur(50px);
                    /* Note: backdrop-filter has minimal browser support */
                    border-radius: 51px;
                }
                form label, form input {
                    margin: 10px 0;
                }
                form input {
                    border: none;
                    outline: none;
                    background: none;
                    padding: 10px 15px;
                    border-radius: 10px;
                    color: #fff;
                    border-bottom: 2px solid #ff6900;
                }
                input:focus {
                    background-color: #37290276;
                }
                .error1 {
                    font-size: 12px;
                    color: red;
                    margin: 15px;
                }
                .error {
                    font-size: 12px;
                    color: red;
                    margin: 15px;
                }
                button {
                    margin: 15px;
                    padding: 10px 20px;
                    border-radius: 20px;
                    background-color: #ff6900;
                }
                .links {
                    margin: 10px 0;
                }
                .links a {
                    color: aliceblue;
                }
                .error1 {
                    display: none;                    
                }
                input:focus:invalid ~ .error1 {
                    display: block;                    
                }
            </style>
            <div class="form col-12 just-cnt-cent align-itm-cent flx-d-col">
                <h1 class="col-12 txt-al-cent">Welcome Back !</h1>
                <form method="post" class="col-12 just-cnt-cent flx-d-col">
                    <label for="">Email *</label>
                    <input type="email" name="user_email" id="" required class="col-12" placeholder="Your Email">
                    <label for="">Password *</label>
                    <input type="password" name="password" id="" required class="col-12" placeholder="Your Password">
                    <p class="error1">* Required, Please Fill all the required Fields </p>
                    <hr/>
                    <button type="submit">Sign In</button>
                    <?php echo $error ?>
                    <div class="links col-12 just-cnt-spbw">
                        <a href="./index.html">← Go Back</a>
                        <a href="./index.html">Forgot Password?</a>
                    </div>
                    <div class="links col-12 just-cnt-cent">
                        <a href="./signup.php">New User ? Click here to Sign Up</a>
                    </div>
                </form>
            </div>

        </div>
    </main>
    <!-- Main End -->

    <!-- Footer Start -->
    <footer class="col-12 just-cnt-cent align-itm-cent flx-d-col">
        <div class="cont col-12 just-cnt-cent align-itm-cent flx-wrp">
            <div class="sub-cont col-12 col-md-3 flx-d-col just-cnt-cent align-itm-cent">
                <img src="./images/main-logo.png" alt="" class="col-12">
            </div>
            <div class="sub-cont col-12 col-md-3 flx-d-col just-cnt-cent align-itm-cent">
                <h3>Quick Links</h3>
                <a href="#">Link →</a>
                <a href="#">Link →</a>
                <a href="#">Link →</a>
                <a href="#">Link →</a>
            </div>
            <div class="sub-cont col-12 col-md-3 flx-d-col just-cnt-cent align-itm-cent">
                <h3>Quick Links</h3>
                <a href="#">Link →</a>
                <a href="#">Link →</a>
                <a href="#">Link →</a>
                <a href="#">Link →</a>
            </div>
            <div class="sub-cont col-12 col-md-3 just-cnt-cent align-itm-cent">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-telegram"></i></a>
            </div>
        </div>
        <div class="copyr col-12 just-cnt-cent align-itm-cent txt-al-cent">
            <p class="col-12 txt-al-cent">Copyright - LegalDoji &copy; All Rights Reserved, 2022 <br/>
             Made and Managed By Web-Fire.com</p>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- Script -->
    <script src="https://kit.fontawesome.com/c758c8bec9.js" crossorigin="anonymous"></script>
    <script src="./scripts/vanilla-tilt.js"></script>
    
</body>
</html>