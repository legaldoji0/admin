<?php 

session_start();
require "../private/database.php";
require "../private/functions.php";
$user_tickets = "";
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
  header("Location: ../otp.php");
  die;
        } else  {
            
        }
      }
    }
  }
} else {
  header("Location: ../signup.php");
  die;
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $clientId = $user_id;
    $advocateId = "LA76RTH";
    $ticketId = rand(1111111, 9999999);
    $price = "0.00"; // $advocateId.price().echo()
    $status = "open";
    $description = $_POST['ticketDescription'];
    $meetDate = $_POST['tickDate'];

    $query = "INSERT INTO `userTickets` (`id`, `clientId`, `advocateId`, `status`, `price`, `description`, `meetDate`) VALUES ('$ticketId','$clientId','$advocateId', 'open', '$price', '$description', '$meetDate')";
    
	mysqli_query($connection, $query);
	
	header("Location: ./dashboard.php");
	die;
}

// ALTER TABLE `test_data` ADD PRIMARY KEY(`file_name`);
// 	$query = "CREATE TABLE `caslilck_legaldoji`.`".$user_data['user_id']."_daily_data` (`date` VARCHAR(100) NOT NULL ,`downloads` INT NOT NULL , `earnings` VARCHAR(100) NOT NULL , `clicks` INT NOT NULL, PRIMARY KEY (`date`)) ENGINE = InnoDB;";
// 	mysqli_query($connection, $query);
	
// for ($i=0; $i < 100; $i++) {
//     $days_to_add = " + ".$i." days";
//     $n_date = date('Y-m-d', strtotime($days_to_add));
    
// 	$query = "insert into ".$user_data['user_id']."_daily_data (date, downloads, clicks, earnings) values ('$n_date', '0', '0', '0.00')";

// 	mysqli_query($connection, $query);
// }
