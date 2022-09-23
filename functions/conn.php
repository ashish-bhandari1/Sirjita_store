<?php 
$mysqli = new mysqli ('localhost', 'root', '', 'sirjita_store');
   if (mysqli_connect_errno()){
   die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
   }
?>