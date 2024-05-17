<?php
session_start();
include "../components/db_conn.php";
date_default_timezone_set("Asia/Manila");

if (isset($_POST['emp_id']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $emp_id = validate($_POST['emp_id']);
    $pass = validate($_POST['password']);

    if (empty($emp_id) || empty($pass)) {
        header("Location: ../index.php?error=Username and password are required");
        exit();
    }

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR employee_id = ?");
    $stmt->bind_param("ss", $emp_id, $emp_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify the hashed password
        if (password_verify($pass, $row['password'])) {
            // Password is correct
            // Fetch additional details from the employees table
            $empDetailsSql = "SELECT full_name, department, position FROM employees WHERE employee_id = ?";
            $empDetailsStmt = $conn->prepare($empDetailsSql);
            $empDetailsStmt->bind_param("s", $emp_id);
            $empDetailsStmt->execute();
            $empDetailsResult = $empDetailsStmt->get_result();

            if ($empDetailsResult && $empDetailsResult->num_rows === 1) {
                $empDetails = $empDetailsResult->fetch_assoc();

                if ($empDetails['position'] === 'ADMIN') {
                    // Format the time to display in AM/PM format
                    $formattedTime = date("h:i A");

                    // Now you have the details, and you can insert into the log_report table
                    $insertLogSql = "INSERT INTO log_report (employee_id, full_name, login_date, login_time, department, position, status) VALUES (?, ?, CURDATE(), ?, ?, ?, 'Active Admin')";
                    $insertLogStmt = $conn->prepare($insertLogSql);
                    $insertLogStmt->bind_param("sssss", $emp_id, $empDetails['full_name'], $formattedTime, $empDetails['department'], $empDetails['position']);
                    $insertLogStmt->execute();

                    // Set session variables and redirect-
                    $_SESSION['employee_id'] = $row['employee_id'];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['role'] = $empDetails['position'];
                    $_SESSION['name'] = $empDetails['full_name'];
                    header("Location: ../admin/dashboard.php");
                    exit();
                } else {
                    header("Location: ../index.php?error=Only Admin can access");
                    exit();
                }
            } else {
                header("Location: ../index.php?error=Error fetching employee details");
                exit();
            }
        } else {
            // Incorrect password
            header("Location: ../index.php?error=Incorrect User name or password");
            exit();
        }
    } else {
        // User not found
        header("Location: ../index.php?error=Incorrect User name or password");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>
