<?php
  include_once("common/authorize.php"); 
  include_once('functions/conn.php');
       
  $sql = "SELECT * FROM vat WHERE quantity <=2 order by name";
  if(isset($_POST['filter']) && $_POST["product"] == "oos"){
    $sql = "SELECT * FROM vat WHERE quantity = 0 and sub_stock = 0 order by name";
  }
  $result = $mysqli-> query($sql);
   
  ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Stock</title>
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
         <h3>Vat Stock Going to be Finished</h3>
         <?php if (isset($_GET['msg'])){
            echo $_GET['msg'];
            }    
            ?>
         <div class="buttoms">
              <form method = "POST" action = "outOfVatStock.php">
              <select name="product" required="required">
                <option value = "all">All </option>
                <option value = "oos">Out Of Stock </option>
              </select>
              <button type = "submit" name = "filter">Filter</button>
            </form>
         </div>
         <div style = "overflow:scroll">
            <table class="table table-bordered" style="background-color:rgb(255, 215, 215)" >
               <thead  style="background-color: rgb(255, 95, 95);" >
                  <tr>
                     <th scope="col">#</th>
                     <th scope="col">Name</th>
                     <th scope="col">Comes In</th>
                     <th scope="col">Amount/ type</th>
                     <th scope="col">Cost Price</th>
                     <th scope="col">Wholesell price</th>
                     <th scope="col">Sell Price</th>
                     <th scope="col">Retail Price</th>

                     <?php if(isset($_SESSION['super_user'])){  ?>           
                     <th scope="col">Stock in Sack/Cartoon</th>
                     <th scope="col">Stock out of Sack/Cartoon</th>
                     <th scope="col">Total stock</th>
                     <th>Operation</th>
                     <?php } ?>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     if($result->num_rows >0){
                      $i = 1;
                         while($row = mysqli_fetch_assoc($result)){
                          $total = ((double)$row['amountPtype'] * (double)$row['quantity']) + (double)$row['sub_stock'];
                     ?>   
                  <tr>
                     <th scope='row'> <?php echo $i ?> </th>
                     <td>  <?php echo $row['name'] ?> </td>
                     <td>  <?php echo $row['type'] ?> </td>
                     <td>  <?php echo $row['amountPtype']; 
                          if($row['type'] == "Sack"){
                              echo ' kg/sack ';
                          }
                          else{
                            echo ' Piece/catroon ';
                          }  ?>
                      </td>
                     <td>  <?php echo $row['cost'] ?> </td>
                     <td>  <?php echo $row['wholesell'] ?> </td>
                     <td>  <?php echo $row['sell'] ?> </td>
                     <td>  <?php echo $row['retail'] ?> </td>

                     <?php if(isset($_SESSION['super_user'])){  ?>           
                     <td>  <?php echo $row['quantity'] ?>  </td>
                     <td>  <?php echo $row['sub_stock'] ?>  </td>
                     <td>  <?php echo $total;
                         if($row['type'] == "Sack"){
                              echo ' kg';
                          }
                          else{
                            echo ' Piece';
                          }  ?>
                     </td>
                     <td>
                      <a class="edit" href="functions/vat_edit.php?ID=<?php echo $row['id']; ?>" title="Click here to edit this data"> <i class="fas fa-edit"></i>Edit</a>
                        <form method="POST" action="functions/obj.php" style="display:block; margin:0px; padding:0px"> 
                           <input type = "text" name = "id" value = "<?php echo $row['id']; ?>" style="display:none" >
                           <button style="border:none; background:none" type="submit" name="deleteVat" onclick="return confirm('Are you sure you want to delete this Product?');" title="Click here to delete this data"> 
                           <i class="fas fa-trash-alt" style="color:red"></i>Delete
                           </button>
                        </form>
                        <?php } ?>
                     </td>
                    </tr>
                  <?php $i ++; } } ?> 
               </tbody>
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



    
   