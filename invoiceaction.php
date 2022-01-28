<?php
 require_once("dbConfig.php");
//  var_dump($con);
 
 if (isset($_POST['submit']))
{
     $invoice_no = $_POST['invoice_no'];
     $date = $_POST['date'];
     $user_id = $_POST['user_id'];

    $GrossTotal = $_POST['GrossTotal'];
    $ExtraBonus = $_POST['ExtraBonus'];
    $NetTotal = $_POST['NetTotal'];

 $query = "INSERT into `invoices`(`invoice_no`, `user_id`,`date`,`GrossTotal`,`ExtraBonus`,`NetTotal`) 
  VALUES ('$invoice_no','$user_id','$date','$GrossTotal','$ExtraBonus','$NetTotal')";
    
if (mysqli_query($con, $query)) 
{
  $last_id = mysqli_insert_id($con);
  //  echo "<script>alert(\"New record created successfully\");</script>";
}
//  else {
//  echo "<script>alert(\"Error: \" . $query . \"<br>\" . mysqli_error($con)\");</script>";
// }

 $slct = "SELECT * FROM invoices WHERE id='$last_id'";
 $result = mysqli_query($con, $slct);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
$invoice_id = $row['id'];    
$user_idd = $row['user_id'];
}
}


$product_ids = $_POST['product_id'];
$ItemPrices = $_POST['ItemPrice'];
$PercentPrices = $_POST['PercentPrice'];
$Quantitys = $_POST['Quantity'];
$SubTotals = $_POST['SubTotal'];

  //conditional assignment operators   
        //$x = expr1 ? expr2 : expr3 	Returns the value of $x.
        //The value of $x is expr2 if expr1 = TRUE.
        //The value of $x is expr3 if expr1 = FALSE

for ($i = 0; $i < count($product_ids); $i++) 
{ //construct the outer loop with the largest group, unless they're all the same amount, then it doesn't matter
 $product_id = (!empty($product_ids[$i])) ? $product_ids[$i] : '';
//  echo $product_id. "<br>";
 $ItemPrice = (!empty($ItemPrices[$i])) ? $ItemPrices[$i] : '';
//  echo $ItemPrice. "<br>";
 $PercentPrice = (!empty($PercentPrices[$i])) ? $PercentPrices[$i] : '';
//  echo $PercentPrice. "<br>";
 $Quantity = (!empty($Quantitys[$i])) ? $Quantitys[$i] : '';
//  echo $Quantity. "<br>";
 $SubTotal = (!empty($SubTotals[$i])) ? $SubTotals[$i] : '';
//  echo $SubTotal. "<br>";



$query2 = "INSERT into `invoice_products`(`invoice_id`,`user_id`,`product_id`,`ItemPrice`,`PercentPrice`,`Quantity`,`SubTotal`)
VALUES ('$invoice_id','$user_idd','$product_id','$ItemPrice','$PercentPrice','$Quantity','$SubTotal')";
if(mysqli_query($con, $query2))
{
// echo "New record created successfully";
//echo "<script>alert(\"New record created successfully\");</script>";
header("location:allinvoices.php");
}
else {
 // echo "Error: " . $query2 . "<br>" . mysqli_error($con);
 //echo "<script>alert(\"Error: \" . $query2 . \"<br>\" . mysqli_error($con)\");</script>";
}

/////////////////////

$qty= "UPDATE products set quantity = (quantity - '$Quantity') WHERE id = '$product_id'";
$result=mysqli_query($con,$qty);
///////////////////////

}
  

 }
?>