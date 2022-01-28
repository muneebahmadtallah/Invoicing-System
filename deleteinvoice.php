<?php
require_once("dbConfig.php");

$id =$_GET['id'];

$query= mysqli_query($con, "DELETE FROM invoices WHERE id = $id");
$query2= mysqli_query($con, "DELETE FROM invoice_products WHERE invoice_id = $id");
if($query2){
    header("location:allinvoices.php");
}

?>