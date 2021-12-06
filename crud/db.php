<?php
session_start();

$conn = mysqli_connect(
  'localhost',
  'root',
  '',
  'steakhouse'
) or die(mysqli_error($mysqli));

?>
