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
    <title>Orders</title>
    
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendors/simple-datatables/style.css">
    <script defer src="../assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/css/app.css">
      <style type="text/css">
        .notif:hover{
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
                <div id="gcashModal" class="modal">
                    <div class="modal-content"  style=" max-width: 250px; margin-top:70px; margin-bottom:-50px;">
                        <span class="close" onclick="closeGcashModal()">&times;</span>
                        <img src="../assets/images/gcash.png" alt="GCash QR Code" style=" max-width: 250px;"><br><br>
                        <p></p>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            include "../components/db_connect.php";

                            $sql = "SELECT * FROM orders";
                            $result = $connect->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<table class='table' id='table1'>";
                                echo "    <thead>";
                                echo "        <tr>";
                                echo "            <th>User ID</th>";
                                echo "            <th>Date</th>";
                                echo "            <th>Address</th>";
                                echo "            <th>Payment</th>";
                                echo "            <th>Price</th>";
                                echo "            <th>Name</th>";
                                echo "            <th>Confirmation</th>";
                                echo "        </tr>";
                                echo "    </thead>";
                                echo "    <tbody>";

                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td>' . $row['user_id'] . '</td>';
                                    echo '<td>' . $row['date'] . '</td>';
                                    echo '<td>' . $row['address'] . '</td>';
                                    echo '<td><button type="button" class="btn btn-primary btn-sm"  onclick="showGcashModal()">' . $row['payment'] . '</button></td>';
                                    echo '<td>₱' . $row['price'] . '</td>';
                                    echo '<td>' . $row['name'] . '</td>';
                                    
                                    $status_color = '';
                                    switch ($row['confirmation']) {
                                        case 'Unsettled':
                                            $status_color = 'red';
                                            break;
                                        case 'Paid':
                                            $status_color = 'green';
                                            break;
                                        case 'Unpaid':
                                            $status_color = 'purple';
                                            break;
                                        default:
                                            $status_color = 'blue'; // Default color if status doesn't match any case
                                    }

                                    echo '<td><button type="button" class="btn btn-primary btn-sm" style="background-color:' . $status_color . '" onclick="showStatusForm(' . $row['id'] . ')">' . $row['confirmation'] . '</button></td>';
 
                                    echo '</tr>';
                                }
                                
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
    //modals
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel">Confirm Payment</h5>
                        <button type="button" class="close" aria-label="Close" onclick="closeEditModal()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form" method="post" id="statusForm" >
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="Unsettled">Unsettled</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Unpaid">Unpaid</option>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                url: "update_payment.php",
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
        function showGcashModal() {
            var modal = document.getElementById("gcashModal");
            var fileUploadContainer = document.getElementById("fileUploadContainer");
            modal.style.display = "block";
            fileUploadContainer.style.display = "block";
        }

        // Function to close the GCash modal
        function closeGcashModal() {
            var modal = document.getElementById("gcashModal");
            var fileUploadContainer = document.getElementById("fileUploadContainer");
            modal.style.display = "none";
            fileUploadContainer.style.display = "block"; 
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
