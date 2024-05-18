<?php 
session_start();
include "../components/db_conn.php";
echo "Role: " . $_SESSION['role'];

if (isset($_SESSION['admin_id'])) {
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
    
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    
    <script defer src="../assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/css/app.css">
      <style type="text/css">
        .notif:hover{
          background-color: rgba(0,0,0,0.1);
                  }
      </style>
</head>
<body>
    <div id="app">
        <?php require'../components/menu.php';?>
        <div id="main">
            
            
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Employee</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                
            </div>
        </div>

    </div>


    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        
                    <?php
                        include "../components/db_conn.php";
                        if (isset($_SESSION['employee_id'])) {
                            $employee_id = $_SESSION['employee_id'];

                            $sql = "SELECT employees.*, shift.am_start, shift.am_end, shift.pm_start, shift.pm_end, users.username, users.password 
                                    FROM employees
                                    LEFT JOIN shift ON employees.shift_id = shift.id
                                    LEFT JOIN users ON employees.employee_id = users.employee_id
                                    WHERE employees.employee_id = '" . $employee_id . "'";
                            $result = $conn->query($sql);
                            if ($result->num_rows == 1) {
                                $row = $result->fetch_assoc();
                                
                    ?>
                            <div class="card-body" >
                                <form class="form" method="post">
                                        <div class="row">
                                            <div class="col-md-2 col-12">
                                                    <img src="../uploads/<?php  echo $row['avatar']; ?>" alt="Avatar" style="width: 150px; height: 150px; border: 2px solid #45a049; ">
                                            </div>
                                            <div class="col-md-10 col-12">
                                                <div class="form-group has-icon-left">
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <label for="first-name-icon">Full Name</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" name="full_name" value="<?php echo $row['full_name']; ?>"  id="first-name-icon" disabled>
                                                        <div class="form-control-icon">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="first-name-icon">Email</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" name="email" value="<?php echo $row['email']; ?>" id="first-name-icon" disabled>
                                                        <div class="form-control-icon">
                                                            <i class="fa fa-envelope"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="first-name-icon">Contact</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" name="contact_number" value="<?php echo $row['contact_number']; ?>" id="first-name-icon" disabled>
                                                        <div class="form-control-icon">
                                                            <i class="fa fa-phone"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="first-name-icon">Shift Schedule</label>
                                                    <div class="position-relative">
                                                    <input type="text" class="form-control" name="shift" value="<?php echo date('h:i A', strtotime($row['am_start'])) . ' - ' . date('h:i A', strtotime($row['am_end'])) . ' / ' . date('h:i A', strtotime($row['pm_start'])) . ' - ' . date('h:i A', strtotime($row['pm_end'])); ?>" id="shift" disabled>
                                                        <div class="form-control-icon">
                                                            <i class="fa fa-clock"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="first-name-icon">Gender</label>
                                                    <div class="position-relative">
                                                    <input type="text" class="form-control" name="gender" value="<?php echo $row['gender']; ?>" id="first-name-icon" disabled>
                                                        <div class="form-control-icon">
                                                            <i class="fa fa-venus-mars"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="first-name-icon">Department</label>
                                                    <div class="position-relative">
                                                    <input type="text" class="form-control" name="department" value="<?php echo $row['department']; ?>" id="first-name-icon" disabled>
                                                        <div class="form-control-icon">
                                                            <i class="fa fa-building"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="first-name-icon">Position</label>
                                                    <div class="position-relative">
                                                    <input type="text" class="form-control" name="position" value="<?php echo $row['position']; ?>" id="first-name-icon" disabled>
                                                        <div class="form-control-icon">
                                                            <i class="fa fa-users"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="first-name-icon">Username</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" name="username"  value="<?php echo $row['username']; ?>"id="first-name-icon" disabled>
                                                        <div class="form-control-icon">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="password">Password</label>
                                                    <div class="position-relative">
                                                        <input type="password" class="form-control" name="password" value="<?php echo $row['password']; ?>" id="password" disabled>
                                                        <div class="form-control-icon" id="togglePassword" style="cursor: pointer;">
                                                            <i class="fa fa-eye" onclick="togglePasswordVisibility('password')"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        </div>
                                </form>
                        </div>
                        

                        <?php
                        } else {
                            echo 'Employee not found.';
                            echo "
                                <br>
                                <a href='emp_list.php'>Back to Employee List</a>
                            ";
                        }
                    }

                    $conn->close();
                    ?> 
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
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
        function togglePasswordVisibility(inputId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById('togglePassword');

            if (passwordInput.type === 'password') {
                // Temporarily set the type to 'text' to display the original password
                passwordInput.type = 'text';
                toggleIcon.innerHTML = '<i class="fa fa-eye-slash" onclick="togglePasswordVisibility(\'' + inputId + '\')"></i>';
            } else {
                // Switch back to 'password' type
                passwordInput.type = 'password';
                toggleIcon.innerHTML = '<i class="fa fa-eye" onclick="togglePasswordVisibility(\'' + inputId + '\')"></i>';
            }
        }
    </script>
    
</body>
</html>
<?php 
}else{

     header("Location: ../index.php?error=1Only Admin can access ");

     exit();
}
 ?>