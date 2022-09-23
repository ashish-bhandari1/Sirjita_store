<?php
   include_once("common/authorize.php");
   
   // Create database connection
   include_once('functions/conn.php');
   
   $user = $mysqli-> query( "SELECT id from customer");
   $stock = $mysqli-> query( "SELECT id   from stock");
   $booking = $mysqli-> query( "SELECT distinct billno from bill");
   
   //count data
   $user_count = mysqli_num_rows($user);
   $stock_count = mysqli_num_rows($stock);
   $booking_count = mysqli_num_rows($booking);
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Home</title>
      <?php
         include_once("common/link.php");
         ?>
      <link rel="stylesheet" type="text/css" href="css/body.css">
   </head>
   <body onload=printdate();>
      <!-- top nav end -->
      <!-- <div class="row"> -->
      <?php
         include_once("common/header.php");
         ?>
      <div class="col-md-10">
         <div class="total_user">
            <i class="fas fa-users"></i>
            <h4>total Customer added: <span> <?php echo $user_count; ?> </span></h4>
         </div>
         <div class="total_movie">
            <i class="fas fa-film"></i>
            <h4>total product added: <span> <?php echo $stock_count ; ?></span></h4>
         </div>
         <div class="total_booking">
            <i class="fas fa-coins"></i>
            <h4>total billing done: <span> <?php echo $booking_count ;?></span></h4>
         </div>
         <br>
         <p style="text-align:left; color:red;">*Note: This data is not based on any Day. This is data of all Time</p>
      </div>
      </div>
      <script src="js/admin.js"></script>
      <script>
         var icon = document.getElementById('menu');
         var Menu = document.getElementById('dropdownMenu');
         icon.onclick = function() {
             if (Menu.className === "col-md-2") {
                 Menu.classList.add("menuActive");
             } else {
                 Menu.className = "col-md-2";
             }
         }
      </script>
      <script src="bootstrap/js/bootstrap.min.js"></script>
   </body>
</html>