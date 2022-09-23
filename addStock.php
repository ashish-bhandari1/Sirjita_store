

<?php
   include_once("common/authorize.php");
   include_once('functions/conn.php');
         
   $store = "SELECT * FROM stock order by name";
   $store2 = "SELECT * FROM stock order by name";
   
   $stResult = $mysqli-> query($store);
   $stResult2 = $mysqli-> query($store2);
       
          
   // }
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Add Product</title>
      <?php include_once("common/link.php"); ?>
      <link rel="stylesheet" type="text/css" href="css/body.css">
   </head>
   <body onload=printdate();>
      <!-- top nav end -->
      <!-- <div class="row"> -->
      <?php
         include_once("common/header.php");
         ?>
      <div class="col-md-10">
         <?php if (isset($_GET['msg'])){
            echo $_GET['msg'];
            }    
            ?>
         <h3>Update your existing Stock</h3>
         <i>If you want to add New product, go to 
         <a href="stock.php"> stock page</a>
         </i>
         <!-- SCREENING ADD FORM  _________________ START -->
         <div class="editForm" id="">
            <div class="formWrapper grid ediTformWrapper">
               <h1> Update existing product</h1>
               <i style="color:red">*Please add data carefully*</i>
               <form id="jsform" method="POST" action="functions/obj.php">
                  <div class="inputWrapper">
                     <div class="input">
                        <label>Product Name</label>
                        <select name="name">
                        <?php
                           if($stResult2->num_rows >0){
                               while($thRow = mysqli_fetch_assoc($stResult2)){
                               echo " 
                           <option value='". $thRow['id']."' >".$thRow['name']." </option> ";
                               }
                           }
                             
                           ?>
                        </select>
                     </div>
                  </div>
                  <div class="radioWrapper">
                     <div class="input">
                        <label>Add product in: </label>
                        <input type="radio" name="type" value="Sack"  onclick="stockradio()" >
                        <label> Sack or Cartoon</label>
                        <input type="radio" name="type" value="kg" onclick="stockradio()">
                        <label> Piece or Kg</label>
                     </div>
                  </div>
                  <div class="inputWrapper noVisible" id= "inputQtwrap">
                     <div class="input">
                        <label> Add Quantity </label>
                        <input Type="number" id= "inputQt" name="quantity" onkeyup="stockinputerror('inputQt')"  placeholder="eg. 50 sack or 50 cartoon">
                     </div>
                  </div>
                  <div class="inputWrapper noVisible" id= "inputAmtwrap">
                     <div class="input">
                        <label > Add Amount </label>
                        <input Type="number" id= "inputAmt" step="0.1" name="sub_stock" onkeyup="stockinputerror('inputAmt')"   placeholder="eg. 50kg or 50 piece">
                     </div>
                  </div>
                  <div class="input">
                     <label id="error" style="color:red; text-transform: none;"></label>
                  </div>
                  <div class="button d-flex justify-content-end">
                     <button type="submit" id="screeningBtn" name = "addExistingStock" onsubmit = >Add data</button>
                  </div>
               </form>
            </div>
            <div style = "overflow:scroll">
               <table class="table table-bordered"style="background-color:rgb(255, 245, 238)" >
                  <thead class="thead-light">
                     <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Comes In</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Amount/ type</th>
                        <?php if(isset($_SESSION['super_user'])){  ?>           
                        <th scope="col">Stock in quantity</th>
                        <th scope="col">Total stock</th>
                        <?php } ?>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                        if($stResult->num_rows >0){
                           $i = 1;
                            while($row = mysqli_fetch_assoc($stResult)){
                              $total = ((double)$row['amountPtype'] * (double)$row['quantity']) + (double)$row['sub_stock'];
                        ?>
                     <tr>
                        <th scope='row'>
                           <?php echo $i ?>
                        </th>
                        <td>
                           <?php echo $row['name'] ?>
                        </td>
                        <td>
                           <?php echo $row['type'] ?>
                        </td>
                        <td>
                           <?php echo $row['quantity'] ?>
                        </td>
                        <td>
                           <?php echo $row['amountPtype']; 
                              if($row['type'] == "Sack"){
                                  echo ' kg/sack ';
                              }
                              else{
                                echo ' Piece/catroon ';
                              }  ?>
                        </td>
                        <?php if(isset($_SESSION['super_user'])){  ?>           
                        <td>
                           <?php echo $row['sub_stock'] ?>
                        </td>
                        <td>
                           <?php echo $total; 
                              if($row['type'] == "Sack"){
                                  echo ' kg';
                              }
                              else{
                                echo ' Piece   ';
                              }  ?>
                        </td>
                        <?php } ?>
                     </tr>
                     <?php $i ++; }} ?>
                  </tbody>
               </table>
            </div>
         </div>
         <!-- SCREENING ADD FORM  _________________ END -->
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
      <script src="../js/admin.js"></script>
   </body>
</html>

