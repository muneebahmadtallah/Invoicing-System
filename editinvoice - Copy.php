<?php
 require_once("dbConfig.php");

 $id = $_GET['id']; // get id through query string

$slct= "SELECT invoices.invoice_no, invoices.user_id, invoices.date, invoices.GrossTotal, invoices.ExtraBonus, invoices.NetTotal, 
users.name
FROM invoices 
INNER JOIN users 
ON invoices.user_id = users.id 
WHERE invoices.id = '$id'";

  $result=mysqli_query($con, $slct);
  $data =mysqli_fetch_array($result);
///////////////////////////////////////////////////////////////////////////////////////////
 
 if (isset($_POST['submit']))
{
     $invoice_no = $_POST['invoice_no'];
     $date = $_POST['date'];
    $GrossTotal = $_POST['GrossTotal'];
    $ExtraBonus = $_POST['ExtraBonus'];
    $NetTotal = $_POST['NetTotal'];

 $update = "update invoices set invoice_no='$invoice_no', date='$date', GrossTotal='$GrossTotal',
 ExtraBonus='$ExtraBonus', NetTotal='$NetTotal' where id='$id'";
if (mysqli_query($con, $update)) 
{
  // $last_id = mysqli_insert_id($con);
  //  echo "<script>alert(\"New record created successfully\");</script>";
}
////////////////////////////////////////////////////////////////////////////////

// $product_ids = $_POST['product_id'];
$invoice_products_id = $_POST['invoice_product_id'];
$ItemPrices = $_POST['ItemPrice'];
$PercentPrices = $_POST['PercentPrice'];
$Quantitys = $_POST['Quantity'];
$SubTotals = $_POST['SubTotal'];

for ($i = 0; $i < count($ItemPrices); $i++) 
{ //construct the outer loop with the largest group, unless they're all the same amount, then it doesn't matter
//  $product_id = (!empty($product_ids[$i])) ? $product_ids[$i] : '';
//  echo $product_id. "<br>";
 $ItemPrice = (!empty($ItemPrices[$i])) ? $ItemPrices[$i] : '';
 //echo $ItemPrice. "<br>";
$invoice_products_ids = (!empty($invoice_products_id[$i])) ? $invoice_products_id[$i] : '';
//  echo $invoice_products_ids.'<br>';
// echo $i. '<br>';
 $PercentPrice = (!empty($PercentPrices[$i])) ? $PercentPrices[$i] : '';
//  echo $PercentPrice. "<br>";
 $Quantity = (!empty($Quantitys[$i])) ? $Quantitys[$i] : '';
//  echo $Quantity. "<br>";
 $SubTotal = (!empty($SubTotals[$i])) ? $SubTotals[$i] : '';
//  echo $SubTotal. "<br>";

$update2 = "update invoice_products set  ItemPrice='$ItemPrice',
PercentPrice='$PercentPrice', Quantity='$Quantity', SubTotal='$SubTotal' where id='$invoice_products_ids'";
if(mysqli_query($con, $update2))
{
header("location:allinvoices.php");
}
else {
 // echo "Error: " . $query2 . "<br>" . mysqli_error($con);
//  echo "<script>alert(\"Error: \" . $update2 . \"<br>\" . mysqli_error($con)\");</script>";
}

}

 }
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
include 'sidebar.php'	;
?>


        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">
      
      <h1 class="text-orange text-center">New Invoice</h1><br><br>
<form action="" method="post">
<div class="row">
<div class="col-md-4">
<div class="form-group row">
  <label class="col-sm-3 col-form-label">Invoice No:</label>
  <div class="col-sm-9">
    <input type="text" class="form-control" name="invoice_no" value="<?php echo $data['invoice_no'] ?>" required >
  </div>
</div>
</div>

<div class="col-md-4 offset-md-4">
<div class="form-group row">
  <label class="col-sm-2 col-form-label">Date </label>
  <div class="col-sm-10">
    <input type="date" value="<?php echo $data['date'] ?>" name="date" class="form-control" required>
  </div>
</div>
</div>
</div>

      
<div class="row">
<div class="col-md-4">
<div class="form-group row">
  <label class="col-sm-3 col-form-label">To: </label>
  <div class="col-sm-9">
      <input type="text" class="form-control" name="user_name" id="uname" value="<?php echo $data['name'] ?>" readonly> 
      <input type='hidden' name='user_id' value="<?php echo $data['user_id'] ?>">
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
    <!-- <th scope="col"><a href="javascript:void(0);" class="btn btn-success" id="add" title="Add row" >+ Row</a></th> -->
  </tr>
