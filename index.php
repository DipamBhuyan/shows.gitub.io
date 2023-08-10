<?php
    session_start();
    if(isset($_POST['username'])){
        $dbh = new PDO('mysql:host=localhost;dbname=show_record', 'root', 'password');
        $user=$_POST['username'];
        $password=$_POST['password'];
        $stmt = $dbh->prepare("SELECT * FROM admins where username = ? and password = ?");
        $stmt->bindParam(1, $user);
        $stmt->bindParam(2, $password);
        $stmt->execute();
        if($stmt->rowCount()==0){
            $msg = "<center>Wrong Username or Password</center>";
        }
        else{
            $row = $stmt->fetch();
            session_regenerate_id(); 
            $_SESSION["rid"] = $row[0];
            header("location: home.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Roboto:wght@500&display=swap" rel="stylesheet">
    <title>Admin Login</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: linear-gradient(150deg, #ffd700cf, #ffd300a6, #ffc1078c, #ffc1076b, #ffc1025c);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            height: 350px;
            animation: fadeInUp 0.5s;
        }
        .login-container h2{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .w3-btn {
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
            
        @media screen and (max-width: 600px) {
            .login-container {
            width: 300px;
            height: 350px;
        }
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form action="index.php" method="POST">
            <div class="form-group">
                <?php
                    if (!empty($msg)) {
                        echo '<div class="error-message">' . $msg . '</div>';
                    }
                ?>
            </div>
            <div class="form-group">
                <label for="username">  <i class="fa fa-user icon fa-lg"></i>    Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" required>
                    <i class="fa fa-eye icon fa-lg toggle-password" onclick="togglePasswordVisibility()"></i>
                </div>
            </div>
            <button type="submit" class="w3-btn w3-amber">Login</button>
        </form>
    </div>
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("password");
            const icon = document.querySelector(".toggle-password");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>