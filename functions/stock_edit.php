

<?php
   //authorize
   session_start();
   if(!isset($_SESSION["admin_user"])){
       if(!isset($_SESSION["super_user"]) ){
       header("Location:../index.php?msg=<i class='errorMsg' id = 'ermsg'> Please login first! <span  id = 'errorClose'> close</span> </i>");
       }
   }
   include_once('conn.php');
   
       $id = $_GET['ID'];
       $sql = "SELECT * FROM stock WHERE id = '$id'";
       $result = $mysqli-> query($sql);
       $row = mysqli_fetch_assoc($result);
     
       $amount = $row['amountPtype'];
       $cp = $row['cost'] * $amount;
       $wp = $row['wholesell'] * $amount;
       $sp = $row['sell'] * $amount;
       $rp = $row['retail'] * $amount;
   ?>
<!DOCTYPE html>
<html>
   <head>
      <?php include_once("../common/link.php"); ?>
      <link rel="stylesheet" type="text/css" href="../css/body.css">
   </head>
   <body>
      <!-- top nav end -->
      <!-- THEATRE UPDATE FORM  _________________ START -->
      <div class="editForm" id="formWrap">
         <div class="formWrapper grid ">
            <h1> Update stock detail<a href="../stock.php" style="text-decoration:none" onclick="return confirm('Are you exit current form?');"class='a' ><span class="close" id="closeform" >&times;</span></a></h1>
            <i style="color:red; margin-top:15px">*Please update data carefully*</i>
            <form method="POST" action="../functions/obj.php">
               <div class="inputWrapper">
                  <div class="input" style = "display:none">
                     <label>ID</label>
                     <input type="text" name="thid" id="theatrename" required="required" value="<?php echo $row['id']?>">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>Name</label>
                     <input type="text" name="name" id="theatrename" required="required" value="<?php echo $row['name']?>">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                  <label>Quantity in <?php echo $row['type']?></label>
                     <input type="number" step = '0.5' name="quantity" required="required" value = "<?php echo $row['quantity']?>">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>Quantity out of  <?php echo $row['type']?> </label>
                     <input type="number"  name="substok" required="required" value = "<?php echo $row['sub_stock']?>">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>Amount Per <?php echo $row['type']?> </label>
                     <input type="number" name="amountPtype" required="required" value = "<?php echo $row['amountPtype']?>" >
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label> Cost Price </label>
                     <input type="text"  name="cp" required="required" value = "<?php echo $cp ?>"  >
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label> Wholesell Price </label>
                     <input type="text" name="wp" required="required" value = "<?php echo $wp?>">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label> Sell Price </label>
                     <input type="text"  name="sp" required="required" value = "<?php echo $sp?>" >
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label> Retail Price </label>
                     <input type="text" name="rp" required="required" value = "<?php echo $rp?>" >
                  </div>
               </div>
               <div class="button d-flex justify-content-end">
                  <a href="../stock.php"onclick="return confirm('Are you exit current form?');" >Back</a>
                  <button type="submit" name="stockEdit" >Update</button>
               </div>
            </form>
         </div>
      </div>
      <!-- THEATRE UPDATE FORM  _________________ END -->
      <!-- <div class="row"> -->
      <script src="js/admin.js"></script>  
      <script src="bootstrap/js/bootstrap.min.js"></script>
   </body>
</html>

