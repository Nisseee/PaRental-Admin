<?php 
session_start();
include "../components/db_conn.php";

if (isset($_SESSION['admin_id'])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendors/simple-datatables/style.css">
    <script defer src="../assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <style type="text/css">
        .notif:hover {
            background-color: rgba(0,0,0,0.1);
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
                            <h3>Manage Users</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-success">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            include "../components/db_connect.php";
                            $target_dir = "/PaRental-Guardian-Website/images/users/";

                            // Modify SQL query to exclude password, address, gender, and birthday
                            $sql = "SELECT id, full_name, phone_number, email, image, username FROM users";
                            $result = $connect->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<table class='table' id='table1'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Photo</th>";
                                echo "<th>Full Name</th>";
                                echo "<th>Phone Number</th>";
                                echo "<th>Email</th>";
                                echo "<th>Username</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>";
                                    if (!empty($row['image'])) {
                                        echo '<img src="/PaRental-Guardian-Website/images/users/' . $row['image'] . '" alt="Avatar" style="width: 50px; height: 50px; border-radius:10%; border: 2px solid #45a049">';
                                    } else {
                                        echo 'No Image';
                                    }
                                    echo "</td>";
                                    echo "<td>" . htmlspecialchars($row['full_name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['phone_number']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                            } else {
                                echo '<h2 style="text-align: center; color: orange;">No Users in the List</h2>';
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
} else {
    header("Location: ../index.php?error=1Only Admin can access ");
    exit();
}
?>
