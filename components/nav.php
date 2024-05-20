<?php 

include "../components/db_connect.php";
    $full_name = $_SESSION['name'];

  
    ?>
   <body>
   <nav class="navbar navbar-header navbar-expand navbar-light">
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
            
                <li class="dropdown">
                <a href="#" data-bs-toggle="dropdown"
                    class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <div class="avatar me-1">
                    <img src="../assets/images/logo.png"  alt="Avatar" style="width: 40px; height: 40px; border-radius:100%; border: 2px solid #45a049" ">
                    </div>
                    <div class="d-none d-md-block d-lg-inline-block">Admin</div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../components/update_logout.php"><i data-feather="log-out"></i> Logout</a>
                </div>
                </li>
            </ul>
        </div>
    </nav>
      
   </body>
