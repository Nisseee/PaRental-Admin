<?php 
session_start();
include "../components/db_connect.php";

if (isset($_SESSION['admin_id'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $product_id = $_POST['product_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $color = $_POST['color'];
        $dimension = $_POST['dimension'];
        $material = $_POST['material'];
        $category_id = $_POST["category_id"];
        $trimmed_category_id = explode(".", $category_id)[0];
        $stock = $_POST['stock'];

        // Handle file upload
        if ($_FILES["picture"]["error"] == 0) {
            $target_dir = "C:/xampp/htdocs/PaRental-Guardian-Website/images/products/";
            $target_file = $target_dir . basename($_FILES["picture"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is an actual image or fake image
            $check = getimagesize($_FILES["picture"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                header("Location: ../admin/edit_product.php?product_id=$product_id&failed=1");
                exit();
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                header("Location: ../admin/edit_product.php?product_id=$product_id&failed=1");
                exit();
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                header("Location: ../admin/edit_product.php?product_id=$product_id&failed=1");
                exit();
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                header("Location: ../admin/edit_product.php?product_id=$product_id&failed=1");
                exit();
            } else {
                if (!move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
                    header("Location: ../admin/edit_product.php?product_id=$product_id&failed=1");
                    exit();
                }
            }
        }

        // Update data in the database
        $sql = "UPDATE products SET name='$name', price='$price', color='$color', material='$material', dimension='$dimension', stock='$stock'";
        if ($_FILES["picture"]["error"] == 0) {
            $picture = basename($_FILES["picture"]["name"]);
            $sql .= ", image='$picture'";
        }
        $sql .= " WHERE id='$product_id'";

        if ($connect->query($sql) === TRUE) {
            header("Location: ../components/edit_product.php?product_id=$product_id&success=1");
            exit();
        } else {
            echo "Error updating product: " . $connect->error;
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
    <title>Edit Product</title>
    
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
        <?php require '../components/menu.php'; ?>
        <div id="main">
            <?php require '../components/nav.php'; ?>
            <div class="main-content container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Edit Product</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../admin/manage_product.php" class="text-success">Product Management</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <?php
                                    include "../components/db_connect.php";
                                    if (isset($_GET['product_id'])) {
                                        $product_id = $_GET['product_id'];
                                        $sql = "SELECT products.*, category.name AS cname, products.name AS pname, products.category_id AS c_id FROM products
                                                LEFT JOIN category ON products.category_id = category.id
                                                WHERE products.id = '" . $product_id . "'";
                                        $result = $connect->query($sql);
                                        if ($result->num_rows == 1) {
                                            $row = $result->fetch_assoc();
                                            $available = $row['stock'] - ($row['reserve'] + $row['used']);
                                    ?>
                                            <div class="card-body">
                                                <?php
                                                if (isset($_GET['success']) && $_GET['success'] == 1) {
                                                    echo '<div class="alert alert-success" role="alert">
                                                            Product has been edit successfully!
                                                        </div>';
                                                } ?>
                                                <?php
                                                if (isset($_GET['failed']) && $_GET['failed'] == 1) {
                                                    echo '<div class="alert alert-danger" role="alert">
                                                            Unfortunately, the Product has not been edit!
                                                        </div>';
                                                } ?>
                                                <form class="form" method="post" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-md-2 col-12">
                                                            <label for="picture">
                                                                <img src="/PaRental-Guardian-Website/images/products/<?php echo $row['image']; ?>" alt="Avatar" style="width: 150px; height: 150px; border: 2px solid #45a049;" id="avatar-image"/>
                                                            </label>
                                                            <input class="avatar-upload" type="file" name="picture" id="picture" accept="image/*" style="display: none;"/>
                                                        </div>
                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group">
                                                                <br>
                                                                <br>
                                                                <br>
                                                                <br>
                                                                <label for="first-name-icon">Product Name</label>
                                                                <input type="text" class="form-control" name="name" value="<?php echo $row['pname']; ?>" id="first-name-icon" require>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="price">Price</label>
                                                                <input type="text" class="form-control" name="price" value="<?php echo $row['price']; ?>" id="price" require>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="color">Color</label>
                                                                <input type="text" class="form-control" name="color" value="<?php echo $row['color']; ?>" id="color" require>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                            <fieldset class="form-group">
                                                                <label for="category">Category</label>
                                                                <select class="form-select" name="category_id" id="basicSelect" required>
                                                                <?php
                                                                    include "../components/db_connect.php";
                                                                    $currentcategory_id = $row['c_id'];

                                                                    $sql = "SELECT * FROM category";
                                                                    $results = $connect->query($sql);


                                                                    if ($results->num_rows > 0) {
                                                                        while ($rows = $results->fetch_assoc()) {
                                                                        $categoryName = $rows['name'];
                                                                        $categoryID = $rows['id'];

                                                                        $selected = ($currentcategory_id == $categoryID) ? 'selected' : '';
                                                                
                                                                            echo '<option ' . $selected . ' >' . $categoryID . '. ' . $categoryName . ' </option>';
                                                                        }
                                                                    }else {
                                                                        echo '<option>no Category yet</option>';
                                                                    }

                                                                    
                                                                ?>
                                                                </select>
                                                            </fieldset>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="material">Material</label>
                                                                <input type="text" class="form-control" name="material" value="<?php echo $row['material']; ?>" id="material" require>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="dimension">Dimension</label>
                                                                <input type="text" class="form-control" name="dimension" value="<?php echo $row['dimension']; ?>" id="dimension"require>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="stock">Stock</label>
                                                                <input type="text" class="form-control" name="stock" value="<?php echo $row['stock']; ?>" id="stock" require>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <input type="hidden" name="product_id" id="product_id" value="<?php echo $row['id']; ?>">
                                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                    <?php
                                        } else {
                                            echo 'Product not found.';
                                            echo "<br><a href='../admin/manage_product.php'>Back to Product List</a>";
                                        }
                                    }
                                    $connect->close();
                                    ?>
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
</body>
</html>
<?php 
} else {
    header("Location: ../index.php?error=Only Admin can access ");
    exit();
}
?>
