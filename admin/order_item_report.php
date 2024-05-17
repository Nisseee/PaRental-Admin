<?php 
session_start();
include "../components/db_conn.php";


if (isset($_SESSION['admin_id'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve order ID and status from the POST data
        $orderId = $_POST['orderId'];
        $status = $_POST['status'];
    
        // Update the status in the order_item table
        $sql = "UPDATE order_item SET status = '$status' WHERE id = '$orderId'";
    
        if ($connect->query($sql) === TRUE) {
            echo json_encode(array("success" => true));
            header("Location: ../admin/add_category.php?success=1");
        } else {
            echo json_encode(array("success" => false, "error" => "Error updating record: " . $connect->error));
            header("Location: ../admin/add_category.php?failed=1");
        }
    
        $connect->close();
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    
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
                            <h3>Orders Report</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-success">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Orders Report</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <?php
                                if (isset($_GET['success']) && $_GET['success'] == 1) {
                                    echo '<div class="alert alert-success" role="alert">
                                            Updated successfully!
                                        </div>';
                                } ?>
                                <?php
                                if (isset($_GET['failed']) && $_GET['failed'] == 1) {
                                    echo '<div class="alert alert-danger" role="alert">
                                            Unfortunately, error encounter!
                                        </div>';
                                } ?>
                            <?php
                            include "../components/db_connect.php";

                            $sql = "SELECT o.*, p.name as product_name, oi.quantity as quantity, oi.start_date as start_date, oi.end_date as end_date, oi.status as status, oi.id as order_itemID 
                                    FROM orders o 
                                    JOIN order_item oi ON o.id = oi.order_id 
                                    JOIN products p ON oi.product_id = p.id
                                    ORDER BY o.id DESC";
                            $result = $connect->query($sql);
                            
                            $currentOrderId = null;
                            
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    // Start a new table for each unique order ID
                                    if ($currentOrderId !== $row['id']) {
                                        // Close the previous table if it exists
                                        if ($currentOrderId !== null) {
                                            echo '</tbody>';
                                            echo '</table>';
                                        }
                                        // Start a new table for the current order
                                        echo "<h4>Order ID: " . $row['id'] . "</h4>";
                                        echo "<table class='table' id='table'>";
                                        echo "    <thead>";
                                        echo "        <tr>";
                                        echo "            <th>Product Name</th>";
                                        echo "            <th>Quantity</th>";
                                        echo "            <th>Start Date</th>";
                                        echo "            <th>End Date</th>";
                                        echo "            <th>Payment</th>";
                                        echo "            <th>Status</th>";
                                        echo "        </tr>";
                                        echo "    </thead>";
                                        echo "    <tbody>";
                                        $currentOrderId = $row['id'];
                                    }
                            
                                    // Display order item details within the current table
                                    echo '<tr>';
                                    echo '<td>' . $row['product_name'] . '</td>';
                                    echo '<td>' . $row['quantity'] . '</td>';
                                    echo '<td>' . $row['start_date'] . '</td>';
                                    echo '<td>' . $row['end_date'] . '</td>';
                                    echo '<td>' . $row['payment'] . '<br>' . $row['confirmation'] . '</td>';
                                    
                                    $status_color = '';
                                    switch ($row['status']) {
                                        case 'Pending':
                                            $status_color = 'orange';
                                            break;
                                        case 'Processing':
                                            $status_color = 'orange';
                                            break;
                                        case 'Delivered':
                                            $status_color = 'green';
                                            break;
                                        case 'Returned':
                                            $status_color = 'purple';
                                            break;
                                        default:
                                            $status_color = 'blue'; // Default color if status doesn't match any case
                                    }
                            
                                    echo '<td><button type="button" class="btn btn-primary btn-sm" style="background-color:' . $status_color . '" onclick="showStatusForm(' . $row['order_itemID'] . ')">' . $row['status'] . '</button></td>';
                            
                                    echo '</tr>';
                                }
                            
                                // Close the last table
                                echo '</tbody>';
                                echo '</table>';
                            } else {
                                echo '<h2 style="text-align: center; color: orange;">No Orders in the List</h2>';
                            }
                            
                            $connect->close();
                            
                            ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel">Update Status</h5>
                        <button type="button" class="close" aria-label="Close" onclick="closeEditModal()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form" method="post" id="statusForm" >
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="Processing">Processing</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Returned">Returned</option>
                                </select>
                            </div>
                            <input type="hidden" id="orderId" name="orderId">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeEditModal()">Close</button>
                        <button type="submit" class="btn btn-primary" onclick="updateStatus()">Update</button>
                    </div>
                </div>
            </div>
    </div>
    <script src="../assets/js/feather-icons/feather.min.js"></script>
    <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <script src="../assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/js/vendors.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function showStatusForm(orderId) {
            $('#statusModal').modal('show');
            $('#orderId').val(orderId);
            console.log(orderId);
        }
        
        function updateStatus() {
            var orderId = $('#orderId').val();
            var status = $('#status').val();
            console.log(orderId);
            console.log(status);
            $.ajax({
                type: "POST",
                url: "update_status.php",
                data: {
                    orderId: orderId,
                    status: status
                },
                success: function(response) {
                    // Handle success
                    console.log(response);
                    // Reload the page or update the UI as needed
                    location.reload(); // For example, reload the page after updating
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                    alert("Error updating status");
                }
            });

            // Close the modal
            $('#statusModal').modal('hide');
        }
        function closeEditModal() {
            // Close the modal
            $('#statusModal').modal('hide');
        }
        
    </script>
</body>
</html>
<?php 
} else {
    header("Location: ../index.php?error=Only Admin can access ");
    exit();
}

?>
