<?php
session_start();

$conn = mysqli_connect(
  'localhost', // Hostname
  'root',           // Username
  '',             // Password
  'facturas'  // Database name
) or die(mysqli_error($conn));

?>
