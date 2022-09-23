<?php
   include_once('common/super_authorize.php');
   include_once('functions/conn.php');

   $sql = "SELECT * FROM admin where master = ''";
   
   $result = $mysqli-> query($sql);
   
   // }
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Users</title>
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
         <div class="theatreWrapper ">
         <?php if (isset($_GET['msg'])){
            echo $_GET['msg'];
            }    
            ?>
            <h3>User detail</h3>
            <table class="table" style="background-color:#fff">
               <thead class="thead-light">
                  <tr>
                     <th>#</th>
                     <th>Username</th>
                     <th>Password</th>
                     <th>Operation</th>                     
                  </tr>
               </thead>
               <tbody>
                  <?php
                     if($result->num_rows >0){
                        $i = 1;
                         while($row = mysqli_fetch_assoc($result)){
                     ?>
                  <tr>
                     <th scope="row"><?php echo $i; ?></th>
                     <td><?php echo $row['username']; ?></td>
                     <td><?php echo $row['password']; ?></td>
                     <td>
                        <form method="POST" action="functions/obj.php" style="display:block; margin:0px; padding:0px"> 
                           <input type = "text" name = "id" value = "<?php echo $row['id']; ?>" style="display:none" >
                           <button style="border:none; background:none" type="submit" name="deleteAdmin" onclick="return confirm('Are you sure you want to remove this admin?');" title="Click here to delete this data"> 
                           <i class="fas fa-trash-alt" style="color:red"></i>Delete
                           </button>
                        </form>
                     </td>
                  </tr>
                  <?php  $i++; }} ?>
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