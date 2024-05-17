<?php
session_start();
include "../components/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Delete the product record
    $delete_product_sql = "DELETE FROM products WHERE id = '$product_id'";
    if ($connect->query($delete_product_sql) === TRUE) {
        // Retrieve the image filename
        $image_query = "SELECT image FROM products WHERE id = '$product_id'";
        $image_result = $connect->query($image_query);

        if ($image_result->num_rows == 1) {
            $row = $image_result->fetch_assoc();
            $imageFilename = $row['image'];

            // Delete the associated image file
            if ($imageFilename) {
                $imageFilePath = 'C:/xampp/htdocs/PaRental-Guardian-Website/images/products/' . $imageFilename;
                if (file_exists($imageFilePath)) {
                    unlink($imageFilePath);
                }
            }
        }

        header("Location: ../admin/manage_product.php?success=1");
    } else {
        echo "Error deleting product record: " . $connect->error;
    }

    $image_result->close();
    $connect->close();
} else {
    echo "Invalid request.";
}
?>
