<?php

session_start();
require "./private/database.php";
require "./private/functions.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "./phpmailer/src/Exception.php";
require "./phpmailer/src/PHPMailer.php";
require "./phpmailer/src/SMTP.php";

$otp = "";
$user_data ="";
$error = "";

if (isset($_COOKIE['legaldoji_user_id']) && isset($_COOKIE['legaldoji_user_email'])) {
    $user_id = $_COOKIE['legaldoji_user_id'];
    $query = "select * from admin_users_data where user_id = '$user_id' limit 1";
    $result = mysqli_query($connection, $query);
  
    if ($result) {
      if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        if ($user_data['user_email'] === $_COOKIE['legaldoji_user_email']) {
          $stats = "";
          if ($user_data['status'] === "pending") {
            
$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com'; // mail.goupload.co
$mail->SMTPAuth = true;
$mail->Username = 'webfiretestmail@gmail.com'; // email ID
$mail->Password = 'xjywerwiophpmqcs'; // mail password
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$otp = rand(111111, 999999);

$mail->setFrom('webfiretestmail@gmail.com'); // gmail
$mail->addAddress($user_data['user_email']);
$mail->isHTML(true);

$mail->Subject = "LegalDoji - Email Verification mail";
$mail->Body = "<h1>Hi, This is a Email Verification mail from LegalDoji</h1><br>
               <h2>User Email =".$user_data['user_email']."</h2>
               <b>This is your 6 digit OTP for Email Verification</b>
               <p>".$otp."</p>
               mail sent via legal-doji/react-app/jsx/next-js";

if ($mail->send()) {
    $query = "update admin_users_data set otp = '$otp' where user_id = '$user_id'";
    mysqli_query($connection, $query);
    $stat = "OTP Sent at your Email";
} else {
    $stat = "There was error in sending mail";
}
          } else  {
    header("Location: ./otp.php");
    die;
          }
        }
      }
    }
  } else {
    header("Location: ./signup.php");
    die;
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
 
<?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user_otp = $_POST['otp'];
            if ($user_otp === $user_data['otp']) {
                $stat = "Email Verified";
                $query = "update admin_users_data set status = 'verified' where user_id = '$user_id'";
                mysqli_query($connection, $query);
                sleep(2);
                header("Location: ./client-dashboard/dashboard.php");
                die;
            } else {
                $error = "Incorrect OTP, Click Resend Button To resend Otp";
            }
        }
    ?>

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
                    <li class="just-cnt-cent align-itm-cent"><a class="just-cnt-cent align-itm-cent" href="#">FAQs</a></li>
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
                    background-color: #372b0276;
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
                <h1 class="col-12 txt-al-cent">OTP sent at your mail</h1>
                <form method="post" class="col-12 just-cnt-cent flx-d-col">
                    <label for="">Registered Email</label>
                    <input type="email" name="user_email" id="" readonly value="<?php echo $user_data['user_email'] ?>" required class="col-12" placeholder="Your Email">
                    <label for="">Otp *</label>
                    <input type="password" name="otp" id="" required class="col-12" placeholder="Your Otp">
                    <p class="error1">* Required, Please Fill all the required Fields </p>
                    <hr/>
                    <button type="submit">Verify</button>
                    <?php echo $error ?>
                    <div class="links col-12 just-cnt-spbw">
                        <a href="./index.html">← Go Back</a>
                        <a href="./dashboard.php">Resend OTP</a>
                    </div>
                    <button type="button">Change Email</button>
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