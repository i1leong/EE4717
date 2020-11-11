<!DOCTYPE html>
<html lang="en">

<head>
    <title>Integrated Medical Appointment System</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>

<?php
require('db.php');
if (isset($_REQUEST['email'])){
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($conn,$email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn,$password);
        $name = stripslashes($_REQUEST['name']);
        $name = mysqli_real_escape_string($conn,$name);
        $phone = stripslashes($_REQUEST['phone']);
        $phone = mysqli_real_escape_string($conn,$phone);
        $age = stripslashes($_REQUEST['age']);
        $age = mysqli_real_escape_string($conn,$age);
        $dob = stripslashes($_REQUEST['dob']);
        $dob = mysqli_real_escape_string($conn,$dob);
        $height = stripslashes($_REQUEST['height']);
        $height = mysqli_real_escape_string($conn,$height);
        $condition = stripslashes($_REQUEST['existing_conditions']);
        $condition = mysqli_real_escape_string($conn,$condition);
        $sql = "INSERT into `users` (email, password, name, phone, age, dob, height, existing_condition, account_type) VALUES ('$email', '".md5($password)."', '$name', '$phone', '$age', '$dob', '$height', '$condition', 'normal')";
        $result = mysqli_query($conn,$sql);
        if($result) {
?>
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
                <center>
                <h2>You are registered successfully</h2>
                <p><a href="login.php">Login here</p>
                </center>
            </div>
        </div>
    </div>
    </body>

<?php } } else { ?>

    <body>
        <div class="wrapper">
            <header>
                <center><img src="assets/header.png" height="120px" width="1000px"
                        alt="Integrated Medical Appointment System"></center>
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
                    <h2>Register your account with ease!</h2>
                    <div>
                        <script type="text/javascript" src="/scripts/upload_photo.js"></script>
                        <input class="choose_file" type="file" accept="image/*" name="image" id="file" onchange="loadFile(event)"
                                style="display: none;">
                        <img class="choose_file" id="output"/>
                        <label class="choose" for="file" style="cursor: pointer;">Upload Picture</label>
                    </div>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-25">
                                <label for="name">Name</label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="name" id="name" required>
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
                            <div class="col-25">
                                <label for="email">E-mail</label>
                            </div>
                            <div class="col-75">
                                <input type="email" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="email">Phone</label>
                            </div>
                            <div class="col-75">
                                <input type="number" name="phone" id="phone" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="age">Age</label>
                            </div>
                            <div class="col-75">
                                <input type="number" name="age" id="age" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="dob">D.O.B.</label>
                            </div>
                            <div class="col-75">
                                <input type="date" name="dob" id="dob" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="height">Height (cm)</label>
                            </div>
                            <div class="col-75">
                                <input type="number" name="height" id="height" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="existing_conditions">Existing Conditions</label>
                            </div>
                            <div class="col-75">
                                <textarea type="textarea" name="existing_conditions" id="existing_conditions" size="300px" required></textarea>
                            </div>
                        </div>
                        <div id="register-button-container">
                            <label></label>
                            <input id="register-button" type="submit" value="Register">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </body>
    <!-- <script type="text/javascript" src="scripts/validator2.js"></script> -->
<?php } ?>
</html>
