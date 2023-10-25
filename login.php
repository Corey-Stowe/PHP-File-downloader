<?php
require 'config.php';
session_start();
if($login == false){
    $_SESSION['username'] = "root";
} else {
    $error = [];
if(isset($_POST['submit'])){
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (isset($users[$username]) && $users[$username]['password'] == $password) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
    } else {
        $fail = 'Username or password is incorrect !';
    }
    
        }
    }
}      


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Login</title>
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        .badge-notifications {
            margin: 20px;
            padding: 20px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            text-align: center;
        }

        .login-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>
    <h1 class="text-center mt-4">PHP File Downloader</h1>
    <div class="badge-notifications">
        <?php
        if (isset($_SESSION['error'])) {
            foreach ($_SESSION['error'] as $error) {
                echo '<p class="text-danger">' . $error . '</p>';
            }
            unset($_SESSION['error']);
        }
        if (isset($fail)) {
            echo '<p class="text-danger">' . $fail . '</p>';
        }

       ?>
  
    </div>
    <div class="login-form">
        <form class="login-form-data" action=" " method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="password">password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Passwords">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Login</button>
            <p></p>
            <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo $url ?>'">Support</button>
        </form>
    </div>
</body>
</html>
<?php
 include 'view/footer.php';

?>
