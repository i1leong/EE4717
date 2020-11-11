<!DOCTYPE html>

<html>

<head>
    <title>Integrated Medical Appointment System</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<?php
require('db.php');
session_start();
if (isset($_POST['email'])){
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($conn,$email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn,$password);
    $query = "SELECT * FROM `users` WHERE email='$email' and password='".md5($password)."'";
    $result = mysqli_query($conn,$query) or die(mysql_error());
    if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_assoc($result);
	$_SESSION['id'] = $row['id']; 
	$_SESSION['name'] = $row['name'];
	if ($row['account_type'] == "normal"){
            header("Location: doctor.php");
	}
	else {
	    header("Location: admin.php");
	}
    }
    else { ?>
    
    <body>
    <div class="wrapper">
        <header>
            <center><img src="assets/header.png" height="120px" width="1000px" alt="Integrated Medical Appointment System"></center>
        </header>
        <div class="nav_bar_landing">
            <nav class="navbar">
                <ul class="topnav">
                    <li class="left"><a href="index.html">BACK</a></li>
                </ul>
            </nav>
        </div>
        <div class="content">
            <div class="register">
                <h2>Login to your account</h2>
                <p style="color:red">The email/password is invalid</p>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-25">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-75">
                            <input type="email" name="email" id="email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="password">Password</label>
                        </div>
                        <div class="col-75">
                            <input type="password" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="row">
                        <a class="links" href="register.php" id="register_link">Register?</a>
                    </div>
                    <div class="row">
                        <a class="links" href="" id="forgot-password-link">Forgot Password?</a>
                    </div>
                    <div id="register-button-container">
                        <input id="register-button" type="submit" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div>
    </body>
    
    <?php } } else { ?>

    <body>
    <div class="wrapper">
        <header>
            <center><img src="assets/header.png" height="120px" width="1000px" alt="Integrated Medical Appointment System"></center>
        </header>
        <div class="nav_bar_landing">
            <nav class="navbar">
                <ul class="topnav">
                    <li class="left"><a href="index.html">BACK</a></li>
                </ul>
            </nav>
        </div>
        <div class="content">
            <div class="register">
                <h2>Login to your account</h2>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-25">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-75">
                            <input type="email" name="email" id="email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="password">Password</label>
                        </div>
                        <div class="col-75">
                            <input type="password" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="row">
                        <a class="links" href="register.php" id="register_link">Register?</a>
                    </div>
                    <div class="row">
                        <a class="links" href="" id="forgot-password-link">Forgot Password?</a>
                    </div>
                    <div id="register-button-container">
                        <input id="register-button" type="submit" value="Login">
                    </div>

                </form>

            </div>
        </div>
    </div>
    </body>

    <?php } ?>

</html>
