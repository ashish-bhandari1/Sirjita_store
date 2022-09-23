<?php
   include_once("common/authorize.php"); 
   include_once('functions/conn.php');
   $sql = "SELECT DISTINCT bs.bill_id, b.billno, bs.date, bs.time, bs.due, c.name FROM bill b, customer c, billstatus bs WHERE b.cus_id = c.id and bs.bill_id = b.billid ORDER by b.billno DESC,  bs.time DESC";
   
   if(isset($_POST['filter'])){
      $id = $_POST["customer"];
      $loan = $_POST["loan"];      
      if($id != 'all'){
         if($loan == 'due'){
            $sql = "SELECT DISTINCT bs.bill_id, b.billno, bs.date, bs.time, bs.due, c.name FROM bill b, customer c, billstatus bs WHERE b.cus_id = c.id and bs.bill_id = b.billid and b.cus_id = '$id' and bs.due > 0 ORDER by b.billno DESC, bs.date DESC, bs.time DESC; ";
         }
         else if($loan == 'nodue'){
            $sql = "SELECT DISTINCT bs.bill_id, b.billno, bs.date, bs.time, bs.due, c.name FROM bill b, customer c, billstatus bs WHERE b.cus_id = c.id and bs.bill_id = b.billid and b.cus_id = '$id' and bs.due <= 0 ORDER by b.billno DESC, bs.date DESC, bs.time DESC; ";
         }
         else{
            $sql = "SELECT DISTINCT bs.bill_id, b.billno, bs.date, bs.time, bs.due, c.name FROM bill b, customer c, billstatus bs WHERE b.cus_id = c.id and bs.bill_id = b.billid and b.cus_id = '$id' ORDER by b.billno DESC, bs.date DESC, bs.time DESC; ";  
         }
      }
      else{
         if($loan == 'due'){
            $sql = "SELECT DISTINCT bs.bill_id, b.billno, bs.date, bs.time, bs.due, c.name FROM bill b, customer c, billstatus bs WHERE b.cus_id = c.id and bs.bill_id = b.billid  and bs.due > 0 ORDER by b.billno DESC, bs.date DESC, bs.time DESC; ";
         }
         else if($loan == 'nodue'){
            $sql = "SELECT DISTINCT bs.bill_id, b.billno, bs.date, bs.time, bs.due, c.name FROM bill b, customer c, billstatus bs WHERE b.cus_id = c.id and bs.bill_id = b.billid  and bs.due <= 0 ORDER by b.billno DESC, bs.date DESC, bs.time DESC; ";
         }
         else{
            $sql = "SELECT DISTINCT bs.bill_id, b.billno, bs.date, bs.time, bs.due, c.name FROM bill b, customer c, billstatus bs WHERE b.cus_id = c.id and bs.bill_id = b.billid  ORDER by b.billno DESC, bs.date DESC, bs.time DESC; ";  
         }
      }
      $selectedDd = '1'; 
   }
   $result = $mysqli-> query($sql);
   
   //filter
   function fill_brand($mysqli){
     $output = '';
     $sql = "SELECT * FROM customer order by name";
     $result  = mysqli_query($mysqli, $sql);
     while ($row = mysqli_fetch_array($result)){
        $output .= '<option value = "'.$row['id'].'">'.$row['name'].' </option>';
     }
     $selectedDd = 0;
     return $output;
   }
     
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>View Bills</title>
      <?php include_once("common/link.php"); ?>
      <link rel="stylesheet" type="text/css" href="css/body.css">
      <style>     
      #customers {
      font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: auto;
      }
      #customers td, #customers th {
      border: 1px solid #ddd;
      padding: 3px 25px;
      }
      #customers tr:nth-child(even){background-color: #f2f2f2;}
      #customers tr:hover {background-color: #ddd;}
      #customers th {
      padding-top: 6px;
      padding-bottom: 7px;
      text-align: left;
      background-color: #4a864a;
      color: white;
      }
      </style>
   </head>
   <body onload=printdate();>
      <!-- top nav end -->
      <!-- <div class="row"> -->
      <?php
         include_once("common/header.php");
         ?>
      <div class="col-md-10" >
         <h3>View Bills</h3>
         <?php if (isset($_GET['msg'])){
            echo $_GET['msg'];
            }    
            ?>
         <div class="buttoms">
            <form method = "POST" action = "viewBill.php">
               <lable>Loan Type:</lable>
               <select name="loan" required="required">
               <option value = "all">All Type </option>
               <option value = "due">Due </option>
               <option value = "nodue">No Due </option>
               </select>
               <lable>Customer: </lable>
               <select name="customer" required="required">
                  <option value = "all">All Customer </option>
                  <?php echo fill_brand($mysqli); ?>
               </select>
               <button type = "submit" name = "filter">Filter</button>
            </form>
         </div>
         <div class = 'bill-list'>
            <table id="customers">
               <tr>
                  <th>#</th>
                  <th>Bill No.</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th>Due</th>
                  <th></th>
               </tr>
               <?php
                  if($result->num_rows >0){
                   $i = 1;
                   while($row = mysqli_fetch_assoc($result)){
                      echo '
               <tr>
                  <td>'.$i.'</td>
                  <td>'.$row['billno'].'</td>
                  <td>'.$row['name'].'</td>
                  <td>'.$row['date'].', '.$row['time'].'</td>
                  <td>'.$row['due'].'</td>
                  <td> <a href = "printBill.php?id = '.$row['bill_id'].'"> View </a></td>
               </tr>
               ';
               $i ++; } } ?> 
            </table>
         </div>
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
