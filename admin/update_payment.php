<?php 
    include "../components/db_connect.php";

    // Check if orderId and status are set
    if (isset($_POST['orderId']) && isset($_POST['status'])) {
        $orderId = $_POST['orderId'];
        $status = $_POST['status'];

        // Update the status of the order item in the database
        $sql = "UPDATE orders SET confirmation='$status' WHERE id='$orderId'";
        if ($connect->query($sql) === TRUE) {
            echo "Status updated successfully";
        } else {
            echo "Error updating status: " . $connect->error;
        }
    } else {
        echo "Invalid parameters";
    }

    $connect->close();
?>