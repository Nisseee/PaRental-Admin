<?php 
session_start();
include "../components/db_connect.php";
date_default_timezone_set("Asia/Manila");


if (isset($_SESSION['admin_id']) ) {
 // Fetch the employee count from the database
 $sql = "SELECT COUNT(*) AS user_count FROM users"; 
 $result = mysqli_query($connect, $sql);

 if ($result) {
     $row = mysqli_fetch_assoc($result);
     $userCount = $row['user_count'];
 } else {
     // Handle the query error if needed
     $userCount = "Error fetching data";
 }

 $sql = "SELECT COUNT(*) AS product_count FROM products"; 
 $result = mysqli_query($connect, $sql);

 if ($result) {
     $row = mysqli_fetch_assoc($result);
     $productCount = $row['product_count'];
 } else {
     // Handle the query error if needed
     $productCount = "Error fetching data";
 }

 $sql = "SELECT COUNT(*) AS orders_count FROM orders"; 
 $result = mysqli_query($connect, $sql);

 if ($result) {
     $row = mysqli_fetch_assoc($result);
     $orderCount = $row['orders_count'];
 } else {
     // Handle the query error if needed
     $orderCount = "Error fetching data";
 }

 $connect->close();
 
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Admin Parental</title>
      <link rel="stylesheet" href="../assets/css/bootstrap.css">
      <script defer src="../assets/fontawesome/js/all.min.js"></script>
      <link rel="stylesheet" href="../assets/vendors/chartjs/Chart.min.css">
      <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
      <link rel="stylesheet" href="../assets/css/app.css">
      <style type="text/css">
        .custom-time-fontsize {
            font-size: 5em; 
        }

        #currentDate {
            color: #05445E; 
        }
      </style>
   </head>
   <body>
      <div id="app">
      <?php require'../components/menu.php';?>
         <div id="main"style="background-color:white;">
          <?php require'../components/nav.php';?>
            <div class="main-content container-fluid" style="background-color:white;">
               <div class="page-title">
                  <h3 style="margin-top:-40px; text-align: center;">Dashboard</h3>
               </div>
               <section class="section">
                  <div class="row mb-2">
                  <div class="col-xl-12 col-md-12 mb-4">
            <div class="card" style="background-color:white; box-shadow: none;">
              <div class="card-body">
                <div class="d-flex justify-content-center">
                    <div class="d-flex flex-row">
                      <div>
                        <p id="currentTime" class="text custom-time-fontsize h1 mb-2" style="color:#05445E;"></p>
                        <p id="currentDate" class="text h4 mb-4" style="color:gray; text-align:center;"></p>
                        <div id="timeInMessage" class="text-info h5 mb-4"></div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-12 mb-4"style="margin-top: -50px;">
            <div class="card" style="background-color:#FFFCEE; box-shadow: none; border-radius: 10px;">
              <div class="card-body">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="fa fa-users text-warning fa-3x me-4"></i>
                    </div>
                    <div>
                      <h4>Users</h4>
                        <h2 class="h1 mb-0"><?php echo $userCount; ?></h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
                    <div class="col-xl-4 col-md-12 mb-4"style="margin-top: -50px;">
            <div class="card" style="background-color:#EBFFDE; box-shadow: none; border-radius: 10px;">
              <div class="card-body">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="fa fa-chair text-success fa-3x me-4"></i>
                    </div>
                    <div>
                      <h4>Products</h4>
                      <h2 class="h1 mb-0"><?php echo $productCount; ?></h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>          
          <div class="col-xl-4 col-md-12 mb-4"style="margin-top: -50px;">
            <div class="card" style="background-color:#FFFEDE; box-shadow: none; border-radius: 10px;">
              <div class="card-body">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="fa fa-list text fa-3x me-4" style="color:#F2E34C;"></i>
                    </div>
                    <div>
                      <h4>Orders</h4>
                      <h2 class="h1 mb-0"><?php echo $orderCount; ?></h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
           <div class="col-xl-4 col-md-12 mb-4" style="margin-top: -50px;">
            <div class="card"style="background-color:#F8F8F8; box-shadow: none; border-radius: 10px;">
              <div class="card-body">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="fa fa-spinner text fa-3x me-4" style="color:gray;"></i>
                    </div>
                    <div>
                      <h4>Processing Orders</h4>
                        <h2 class="h1 mb-0">7</h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
                    <div class="col-xl-4 col-md-12 mb-4" style="margin-top: -50px;"> 
            <div class="card"style="background-color:#F3FFFD; box-shadow: none; border-radius: 10px;">
              <div class="card-body">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="fa fa-truck text fa-3x me-4"style="color:#189AB4;"></i>
                    </div>
                    <div>
                      <h4>Delivered Orders</h4>
                      <h2 class="h1 mb-0">2</h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>          
          <div class="col-xl-4 col-md-12 mb-4"style="margin-top: -50px;">
            <div class="card"style="background-color:#FFF3F3; box-shadow: none; border-radius: 10px;">
              <div class="card-body">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="fa fa-arrow-left text-danger fa-3x me-4"></i>
                    </div>
                    <div>
                      <h4>Completed Orders</h4>
                      <h2 class="h1 mb-0">1</h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
                 
                  </div>
               </section>
            </div>
         </div>
      </div>
      <script src="../assets/js/feather-icons/feather.min.js"></script>
      <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
      <script src="../assets/js/app.js"></script>
      <script src="../assets/vendors/simple-datatables/simple-datatables.js"></script>
      <script src="../assets/js/vendors.js"></script>
      <script src="../assets/js/main.js"></script>
      <script>
        function updateCurrentTime() {
            var currentTime = new Date();
            var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();
            var seconds = currentTime.getSeconds();
            var ampm = hours >= 12 ? 'PM' : 'AM';

            // Convert to 12-hour format
            hours = hours % 12;
            hours = hours ? hours : 12; // Handle midnight (0 hours)

            var formattedTime = hours + ':' + (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds + ' ' + ampm;

            document.getElementById('currentTime').innerText = formattedTime;
        }

        function updateCurrentDate() {
            var currentDate = new Date();
            var daysOfWeek = ["SUNDAY", "MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY", "FRIDAY", "SATURDAY"];
            var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            var formattedDate =
                daysOfWeek[currentDate.getDay()] + ', ' +
                months[currentDate.getMonth()] + ' ' +
                currentDate.getDate() + ', ' +
                currentDate.getFullYear();

            document.getElementById('currentDate').innerText = formattedDate;
        }
        // Call updateCurrentTime and updateCurrentDate functions initially
        updateCurrentTime();
        updateCurrentDate();

        // Update the time every second
        setInterval(updateCurrentTime, 1000);
        // Update the date every 60000 milliseconds (1 minute)
        setInterval(updateCurrentDate, 60000);
      </script>
   </body>
</html>

<?php 
}else{

  echo "Welcome, " . $_SESSION['position'];
    //  header("Location: ../index.php?error=1Only Admin can access ");

    //  exit();
}
 ?>


