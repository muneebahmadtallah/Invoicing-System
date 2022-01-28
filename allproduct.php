
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
      
        <h1 class="text-orange">All Products
</h1><br>
<div class="form-row">
    <div class="form-group col-md-4">
      <label for="title">Search By product Name</label>
        <input type="text" class="form-control search_product"/>
    </div>
    <div class="form-group col-md-4">
      <label for="quantity" class="text-white">Create Invoice</label>
<a href="addproduct.php"><button class="form-control btn btn-primary text-white">Add Product</button></a>
    </div>
    <!-- <div class="form-group col-md-4">
        <input type="text" class="form-control search_product"/>
    </div> -->
</div>

<table class="table">
<thead class="thead-light" >  
<tr>
    <th>Sr.No.</th>
    <th>Title</th>
    <th>Remaining Qauntity</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>
</thead>
<tbody id="tbl_body">
<?php

require_once("dbConfig.php");

$count = 0;
$sql = "SELECT id, title , quantity FROM products order by id desc";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $count ++;
    ?>
    <tr>
    <td><?php echo $count; ?></td>
    <td><?php echo $row['title']; ?></td>
    <td><?php echo $row['quantity']; ?></td>    
    <td><button class="btn btn-secondary"><a class="text-white" href="editproduct.php?id=<?php echo $row['id']; ?>">Edit</a></button></td>
    <td><button class="btn btn-danger"><a class="text-white" href="deleteproduct.php?id=<?php echo $row['id']; ?>"  onclick="return confirm('Are you sure to Delete?')">Delete</a></button></td>
  </tr>	
    <!-- echo "id: " . $row["id"]. "Name: " . $row["name"]. "Contact Number: " . $row["contact_number"]. " Address: " . $row["address"]. "<br>"; -->
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

$(document).on("keyup", ".search_product", function () {
                var search_product = $(".search_product").val();
                $.ajax({
                    url: 'getData.php',
                    type: 'POST',
                    data: {search_product:search_product},
                    success: function (data) {
                        $("#tbl_body").html(data);
                    }
                });
            });
  </script>

  </body>
</html>