
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
      
        <h1 class="text-orange">All Invoices</h1><br>
        <div class="form-row">
    <div class="form-group col-md-3">
      <label for="title">Search By user Name</label>
        <input type="text" class="form-control search_param"/>
    </div>
    <div class="form-group col-md-3">
      <label for="quantity">Search By Invoice No</label>
        <input type="text" class="form-control search_parami"/>
    </div>
    <div class="form-group col-md-3">
      <label for="quantity">Search By Date</label>
        <input type="text" class="form-control search_paramdd" />
    </div>
    <div class="form-group col-md-3">
      <label for="quantity" class="text-white">Create Invoice</label>
<a href="createinvoice.php"><button class="form-control btn btn-primary text-white">New invoice</button></a>
    </div>
  </div><br>
                   
<table class="table table-hover">
<thead class="thead-light">  
<tr>
    <th>Invoice No</th>
    <th>User Name</th>
    <th>Date</th>
    <th>Gross Total</th>
    <th>Extra Bonus</th>
    <th>Net Total</th>
    <th>Edit</th>
    <th>Details</th>
    <th>Delete</th>
  </tr>
</thead>
<tbody id="tbl_body">
<?php
require_once("dbConfig.php");
$count = 0;


$slct = "SELECT invoices.id, invoices.invoice_no, invoices.date, invoices.GrossTotal, invoices.ExtraBonus, invoices.NetTotal, users.name
FROM invoices
INNER JOIN users ON invoices.user_id = users.id order by invoices.id desc";

$result = mysqli_query($con, $slct);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
      $count++;
    ?>
    <tr>
    <td><?php echo $row['invoice_no']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['date']; ?></td>  
    <td><?php echo $row['GrossTotal']; ?></td>
    <td><?php echo $row['ExtraBonus']; ?></td>
    <td><?php echo $row['NetTotal']; ?></td>   
    <td><button class="btn btn-secondary"><a class="text-white" href="editinvoice.php?id=<?php echo $row['id']; ?>">Edit</a></button></td>
    <td><button class="btn btn-primary"><a class="text-white" href="bill.php?id=<?php echo $row['id']; ?>">Details</a></button></td>
    <td><button class="btn btn-danger"><a class="text-white" href="deleteinvoice.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure to Delete?')">Delete</a></button></td>
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
            $(document).on("keyup", ".search_param", function () {
                var search_param = $(".search_param").val();
                $.ajax({
                    url: 'getData.php',
                    type: 'POST',
                    data: {search_param: search_param},
                    success: function (data) {
                        $("#tbl_body").html(data);
                    }
                });
            });

            
            $(document).on("keyup", ".search_parami", function () {
                var search_parami = $(".search_parami").val();
                $.ajax({
                    url: 'getData.php',
                    type: 'POST',
                    data: {search_parami: search_parami},
                    success: function (data) {
                        $("#tbl_body").html(data);
                    }
                });
            });

            
            $(document).on("keyup", ".search_paramdd", function () {
                var search_paramdd = $(".search_paramdd").val();
                $.ajax({
                    url: 'getData.php',
                    type: 'POST',
                    data: {search_paramdd: search_paramdd},
                    success: function (data) {
                        $("#tbl_body").html(data);
                    }
                });
            });
        </script> 

  </body>
</html>