
<!doctype html>
<html lang="en">
  <head>
  	<title>A.A.TRADERS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/custom.css">
  </head>
  <body>
		

		<?php
    include 'sidebar.php'	;
?>
        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">
      
        <h1 class="text-orange">All Products Invoices</h1><br>
        

    <div class="form-row">
    <div class="form-group col-md-3">
      <label for="title">Search By user Name</label>
        <input type="text" class="form-control search_paramu"/>
    </div>
    <div class="form-group col-md-3">
      <label for="quantity">Search By Prodcut Name</label>
        <input type="text" class="form-control search_paramm"/>
    </div>
    <div class="form-group col-md-3">
      <label for="quantity">Search By Date</label>
        <input type="text" class="form-control search_paramd" />
    </div>
    <div class="form-group col-md-3">
      <label for="quantity" class="text-white">Create Invoice</label>
<a href="createinvoice.php"><button class="form-control btn btn-primary text-white">New invoice</button></a>
    </div>
  </div><br>
                    
<table class="table table-hover">
<thead class="thead-light">  
<tr>
    <th>User Name</th>
    <th>Invoice No</th>
    <th>Prodcut Name</th>
    <th>Item Price</th>
    <th>Percent Price</th>
    <th>Quantity</th>
    <th>Subtotal</th>
    <th>Date</th>
  </tr>
</thead>
<tbody id="tbl_bodyy">
<?php
require_once("dbConfig.php");
$count = 0;


$slct = "SELECT invoice_products.id, invoice_products.ItemPrice, invoice_products.PercentPrice, invoice_products.Quantity, invoice_products.SubTotal,
users.name, products.title, invoices.date, invoices.invoice_no
FROM invoice_products
INNER JOIN users ON invoice_products.user_id = users.id
INNER JOIN products ON invoice_products.product_id = products.id  
INNER JOIN invoices ON invoice_products.invoice_id = invoices.id
order by invoice_products.id desc";

$result = mysqli_query($con, $slct);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
      $count++;
    ?>
    <tr>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['invoice_no']; ?></td>
    <td><?php echo $row['title']; ?></td>
    <td><?php echo $row['ItemPrice']; ?></td>  
    <td><?php echo $row['PercentPrice']; ?></td>
    <td><?php echo $row['Quantity']; ?></td>
    <td><?php echo $row['SubTotal']; ?></td>  
    <td><?php echo $row['date']; ?></td> 
  </tr>	
 
 <?php  
  }
} else {
  echo "0 results";
}

mysqli_close($con);
?>
</tbody>
</table>
</div>




<script>
            $(document).on("keyup", ".search_paramm", function () {
                var search_paramm = $(".search_paramm").val();
                $.ajax({
                    url: 'getData.php',
                    type: 'POST',
                    data: {search_paramm: search_paramm},
                    success: function (data) {
                        $("#tbl_bodyy").html(data);
                    }
                });
            });

            $(document).on("keyup", ".search_paramu", function () {
                var search_paramu = $(".search_paramu").val();
                $.ajax({
                    url: 'getData.php',
                    type: 'POST',
                    data: {search_paramu: search_paramu},
                    success: function (data) {
                        $("#tbl_bodyy").html(data);
                    }
                });
            });

$(document).on("keyup", ".search_paramd", function () {
    var search_paramd = $(".search_paramd").val();
    $.ajax({
        url: 'getData.php',
        type: 'POST',
        data: {search_paramd: search_paramd},
        success: function (data) {
            $("#tbl_bodyy").html(data);
        }
    });
});
        </script> 

  </body>
</html>