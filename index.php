<?php
session_start();

require_once "./components/db_connect.php";

$error = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_phone = $_POST['email_phone'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE phone_number = '$email_phone' OR email = '$email_phone'";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $userId = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['admin_id'] = $userId; 
            header("Location: ./admin/dashboard.php");
            exit();
        } else {
            $error = "Incorrect email or phone, or password.";
            $_SESSION['email_phone'] = $email_phone; 
        }
    } else {
        $error = "Incorrect email or phone, or password.";
        $_SESSION['email_phone'] = $email_phone; 
    }
}

if ($_SERVER["REQUEST_METHOD"] != "POST" || isset($error)) {
    unset($_SESSION['email_phone']);
}

$connect->close();
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign In</title>
  <link rel="stylesheet" href="./assets/css/signin.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>
<body>
  <div class="container" id="container">
    <div class="form-container sign-up-container"></div>
    <div class="form-container sign-in-container">
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h1>Log In</h1>
        <div class="social-container">
        </div>
        
        <input type="text" name="email_phone" placeholder="Email or Phone" value="<?php echo isset($_SESSION['email_phone']) ? $_SESSION['email_phone'] : ''; ?>" />
        <input type="password" name="password" placeholder="Password" />
        <?php if (isset($_GET['error'])) { ?>
          <span style="color: red;"><?php echo $_GET['error']; ?></span></>
        <?php } ?>
        <span style="color: red;"><?php echo $error; ?></span>
       
        <button type="submit">Sign In</button>
      </form>
    </div>
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1>Welcome Back!</h1>
          <p>To keep connected with us please login</p>
        </div>
        <div class="overlay-panel overlay-right">
          <h1>Welcome Back Admin!</h1>
         
          <a href="../login/signup.php" id="login" class="ghost"></a>
        </div>
      </div>
    </div>
  </div>
  <?php
    unset($_SESSION['email_phone']); 
  ?>
</body>
</html>
