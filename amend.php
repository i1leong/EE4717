<!DOCTYPE html>
<?php 
    include "session.php";
?>
<head>
    <link rel="stylesheet" href="style.css">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Integrated Medical Appointment System</title>
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
                    <li><a href="profile.php">Profile</a></li>
                    <li class="right" id="logout"><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
        <?php
    	    $bid = $_GET["bid"];
    	    $did = $_GET["did"];
	    include "db.php";
	    if ((!isset($_POST['amend'])) AND (!isset($_POST['cancel']))){
            //$bid = $_GET["bid"];
            //$did = $_GET["did"];

            //include "db.php";
            $sql = "SELECT * FROM `bookingcalendar` WHERE id = '$bid' AND cancelled = 0";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $GLOBALS = $row;
        ?>    
            
            <div class="content">
            <div class="box">
                <p><?php echo "You are amending Booking ".$GLOBALS['id']." scheduled on ".$GLOBALS['start_day']." from ".sprintf("%02d:%02d",$GLOBALS["start_hour"],$GLOBALS["start_minute"]).' to '.sprintf("%02d:%02d",$GLOBALS["end_hour"],$GLOBALS["end_minute"])." with Dr.".$GLOBALS['doctor'];?></p>
                <table border="1" cellpadding="5" width="1400">
                    <tr>
                        <td valign="top">
                        <form action="" method="post">
                            <table width="460">
							<h3>Amend booking</h3>
                            <p>All fields are mandatory</p>                            
                                <tr>
                                    <td>Booking date:</td>
                                </tr>
                                <tr>
                                    <td>
				                    <input name="start_day" required="" type="date" value="<?php echo $GLOBALS['start_day'];?>">
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
				                    <td><textarea type="textarea" name="sickness" id="sickness" size="300px"><?php echo $GLOBALS['sickness'];?></textarea></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>
                                        <center><input name="amend" type="submit" value="Amend Booking"></center>   
                                    </td>
				</tr>
				<tr>
				    <td><center>or</center></td>
				</tr>
				<tr>
				    <td>
					<center><input style= "background-color:red" name="cancel" type="submit" value="Cancel Booking"></center>
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
            <?php }} else if (isset($_POST['amend'])) {
                include 'db.php';
                $bid = $_GET["bid"];

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
		echo
		'<script type = "text/Javascript">
		confirm("Confirm submission?");
		</script>';

                $sql = "UPDATE `bookingcalendar` SET 
                `sickness`='$sickness',
                `start_day`='$start_day',
                `start_hour`= '$start_hour',
                `start_minute` = '$start_minute', 
                `end_hour` = '$end_hour',
                `end_minute` = '$end_minute',
                `start_epoch` ='$start_epoch', 
                `end_epoch`='$end_epoch', 
                `unix_start_day`='$unix_start_day', 
                `unix_start_time`='$unix_start_time', 
                `unix_end_day`='$unix_start_day', 
                `unix_end_time`='$unix_end_time'
                WHERE `id`='$bid'";
		
                if (mysqli_query($conn, $sql)) {
                    $_POST = array();
                    echo '<script type="text/Javascript">
                    alert("Your booking is amended");
		    window.location.href = "appointments.php";
		    </script>';

                }}
                else if (isset($_POST['cancel'])){
			//echo "hello";
			echo
			'<script type = "text/Javascript">
			confirm("Are you sure you want to cancel the booking?");
			</script>';

			$sql = "UPDATE `bookingcalendar` SET `cancelled`='1' WHERE `id`='$bid'";
			//echo $sql;

			if (mysqli_query($conn, $sql)) {
				$_POST = array();
			echo '<script type="text/Javascript">
			alert("Your booking is cancelled");
                        window.location.href = "appointments.php";
			</script>';
			}
		} 
                end:
                
            ?>
    </div>
</body>
<?php
/* draws a calendar */
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

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar.= '<td class="calendar-day">';
			/* add in the day number */
			$calendar.= '<div class="day-number">'.$list_day.'</div>';

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$calendar.= str_repeat('<p> </p>',2);
			$current_epoch = mktime(0,0,0,$month,$list_day,$year);
			// console.log($current_epoch);	
			$sql = "SELECT * FROM `bookingcalendar` WHERE ($current_epoch BETWEEN unix_start_day AND unix_end_day) AND doctor_id=$did AND cancelled=0";
						
			$result = mysqli_query($conn, $sql);
    		
    		if (mysqli_num_rows($result) > 0) {
    			// output data of each row
    			while($row = mysqli_fetch_assoc($result)) {
					// if($row["cancelled"] == 1) $calendar .= "<font color=\"grey\"><s>";
    				$calendar .= "<br>Booking ID: " . $row["id"] . "<br>";
    				if($current_epoch == $row["unix_start_day"] AND $current_epoch != $row["unix_end_day"]) {
    					$calendar .= "Booking starts: " . sprintf("%02d:%02d", $row["start_hour"], ($row["start_minute"])) . "<br><hr><br>";
    				}
    				if($current_epoch == $row["unix_start_day"] AND $current_epoch == $row["unix_end_day"]) {
    					$calendar .= "Booking starts: " . sprintf("%02d:%02d", $row["start_hour"], ($row["start_minute"])) . "<br>";
    				}
    				if($current_epoch == $row["unix_end_day"]) {
    					$calendar .= "Booking ends: " . sprintf("%02d:%02d", $row["end_hour"], ($row["end_minute"])) . "<br><hr><br>";
    				}
    				// if($current_epoch != $row["start_day"] AND $current_epoch != $row["end_day"]) {
	    			// 	$calendar .= "Booking: 24h<br><hr><br>";
	    			// }
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
