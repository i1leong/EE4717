<!DOCTYPE html>
<html lang="en">

<head>
    <title>Integrated Medical Appointment System</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>

<?php 
    include ("session.php");
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
	<h1><center><?php echo"Welcome Back, ".$_SESSION['name']."!"?></center></h1>
	    <div id="tiles">
                <div class="column">
                    <table align="center">
                        <tbody id="doctor-tile">
                            <tr id="image-row">
                                <img id="doctor-image" src="assets/doctor_1.png" alt="doctor_image" width="250px">
                            </tr>
                            <tr>
                                <label for="doctor_name" id="doctor-name">Dr. Grey</label>
                            </tr>
                            <tr>
                                <label for="doctor_hospital" id="doctor-hospital">Nanyang Technological University</label>
                            </tr>
                            <tr style="column-span: 2;">
                                <div id="tile-button-container">
                                    <td >
                                        <button id="tile-button">
                                            <a id="tile-button-text" href="doctor_profile.php?did=1">View</a>
                                        </button>
                                    </td>
                                    <td>
                                        <button id="tile-button">
                                            <a id="tile-button-text" href="book.php?did=1">Book</a>
                                        </button>
                                    </td>
                                </div>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="column">
                    <table align="center">
                        <tbody id="doctor-tile">
                            <tr id="image-row">
                                <img id="doctor-image" src="assets/doctor_2.png" alt="doctor_image" width="250px">
                            </tr>
                            <tr>
                                <label for="doctor_name" id="doctor-name">Dr. Bailey</label>
                            </tr>
                            <tr>
                                <label for="doctor_hospital" id="doctor-hospital">Nanyang Technological University</label>
                            </tr>
                            <tr style="column-span: 2;">
                                <div id="tile-button-container">
                                    <td >
                                        <button id="tile-button">
                                            <a id="tile-button-text" href="doctor_profile.php?did=2">View</a>
                                        </button>
                                    </td>
                                    <td>
                                        <button id="tile-button">
                                            <a id="tile-button-text" href="book.php?did=2">Book</a>
                                        </button>
                                    </td>
                                </div>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="column">
                    <table align="center">
                        <tbody id="doctor-tile">
                            <tr id="image-row">
                                <img id="doctor-image" src="assets/doctor_3.png" alt="doctor_image" width="250px">
                            </tr>
                            <tr>
                                <label for="doctor_name" id="doctor-name">Dr. Shepherd</label>
                            </tr>
                            <tr>
                                <label for="doctor_hospital" id="doctor-hospital">Nanyang Technological University</label>
                            </tr>
                            <tr style="column-span: 2;">
                                <div id="tile-button-container">
                                    <td >
                                        <button id="tile-button">
                                            <a id="tile-button-text" href="doctor_profile.php?did=3">View</a>
                                        </button>
                                    </td>
                                    <td>
                                        <button id="tile-button">
                                            <a id="tile-button-text" href="book.php?did=3">Book</a>
                                        </button>
                                    </td>
                                </div>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="column">
                    <table align="center">
                        <tbody id="doctor-tile">
                            <tr id="image-row">
                                <img id="doctor-image" src="assets/doctor_4.png" alt="doctor_image" width="250px">
                            </tr>
                            <tr>
                                <label for="doctor_name" id="doctor-name">Dr. Karev</label>
                            </tr>
                            <tr>
                                <label for="doctor_hospital" id="doctor-hospital">Nanyang Technological University</label>
                            </tr>
                            <tr style="column-span: 2;">
                                <div id="tile-button-container">
                                    <td >
                                        <button id="tile-button">
                                            <a id="tile-button-text" href="doctor_profile.php?did=4">View</a>
                                        </button>
                                    </td>
                                    <td>
                                        <button id="tile-button">
                                            <a id="tile-button-text" href="book.php?did=4">Book</a>
                                        </button>
                                    </td>
                                </div>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
