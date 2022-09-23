<?php
   session_start();
   // Set session variables
   include_once('conn.php');

   $id = $_GET['ID'];

   $qry = $mysqli->query("SELECT * FROM customer WHERE id = '$id'");
   $row = mysqli_fetch_assoc($qry);       
   ?>
<!DOCTYPE html>
<html>
   <head>
      <?php include_once("../common/link.php"); ?>
      <link rel="stylesheet" type="text/css" href="../css/body.css">
   </head>
   <body>
      <!-- top nav end -->
      <!-- SCREENING EDIT FORM  _________________ START -->
      <div class="editForm" id="formWrap">
         <div class="formWrapper grid ediTformWrapper">
            <h3><a href="../menu.php" style="text-decoration:none" onclick="return confirm('Are you exit current form?');" ><span>&times;</span></a></h3>
            <h1> Update Customer Detail</h1>
            <br>
            
            <i style="color:red; ">*Please update detail carefully*</i>
            <form method="POST" action="obj.php">
               <div class="inputWrapper">
                  <div class="input" style = "display:none">
                     <label>ID</label>
                     <input type="text" name="id" id="screening" required="required" value="<?php echo $id; ?>">
                  </div>
               </div>

               <div class="inputWrapper">
                  <div class="input">
                     <label>Name</label>
                     <input type="text" name="name" value=" <?php echo $row['name'] ?> " required="required">
                  </div>
               </div>               
               <div class="inputWrapper">
                  <div class="input">
                     <label>Address</label>
                     <input type="text" name="address" value=" <?php echo $row['address'] ?> " required="required">
                  </div>
               </div>               
               <div class="inputWrapper">
                  <div class="input">
                     <label>Phone</label>
                     <input type="text" name="phone" value=" <?php echo $row['phone'] ?> " >
                  </div>
               </div>               
              
               <div class="radioWrapper">
                  <div class="input">
                     <label>Type: </label>
                     <input type="radio" name="type" value="new" <?php if($row['type'] == 'new'){ echo 'checked="checked"';  } ?> >
                     <label> New</label>
                     <input type="radio" name="type" value="old" <?php if($row['type'] == 'old'){ echo 'checked="checked"';  } ?>>
                     <label> Old</label>
                  </div>
 

               <div class="button d-flex justify-content-end">
                  <a href="../customer.php" onclick="return confirm('Are you exit current form?');" >Back</a>
                  <button type="submit" id="screeningBtn" name="editCustomer" >Update</button>
               </div>
            </form>
         </div>
      </div>
      <!-- SCREENING EDIT FORM  _________________ END -->
      <!-- <div class="row"> -->
      </body>
      <script src="../js/admin.js"></script>  
      <script src="../bootstrap/js/bootstrap.min.js"></script>
  
</html>
