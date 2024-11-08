<?php
session_start();

$conn = mysqli_connect(
  'sql306.infinityfree.com', // Hostname
  'if0_37330885',           // Username
  'z09Mn11acpOG',             // Password
  'if0_37330885_control_escolar'  // Database name
) or die(mysqli_error($conn));

?>
