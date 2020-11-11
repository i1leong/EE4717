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
	<?php
	    include 'db.php';
	    $did = $_GET['did'];
	?>
        <div class="nav_bar_landing">
            <nav class="navbar">
                <ul class="topnav">
                    <li class="left"><a href="doctor.php">Doctor</a></li>
                    <li><a>|</a></li>
                    <li><a href="appointments.php">Appointments</a></li>
                    <li><a>|</a></li>
                    <li><a href="history.php">History</a></li>
                    <li><a>|</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li class="right" id="logout"><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
        <div class="content">
            <div class="profile-form">
                <div class="profile_picture">
		<img class="avatar" src="assets/<?php echo $image;?>" alt="avatar" width="150px">
                </div>
                <form action="scripts/show_post.php" method="post">
                    <div class="row">
                        <div class="col-50-left">
                            <label for="name">Name:</label>
                        </div>
                        <div class="col-50-right">
				<label id="name" for="name">Dr. <?php echo $dname; ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-50-left">
                            <label for="specialisation">Specialisation:</label>
                        </div>
                        <div class="col-50-right">
			<label id="specialisation" for="specialisation"><?php echo $specialisation; ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-50-left">
                            <label for="email">E-mail:</label>
                        </div>
                        <div class="col-50-right">
			<label id="email" for="email"><?php echo $email;?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-50-left">
			<label for="schedule">Schedule:</label>
                        </div>
                        <div class="col-50-right">
			<label id="schedule" for="schedule"><?php echo $schedule;?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-50-left">
                            <label for="qualification">Qualification:</label>
                        </div>
                        <div class="col-50-right">
			<label id="qualification" for="qualification"><?php echo $qualification;?></label>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</body>

</html>
