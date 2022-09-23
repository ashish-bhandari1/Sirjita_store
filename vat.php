<?php
  include_once("common/authorize.php"); 
  include_once('functions/conn.php');
       
  $sql = "SELECT * FROM vat order by name";
  if(isset($_POST['filter']) && $_POST["vat"] != "all"){
    $id = $_POST["vat"];
    $sql = "SELECT * from vat where id = '$id'";
  }
  $result = $mysqli-> query($sql);

  //filter
  function fill_brand($mysqli){
    $output = '';
    $sql = "SELECT * FROM vat order by name";
    $result  = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($result)){
       $output .= '<option value = "'.$row['id'].'">'.$row['name'].' </option>';
    }
    return $output;
 }
   
  ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Vat</title>
    <?php include_once("common/link.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/body.css">
  </head>
  <body onload=printdate();>
    <!-- top nav end -->
    <!-- THEATRE UPDATE FORM  _________________ START -->
    <div class="UploadFrom" id="formWrap">
      <div class="formWrapper grid">
        <h1> Add New Vat Product  <span class="close" id="closeform" onclick="closeFrom();" >&times;</span></h1>
        <i style="color:red">*Please update data carefully*</i>
        <form id="jsform" method="POST" enctype="multipart/form-data" action="functions/obj.php">
          <div class="inputWrapper">
            <div class="input">
              <label>Name</label>
              <input type="text" name="name" id="theatrename" required="required">
            </div>
          </div>
          
          <div class="radioWrapper">
                  <div class="input">
                     <label>Product comes in: </label>
                     <input type="radio" name="type" value="Sack" checked="checked" onclick = "stockradioLbl()">
                     <label> Sack</label>
                     <input type="radio" name="type" value="Cartoon" onclick = "stockradioLbl()">
                     <label> Cartoon</label>
                  </div>
               </div>
          <div class="inputWrapper">
            <div class="input">
              <label id = 'radioMsg1'> Quantity of Sack </label>
              <input  Type="number" name="quantity" required="required" placeholder="50sack or 50 cartoon">
            </div>
          </div>
          <div class="inputWrapper">
            <div class="input">
              <label id = 'radioMsg2'> Amount Per <i> Sack </i> </label>
              <input Type="number" step="0.1" name="amountPtype" required="required" placeholder="50kg/sack">
            </div>
          </div>

          <div class="inputWrapper">
            <div class="input">
              <label id = 'radioMsg3'>Cost Price <i>/ Sack </i></label>
              <input type="number"step="0.1" name="cp" required="required" placeholder="100 Rs">
            </div>
          </div>          
          <div class="inputWrapper">
            <div class="input">
              <label id = 'radioMsg4'>Wholesell Price <i>/ Sack </i> </label>
              <input type="number"step="0.1" name="wp" required="required" placeholder="100 Rs">
            </div>
          </div>          
          <div class="inputWrapper">
            <div class="input">
              <label id = 'radioMsg5'>Sell Price <i>/ Sack </i> </label>
              <input type="number" step="0.1" name="sp" required="required">
            </div>
          </div>
          <div class="inputWrapper">
            <div class="input">
              <label id = 'radioMsg6'> Retail Price <i>/ Sack </i></label>
              <input type="number" step="0.1" name="rp" required="required">
            </div>
          </div>
          <div class="button d-flex justify-content-end">
            <button type="submit" name="addVat">Add</button>
          </div>
        </form>
      </div>
    </div>
    <!-- THEATRE UPDATE FORM  _________________ END -->
    <!-- <div class="row"> -->
    <?php
         include_once("common/header.php");
         ?>
      <div class="col-md-10" style = "background: rgb(252, 235, 255);">
         <h3>Vat Stock Management</h3>
         <?php if (isset($_GET['msg'])){
            echo $_GET['msg'];
            }    
            ?>
         <div class="buttoms">
              <button class="addData" onclick="addForm();" title="Click here to add product"> <i class="fas fa-plus-square"></i> Add New Product</button>
              <form method = "POST" action = "vat.php">
              <select name="vat" required="required">
                <option value = "all">All Product </option>
                <?php echo fill_brand($mysqli); ?>
              </select>
              <button type = "submit" name = "filter">Filter</button>
            </form>
         </div>
         <div style = "overflow:scroll">
            <table class="table table-bordered" style="background-color:rgb(255, 245, 238)" >
               <thead class="thead-light">
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
                     <th scope="col">Stock in quantity</th>
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



    
   