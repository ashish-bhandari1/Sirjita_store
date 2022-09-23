<?php
   $connect = new mysqli ('localhost', 'root', '', 'sirjita_store');
    $output = '';

    if(isset($_POST["brand_id"])){
        $sql = "SELECT * FROM stock WHERE id = '".$_POST["brand_id"]."'";
        $result = mysqli_query($connect, $sql);

        while($row = mysqli_fetch_array($result)){
            if($row['type'] == "sack"){
                $unit = 'KG';
             }
             else{
                $unit = 'Piece';
             }

            $output .=  '<div class="input" >
            <label > Product Comes in <label id = "pType">'.$row["type"].'</label>,<i style = "color:blue"> 1 </i>'.$row["type"].' contains 
            </label>
            <label ><i style = "color:blue"> <label id = "amtType"> '.$row["amountPtype"]. ' '. $unit.' <label> </i> of '. $row["name"].'
            </label>
            </div>
            <div class="input" >
            <label > Wholesell Price:<i style = "color:blue"> <label id = "wp">'.$row["wholesell"].'</label></i> 
            </label>
            </div>
            <div class="input" >
            <label > Sell Price: <i style = "color:blue"> <label id = "sp">'.$row["sell"].'</label></i>
            </label>
            </div>
            <div class="input">
            <label > Retail Price : <i style = "color:blue"> <label id = "rp">'.$row["retail"].'</label></i>
             </div>
            ';
            }
        echo $output;
    }

    if(isset($_POST["vatBrand_id"])){
        $sql = "SELECT * FROM vat WHERE id = '".$_POST["vatBrand_id"]."'";
        $result = mysqli_query($connect, $sql);

        while($row = mysqli_fetch_array($result)){
            if($row['type'] == "sack"){
                $unit = 'KG';
             }
             else{
                $unit = 'Piece';
             }

            $output .=  '<div class="input" >
            <label > Product Comes in <label id = "pType">'.$row["type"].'</label>,<i style = "color:blue"> 1 </i>'.$row["type"].' contains 
            </label>
            <label ><i style = "color:blue"> <label id = "amtType"> '.$row["amountPtype"]. ' '. $unit.' <label> </i> of '. $row["name"].'
            </label>
            </div>
            <div class="input" >
            <label > Wholesell Price:<i style = "color:blue"> <label id = "wp">'.$row["wholesell"].'</label></i> 
            </label>
            </div>
            <div class="input" >
            <label > Sell Price: <i style = "color:blue"> <label id = "sp">'.$row["sell"].'</label></i>
            </label>
            </div>
            <div class="input">
            <label > Retail Price : <i style = "color:blue"> <label id = "rp">'.$row["retail"].'</label></i>
           </div>
            ';
            }
        echo $output;
    }
?>