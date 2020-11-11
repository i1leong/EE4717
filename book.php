<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="style.css">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Integrated Medical Appointment System</title>
   
</head>

<?php
	include ("session.php");
	if(isset($_POST['book'])){
		include 'db.php';
		$start_day = $_POST["start_day"];	
		$unix_start_day = intval(strtotime(htmlspecialchars($start_day)));

		$start_hour = $_POST["start_hour"];
		$start_minute = $_POST["start_minute"];
		$unix_start_time = (60*60*intval(htmlspecialchars($start_hour))) + (60*intval(htmlspecialchars($start_minute)));
		
		$end_hour = $_POST["end_hour"];
		$end_minute = $_POST["end_minute"];
		$unix_end_time = (60*60*intval(htmlspecialchars($end_hour))) + (60*intval(htmlspecialchars($end_minute)));
		$sickness = htmlspecialchars($_POST["sickness"]);
		
		$start_epoch = $unix_start_day + $unix_start_time;
		$end_epoch = $unix_start_day + $unix_end_time;
		
		// prevent double booking
		$sql = "SELECT * FROM `bookingcalendar` WHERE (unix_start_day>=$unix_start_day) AND cancelled=0";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {

			while($row = mysqli_fetch_assoc($result)) {
				for ($i = $start_epoch; $i <= $end_epoch; $i=$i+600) {
					if ($i>($row["unix_start_day"]+$row["unix_start_time"]) && $i<($row["unix_end_day"]+$row["unix_end_time"])) {
						echo 
						'<script type="text/Javascript">
						alert("The timeslot has been booked. Please choose another time");
						window.history.back();
						</script>';
						goto end;
					}
				}
			}				
		}
		$name = $_SESSION['name'];
		$phone = $_SESSION['phone'];
		$pid = $_SESSION['id'];		
		$sql = "INSERT INTO `bookingcalendar` (patient_id, name, phone, sickness, start_day, start_hour, start_minute, end_hour, end_minute, start_epoch, end_epoch, unix_start_day, unix_start_time, unix_end_day, unix_end_time, doctor, doctor_id, cancelled)
			VALUES ('$pid', '$name', '$phone', '$sickness', '$start_day', '$start_hour', '$start_minute', '$end_hour', '$end_minute', '$start_epoch', '$end_epoch', '$unix_start_day', '$unix_start_time', '$unix_start_day', '$unix_end_time', '$dname', '$did', '0')";
		
		if (mysqli_query($conn, $sql)) {
			$_POST = array(); //clear off POST array after insertion complete
			send_mail($name); //send email
			
?>
		<body>
    	<div class="wrapper">
        <header>
            <center><img src="assets/header.png" height="120px" width="1000px"
                    alt="Integrated Medical Appointment System"></center>
        </header>
        <div class="nav_bar_landing">
            <nav class="navbar">
                <ul class="topnav">
                    <li class="left"><a class="active" href="doctor.php">Doctor</a></li>
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
            <div class="box">
				<center>
					<p>Your booking is submitted. You will receive a confirmation email at your registered email address.</p>
					<table border = "1">
						<tr><td>
							<p><center>Booking Details</center>
							<br>Doctor: Dr.<?php echo $dname; ?>
							<br>Appointment Date: <?php echo $start_day;?>
							<br>Appointment Time: <?php echo $start_hour.":".$start_minute." - ".$end_hour.":".$end_minute;?> </p>
						</td></tr>
					</table>
					<p><a href="appointments.php">Amend your appointment here</a><p>
				</center>
			</div>
		</div>

<?php } else { 
			echo 
			'<script type="text/Javascript">
			alert("There is an error processing your request. Please try again");
			window.history.back();
			</script>';
			end:
			mysqli_close($conn);
		}
	} else {
?>

<body>
    <div class="wrapper">
        <header>
            <center><img src="assets/header.png" height="120px" width="1000px"
                    alt="Integrated Medical Appointment System"></center>
        </header>
        <div class="nav_bar_landing">
            <nav class="navbar">
                <ul class="topnav">
                    <li class="left"><a class="active" href="doctor.php">Doctor</a></li>
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
            <div class="box">
                <table border="1" cellpadding="5" width="1400">
                    <tr>
                        <td valign="top">
                        <form action="" method="post">
                            <table width="460">
							<h3>Make booking</h3>
                            <p>All fields are mandatory</p>
                                <tr>
                                    <td>Booking date:</td>
                                </tr>
                                <tr>
                                    <td>
                                    <input name="start_day" required="" type="date"/>
                                    </td>
                                </tr>                                
                                <tr>
                                    <td>Start time:</td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="start_hour">
                                        <option selected="selected">08</option>
                                        <option>09</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                        <option>14</option>
                                        <option>15</option>
                                        <option>16</option>
                                        <option>17</option>
                                        <option>18</option>
                                        <option>19</option>
                                        <option>20</option>
                                        <option>21</option>
                                        </select>:<select name="start_minute">
                                        <option selected="selected">00</option>
                                        <option>30</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>End time:</td>
                                </tr>
                                <tr>
                                    <td><select name="end_hour">
                                        <option selected="selected">08</option>
                                        <option>09</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                        <option>14</option>
                                        <option>15</option>
                                        <option>16</option>
                                        <option>17</option>
                                        <option>18</option>
                                        <option>19</option>
                                        <option>20</option>
                                        <option>21</option>
                                        </select>:<select name="end_minute">
                                        <option>00</option>
                                        <option selected="selected">30</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td>Sickness</td>
                                </tr>
                                <tr>
                                    <td><textarea type="textarea" name="sickness" id="sickness" size="300px" required></textarea></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>
                                        <center><input name="book" type="submit" value="Book"></center>   
                                    </td>
                                </tr>
                            </table>                          
                        </form>
                        </td>
                        <td valign="top">
                        <?php
                            include 'db.php';
                            
                            $month = date("m");
                            $year = date("Y");
                            $monthName = date('F', mktime(0, 0, 0, $month, 10));
                            echo "<h3>Schedule for Dr.$dname $monthName $year $pass</h3>";
                            echo draw_calendar($month, $year);
                        ?>
                        
                        </td>
                    </tr>
                </table>              
            </div>  
        </div>
	</div>
  
<?php } ?>
<?php
function draw_calendar($month,$year){

	include 'db.php';

	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar" width="1000">';

	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar.= '<td class="calendar-day">';
			/* add in the day number */
			$calendar.= '<div class="day-number">'.$list_day.'</div>';

			$calendar.= str_repeat('<p> </p>',2);
			$current_epoch = mktime(0,0,0,$month,$list_day,$year);
			$sql = "SELECT * FROM `bookingcalendar` WHERE ($current_epoch BETWEEN unix_start_day AND unix_end_day) AND doctor_id=$did AND cancelled=0";
						
			$result = mysqli_query($conn, $sql);
    		
    		if (mysqli_num_rows($result) > 0) {
    			while($row = mysqli_fetch_assoc($result)) {
    				$calendar .= "<br>Booking ID: ".$row["id"]."<br>";
    				if($current_epoch == $row["unix_start_day"] AND $current_epoch != $row["unix_end_day"]) {
    					$calendar .= "Booking starts: ".sprintf("%02d:%02d", $row["start_hour"], ($row["start_minute"]))."<br><hr><br>";
    				}
    				if($current_epoch == $row["unix_start_day"] AND $current_epoch == $row["unix_end_day"]) {
    					$calendar .= "Booking starts: ".sprintf("%02d:%02d", $row["start_hour"], ($row["start_minute"]))."<br>";
    				}
    				if($current_epoch == $row["unix_end_day"]) {
    					$calendar .= "Booking ends: ".sprintf("%02d:%02d", $row["end_hour"], ($row["end_minute"])) . "<br><hr><br>";
    				}
					if($row["cancelled"] == 1) $calendar .= "</s></font>";
    			}
			} else {
    			$calendar .= "No bookings";
			}
			
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8 AND $days_in_this_week > 1):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	$calendar.= '</tr>';

	$calendar.= '</table>';
	
	mysqli_close($conn);
	
	return $calendar;
}
?>

<?php
function send_mail($name){
$to      = 'f32ee@localhost';
$subject = 'Booking Confirmed';
$message = 'Hello '.$name.','."\n".'Your booking is confirmed';
$headers = 'From: admin@imas.com' . "\r\n" .
	    'Reply-To: f32ee@localhost' . "\r\n" .
	        'X-Mailer: PHP/' . phpversion();
mail($to, $subject, $message, $headers,'-ff32ee@localhost');
}
?> 

</body>

</html>

