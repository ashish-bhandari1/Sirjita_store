<?php
//USER MANAGEMENT START
class user {
    function __construct($username, $role, $password) {
        //role whise query
        if ($role == "admin") {
            include_once 'conn.php';
            $qry = $mysqli->query("SELECT * from admin WHERE username = '$username' AND password = '$password'");
            if (!$qry) {
                die("Error 02: can't 
                execute query! <br>your table in database might be deleted ! <br>Please 
                <a target='_blank' href='https://mail.google.com/mail/u/0/#inbox?compose=jrjtXGjZgvLDvLnknWmHqFBGBJPXSpnfQWpxqXHxVKhcKHNBhfswqDqHsPjwmgqMrKqsfhxK' >
                contact your service provider</a>");
            }
            $verify = mysqli_num_rows($qry);
            if ($verify == 1) {
                $row = mysqli_fetch_assoc($qry);
                session_start();
                $_SESSION['admin_id'] = $row['id'];
                $_SESSION['admin_user'] = $row['username'];
                $_SESSION['admin_tid'] = $row['theatre_id'];
                header("Location: ../body.php");
            } else {
                header("Location: ../?msg=<i class='errorMsg' id = 'ermsg'> username and password doesnot match <span  id = 'errorClose'  onclick='errorfunction()'> close</span> </i>");
                /* Redirect browser */
            }
        } else {
            include_once 'conn.php';
            $qry = $mysqli->query("SELECT * from admin WHERE username = '$username' AND master = '$password'");
            if (!$qry) {
                die("Error 02: can't 
                execute query! <br>your table in database might be deleted ! <br>Please 
                <a target='_blank' href='https://mail.google.com/mail/u/0/#inbox?compose=jrjtXGjZgvLDvLnknWmHqFBGBJPXSpnfQWpxqXHxVKhcKHNBhfswqDqHsPjwmgqMrKqsfhxK' >
                contact your service provider 9869213908</a>");
            }
            $verify = mysqli_num_rows($qry);
            if ($verify == 1) {
                $row = mysqli_fetch_assoc($qry);
                session_start();
                $_SESSION['admin_id'] = $row['id'];
                $_SESSION['super_user'] = $row['username'];
                header("Location: ../body.php");
            } else {
                header("Location: ../?msg=<i class='errorMsg' id = 'ermsg'> username and password doesnot match <span  id = 'errorClose'> close</span> </i>");
                /* Redirect browser */
            }
        }
    }
}
//SUPERAdmin FUNCTION
class admin {
    function add_admin($username, $password) {
        include_once 'conn.php';
        $sql = "INSERT INTO admin VALUES('', '$username','$password','')";
        $insert = $mysqli->query($sql);
        if ($insert) {
            header("Location: ../addAdmin.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Admin Successfully Added <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            mysqli_close($mysqli);
        } else {
            // echo("Error description: " . $mysqli -> error);
            header("Location: ../addAdmin.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while uploading data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            mysqli_close($mysqli);
        }
    }
    function change_pw($user, $pw, $newpw, $role) {
        include_once 'conn.php';
        session_start();
        $id = $_SESSION['admin_id'];
        if ($role == 'admin') {
            $valid = $mysqli->query("SELECT * from admin where id = '$id' and password = '$pw'");
            if (mysqli_num_rows($valid) == 1) {
                $sql = "UPDATE  admin SET  username = '$user', password ='$newpw' WHERE id = '$id' ";
                $update = $mysqli->query($sql);
                if (!$update) {
                    header("Location: ../password.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while updating Password <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                }
                if ($update) {
                    $_SESSION['admin_user'] = $user;
                    header("Location: ../password.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully Changed!  <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                }
                mysqli_close($mysqli);
            } else {
                header("Location: ../password.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Incorrect current password <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
        }
        if ($role == 'superadmin') {
            $valid = $mysqli->query("SELECT * from admin where id = '$id' and master = '$pw'");
            if (mysqli_num_rows($valid) == 1) {
                $sql = "UPDATE  admin SET   username = '$user',  master ='$newpw' WHERE id = '$id' ";
                $update = $mysqli->query($sql);
                if (!$update) {
                    header("Location: ../password.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while updating Password <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                }
                if ($update) {
                    $_SESSION['super_user'] = $user;
                    header("Location: ../password.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully Changed <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                }
                mysqli_close($mysqli);
            } else {
                header("Location: ../password.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Incorrect current password <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
        }
    }
    function deleteAdmin($id) {
        include_once 'conn.php';
        $qry = "DELETE FROM admin WHERE id = '$id'";
        $delete = $mysqli->query($qry);
        if ($delete) {
            header("Location: ../users.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully deleted <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        } else {
            /* Redirect browser */
            header("Location: ../users.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while deleteing data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
    }
}
//STOCK MANAGEMENT START..........
class stock {
    function editStock($id, $name, $quantity, $sub_stock, $amountPtype, $cp, $wp, $sp, $rp) {
        include_once 'conn.php';
        $cp = $cp / $amountPtype;
        $wp = $wp / $amountPtype;
        $sp = $sp / $amountPtype;
        $rp = $rp / $amountPtype;
        //rounding
        $sql = "UPDATE  stock SET  name ='$name',quantity='$quantity', sub_stock = '$sub_stock', amountPtype= '$amountPtype',  cost= '$cp',wholesell= '$wp', sell='$sp', retail ='$rp' WHERE id = '$id'";
        $insert = $mysqli->query($sql);
        if ($insert) {
            header("Location: ../stock.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully updated <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            mysqli_close($mysqli);
        } else {
            header("Location: ../stock.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while uploading data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            mysqli_close($mysqli);
        }
    }
    function addStock($id, $image, $name, $type, $quantity, $amountPtype, $cp, $wp, $sp, $rp) {
        include_once 'conn.php';
        // image file directory
        $target = "../dbimage/" . basename($image);
        //get image height and width
        $image_info = getimagesize($_FILES["image"]["tmp_name"]);
        $image_width = $image_info[0];
        $image_height = $image_info[1];
        $allowed_image_extension = ["png", "PNG", "jpg", "JPG", "jpeg", "JPEG"];
        // Get image file extension
        $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        //validate extension
        if (!in_array($file_extension, $allowed_image_extension)) {
            header("Location: ../stock.php?msg= <i class='errorMsg' id = 'ermsg' style='color:red'> Error: Upload valid images. Only PNG and JPEG are allowed. <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
        //validate size
        elseif ($_FILES["image"]["size"] > 4000000) {
            header("Location: ../stock.php?msg= <i class='errorMsg' id = 'ermsg' style='color:red'> Error: Image size exceeds 4MB <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
        //
        //    else if($image_height>2000 || $image_width>2000){
        //         header("Location: ../theatre.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:red'> Error: Image dimension should be within 1000X1000 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        //         die();
        //     }
        else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target)) {
                $icp = $cp / $amountPtype;
                $iwp = $wp / $amountPtype;
                $isp = $sp / $amountPtype;
                $irp = $rp / $amountPtype;
                $total = $amountPtype * $quantity;
                $qry = "INSERT INTO stock VALUES ('', '$image',  '$name' ,'$type', '$quantity', '$amountPtype', '0', '$icp', '$iwp', '$isp', '$irp')";
                $result = $mysqli->query($qry);
                if (!$result) {
                    echo "Data insertion error, : " . $mysqli->error;
                    header("Location: ../stock.php?msg = <i class='errorMsg' id = 'ermsg' style='color:red'> Error while product uploading<span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                }
                if ($result) {
                    header("Location: ../stock.php?msg= <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully Uplaoded <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                }
            } else {
                header("Location: ../stock.php?msg= <i class='errorMsg' id = 'ermsg' style='color:red'> Error: Failed to save image in Images folder <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
        }
    }
    function deleteStock($id) {
        include_once 'conn.php';
        $sql = "DELETE FROM  stock WHERE  id ='$id' ";
        $delete = $mysqli->query($sql);
        if ($delete) {
            header("Location: ../stock.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully deleted <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        } else {
            /* Redirect browser */
            header("Location: ../stock.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while deleteing data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
    }
    function addExistingStock($name, $type, $quantity, $sub_stock) {
        include_once 'conn.php';
        $sql = "SELECT * FROM stock WHERE id = '$name'";
        $result = $mysqli->query($sql);
        if (!$result) {
            die("Error description: " . $mysqli->error);
            header("Location: ../addStock.php?msg= <i class='errorMsg' id = 'ermsg' style='color:red'> Error while uploading data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>"); /* Redirect browser */
        }
        $row = mysqli_fetch_assoc($result);
        $oldQty = (int)$row['quantity'];
        $oldSubstok = (float)$row['sub_stock'];
        $amountPtype = (float)$row['amountPtype'];
        $type = $row['type'];
        $newQty = $oldQty + (int)$quantity;
        if ($sub_stock > 0 || $quantity > 0) {
            //for sub_stock
            if ($quantity == null) {
                echo $name . ' ' . $type . 'Null qty    input qty ' . $quantity . '    amount/type  ' . $amountPtype . '     input substock' . $sub_stock . '     new qty' . $newQty . '    new substock:' . $newSubstok . '    old substock:' . $oldSubstok . '    old qty' . $oldQty;
                //if number is negative
                if ($amountPtype > $sub_stock) {
                    //if substok plus input is greater than sack or cartoon
                    $sumSubtok = $oldSubstok + $sub_stock;
                    if ($sumSubtok >= $amountPtype) {
                        $newSubstok = $sumSubtok - $amountPtype;
                        $newQty = $oldQty + 1;
                        $insert = "UPDATE stock set sub_stock = '$newSubstok', quantity = '$newQty'  where id = '$name'";
                        $update = $mysqli->query($insert);
                        if ($update) {
                            header("Location: ../addStock.php?msg= <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully Added <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                        } else {
                            header("Location: ../addStock.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:red'> Failed to update data :(  <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                        }
                    } else {
                        $newSubstok = $sub_stock + $oldSubstok;
                        $insert = "UPDATE stock set sub_stock = '$newSubstok' where id = '$name'";
                        $update = $mysqli->query($insert);
                        if ($update) {
                            header("Location: ../addStock.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully Added <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                        } else {
                            header("Location: ../addStock.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Failed to update data :(  <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                        }
                    }
                } else {
                    if ($type == 'Sack') {
                        $msg = 'Kg';
                    } else {
                        $msg = 'Piece';
                    }
                    header("Location: ../addStock.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> According to your database $amountPtype $msg = 1 $type. Please add item in $type first <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                }
            }
            //for quantity
            elseif ($sub_stock == null) {
                $insert = "UPDATE stock set quantity = '$newQty' where id = '$name'";
                $update = $mysqli->query($insert);
                if ($update) {
                    header("Location: ../addStock.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully Added <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                } else {
                    header("Location: ../addStock.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Failed to update data :(  <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                }
            } else {
                header("Location: ../addStock.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Unexpected error occured :( please contact your service provider 9869213908 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
        } else {
            header("Location: ../addStock.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Hey, you have entered input less then or equal to 0 :{  <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>"); /* Redirect browser */
        }
        mysqli_close($mysqli);
    }
}
//Billing ...
class billing {
    function addBill($time, $date, $bill, $cus_id, $cus_type, $cus_name, $address, $phone, $cus_type_input, $product, $qty, $amt, $rate, $total) {
        include_once 'conn.php';
        $upload = 0;
        $billId = (int)$bill;
        //fetching data
        $sql = "SELECT * from stock WHERE id = '$product'";
        $result = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($result);
        $pName = $row['name'];
        $pType = $row['type'];
        $amountPtype = $row['amountPtype'];
        $wp = $row['wholesell'];
        $sp = $row['sell'];
        $rp = $row['retail'];
        $currentQty = $row['quantity'];
        $currentAmt = $row['sub_stock'];
        if ($cus_type == 'new') {
            $CusSql = "INSERT INTO customer values('', '$cus_name', '$cus_type_input', '$address', '$phone')";
            $cusInsert = $mysqli->query($CusSql);
            //if customer not inserted
            if ($cusInsert == true) {
                $upload = 1;
                echo '
                <script>
                alert("Customer Added");
                </script>
                    ';
                $last_id = $mysqli->insert_id;
                $cus_id = $last_id;
            } else {
                $upload = 0;
                header("Location: ../billing.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error While Adding New Customer, Please Contact your service provider 9869213908 :(  <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
        }
        if ($cus_type == 'existing') {
            $upload = 1;
        }
        //for billing
        if ($upload == 1) {
            //Validating amount input
            if ($amt < $amountPtype) {
                //calculating total stock
                $totalStock = ($currentQty * $amountPtype) + $currentAmt;
                //calculating input total
                $totalInput = ($qty * $amountPtype) + $amt;
                if ($totalInput > $totalStock) {
                    $upload = 0;
                    //echo $totalInput . ' / '.$totalStock;
                    header("Location: ../billing.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Product does not have that much stock. Please input lesser! <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                } else {
                    $newQty = $currentQty - $qty;
                    //managing stock
                    echo $amt . '<br>c' . $currentAmt . '<br>';
                    if ($amt > $currentAmt) {
                        $newQty = ($newQty - 1);
                        $new_amt = $amountPtype - ($amt - $currentAmt);
                        $upload = 1;
                        echo 'error ';
                    } else if ($currentAmt >= $amt) {
                        $new_amt = $currentAmt - $amt;
                        $upload = 1;
                        echo '/error 2';
                    } else {
                        $upload = 0;
                        //echo $amt.'new qty<br>'.$newQty.'<br>n'.$new_amt.'<br>c'.$currentAmt.'<br>';
                        header("Location: ../billing.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Unexpected Error Occured. Please contact your service provider 9869213908 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                    }
                    //Ending loop if everyting is fine
                    if ($upload == 1) {
                        session_start();
                        $_SESSION["sessionBillNo"] = $bill;
                        //insert to bill first
                        $bl_insert = $mysqli->query("INSERT INTO bill values ('', '$cus_id', '$product' ,'$billId', '$bill', '$pName', '$pType', '$qty', '$amt', '$totalInput', '$rate', '$total', '$time','$date')");
                        if ($bl_insert) {
                            $stock_update = $mysqli->query("UPDATE stock set quantity = '$newQty', sub_stock = '$new_amt' WHERE id = '$product'");
                            if ($stock_update == true) {
                                $_SESSION["sessionBillNo"] = $billId;
                                //Show bill
                                $_SESSION["sessionBillshow"] = "visible";
                                //set customer id
                                $_SESSION["initialCusid"] = $cus_id;
                                header("Location: ../billing.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Success: Product Successfully added to bill. <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                            } else {
                                header("Location: ../billing.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error: System can not update stock :( . Please contact your service provider 9869213908 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                            }
                        } else {
                            //echo $cus_id. ' '. $bill. ' '. $pName. ' '. $qty. ' '. $amt. ' '. $totalInput. ' '. $rate. ' '. $total;
                            header("Location: ../billing.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error: System can not insert data to bliing :( . Please contact your service provider 9869213908 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                        }
                    } else {
                        //echo '<br>'.$amt.'new qty'.$newQty.'<br>n'.$new_amt.'<br>c'.$currentAmt.'<br>';
                        header("Location: ../billing.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Unexpected Error Occured. Please contact your service provider 9869213908 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                    }
                }
            } else {
                $upload = 0;
                header("Location: ../billing.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> According to your database $amountPtype Kg or Piece = 1 Sack or Cartoon. Please add product in Quantity field <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
        } else {
            header("Location: ../billing.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Unexpected Error Occured at loop 1. Please contact your service provider 9869213908 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
    }
    function deleteP($id, $pid, $qty, $amt) {
        include_once 'conn.php';
        $upload = 0;
        //fetching data
        $sql = "SELECT * from stock WHERE id = '$pid'";
        $result = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($result);
        $amountPtype = $row['amountPtype'];
        $currentQty = $row['quantity'];
        $currentAmt = $row['sub_stock'];
        $newQty = $currentQty + $qty;
        $sum = $amt + $currentAmt;
        // echo $amountPtype.'/';
        // echo $currentAmt.'/'.$currentQty.'<br>';
        if ($sum >= $amountPtype) {
            $newQty = $newQty + 1;
            $new_amt = $sum - $amountPtype;
            $upload = 1;
        } else if ($sum < $amountPtype) {
            $new_amt = $sum;
            $upload = 1;
        } else {
            $upload = 0;
            header("Location: ../billing.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Unexpected Error Occured at loop 1. Please contact your service provider 9869213908 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
        if ($upload == 1) {
            // echo $new_amt.'/'.$newQty.'<br>';
            // echo $currentAmt.'/'.$currentQty.'<br>';
            $stock_update = $mysqli->query("UPDATE stock set quantity = '$newQty', sub_stock = '$new_amt' WHERE id = '$pid'");
            if ($stock_update) {
                $bl_delete = $mysqli->query("DELETE FROM  bill WHERE  id ='$id'");
                if ($bl_delete == true) {
                    header("Location: ../billing.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Item Successfully Removed from bill. <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                } else {
                    header("Location: ../billing.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error: System can not Delete list But Stock is Reseted :( . Please contact your service provider 9869213908 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                }
            } else {
                header("Location: ../billing.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error: System can not update stock :( . Please contact your service provider 9869213908 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                //echo $cus_id. ' '. $bill. ' '. $pName. ' '. $qty. ' '. $amt. ' '. $totalInput. ' '. $rate. ' '. $total;
                
            }
        } else {
            header("Location: ../billing.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Unexpected Error Occured. Please contact your service provider 9869213908 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
    }
    function billStatus($bill, $grand, $vat, $paid, $word, $type, $time, $date) {
        include_once 'conn.php';
        $billID = (int)$bill;
        //checking due amount
        $due = $vat - $paid;
        $qry = "INSERT INTO billstatus VALUES ('', '$billID', '$bill', '$grand', '$vat', '$paid', '$word', '$type' , '$due', '$time', '$date')";
        $result = $mysqli->query($qry);
        if (!$result) {
            echo "Data insertion error, : " . $mysqli->error;
            header("Location: ../billing.php?msg =  <i class='errorMsg' id = 'ermsg' style='color:red'> Error while Adding Bill Status<span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        } else {
            $billID = $billID + 1;
            session_start();
            $_SESSION["sessionBillNo"] = $billID;
            //unset session
            $_SESSION["sessionBillshow"] = "invisible";
            $_SESSION["initialCusid"] = "none";
            header("Location: ../billing.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:green'> Bill Successfully Added <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
    }
}
//STOCK MANAGEMENT END
//Vat MANAGEMENT START..........
class vat {
    function editVat($id, $name, $quantity, $sub_stock, $amountPtype, $cp, $wp, $sp, $rp) {
        include_once 'conn.php';
        $cp = $cp / $amountPtype;
        $wp = $wp / $amountPtype;
        $sp = $sp / $amountPtype;
        $rp = $rp / $amountPtype;
        $sql = "UPDATE  vat SET  name ='$name',quantity='$quantity', sub_stock = '$sub_stock', amountPtype= '$amountPtype',  cost= '$cp',wholesell= '$wp', sell='$sp', retail ='$rp' WHERE id = '$id'";
        $insert = $mysqli->query($sql);
        if ($insert) {
            header("Location: ../vat.php?msg= <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully updated <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            mysqli_close($mysqli);
        } else {
            header("Location: ../vat.php?msg= <i class='errorMsg' id = 'ermsg' style='color:red'> Error while uploading data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            mysqli_close($mysqli);
        }
    }
    function addVat($id, $name, $type, $quantity, $amountPtype, $cp, $wp, $sp, $rp) {
        include_once 'conn.php';
        $icp = $cp / $amountPtype;
        $iwp = $wp / $amountPtype;
        $isp = $sp / $amountPtype;
        $irp = $rp / $amountPtype;
        $total = $amountPtype * $quantity;
        $qry = "INSERT INTO vat VALUES ('', '$name' ,'$type', '$quantity', '$amountPtype', '0', '$icp', '$iwp', '$isp', '$irp')";
        $result = $mysqli->query($qry);
        if (!$result) {
            echo "Data insertion error, : " . $mysqli->error;
            header("Location: ../vat.php?msg =  <i class='errorMsg' id = 'ermsg' style='color:red'> Error while movie uploading<span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
        if ($result) {
            header("Location: ../vat.php?msg= <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully Uplaoded <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
    }
    function deleteVat($id) {
        include_once 'conn.php';
        $sql = "DELETE FROM  vat WHERE  id ='$id' ";
        $delete = $mysqli->query($sql);
        if ($delete) {
            header("Location: ../vat.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully deleted <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        } else {
            /* Redirect browser */
            header("Location: ../vat.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while deleteing data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
    }
    function addExistingvatStock($name, $type, $quantity, $sub_stock) {
        include_once 'conn.php';
        $sql = "SELECT * FROM vat WHERE id = '$name'";
        $result = $mysqli->query($sql);
        if (!$result) {
            die("Error description: " . $mysqli->error);
            header("Location: ../addStock.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while uploading data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>"); /* Redirect browser */
        }
        $row = mysqli_fetch_assoc($result);
        $oldQty = (int)$row['quantity'];
        $oldSubstok = (float)$row['sub_stock'];
        $amountPtype = (float)$row['amountPtype'];
        $type = $row['type'];
        $newQty = $oldQty + (int)$quantity;
        if ($sub_stock > 0 || $quantity > 0) {
            //for sub_stock
            if ($quantity == null) {
                echo $name . ' ' . $type . 'Null qty    input qty ' . $quantity . '    amount/type  ' . $amountPtype . '     input substock' . $sub_stock . '     new qty' . $newQty . '    new substock:' . $newSubstok . '    old substock:' . $oldSubstok . '    old qty' . $oldQty;
                //if number is negative
                if ($amountPtype > $sub_stock) {
                    //if substok plus input is greater than sack or cartoon
                    $sumSubtok = $oldSubstok + $sub_stock;
                    if ($sumSubtok >= $amountPtype) {
                        $newSubstok = $sumSubtok - $amountPtype;
                        $newQty = $oldQty + 1;
                        $insert = "UPDATE vat set sub_stock = '$newSubstok', quantity = '$newQty'  where id = '$name'";
                        $update = $mysqli->query($insert);
                        if ($update) {
                            header("Location: ../addVat.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully Added <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                        } else {
                            header("Location: ../addVat.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Failed to update data :(  <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                        }
                    } else {
                        $newSubstok = $sub_stock + $oldSubstok;
                        $insert = "UPDATE vat set sub_stock = '$newSubstok' where id = '$name'";
                        $update = $mysqli->query($insert);
                        if ($update) {
                            header("Location: ../addVat.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully Added <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                        } else {
                            header("Location: ../addVat.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Failed to update data :(  <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                        }
                    }
                } else {
                    if ($type == 'Sack') {
                        $msg = 'Kg';
                    } else {
                        $msg = 'Piece';
                    }
                    header("Location: ../addVat.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> According to your database $amountPtype $msg = 1 $type. Please add item in $type first <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                }
            }
            //for quantity
            elseif ($sub_stock == null) {
                $insert = "UPDATE vat set quantity = '$newQty' where id = '$name'";
                $update = $mysqli->query($insert);
                if ($update) {
                    header("Location: ../addVat.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully Added <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                } else {
                    header("Location: ../addVat.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Failed to update data :(  <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                }
            } else {
                header("Location: ../addVat.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Unexpected error occured :( please contact your service provider 9869213908 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
        } else {
            header("Location: ../addVat.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Hey, you have entered input less then or equal to 0 :{  <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>"); /* Redirect browser */
        }
        mysqli_close($mysqli);
    }
}
//Billing ...
class vatBilling {
    function addVatBill($time, $date, $bill, $cus_id, $cus_type, $cus_name, $address, $phone, $cus_type_input, $product, $qty, $amt, $rate, $total) {
        include_once 'conn.php';
        $upload = 0;
        $billId = (int)$bill;
        //fetching data
        $sql = "SELECT * from vat WHERE id = '$product'";
        $result = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($result);
        $pName = $row['name'];
        $pType = $row['type'];
        $amountPtype = $row['amountPtype'];
        $wp = $row['wholesell'];
        $sp = $row['sell'];
        $rp = $row['retail'];
        $currentQty = $row['quantity'];
        $currentAmt = $row['sub_stock'];
        if ($cus_type == 'new') {
            $CusSql = "INSERT INTO customer values('', '$cus_name', '$cus_type_input', '$address', '$phone')";
            $cusInsert = $mysqli->query($CusSql);
            //if customer not inserted
            if ($cusInsert == true) {
                $upload = 1;
                echo '
                <script>
                alert("Customer Added");
                </script>
                    ';
                $last_id = $mysqli->insert_id;
                $cus_id = $last_id;
            } else {
                $upload = 0;
                header("Location: ../vatBilling.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error While Adding New Customer, Please Contact your service provider 9869213908 :(  <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
        }
        if ($cus_type == 'existing') {
            $upload = 1;
        }
        //for billing
        if ($upload == 1) {
            //Validating amount input
            if ($amt < $amountPtype) {
                //calculating total stock
                $totalStock = ($currentQty * $amountPtype) + $currentAmt;
                //calculating input total
                $totalInput = ($qty * $amountPtype) + $amt;
                if ($totalInput > $totalStock) {
                    $upload = 0;
                    //echo $totalInput . ' / '.$totalStock;
                    header("Location:../vatBilling.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Product does not have that much stock. Please input lesser! <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                } else {
                    $newQty = $currentQty - $qty;
                    //managing stock
                    echo $amt . '<br>c' . $currentAmt . '<br>';
                    if ($amt > $currentAmt) {
                        $newQty = ($newQty - 1);
                        $new_amt = $amountPtype - ($amt - $currentAmt);
                        $upload = 1;
                        echo 'error ';
                    } else if ($currentAmt >= $amt) {
                        $new_amt = $currentAmt - $amt;
                        $upload = 1;
                        echo '/error 2';
                    } else {
                        $upload = 0;
                        //echo $amt.'new qty<br>'.$newQty.'<br>n'.$new_amt.'<br>c'.$currentAmt.'<br>';
                        header("Location: ../vatBilling.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Unexpected Error Occured. Please contact your service provider 9869213908 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                    }
                    //Ending loop if everyting is fine
                    if ($upload == 1) {
                        session_start();
                        $_SESSION["sessionvatBillNo"] = $bill;
                        //insert to bill first
                        $bl_insert = $mysqli->query("INSERT INTO vatbill values ('', '$cus_id', '$product' ,'$billId', '$bill', '$pName', '$pType', '$qty', '$amt', '$totalInput', '$rate', '$total', '$time','$date')");
                        if ($bl_insert) {
                            $stock_update = $mysqli->query("UPDATE vat set quantity = '$newQty', sub_stock = '$new_amt' WHERE id = '$product'");
                            if ($stock_update == true) {
                                $_SESSION["sessionvatBillNo"] = $billId;
                                //Show bill
                                $_SESSION["sessionvatBillshow"] = "visible";
                                //set customer id
                                $_SESSION["vatInitialCusid"] = $cus_id;
                                header("Location: ../vatBilling.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Success: Product Successfully added to bill. <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                            } else {
                                header("Location: ../vatBilling.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error: System can not update stock :( . Please contact your service provider 9869213908 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                            }
                        } else {
                            //echo $cus_id. ' '. $bill. ' '. $pName. ' '. $qty. ' '. $amt. ' '. $totalInput. ' '. $rate. ' '. $total;
                            header("Location: ../vatBilling.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error: System can not insert data to bliing :( . Please contact your service provider 9869213908 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                        }
                    } else {
                        //echo '<br>'.$amt.'new qty'.$newQty.'<br>n'.$new_amt.'<br>c'.$currentAmt.'<br>';
                        header("Location: ../vatBilling.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Unexpected Error Occured. Please contact your service provider 9869213908 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                    }
                }
            } else {
                $upload = 0;
                header("Location: ../vatBilling.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> According to your database $amountPtype Kg or Piece = 1 Sack or Cartoon. Please add product in Quantity field <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
        } else {
            header("Location: ../vatBilling.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Unexpected Error Occured at loop 1. Please contact your service provider 9869213908 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
    }
    function deleteV($id, $pid, $qty, $amt) {
        include_once 'conn.php';
        $upload = 0;
        //fetching data
        $sql = "SELECT * from vat WHERE id = '$pid'";
        $result = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($result);
        $amountPtype = $row['amountPtype'];
        $currentQty = $row['quantity'];
        $currentAmt = $row['sub_stock'];
        $newQty = $currentQty + $qty;
        $sum = $amt + $currentAmt;
        // echo $amountPtype.'/';
        // echo $currentAmt.'/'.$currentQty.'<br>';
        if ($sum >= $amountPtype) {
            $newQty = $newQty + 1;
            $new_amt = $sum - $amountPtype;
            $upload = 1;
        } else if ($sum < $amountPtype) {
            $new_amt = $sum;
            $upload = 1;
        } else {
            $upload = 0;
            header("Location: ../vatBilling.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Unexpected Error Occured at loop 1. Please contact your service provider 9869213908 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
        if ($upload == 1) {
            // echo $new_amt.'/'.$newQty.'<br>';
            // echo $currentAmt.'/'.$currentQty.'<br>';
            $stock_update = $mysqli->query("UPDATE vat set quantity = '$newQty', sub_stock = '$new_amt' WHERE id = '$pid'");
            if ($stock_update) {
                $bl_delete = $mysqli->query("DELETE FROM  vatbill WHERE  id ='$id'");
                if ($bl_delete == true) {
                    header("Location: ../vatBilling.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Item Successfully Removed from bill. <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                } else {
                    header("Location: ../vatBilling.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error: System can not Delete list But Stock is Reseted :( . Please contact your service provider 9869213908 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                }
            } else {
                header("Location: ../vatBilling.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error: System can not update stock :( . Please contact your service provider 9869213908 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                //echo $cus_id. ' '. $bill. ' '. $pName. ' '. $qty. ' '. $amt. ' '. $totalInput. ' '. $rate. ' '. $total;
                
            }
        } else {
            header("Location: ../vatBilling.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Unexpected Error Occured. Please contact your service provider 9869213908 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
    }
    function vatBillStatus($bill, $grand, $vat, $paid, $word, $type, $time, $date) {
        include_once 'conn.php';
        $billID = (int)$bill;
        //checking due amount
        $due = $vat - $paid;
        $qry = "INSERT INTO vatbillstatus VALUES ('', '$billID', '$bill', '$grand', '$vat', '$paid', '$word', '$type' , '$due', '$time', '$date')";
        $result = $mysqli->query($qry);
        if (!$result) {
            echo "Data insertion error, : " . $mysqli->error;
            header("Location: ../vatBilling.php?msg =  <i class='errorMsg' id = 'ermsg' style='color:red'> Error while Adding Bill Status<span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        } else {
            $billID = $billID + 1;
            session_start();
            $_SESSION["sessionvatBillNo"] = $billID;
            //unset session
            $_SESSION["sessionvatBillshow"] = "invisible";
            $_SESSION["vatInitialCusid"] = "none";
            header("Location: ../vatBilling.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:green'> Bill Successfully Added <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
    }
}
//Vat MANAGEMENT END
//CUSTOMER FUNCTION ...........
class customer {
    function editCus($id, $name, $address, $phone, $type) {
        include_once 'conn.php';
        $qry = "UPDATE  customer SET  name = '$name', address = '$address', phone = '$phone', type = '$type' WHERE id='$id'";
        $result = $mysqli->query($qry);
        if ($result) {
            echo "Data insertion error, : " . $mysqli->error;
            header("Location: ../customer.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully updated <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        } else {
            header("Location: ../customer.php?msg =  <i class='errorMsg' id = 'ermsg' style='color:red'> Error while updating<span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
    }
    function deleteCus($id) {
        include_once 'conn.php';
        $sql = "DELETE FROM  customer WHERE  id ='$id' ";
        $delete = $mysqli->query($sql);
        if ($delete) {
            header("Location: ../customer.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully deleted <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        } else {
            header("Location: ../customer.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while deleteing data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
    }
}
?>
