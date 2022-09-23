<div>
   <nav class="navbar fixed-top ">
      <a class="navbar-brand" title="Collapse" href="javascript:dropdown()"> <i class="fas fa-bars" id="menu"></i> Dashboard</a>
      <nav class="navWrapper">
         <div class="splash" style="position:absolute; color:#fff;  top:2vh; float:right; right:2vh">
            <a class="" href="#!" id="date" style="color:#fff; margin-right:30px;text-decoration:none; "></a>
            <a href="#!" id="welcomeAdmin" style="color:#fff;text-decoration:none;"></a>
         </div>
      </nav>
   </nav>
</div>
<div class="row">
<div class="col-md-2" id="dropdownMenu" style="max-height:130vh">
   <!-- Content -->
   <h1 class="navh1">databse management</h1>
   <ul>
      <li><a href="body.php"> <i class="fas fa-chart-line"></i> Activety</a></li>
      <li><a href="stock.php"><i class="fas fa-home"></i>Stock</a></li>
      <li><a href="addStock.php"><i class="fas fa-cart-plus"></i>Add existing Product</a></li>
      <li><a href="billing.php"><i class="fas fa-money-check-alt"></i>Billing </a></li>
      <li><a href="viewBill.php"><i class="fas fa-folder-open"></i>View Bills </a></li>
      <li><a href="users.php"><i class="fas fa-user"></i> Users</a></li>
      <li><a href="customer.php"><i class="fas fa-users"></i>Customers</a></li>
   </ul>
   <h1>Vat Management</h1>
   <ul>
      <li><a href="vat.php"><i class="fas fa-hotel"></i>Vat Stock</a></li>
      <li><a href="addVat.php"><i class="fas fa-shopping-cart"></i>Add existing Product to vat</a></li>
      <li><a href="vatBilling.php"><i class="fas fa-file-invoice-dollar"></i>Vat Billing </a></li>
      <li><a href="viewVatBill.php"><i class="far fa-folder-open"></i>View Vat Bills</a></li>
   </ul>
   <h1>Other</h1>
   <ul>
      <li ><a href="outOfStock.php" style = "color:rgb(165, 0, 0);"><i class="fas fa-battery-empty" style = "color:rgb(165, 0, 0);"></i>Red Stock</a></li>
      <li><a href="outOfVatStock.php" style = "color:rgb(165, 0, 0);"><i class="fas fa-battery-empty" style = "color:rgb(165, 0, 0);"></i>Red Vat Stock</a></li>
   </ul>
   <h1>Setting</h1>
   <ul>
      <li><a href="addAdmin.php"> <i class="fas fa-user-plus"></i> </i>Add Admin </a></li>
      <li><a href="password.php"><i class="fas fa-cash-register"></i>Account Setting</a></li>
      <li><a href="functions/logout.php" onclick= "return confirm('Are you sure wanna logout?');"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
   </ul>
</div>
<!-- <div class="col-md-10">
   </div>
   </div> -->