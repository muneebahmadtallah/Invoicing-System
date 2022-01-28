<?php
require_once("dbConfig.php");

$id =$_GET['id'];

$slct= mysqli_query($con, "SELECT * FROM invoice_products WHERE id = $id");

if (mysqli_num_rows($slct) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($slct)) {
        
    $in_id = $row['invoice_id'];
 
   

$query= mysqli_query($con, "DELETE FROM invoice_products WHERE id = $id");
   
if($query){
    header("location:editinvoice.php?id=$in_id");
    // header("location:allinvoices.php");
    // echo 'success';
}}
}

?>