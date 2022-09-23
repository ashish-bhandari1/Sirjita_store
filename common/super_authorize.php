<?php
session_start();
// Set session variables
if(!isset($_SESSION["super_user"]) ){
    header("Location:index.php?msg=<i class='errorMsg' id = 'ermsg'> Please login as SuperAdmin! <span  id = 'errorClose'> close</span> </i>");
}

?>