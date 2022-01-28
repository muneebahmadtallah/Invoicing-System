
<?php

include_once "dbConfig.php";

$query = "SELECT invoice_no from invoices where invoice_no LIKE '%20-21%' order by invoice_no DESC LIMIT 1";
$stmt = $con->query($query);
if(mysqli_num_rows($stmt) > 0) {
if ($row = mysqli_fetch_assoc($stmt)) {
$value2 = $row['invoice_no'];
$value2 = substr($value2, 10, 13);//separating numeric part
$value2 = $value2 + 1;//Incrementing numeric part
$value2 = "AAT/20-21/" . sprintf('%03s', $value2);//concatenating incremented value
$invoice_no = $value2;
}
}
else {
$value2 = "AAT/20-21/001";
$invoice_no = $value2;
}


?>


<!doctype html>
<html lang="en">
  <head>
  	<title>A.A.TRADERS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/custom.css">

    <script>
$(document).ready(function(){
    $('#myForm input[type="text"]').blur(function(){
        if(!$(this).val()){
            $(this).addClass("error");
        } else{
            $(this).removeClass("error");
        }
    });
});
</script>
           
</head> 
           
  <body>
		
		<div class="wrapper d-flex align-items-stretch">

		<?php
    include 'sidebar.php'	;
?>
        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">
      
        <h1 class="text-orange text-center">New Invoice</h1><br><br>
<form id="form" action="invoiceaction.php" method="post">
<div class="row">
<div class="col-md-4">
  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Invoice No:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="invoice_no" value="<?php echo $invoice_no ?>" required >
    </div>
  </div>
</div>

<div class="col-md-4 offset-md-4">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Date </label>
    <div class="col-sm-10">
      <input type="date" value="<?php echo date('Y-m-d'); ?>" name="date" class="form-control" required>
    </div>
  </div>
</div>
</div>

        
<div class="row">
<div class="col-md-4">
  <div class="form-group row">
    <label class="col-sm-3 col-form-label">To: </label>
    <div class="col-sm-9">
        <input type="text" class="form-control" name="user_name" id="uname" value="" placeholder="Search user name" required> 
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
        <thead class="thead-light">
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
    <tr>
      <th scope="row" class="no">1</th>
      <td>
      <input type="text" class="form-control pname" name="title[]" value="" placeholder="Search product" required>
      <div class="pnamelist"></div>
      </td>
      <td>
      <input type="text" class="form-control ItemPrice" name="ItemPrice[]" required></td>
      <td>
      <input type="text" class="form-control PercentPrice" name="PercentPrice[]" required></td>
      <td>
      <input type="text" class="form-control Quantity" name="Quantity[]" required></td>
      <td>
      <input type="text" class="form-control SubTotal" name="SubTotal[]" required></td>
      <td>
      <a href="#" class="btn btn-danger remove">Delete</a></td>
    </tr>
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
      <input type="text" name="GrossTotal" class="form-control" id="GrossTotal" required>
    </div>
  </div>
</div>
</div>


<div class="row">
<div class="col-md-5 offset-md-7">
  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Extra Percentage</label>
    <div class="col-sm-8">
      <input type="text" name="ExtraBonus" class="form-control" id="ExtraBonus">
    </div>
  </div>
</div>
</div>

<div class="row">
  <div class="col-md-4">
  <button type="submit" name="submit" class="btn btn-primary">Save invoice</button>
  <!-- <input type="submit" name="submit" class="btn btn-primary" value="Save Invoice"> -->
</div>
<div class="col-md-5 offset-md-3">
  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Net Total</label>
    <div class="col-sm-8">
      <input type="text" name="NetTotal" id="NetTotal" class="form-control" required>
    </div>
  </div>
</div>
</div>

</form>

</div>
		</div>


    <script type="text/javascript">
  $(document).ready(function(){
      $("#uname").on("keyup", function(){
        var uname = $(this).val();
        if (uname !=="") {
          $.ajax({
            url:"usersearch.php",
            type:"POST",
            cache:false,
            data:{uname:uname},
            success:function(data){
              //alert("Yes")
              $("#unamelist").html(data);
            // $("#test").html(data);
              $("#unamelist").fadeIn();
            }  
          });
        }else{
          $("#unamelist").html("");  
          $("#unamelist").fadeOut();
        }
      });
      // click one particular city name it's fill in textbox
      $(document).on("click","#unamelist li", function(){
        $('#uname').val($(this).text());
        $('#unamelist').fadeOut("fast");
      });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
      // $(".pname").on("keyup", function(){
      $('body').delegate('.pname','keyup', function(){
        var tr=$(this).parent().parent(); 
        var pname=tr.find('.pname').val(); 
        //var pname = $(this).val();
        if (pname !=="") {
          $.ajax({
            url:"productsearch.php",
            type:"POST",
            cache:false,
            data:{pname:pname},
            success:function(data){
              console.log(data);
              tr.find(".pnamelist").fadeIn();
            tr.find(".pnamelist").html(data);
            }  
          });
        }
        else{
          tr.find(".pnamelist").html("");  
          tr.find(".pnamelist").fadeOut();
        }
      });
      // click one particular product name it's fill in textbox
        $('body').delegate('.pnamelist li','click', function(){
        // alert($(this).val());
        var tr=$(this).parent().parent(); 
        //console.log("1" + tr);
      $(this).parent().parent().parent().find('.pname').val($(this).text());
      //console.log("2" + $(this).parent().parent().parent().find('.pname').val($(this).text()));
        $('.pnamelist').fadeOut("fast");
      });
  });
</script>


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
      '<input type="text" class="form-control pname" name="title[]" value="" placeholder="Search product" required>' +
      '<div class="pnamelist"></div>' +
      '</td>' +
      '<td>' +
      '<input type="text" class="form-control ItemPrice" name="ItemPrice[]" required></td>' +
      '<td>' +
      '<input type="text" class="form-control PercentPrice" name="PercentPrice[]" required></td>' +
      '<td>' +
      '<input type="text" class="form-control Quantity" name="Quantity[]" required></td>' +
      '<td>' +
      '<input type="text" class="form-control SubTotal" name="SubTotal[]" required></td>' +
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

<script>
  $(document).ready(function() {
    $("#form").validate();
  });
</script>
</body>
</html>