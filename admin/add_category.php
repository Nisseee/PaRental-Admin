<?php 
session_start();
include "../components/db_connect.php";

if (isset($_SESSION['admin_id'])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $name = $_POST['name'];
        $description = $_POST['description'];

        // Handle file upload
        $target_dir = "C:/xampp/htdocs/PaRental-Guardian-Website/images/categories/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["picture"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            header("Location: ../admin/add_category.php?failed=1");
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            header("Location: ../admin/add_category.php?failed=1");
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            header("Location: ../admin/add_category.php?failed=1");
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            header("Location: ../admin/add_category.php?failed=1");
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
                $picture = basename($_FILES["picture"]["name"]); // Save the filename to the database

                // Insert data into the database
                $sql = "INSERT INTO category (name, description, picture) VALUES ('$name', '$description', '$picture')";

                if ($connect->query($sql) === TRUE) {
                    header("Location: ../admin/add_category.php?success=1");
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
    <title>Add Category</title>
    
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    
    <script defer src="../assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <style type="text/css">
        .notif:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div id="app">
        <?php require '../components/menu.php';?>
    <div id="main">
         <?php require '../components/nav.php';?>   
                
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Add Category</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php" class="text-success">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Vertical form layout section start -->
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <?php
                            if (isset($_GET['success']) && $_GET['success'] == 1) {
                                echo '<div class="alert alert-success" role="alert">
                                        Category has been added successfully!
                                      </div>';
                            } ?>
                            <?php
                            if (isset($_GET['failed']) && $_GET['failed'] == 1) {
                                echo '<div class="alert alert-danger" role="alert">
                                        Unfortunately, the category has not been added!
                                      </div>';
                            } ?>
                            <form class="form" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div>
                                            <label for="am-start">Category Name</label>
                                            <input type="text" class="form-control" id="name" name="name" style="text-align: left;">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div>
                                            <label for="am-end">Description</label>
                                            <input type="text" class="form-control" id="description" name="description">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div>
                                            <label for="pm-start">Photo</label>
                                            <input type="file" class="form-control" id="picture" name="picture">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1" style="margin-top: 10px;">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script src="../assets/js/feather-icons/feather.min.js"></script>
    <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <script src="../assets/js/main.js"></script>

    
</body>
</html>
<?php 
} else {
    header("Location: ../index.php?error=1Only Admin can access ");
    exit();
}
?>
