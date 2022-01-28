
<?php
 require_once("dbConfig.php");

 //$id = $_GET['id']; // get id through query string
$id = 40;
// $slct = "SELECT invoices.invoice_no, invoices.user_id, invoices.date, invoices.GrossTotal, invoices.ExtraBonus, invoices.NetTotal, invoice_products.product_id, invoice_products.ItemPrice, invoice_products.PercentPrice, invoice_products.Quantity, invoice_products.SubTotal FROM invoices INNER JOIN invoice_products ON invoices.id = invoice_products.invoice_id 
// INNER JOIN users ON invoices.user_id = users.id
// INNER JOIN products ON invoice_products.product_id = products.id
// WHERE invoices.id = '$id'"; 

 $slct= "SELECT invoices.invoice_no, invoices.user_id, invoices.date, invoices.GrossTotal, invoices.ExtraBonus, invoices.NetTotal, 
 invoice_products.product_id, invoice_products.ItemPrice, invoice_products.PercentPrice, invoice_products.Quantity, invoice_products.SubTotal
  FROM invoices INNER JOIN invoice_products ON invoices.id = invoice_products.invoice_id WHERE invoices.id = '$id'";

// $slct = "SELECT * FROM invoices WHERE id = '$id'";
  $result=mysqli_query($con, $slct);
 $data = mysqli_fetch_array($result); // fetch data

 $count =0;
//  $slct2 = "SELECT * FROM invoice_products where id = '$id'";
//  $result2=mysqli_query($con, $slct2);
//  if(mysqli_num_rows($result2) > 0)
//  {
  //  while($row = mysqli_fetch_assoc($result2))
  //  {
  //   $count++;



 

//  if(isset($_POST['update'])) // when click on Update button
//  {
//     $name = $_POST['name'];
//   $contact = $_POST['contact'];
//   $address = $_POST['address'];
     
//      $edit = mysqli_query($con,"update invoices set name='$name', contact_number='$contact', address='$address' where id='$id'");
     
//      if($edit)
//      {
//          mysqli_close($con); // Close connection
//          header("location:allinvoices.php"); // redirects to all records page
//          exit;
//      }
//      else
//      {
//          echo mysqli_error($con); 
//      }    	
//  }
 

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>A.A. TRADERS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  </head>
  <body>
		

  <div class="wrapper d-flex align-items-stretch">

<?php
include 'sidebar.php';
?>


        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">
      
      <h1 class="text-primary text-center">New Invoice</h1><br><br>
<form action="invoiceaction.php" method="post">
<div class="row">
<div class="col-md-4">
<div class="form-group row">
  <label class="col-sm-3 col-form-label">Invoice No:</label>
  <div class="col-sm-9">
    <input type="text" class="form-control border border-info" name="invoice_no" value="<?php echo $data['invoice_no'] ?>" >
  </div>
</div>
</div>

<div class="col-md-4 offset-md-4">
<div class="form-group row">
  <label class="col-sm-2 col-form-label">Date </label>
  <div class="col-sm-10">
    <input type="date" value="<?php echo $data['date'] ?>" name="date" class="form-control border border-info">
  </div>
</div>
</div>
</div>

      
<div class="row">
<div class="col-md-4">
<div class="form-group row">
  <label class="col-sm-3 col-form-label">To: </label>
  <div class="col-sm-9">
      <input type="text" class="form-control border border-info" name="user_name" id="uname" value="<?php echo $data['user_id'] ?>"> 
      <input type='hidden' name='id' value="">
       <div id="unamelist"></div>
  </div>
</div>
</div>

<div class="col-md-3 offset-md-5">
<div class="form-group row">
  <h5 class="text-right">From: A.A.TRADERS<br>Abbottabad</h5>
</div>
</div>
</div>




<div class="row">
<table class="table table-bordered">
      <thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Medicine Title</th>
    <th scope="col">Price per item</th>
    <th scope="col">Price after 15%</th>
    <th scope="col">Quantity</th>
    <th scope="col">Sub Total</th>
    <th scope="col">
<a href="javascript:void(0);" class="btn btn-success" id="add" title="Add row" >+ Row</a></th>
  </tr>
</thead>
<tbody class="detail">
  <?php 
  while($pdata = mysqli_fetch_assoc($result))
  //foreach($data as $pdata)
   {
//   $count++;
//   print_r($pdata);
var_dump($pdata);
   }
   ?>