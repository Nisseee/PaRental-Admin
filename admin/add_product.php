<?php 
session_start();
include "../components/db_connect.php";
include "../components/db_conn.php";

if (isset($_SESSION['admin_id']) ) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $name = $_POST['name'];
        $price = $_POST['price'];
        $color = $_POST['color'];
        $dimension = $_POST['dimension'];
        $material = $_POST['material'];
        $category_id = $_POST["category_id"];
        $trimmed_category_id = explode(".", $category_id)[0];
        $stock = $_POST['stock'];

        // Handle file upload
        $target_dir = "C:/xampp/htdocs/PaRental-Guardian-Website/images/products/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["picture"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            header("Location: ../admin/add_product.php?failed=1");
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            header("Location: ../admin/add_product.php?failed=1");
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            header("Location: ../admin/add_product.php?failed=1");
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            header("Location: ../admin/add_product.php?failed=1");
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
                $picture = basename($_FILES["picture"]["name"]); // Save the filename to the database

                // Insert data into the database
                $sql = "INSERT INTO products (name, category_id, price, color, material, dimension, stock, image) VALUES ('$name', '$trimmed_category_id', '$price', '$color', '$material', '$dimension',  '$stock', '$picture')";

                if ($connect->query($sql) === TRUE) {
                    header("Location: ../admin/add_product.php?success=1");
                } else {
                    echo "Error: " . $sql . "<br>" . $connect->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        // Close the database connection
        $connect->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    
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
                <h3>Add Product</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../admin/dashboard.php" class="text-success">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Product</li>
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
                        <div class="card-body">
                            <?php
                            if (isset($_GET['success']) && $_GET['success'] == 1) {
                                echo '<div class="alert alert-success" role="alert">
                                        Product has been added successfully!
                                      </div>';
                            } ?>
                            <?php
                            if (isset($_GET['failed']) && $_GET['failed'] == 1) {
                                echo '<div class="alert alert-danger" role="alert">
                                        Unfortunately, the Product has not been added!
                                      </div>';
                            } ?>
                            <form class="form" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    
                                    <div class="col-md-4 col-12">
                                        <div>
                                            <label for="first-name-icon">Product Name</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" name="name" id="first-name-icon" required>
                                                <div class="form-control-icon">
                                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div>
                                            <label for="first-name-icon">Price</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" name="price" id="first-name-icon" required>
                                                <div class="form-control-icon">
                                        
                                                </div>
                                            </div>
                                        </div>
                                    </div><div class="col-md-4 col-12">
                                        <div>
                                            <label for="first-name-icon">Color</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" name="color" id="first-name-icon" required>
                                                <div class="form-control-icon">
                        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 col-12">
                                        <div>
                                            <label for="first-name-icon">Material</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" name="material" id="first-name-icon" required>
                                                <div class="form-control-icon">
        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div>
                                            <label for="first-name-icon">Dimension</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" name="dimension" id="first-name-icon" required>
                                                <div class="form-control-icon">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div>
                                            <label for="first-name-icon">Photo</label>
                                            <div class="position-relative">
                                                <input type="file" class="form-control" name="picture" id="picture" required>
                                                <div class="form-control-icon">
                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div>
                                            <label for="first-name-icon">Category</label>
                                            <div class="position-relative">
                                                <fieldset class="form-group">
                                                    <select class="form-select" name="category_id" id="basicSelect" required>
                                                    <?php
                                                        include "../components/db_connect.php";

                                                        $sql = "SELECT * FROM category";
                                                        $result = $connect->query($sql);

                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                               $categoryName = $row['name'];
                                                    
                                                                echo '<option>' . $row['id'] . '. ' . $categoryName . ' </option>';
                                                            }
                                                        }else {
                                                            echo '<option>no Category yet</option>';
                                                        }

                                                        $connect->close();
                                                        ?>
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                
                                
                                    <div class="col-md-6 col-12">
                                        <div>
                                            <label for="first-name-icon">Stock</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" name="stock" id="first-name-icon" required>
                                                <div class="form-control-icon">
                                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
    
</body>
</html>
<?php 
}else{

     header("Location: ../index.php?error=1Only Admin can access ");

     exit();
}
 ?>