</thead>
<tbody class="detail">
<?php  
 $count =0;
 $slct2 = "SELECT invoice_products.id, invoice_products.product_id, invoice_products.ItemPrice,
 invoice_products.PercentPrice, invoice_products.Quantity, invoice_products.SubTotal, products.title
 FROM invoice_products
 INNER JOIN products 
 ON products.id = invoice_products.product_id 
 WHERE invoice_products.invoice_id= '$id'";
 $result2=mysqli_query($con, $slct2);
 if(mysqli_num_rows($result2) > 0)
 {
  while($data2 = mysqli_fetch_assoc($result2)) {
    $count ++;
  ?>
  <tr>
    <th scope="row" class="no"><?php echo $count ?></th>
    
    <input type="hidden" name="invoice_product_id[]" value="<?php echo $data2["id"] ?>" >
    <td>
    <input type="text" class="form-control pname" name="title[]" value="<?php echo $data2["title"] ?>" readonly>
      <input type="hidden" name="product_id" value="<?php echo $data2["product_id"] ?>">
    <div class="pnamelist"></div>
    </td>
    <td>
    <input type="text" class="form-control ItemPrice" name="ItemPrice[]" value="<?php echo $data2["ItemPrice"] ?>" required></td>
    <td>
    
    <input type="text" class="form-control PercentPrice" name="PercentPrice[]" value="<?php echo $data2["PercentPrice"] ?>" required></td>
    <td>
    <input type="text" class="form-control Quantity" name="Quantity[]" value="<?php echo $data2["Quantity"] ?>" required></td>
    <td>
    <input type="text" class="form-control SubTotal" name="SubTotal[]" value="<?php echo $data2["SubTotal"] ?>" required></td>
    <td>
    <a href="#" class="btn btn-danger remove">Delete</a></td>
  </tr>
  <?php }} ?>
  </tbody>
</table>
</div>

<div class="row">
<div class="col-md-4">

</div>
<div class="col-md-5 offset-md-3">
<div class="form-group row">
  <label  class="col-sm-4 col-form-label">Gross Total</label>
  <div class="col-sm-8">
    <input type="text" name="GrossTotal" class="form-control" id="GrossTotal" value="<?php echo $data['GrossTotal'] ?>" required>
  </div>
</div>
</div>
</div>


<div class="row">
<div class="col-md-5 offset-md-7">
<div class="form-group row">
  <label class="col-sm-4 col-form-label">Extra Bonus</label>
  <div class="col-sm-8">
    <input type="text" name="ExtraBonus" class="form-control" id="ExtraBonus" value="<?php echo $data['ExtraBonus'] ?>">
  </div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-4">
<button type="submit" name="submit" class="btn btn-primary">Update invoice</button>
<!-- <input type="submit" name="submit" class="btn btn-primary" value="Save Invoice"> -->
</div>
<div class="col-md-5 offset-md-3">
<div class="form-group row">
  <label class="col-sm-4 col-form-label">Net Total</label>
  <div class="col-sm-8">
    <input type="text" name="NetTotal" id="NetTotal" class="form-control" value="<?php echo $data['NetTotal'] ?>" required>
  </div>
</div>
</div>
</div>

</form>
</div>
  </div>


  
<script type="text/javascript">  
$(function()  
{  
  $('#add').click(function()  
  {  
    addnewrow();  
  });  
  //.delegate( selector, eventType, handler )
  $('body').delegate('.remove','click',function()  
  {  
    $(this).parent().parent().remove();  
  });

  $('body').delegate('.ItemPrice,.Quantity','keyup',function()  
  {  
    var tr=$(this).parent().parent();  
    var qty=tr.find('.Quantity').val();  
    var price=tr.find('.ItemPrice').val();  
    
    var percentprice = 15;
    var obj1 = (price * percentprice) /100;
    var obj2 = price - obj1;
    tr.find('.PercentPrice').val(obj2);

     

    var amt = obj2 * qty;
    // var amt =(qty * price)-(qty * price *dis)/100;  
    tr.find('.SubTotal').val(amt);  
    total();  
  });  
});  

  function total()  
  {  
    var t=0;  
    $('.SubTotal').each(function(i,e)   
    {  
    var amt =$(this).val()-0;  
    t+=amt;  
    });  
    $('#GrossTotal').val(t);  
    }  

  function addnewrow()   
   {  
  var n=($('.detail tr').length-0)+1;  
  var tr = '<tr>' +
    '<th scope="row" class="no">'+n+'</th>' +
    '<td>' +
    '<input type="text" class="form-control pname" name="title[]" value="" placeholder="Search product">' +
    '<div class="pnamelist"></div>' +
    '</td>' +
    '<td>' +
    '<input type="text" class="form-control ItemPrice" name="ItemPrice[]"></td>' +
    '<td>' +
    '<input type="text" class="form-control PercentPrice" name="PercentPrice[]"></td>' +
    '<td>' +
    '<input type="text" class="form-control Quantity" name="Quantity[]"></td>' +
    '<td>' +
    '<input type="text" class="form-control SubTotal" name="SubTotal[]"></td>' +
    '<td>' +
    '<a href="#" class="btn btn-danger remove">Delete</a></td>' +
    '</tr>'; 
  $('.detail').append(tr);   
  }  

</script>  

<script type="text/javascript">
$('body').delegate('#ExtraBonus,#GrossTotal','keyup',function(){
        var extrabonus= $('#ExtraBonus').val();
        var grosstotal= $('#GrossTotal').val();
       // console.log(extrabonus);
        var percent = (grosstotal * extrabonus) / 100;
        var obj = grosstotal - percent;
        //console.log(obj);
    $('#NetTotal').val(obj);
        //document.getElementById('NetTotal').val(obj);
    });

</script>

</body>
</html>