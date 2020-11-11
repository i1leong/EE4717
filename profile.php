<!DOCTYPE html>
<html lang="en">
<?php
    include "session.php";
?>

<head>
    <title>Integrated Medical Appointment System</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="wrapper">
        <header>
            <center><img src="assets/header.png" height="120px" width="1000px"
                    alt="Integrated Medical Appointment System"></center>
        </header>
        <div class="nav_bar_landing">
            <nav class="navbar">
                <ul class="topnav">
                    <li class="left"><a href="doctor.php">Doctor</a></li>
                    <li><a>|</a></li>
                    <li><a href="appointments.php">Appointments</a></li>
                    <li><a>|</a></li>
                    <li><a href="history.php">History</a></li>
                    <li><a>|</a></li>
                    <li><a class="active" href="profile.php">Profile</a></li>
                    <li class="right" id="logout"><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
	    </div>
	
<?php

include "db.php";
$id = $_SESSION["id"];
	$sql = "SELECT * FROM `users` WHERE id='$id'"; 
	$result = mysqli_query($conn, $sql) or die (mysql_error());
	$row = mysqli_fetch_assoc($result);
	$GLOBALS = $row;
if ((isset($_SESSION["id"])) AND (!isset($_POST["update-button"])) AND (!isset($_POST["confirm-button"]))){
	
?>	
        <div class="content">
            <div class="profile-form">
                <div class="profile_picture">
                    <img class="avatar" src="assets/avatar-default.png" alt="avatar" width="150px">
                </div>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-50-left">
                            <label for="name">Name:</label>
                        </div>
                        <div class="col-50-right">
			    <label id="name" for="name"><?php echo $GLOBALS["name"];?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-50-left">
                            <label for="contact">Contact:</label>
                        </div>
                        <div class="col-50-right">
			<label id="contact" for="contact"><?php echo $GLOBALS["phone"];?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-50-left">
                            <label for="email">E-mail:</label>
                        </div>
                        <div class="col-50-right">
			<label id="email" for="email"><?php echo $GLOBALS["email"];?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-50-left">
                            <label for="dob">D.O.B (YYYY-MM-DD):</label>
                        </div>
                        <div class="col-50-right">
			<label id="dob" for="dob"><?php echo $GLOBALS["dob"];?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-50-left">
                            <label for="height">Height</label>
                        </div>
                        <div class="col-50-right">
			<label id="height" for="height"><?php echo $GLOBALS["height"];?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-50-left">
                            <label for="existing_conditions">Health Conditions:</label>
                        </div>
                        <div class="col-50-right">
			<label id="existing_conditions" for="existing_conditions"><?php echo $GLOBALS["existing_condition"];?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-50-left">
                            <label for="active">Active</label>
                        </div>
                        <div class="col-50-right">
                            <label id="active" for="active">Yes</label>
                        </div>
                    </div>
                    <div id="update-button-container">
                        <label></label>
                        <input id="update-button" name="update-button" type="submit" value="Update">
                    </div>
                </form>
                
            </div>
        </div>

<?php } 
	else if ((isset($_SESSION["id"])) AND (isset($_POST["update-button"])) AND (!isset($_POST["confirm-button"]))){
        ?>
    <div class="content">
        <div class="register">
            <h2>Update your particulars here</h2>
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
                        <input type="text" name="name" id="name" value="<?php echo $GLOBALS["name"];?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="email">E-mail</label>
                    </div>
                    <div class="col-75">
                        <input type="email" name="email" id="email" value="<?php echo $GLOBALS["email"];?>"" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="email">Phone</label>
                    </div>
                    <div class="col-75">
                        <input type="number" name="phone" id="phone" value="<?php echo $GLOBALS["phone"];?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="dob">D.O.B (YYYY-MM-DD):</label>
                    </div>
                    <div class="col-75">
                        <input type="date" name="dob" id="dob" value="<?php echo $GLOBALS["dob"];?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="height">Height (cm)</label>
                    </div>
                    <div class="col-75">
                        <input type="number" name="height" id="height" value="<?php echo $GLOBALS["height"];?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="existing_conditions">Existing Conditions</label>
                    </div>
                    <div class="col-75">
                        <textarea type="textarea" name="existing_conditions" id="existing_condition" size="300px" required><?php echo $GLOBALS["existing_condition"];?></textarea>
                    </div>
                </div>
                <div id="register-button-container">
                    <label></label>
                    <input id="confirm-button" name="confirm-button" type="submit" value="Confirm">
                </div>

            </form>

        </div>
    </div>
<?php	}
    else if(isset($_POST["confirm-button"])){
        echo
        '<script type="text/Javascript">
        confirm("Confirm Submission?");
        </script>';

        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($conn,$email);
        $name = stripslashes($_REQUEST['name']);
        $name = mysqli_real_escape_string($conn,$name);
        $phone = stripslashes($_REQUEST['phone']);
        $phone = mysqli_real_escape_string($conn,$phone);
        $dob = stripslashes($_REQUEST['dob']);
        $dob = mysqli_real_escape_string($conn,$dob);
        $height = stripslashes($_REQUEST['height']);
        $height = mysqli_real_escape_string($conn,$height);
        $condition = stripslashes($_REQUEST['existing_conditions']);
        $condition = mysqli_real_escape_string($conn,$condition);
        //$trn_date = date("Y-m-d H:i:s");
        $sql = "UPDATE `users` SET 
                `name` = '$name', 
                `phone` = '$phone', 
                `dob` = '$dob', 
                `height` = '$height', 
                `existing_condition` = '$condition' WHERE `email`='$email'";
        //echo $sql;
        $result = mysqli_query($conn,$sql);
        if($result) {
            //echo "success";
            $GLOBALS = array();
            $_POST = array();
	    echo 
   	    '<script type="text/Javascript">
	    alert("Your particulars are updated.");
	    window.location.href = "profile.php";
	    </script>';
	    
        }
    }
?>
    </div>
</body>
</html>
