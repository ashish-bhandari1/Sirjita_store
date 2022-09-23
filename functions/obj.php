<?php
include 'function.php';
//ADMIN LOGIN
if (isset($_POST['adminLogin'])) {
    $username = $_POST["username"];
    $role = $_POST["role"];
    $pw = md5($_POST["password"]);
    $obj = new user($username, $role, $pw); //passing variable to constructor
    if (!$obj) {
        die("can not call function! system detect bug in program <br>Please <a href='#' >contact your service provider 9869213908</a>");
    }
}
//ADMIN Register
if (isset($_POST['add_admin'])) {
    $username = $_POST["username"];
    $pw = md5($_POST["password"]);
    $obj = new admin();
    $obj->add_admin($username, $pw); //passing variable to constructor
    if (!$obj) {
        die("can not call function! system detect bug in program <br>Please <a href='#' >contact your service provider 9869213908</a>");
    }
}
//Admin Password Change
if (isset($_POST['changePw'])) {
    $pw = md5($_POST['currentpw']);
    $npw = md5($_POST['newpw']);
    $rnpw = md5($_POST['repw']);
    $user = $_POST['user'];
    session_start();
    if (isset($_SESSION['admin_user'])) {
        $role = 'admin';
    }
    if (isset($_SESSION['super_user'])) {
        $role = 'superadmin';
    }
    if ($npw == $rnpw) {
        $obj = new admin();
        $obj->change_pw($user, $pw, $npw, $role);
    } else {
        header("location:../password.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Both Password Must Match <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
    }
}
//admin delete
if (isset($_POST['deleteAdmin'])) {
    $obj = new admin();
    $obj->deleteAdmin($_POST['id']);
}
//Stock DATA MANAGE START.......
if (isset($_POST['stockEdit'])) {
    $id = $_POST['thid'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $amountPtype = $_POST['amountPtype'];
    $cp = $_POST['cp'];
    $wp = $_POST['wp'];
    $sp = $_POST['sp'];
    $rp = $_POST['rp'];
    $substok = $_POST['substok'];
    $obj = new stock();
    $obj->editStock($id, $name, $quantity, $substok, $amountPtype, $cp, $wp, $sp, $rp);
}
if (isset($_POST['addStock'])) {
    $id = $_POST['thid'];
    $image = $_FILES['image']['name'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $quantity = $_POST['quantity'];
    $amountPtype = $_POST['amountPtype'];
    $cp = $_POST['cp'];
    $wp = $_POST['wp'];
    $sp = $_POST['sp'];
    $rp = $_POST['rp'];
    $obj = new stock();
    $obj->addStock($id, $image, $name, $type, $quantity, $amountPtype, $cp, $wp, $sp, $rp);
}
if (isset($_POST['deleteStock'])) {
    $id = $_POST['id'];
    $obj = new stock();
    $obj->deleteStock($id);
}
if (isset($_POST['addExistingStock'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $quantity = $_POST['quantity'];
    $sub_stock = $_POST['sub_stock'];
    $obj = new stock();
    $obj->addExistingStock($name, $type, $quantity, $sub_stock);
}
// If Billing button is clicked ...
if (isset($_POST['billingBtn'])) {
    $time = $_POST['inputTime'];
    $date = $_POST['inputDate'];
    $bill = $_POST['bill_no'];
    $cus_id = $_POST['customerId'];
    $cus_type = $_POST['type'];
    $cus_name = $_POST['cus_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $cus_type_input = $_POST["cus_type"];
    $product = $_POST['product'];
    $qty = $_POST['quantity'];
    $amt = $_POST['amount'];
    $rate = $_POST['rate'];
    $total = $_POST['total'];
    $obj = new billing();
    $obj->addBill($time, $date, $bill, $cus_id, $cus_type, $cus_name, $address, $phone, $cus_type_input, $product, $qty, $amt, $rate, $total);
}
if (isset($_POST['deleteP'])) {
    $id = $_POST['id'];
    $Pid = $_POST['Pid'];
    $qty = $_POST['qty'];
    $amt = $_POST['amount'];
    $obj = new billing();
    $obj->deleteP($id, $Pid, $qty, $amt);
}
if (isset($_POST['sessionBill'])) {
    $grand = $_POST['grand'];
    $vat = $_POST['vat'];
    $paid = $_POST['paid'];
    $word = $_POST['word'];
    $type = $_POST['amt_type'];
    $bill = $_POST['bill'];
    $time = $_POST['inputTime'];
    $date = $_POST['inputDate'];
    $obj = new billing();
    $obj->billStatus($bill, $grand, $vat, $paid, $word, $type, $time, $date);
}
//END
//VAT STOCK MANAGEMENT
if (isset($_POST['addVat'])) {
    $id = $_POST['thid'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $quantity = $_POST['quantity'];
    $amountPtype = $_POST['amountPtype'];
    $cp = $_POST['cp'];
    $wp = $_POST['wp'];
    $sp = $_POST['sp'];
    $rp = $_POST['rp'];
    $obj = new vat();
    $obj->addVat($id, $name, $type, $quantity, $amountPtype, $cp, $wp, $sp, $rp);
}
if (isset($_POST['vatEdit'])) {
    $id = $_POST['thid'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $amountPtype = $_POST['amountPtype'];
    $cp = $_POST['cp'];
    $wp = $_POST['wp'];
    $sp = $_POST['sp'];
    $rp = $_POST['rp'];
    $substok = $_POST['substok'];
    $obj = new vat();
    $obj->editVat($id, $name, $quantity, $substok, $amountPtype, $cp, $wp, $sp, $rp);
}
if (isset($_POST['deleteVat'])) {
    $id = $_POST['id'];
    $obj = new vat();
    $obj->deleteVat($id);
}
if (isset($_POST['addExistingvatStock'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $quantity = $_POST['quantity'];
    $sub_stock = $_POST['sub_stock'];
    $obj = new vat();
    $obj->addExistingvatStock($name, $type, $quantity, $sub_stock);
}
//VAT BILLING
if (isset($_POST['vatBillingBtn'])) {
    $time = $_POST['inputTime'];
    $date = $_POST['inputDate'];
    $bill = $_POST['bill_no'];
    $cus_id = $_POST['customerId'];
    $cus_type = $_POST['type'];
    $cus_name = $_POST['cus_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $cus_type_input = $_POST["cus_type"];
    $product = $_POST['product'];
    $qty = $_POST['quantity'];
    $amt = $_POST['amount'];
    $rate = $_POST['rate'];
    $total = $_POST['total'];
    $obj = new vatBilling();
    $obj->addVatBill($time, $date, $bill, $cus_id, $cus_type, $cus_name, $address, $phone, $cus_type_input, $product, $qty, $amt, $rate, $total);
}
if (isset($_POST['deleteV'])) {
    $id = $_POST['id'];
    $Pid = $_POST['Pid'];
    $qty = $_POST['qty'];
    $amt = $_POST['amount'];
    $obj = new vatBilling();
    $obj->deleteV($id, $Pid, $qty, $amt);
}
if (isset($_POST['sessionVatBill'])) {
    $time = $_POST['inputTime'];
    $date = $_POST['inputDate'];
    $grand = $_POST['grand'];
    $vat = $_POST['vat'];
    $paid = $_POST['paid'];
    $word = $_POST['word'];
    $type = $_POST['amt_type'];
    $bill = $_POST['bill'];
    $obj = new vatBilling();
    $obj->vatBillStatus($bill, $grand, $vat, $paid, $word, $type, $time, $date);
}
//END
//Customer DATA MANAGE START .......
if (isset($_POST['deleteCustomer'])) {
    $obj = new customer();
    $obj->deleteCus($_POST['id']);
}
if (isset($_POST['editCustomer'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $type = $_POST['type'];
    $obj = new customer();
    $obj->editCus($id, $name, $address, $phone, $type);
}
?>
