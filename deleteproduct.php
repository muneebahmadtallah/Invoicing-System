<?php
require_once("dbConfig.php");

$id =$_GET['id'];

$query= mysqli_query($con, "DELETE FROM products WHERE id = $id");
if($query){
    header("location:allproduct.php");
}

?>