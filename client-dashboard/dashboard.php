<?php

session_start();
require "../private/database.php";
require "../private/functions.php";

$user_tickets = "";
$user_all_tickets = "";

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
            
            
            $query = "SELECT * FROM userTickets where clientId = '$user_id'";
            $result = mysqli_query($connection, $query);

            if(mysqli_num_rows($result) > 0)
            {
                $s_no = 0;
              $user_tickets = '
              <div class="tick-wrapper displ-flx col-12">
              ';
              while($row = mysqli_fetch_array($result))
              {
                  $s_no = $s_no + 1;
               $user_tickets .= '
                  <div class="tick-div just-cnt-cent flx-d-col col-12 col-md-6 col-lg-3">
                      <div class="col-12 just-cnt-spev">
                          <!-- <img src="./images/profile.png" alt="" class="col-1"> -->
                          <h4 class="adv-name txt-al-cent">'.$s_no.'.  #TIC'.$row["id"].'</h4>
                      </div>
                      <div class="col-12 just-cnt-cent align-itm-cent flx-d-col">
                          <h4 class="price">₹'.$row["price"].'</h4>
                          <h4 class="date">'.$row["date"].'</h4>
                      </div>
                      <h4 class="txt-al-cent stat-open">
                          <i class="fas fa-circle"></i> Open
                      </h4>
                      <div class="col-12 verified just-cnt-cent align-itm-cent">
                          <button class="col-12 just-cnt-cent align-itm-cent" id="tick-details-btn">View</button>
                      </div>
                  </div>
               ';
              }
              $user_tickets .= '</div>';
            } else {
                $user_tickets = '<div class="tick-wrapper displ-flx col-12">
                <h3>No tickets issued yet</h3>
                </div>';
            }
            
            
            $query = "SELECT * FROM userTickets where clientId = '$user_id'";
            $result = mysqli_query($connection, $query);

            if(mysqli_num_rows($result) > 0)
            {
                $s_no = 0;
              $user_all_tickets = '
              <div class="tick-wrapper displ-flx flx-wrp col-12">
              ';
              while($row = mysqli_fetch_array($result))
              {
                  $s_no = $s_no + 1;
               $user_all_tickets .= '
                  <div class="tick-div just-cnt-cent flx-d-col col-12 col-md-6 col-lg-3">
                      <div class="col-12 just-cnt-spev">
                          <!-- <img src="./images/profile.png" alt="" class="col-1"> -->
                          <h4 class="adv-name txt-al-cent">'.$s_no.'.  #TIC'.$row["id"].'</h4>
                      </div>
                      <div class="col-12 just-cnt-cent align-itm-cent flx-d-col">
                          <h4 class="price">₹'.$row["price"].'</h4>
                          <h4 class="date">'.$row["date"].'</h4>
                      </div>
                      <h4 class="txt-al-cent stat-open">
                          <i class="fas fa-circle"></i> Open
                      </h4>
                      <div class="col-12 verified just-cnt-cent align-itm-cent">
                          <button class="col-12 just-cnt-cent align-itm-cent" id="tick-details-btn">View</button>
                      </div>
                  </div>
               ';
              }
              $user_all_tickets .= '</div>';
            } else {
                $user_all_tickets = '<div class="tick-wrapper displ-flx col-12">
                <h3>No tickets issued yet</h3>
                </div>';
            }
        }
      }
    }
  }
} else {
  header("Location: ../signup.php");
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/general.css">
    <link rel="stylesheet" href="./styles/mediaq.css">
    <link rel="stylesheet" href="./styles/responsive.css">

    <!-- Scripts -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zepto/1.2.0/zepto.min.js"></script>

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
                    <li class="just-cnt-cent align-itm-cent"><a class="just-cnt-cent align-itm-cent" href="#">Dashboard</a></li>
                    <!-- <li class="just-cnt-cent align-itm-cent"><a class="just-cnt-cent align-itm-cent" href="#">Tickets</a></li> -->
                    <li class="just-cnt-cent align-itm-cent"><a class="just-cnt-cent align-itm-cent" href="#">Document</a></li>
                </ul>
            </nav>
            <div class="h-profile align-itm-cent  just-cnt-cent">
                <a href="#" class="jose align-itm-cent just-cnt-cent"><i class="fas fa-newspaper"></i></a>
                <a href="#" class="jose align-itm-cent just-cnt-cent"><i class="fas fa-bell"></i></a>
                <img src="./images/profile.png" alt="">
            </div>
        </div>
    </header>
    <!-- Header End -->

    <style>
        .adv-details-sidebar {
            overflow-y: scroll;
        }
    </style>
    <div id="adv-details-sidebar" class="adv-details-sidebar col-12 displ-flx align-itm-cent flx-d-col ">
        <button id="ads-close">
            Close
        </button>
        <h2>Advocate details</h2>
        <!-- styles -->
        <style>
            .prof-txt-n {
                padding: 10px;
            }
            .prof-txt-n h3, .prof-txt-n p{
                margin: 5px 0;
            }
            .prof-txt-n .status-pending {
                font-size: 12px;
                color: rgba(255, 255, 255, 0.5);
            }
            .prof-txt-main {
                margin: 10px 0;
            }
            .data-wrapper {
                margin: 15px 0;
            }
            .data-wrapper .adv-data-div.col-4 {
                padding : 10px 5px;
                margin: 2px;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(48.5px);
        width: 120px;
        height: 60px;
        border-radius: 20px;
            }
            .data-wrapper .adv-data-div.col-12 {
                padding : 10px;
                margin: 3px;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(48.5px);
        border-radius: 20px;
            }
            .data-wrapper .adv-data-div.col-3 {
                padding : 10px;
                margin: 3px;
        background: rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(48.5px);
        border-radius: 20px;
        width: 80px;
            }
            .data-wrapper .adv-data-div h4, .data-wrapper .adv-data-div p {
                text-align: center;
            }
            .data-wrapper .adv-data-div p {
                height: 100%;
                font-size: 12px;
            }
        </style>
        <div class="col-12 just-cnt-spev">
            <img src="./images/profile.png" alt="" class="col-3" />
            <div class="prof-txt-n col-9 just-cnt-cent flx-d-col">
                <h3 class="adv-name col-9">John Doe<br /> #LA76RTH</h3>
                <p class="status-pending"> </p>
            </div>
        </div>
        <div class="prof-txt-main col-12 just-cnt-cent flx-d-col">
            District : xxxxxxxxx <br>
            State : xxxxxxxxx <br><br>


            <div class="data-wrapper col-12 just-cnt-cent align-itm-cent flx-wrp">
                <div class="adv-data-div col-4 just-cnt-spbw flx-d-col align-itm-cent">
                    <h4>Court</h4>
                    <p>xxxxxxxxx</p>
                </div>
                <div class="adv-data-div col-4 just-cnt-spbw flx-d-col align-itm-cent">
                    <h4>Last active</h4>
                    <p>xxxxxxxxx</p>
                </div>
                <div class="adv-data-div col-12 just-cnt-spbw flx-d-col align-itm-cent">
                    <h4>Practice area</h4>
                    <p>xxxxxxxxx</p>
                    <p>xxxxxxxxx</p>
                    <p>xxxxxxxxx</p>
                </div>
                <div class="adv-data-div col-3 just-cnt-spbw align-itm-cent">
                    <h4><i class="fas fa-briefcase"></i></h4>
                    <p>  5 yrs</p>
                </div>
                <div class="adv-data-div col-3 just-cnt-spbw align-itm-cent">
                    <h4><i class="fas fa-star"></i></h4>
                    <p>  4 / 5</p>
                </div>
                <div class="adv-data-div col-3 just-cnt-spbw align-itm-cent">
                    <h4><i class="fas fa-ticket"></i></h4>
                    <p>  10</p>
                </div>
            </div>

            Reports : 00<br>
        </div>
    </div>


    <div id="tick-book-sidebar" class="tick-book-sidebar col-12 displ-flx align-itm-cent flx-d-col ">
        <button id="tbs-close">
            Close
        </button>
        <h2>Book Ticket</h2>

        <h4>Price ₹0.00</h4>
<style>
    

body .tick-book-sidebar {
  background: rgba(0, 0, 0, 0.431372549);
  box-shadow: 0 0 10px rgba(255, 255, 255, 0.374);
  -webkit-backdrop-filter: blur(48.5px);
          backdrop-filter: blur(48.5px);
  padding: 20px;
  border-radius: 20px;
  height: calc(100vh - 60px);
  max-width: 300px;
  min-width: 250px;
  position: fixed;
  right: 5px;
  bottom: 5px;
  transform-style: preserve-3d;
  z-index: 10000000;
  transition: all 0.5s ease;
  transform: translateX(500px);
}
body .tick-book-sidebar h2 {
  margin: 10px 0 40px 0;
}
body .tick-book-sidebar form {
  margin: 10px 0;
}
body .tick-book-sidebar form input, body .tick-book-sidebar form textarea {
  padding: 5px 20px;
  border-radius: 20px;
  margin: 5px;
  border: 2px solid #ffaa00;
  background-color: transparent;
}
body .tick-book-sidebar form button {
  margin: 10px 0;
  background-color: #ffaa00;
  padding: 5px 10px;
  border-radius: 20px;
}
</style>
        <form action="./bookticket.php" method="post" class="just-cnt-cent align-itm-cent flx-d-col">
            <input placeholder="Date" class="col-12" type="date" name="tickDate" id="tickDate" required>
            <textarea placeholder="Description" class="col-12" type="text" name="ticketDescription" id="tickTxt" required rows="10"></textarea>
            <input placeholder="Documents" class="col-12" type="file" name="tickDocs" id="tickDocs">
            <button type="submit">Pay Now</button>
        </form>
    </div>
    
    <div id="tick-details-sidebar" class="tick-details-sidebar col-12 displ-flx  align-itm-cent flx-d-col ">
        <button id="tds-close">
            Close
        </button>
        <h2>Ticket Details</h2>
    </div>

    <main class="col-12">
        <div class="cont col-12 just-cnt-cent">

            <div class="hero col-12 col-md-9 align-itm-cent flx-d-col">

                <div class="advocates col-12 flx-d-col">
                    <!-- <h3>Issue New Ticket</h3> -->
                    <div class="searchbar col-12 just-cnt-cent align-itm-cent">
                        <input class="just-cnt-cent align-itm-cent" type="text" placeholder="Search advocates">
                        <button id="search-btn" class="just-cnt-cent align-itm-cent"><i class="fas fa-magnifying-glass"></i></button>
                        <button id="filter-btn" class="just-cnt-cent align-itm-cent"><i class="fas fa-filter"></i></button>
                    </div>

                    <div class="adv-wrapper flx-wrp just-cnt-cent col-12">
                        <div class="adv-div just-cnt-cent flx-d-col col-12 col-md-6 col-lg-3">
                            <div class="col-12 just-cnt-spev">
                                <img src="./images/profile.png" alt="" class="col-1" />
                                <h4 class="adv-name">John Doe <br /> #LA76RTH</h4>
                            </div>
                            <div class="col-12 just-cnt-spev">
                                <h4 class="price">₹0.00</h4>
                                <h4 class="experience">5 years</h4>
                            </div>
                            <div class="col-12 just-cnt-cent align-itm-cent">
                                <button id="adv-details-btn" class="col-12 just-cnt-cent align-itm-cent adv-details-btn">View Details</button>
                            </div>
                            <div class="col-12 verified just-cnt-cent align-itm-cent">
                                <button id="tick-book-btn" class="col-12 just-cnt-cent align-itm-cent book-tick-btn">Book</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tickets col-12 flx-d-col active">
                    <div class="just-cnt-spbw align-itm-cent">
                        <h3>Recent Tickets</h3>
                        <button type="button" id="tickopenbtn"><i class="fas fa-up-long"></i></button>
                    </div>
                    <?php echo $user_tickets; ?>
                    <!--<div class="tick-wrapper displ-flx col-12">-->
                    <!--    <div class="tick-div just-cnt-cent flx-d-col col-12 col-md-6 col-lg-3">-->
                    <!--        <h3>No Tickets issued yet</h3>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>

            </div>

            <div class="recent-blogs displ-tab col-md-3 align-itm-cent flx-d-col">
                <h3>Recent Blogs</h3>
                <div class="blog-wrapper col-12 flx-d-col displ-flx align-itm-cent">
                </div>
            </div>

        </div>
    </main>

    <footer class="col-12 just-cnt-cent align-itm-cent displ-mob">
        <div class="cont col-12 just-cnt-cent align-itm-cent">
            <nav class="col-12 just-cnt-cent align-itm-cent">
                <ul class="col-12 just-cnt-cent align-itm-cent">
                    <li class="col-3 just-cnt-cent align-itm-cent"><a href="#" class="col-12 flx-d-col just-cnt-cent align-itm-cent"><i class="fas fa-house-user"></i>Dashboard</a></li>
                    <li class="col-3 just-cnt-cent align-itm-cent"><a href="#" class="col-12 flx-d-col just-cnt-cent align-itm-cent"><i class="fas fa-folder-open"></i>Documents</a></li>
                </ul>
            </nav>
        </div>
    </footer>

    <div class="col-12 rec-tics" id="ticktsec">
        <div class="just-cnt-spbw align-itm-cent">
            <h3>Recent Tickets</h3>
            <button type="button" id="tickclosbtn"><i class="fas fa-up-long"></i></button>
        </div>
        <?php echo $user_all_tickets; ?>
    </div>

    <script src="https://kit.fontawesome.com/c758c8bec9.js" crossorigin="anonymous"></script>
    <script src="./app.js"></script>
    <script src="./scripts/vanilla-tilt.js"></script>
    <script src="./scripts/app.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://cdn.jsdelivr.net/gsap/1.19.1/TweenMax.min.js'></script><script  src="./script.js"></script>

</body>
</html>