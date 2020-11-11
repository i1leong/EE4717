<?php
  $conn = mysqli_connect("localhost","f32ee","f32ee","f32ee");
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
  $headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
