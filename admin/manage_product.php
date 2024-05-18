<?php 
session_start();
include "../components/db_conn.php";

if (isset($_SESSION['admin_id']) ) {
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <link rel="stylesheet" href="../assets/vendors/simple-datatables/style.css">

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
                            <h3>Manage Product</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-success">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Manage Product</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        
                            <div class="row">
                            <div class="col-sm-12 col-md-6">


                            </div>
                            <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                            
                            </div>

                            </div>
                        <div class="card-datatable table-responsive">
                        <?php
                            include "../components/db_connect.php";
                            if (isset($_GET['success']) && $_GET['success'] == 1) {
                                echo '<div class="alert alert-success" role="alert">
                                        Product has been deleted successfully!
                                      </div>';
                            }

                            $sql = "SELECT products.*, category.name AS cname, products.name AS pname  FROM products
                                    LEFT JOIN category ON products.category_id = category.id";

                            $result = $connect->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<table class='table' id='table1'>";
                                echo "    <thead>";
                                echo "        <tr>";
                                echo "            <th>Image</th>";
                                echo "            <th>Product Name</th>";
                                echo "            <th>Price</th>";
                                echo "            <th>Stock</th>";
                                echo "            <th>Action</th>";
                                echo "        </tr>";
                                echo "    </thead>";
                                echo "    <tbody>";

                                while ($row = $result->fetch_assoc()) {
                                    $available = $row['stock'] - ($row['reserve'] + $row['used']);
                                    echo '<tr>';
                                    // Display the avatar image
                                    echo '<td>';
                                            if (!empty($row['image'])) {
                                                echo '<img src="/PaRental-Guardian-Website/images/products/' . $row['image'] . '" alt="Avatar" style="width: 50px; height: 50px; border-radius:10%; border: 2px solid #45a049">';
                                            } else {
                                                echo 'No Image';
                                            }
                                    echo '</td>';

                                    echo '<td>' . $row['pname'] . '<br>' . $row['cname'] . '</td>';
                                    
                                    // Check the value of $row['department'] and display the appropriate badge
                                    // echo '<td>';
                                    // if ($row['department'] == 'HUMAN RESOURCES') {
                                    //     echo '<span class="badge bg-success">' . $row['department'] . '</span>';
                                    // } elseif ($row['department'] == 'CUSTOMER SERVICE') {
                                    //     echo '<span class="badge bg-info">' . $row['department'] . '</span>';
                                    // } elseif ($row['department'] == 'INFORMATION TECHNOLOGY') {
                                    //     echo '<span class="badge bg-danger">I T</span>';
                                    // } else {
                                    //     echo '<span class="badge bg-warning">' . $row['department'] . '</span>';
                                    // }
                                    // echo '</td>';
                                    echo '<td>₱ ' . $row['price'] . '</td>';
                                    
                                    // Display the shift information
                                    echo '<td><span class="text-success">Available: ' . $available . '</span> <br> <span class="text-info">Reserve: ' . $row['reserve'] . '</span><br> <span class="text-warning">In Use: ' . $row['used'] . '</span></td>';
                                    
                                    echo '<td>
                                            <a href="../components/view_product.php?product_id=' . $row['id'] . '"><i class="fa fa-eye text-warning fa-1x"></i></a>
                                            <a href="../components/edit_product.php?product_id=' . $row['id'] . '"><i class="fa fa-pen text-success fa-1x"></i></a>
                                            <a href="../components/delete_product.php?product_id='. $row['id'].'"><i class="fa fa-trash text-danger fa-1x"></i></a>
                                        </td>';
                                    
                                    echo '</tr>';
                                }
                                
                                echo '</tbody>';
                                echo '</table>';
                            } else {
                                echo '<h2 style="text-align: center; color: orange;">No Employee in the List</h2>';
                            }

                            $connect->close();
                        ?>
                        

                            
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
    
</body>

</html>
<?php 
}else{

     header("Location: ../index.php?error=1Only Admin can access ");

     exit();
}
 ?>