<?php
session_start();
include "../components/db_connect.php";

if (isset($_SESSION['admin_id'])) {
    // session_unset();
    // session_destroy();
    header("Location: ../index.php");

    // Get the current date in Philippine standard time
    
} else {
    $response['error'] = 'User session not found.';
}
?>
