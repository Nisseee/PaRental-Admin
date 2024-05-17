<?php 
include "../components/db_connect.php";

// Check if orderId and status are set
if (isset($_POST['orderId']) && isset($_POST['status'])) {
    $orderId = $_POST['orderId'];
    $status = $_POST['status'];

    // Fetch product_id and quantity from order_item table
    $fetch_query = "SELECT product_id, quantity FROM order_item WHERE id = ?";
    $stmt_fetch = $connect->prepare($fetch_query);
    $stmt_fetch->bind_param("i", $orderId);
    $stmt_fetch->execute();
    $stmt_fetch->store_result(); // Store result set to get num_rows
    if ($stmt_fetch->num_rows > 0) {
        $stmt_fetch->bind_result($product_id, $quantity);
        $stmt_fetch->fetch();

        // Update the reserve and used columns in the products table based on status
        if ($status === "Delivered") {
            $update_reserve_query = "UPDATE products SET reserve = reserve - ?, used = used + ? WHERE id = ?";
            $stmt_update = $connect->prepare($update_reserve_query);
            $stmt_update->bind_param("iii", $quantity, $quantity, $product_id);
            if (!$stmt_update->execute()) {
                echo "Error updating reserve and used: " . $stmt_update->error;
            }
        } elseif ($status === "Returned") {
            $update_used_query = "UPDATE products SET used = used - ? WHERE id = ?";
            $stmt_update = $connect->prepare($update_used_query);
            $stmt_update->bind_param("ii", $quantity, $product_id);
            if (!$stmt_update->execute()) {
                echo "Error updating used: " . $stmt_update->error;
            }
        }

        // Update the status of the order item in the database
        $update_status_query = "UPDATE order_item SET status=? WHERE id=?";
        $stmt_status = $connect->prepare($update_status_query);
        $stmt_status->bind_param("si", $status, $orderId);
        if ($stmt_status->execute()) {
            echo "Status updated successfully";
        } else {
            echo "Error updating status: " . $stmt_status->error;
        }
    } else {
        echo "No data found for orderId: $orderId";
    }
} else {
    echo "Invalid parameters";
}

// Close all statements and the database connection
$stmt_fetch->close();
if (isset($stmt_update)) {
    $stmt_update->close();
}
$stmt_status->close();
$connect->close();
?>
