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
                    <li><a class="active" href="appointments.php">Appointments</a></li>
                    <li><a>|</a></li>
                    <li><a href="history.php">History</a></li>
                    <li><a>|</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li class="right" id="logout"><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
        <div id="content">
            <div id="tiles">
                <div class="appointment-title">
                    <h2>Upcoming Appointments</h2>
                </div>
		<?php echo retrieve_appointment();?>
<?php
function retrieve_appointment(){
	include "db.php";
	//session_start();
	$pid = $_SESSION['id'];
	$sql = "SELECT * FROM `bookingcalendar` WHERE cancelled='0' AND patient_id=$pid ORDER BY start_epoch ASC";
	$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0){
	$appointment ="";
	while ($row = mysqli_fetch_assoc($result)) {
		$current_time = $_SERVER['REQUEST_TIME'];
		if ($current_time < $row["start_epoch"]){
		$appointment.= '<div class = "row">';
		$appointment.= '<table class="appointments-row" align="center">';
		$appointment.= '<tbody id ="appointment-tile">';
		$appointment.= '<td id = "clinic-schedule-25">';
		$appointment.= '<label class = "hospital_name" for="dname" id="dname">Dr.'.$row["doctor"].'</label>';
		$appointment.= '<label class = "appointment_schedule" for="date" id="date">Date: '.$row["start_day"].'</label>';
		$appointment.= '<label class = "appointment_schedule" for="time" id="time">Time: '.sprintf("%02d:%02d",$row["start_hour"],$row["start_minute"]).'-'.sprintf("%02d:%02d",$row["end_hour"],$row["end_minute"]).'</label></td>';
			$appointment.= '<td id="clinic-schedule-25">';
			$appointment.= '<button id="schedule-button">';
			$appointment.= '<a id="tile-button-text" href="amend.php?bid='.$row["id"].'&did='.$row["doctor_id"].'">Amend</a>';
			$appointment.= '</button></td>';
		$appointment.= '<td id="clinic-schedule-image">';
		$appointment.= '<img class="clinic-image-appointment" id="doctor-image" src="assets/doctor_'.$row["doctor_id"].'.png" alt="doctor_image">';
		$appointment.= '</td>';
		$appointment.= '</tbody></table></div>';
	}
	
}}
else { $appointment = "<p>You do not have any upcoming appointments. <a href='doctor.php'>Make one now</a></p>";}
return $appointment;
}
?>
        </div>
    </div>
</body>

</html>
