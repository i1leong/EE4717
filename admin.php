<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="style.css">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Integrated Medical Appointment System</title>
</head>

<?php 
    include "session.php";
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
                        <li class="left"><a class="active" href="admin.php">Schedule</a></li>
                        <li><a>|</a></li>
                        <li><a href="admin_profile.php">Profile</a></li>
                        <li class="right" id="logout"><a href="logout.php">Logout</a></li>
                    </ul>
                </nav>
            </div> 
    <?php
        if(!isset($_POST["cancel"])) {
    ?>    
            <div class="content">
            <div class="box">
                <table border="1" cellpadding="5" width="1400">
                    <tr>
                        <td valign="top">                                                        
                            <form action="" method="post">
                                <table width="460">
                                    <h3>Cancel booking</h3>
                                    <tr>
                                        <td>Booking ID:</td>
                                        <td><input type="text" name="bid" id="bid"></td>
                                    </tr>
                                    <tr><td>&nbsp;</td></tr>
                                    <tr><td>
                                        <center><input style="background-color:red" name="cancel" size="300" type="submit" value="Cancel Booking"></center>
                                    </td></tr>
                                </table>
                            </form>
                        </td>
                        <td valign="top">
                        <?php
                            $month = date("m");
                            $year = date("Y");
                            $monthName = date('F', mktime(0, 0, 0, $month, 10));
                            echo "<h3>I-Polyclinic Schedule $monthName $year</h3>";
                            echo draw_calendar($month, $year);
                        ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <?php
            } else if (isset($_POST["cancel"])){

                include "db.php";
		$bid = $_POST["bid"];
		echo
                '<script type = "text/Javascript">
                confirm("Are you sure you want to cancel the booking?");
                </script>';                
                
                $sql = "UPDATE `bookingcalendar` SET `cancelled`='1' WHERE `id`='$bid'";

                if (mysqli_query($conn, $sql)) {
                    $_POST = array();
                    echo '<script type="text/Javascript">
                    alert("The booking is cancelled");
                    window.location.href = "admin.php";
                    </script>'; 
                }
	      }
	   ?>
    </div>
</body>

</html>

<?php
function draw_calendar($month,$year){

    include "db.php";
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
        $sql = "SELECT * FROM `bookingcalendar` WHERE ($current_epoch BETWEEN unix_start_day AND unix_end_day)";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if($row["cancelled"] == 1) $calendar .= "<font color=\"grey\"><s>"; 
                $calendar .= "<br>Name: ".$row["name"]."<br>";
                $calendar .= "Sickness: ".$row["sickness"]."<br>";
                $calendar .= "Doctor: ".$row["doctor"]."<br>";   
                $calendar .= "Booking ID: ".$row["id"]."<br>";
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
        } 
        else {
            $calendar .= "No bookings";
            }

        $calendar.= '</td>';
        
        if($running_day == 6): $calendar.= '</tr>';
        if(($day_counter+1) != $days_in_month): $calendar.= '<tr class="calendar-row">';
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
   
