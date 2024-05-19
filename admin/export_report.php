<?php 
session_start();
include "../components/db_connect.php"; // Ensure the correct inclusion of the database connection file

// Function to export a table to CSV
function exportToCSV($table, $connect) {
    $filename = $table . ".csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $output = fopen("php://output", "w");

    $result = $connect->query("SHOW COLUMNS FROM $table");
    $columns = [];
    while ($row = $result->fetch_assoc()) {
        if ($table == 'admin' && in_array($row['Field'], ['password', 'password_salt'])) {
            continue;
        }
        $columns[] = $row['Field'];
    }
    fputcsv($output, $columns);

    $result = $connect->query("SELECT * FROM $table");
    while ($row = $result->fetch_assoc()) {
        if ($table == 'admin') {
            unset($row['password']);
            unset($row['password_salt']);
        }
        fputcsv($output, $row);
    }
    fclose($output);
    exit();
}

// Check if export is requested
if (isset($_GET['export']) && isset($_GET['table'])) {
    $table = $_GET['table'];
    exportToCSV($table, $connect);
}

if (isset($_SESSION['admin_id'])) {

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Report</title>

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
        <?php require '../components/menu.php';?>
        <div id="main">
            <?php require '../components/nav.php';?>

            <div class="main-content container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Export Data</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-success">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Export Report</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            include "../components/db_conn.php"; // Corrected filename to ensure proper inclusion

                            $result = $connect->query("SHOW TABLES");
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_array()) {
                                    $table = $row[0];
                                    if ($table == 'admin') continue; // Skip the 'admin' table

                                    echo "<h4>Table: $table</h4>";
                                    echo "<table class='table1' id='table_$table'>";
                                    echo "<thead>";
                                    $columns = $connect->query("SHOW COLUMNS FROM $table");
                                    echo "<tr>";
                                    while ($column = $columns->fetch_assoc()) {
                                        if ($table == 'users' && in_array($column['Field'], ['password', 'password_salt'])) {
                                            continue;
                                        }
                                        echo "<th>" . $column['Field'] . "</th>";
                                    }
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";

                                    $data = $connect->query("SELECT * FROM $table");
                                    if ($data->num_rows > 0) {
                                        while ($rowData = $data->fetch_assoc()) {
                                            echo "<tr>";
                                            foreach ($rowData as $key => $value) {
                                                if ($table == 'users' && in_array($key, ['password', 'password_salt'])) {
                                                    continue;
                                                }
                                                echo "<td>" . $value . "</td>";
                                            }
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='" . $columns->num_rows . "'>No data available</td></tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                    echo "<a href='?export=true&table=$table' class='btn btn-success'>Export $table</a>";
                                    echo "<hr>";
                                }
                            } else {
                                echo '<h2 style="text-align: center; color: orange;">No tables found in the database.</h2>';
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
