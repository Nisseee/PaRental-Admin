<?php 
session_start();
include "../components/db_conn.php";
echo "Role: " . $_SESSION['role'];

if (isset($_SESSION['admin_id'])  ) {
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    
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
            <?php require'../components/nav.php';?>
            
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Product</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../admin/manage_product.php" class="text-success">Employee Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Product</li>
                    </ol>
                </nav>
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
                        include "../components/db_connect.php";
                        if (isset($_GET['product_id'])) {
                            $product_id = $_GET['product_id'];

                            $sql = "SELECT products.*, category.name AS cname, products.name AS pname  FROM products
                                    LEFT JOIN category ON products.category_id = category.id
                                    WHERE products.id = '" . $product_id . "'";
                            $result = $connect->query($sql);
                            if ($result->num_rows == 1) {
                                $row = $result->fetch_assoc();
                                $available = $row['stock'] - ($row['reserve'] + $row['used']);
                                
                    ?>
                            <div class="card-body" >
                                <form class="form" method="post">
                                        <div class="row">
                                            <div class="col-md-2 col-12">
                                                    <img src="/PaRental-Guardian-Website/images/products/<?php  echo $row['image']; ?>" alt="Avatar" style="width: 150px; height: 150px; border: 2px solid #45a049; ">
                                            </div>
                                            <div class="col-md-10 col-12">
                                                <div class="form-group">
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <label for="first-name-icon">Product Name</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" name="full_name" value="<?php echo $row['pname']; ?>"  id="first-name-icon" disabled>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-12">
                                                <div class="form-group ">
                                                    <label for="first-name-icon">Price</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" name="email" value="<?php echo $row['price']; ?>" id="first-name-icon" disabled>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group ">
                                                    <label for="first-name-icon">Color</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" name="contact_number" value="<?php echo $row['color']; ?>" id="first-name-icon" disabled>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group ">
                                                    <label for="first-name-icon">Category</label>
                                                    <div class="position-relative">
                                                    <input type="text" class="form-control" name="shift" value="<?php echo $row['cname']; ?>" id="shift" disabled>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group ">
                                                    <label for="first-name-icon">Material</label>
                                                    <div class="position-relative">
                                                    <input type="text" class="form-control" name="gender" value="<?php echo $row['material']; ?>" id="first-name-icon" disabled>
                                                        <!-- <div class="form-control-icon">
                                                            <i class="fa fa-venus-mars"></i>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-icon">Dimension</label>
                                                    <div class="position-relative">
                                                    <input type="text" class="form-control" name="shift" value="<?php echo $row['dimension']; ?>" id="shift" disabled>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-12">
                                                <div class="form-group ">
                                                    <label for="first-name-icon">Available / Reserve / In Use</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" name="username"  value="<?php echo $available; ?> / <?php echo $row['reserve']; ?> / <?php echo $row['used']; ?>"id="first-name-icon" disabled>
                                                        <!-- <div class="form-control-icon">
                                                            <i class="fa fa-user"></i>
                                                        </div> -->
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

                    $connect->close();
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