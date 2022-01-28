
<!doctype html>
<html lang="en">
  <head>
  	<title>A.A.TRADERS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="css/bootstrap.min.css">
		
		<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">

		<?php
    include 'sidebar.php'	;
?>
        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">
      
        <h1 class="text-orange">All Users
</h1><br>

<div class="form-row">
    <div class="form-group col-md-4">
      <label for="title">Search By Customer Name</label>
        <input type="text" class="form-control search_cus"/>
    </div>
    <div class="form-group col-md-4">
      <label for="quantity" class="text-white">Create Invoice</label>
<a href="adduser.php"><button class="form-control btn btn-primary text-white">Add User</button></a>
    </div>
    <!-- <div class="form-group col-md-4">
        <input type="text" class="form-control search_cus"/>
    </div> -->
</div>

<table class="table">
  <thead class="thead-light">
  <tr>
    <th>Sr.No.</th>
    <th>Name</th>
    <th>Contact Number</th>
    <th>Address</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>
</thead>

<tbody id="tbl_body">
<?php

require_once("dbConfig.php");

$count = 0;
$sql = "SELECT id, name, contact_number, address FROM users order by id desc";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $count ++;
    ?>
    <tr>
    <td><?php echo $count; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['contact_number']; ?></td>    
    <td><?php echo $row['address']; ?></td>
    <td><button class="btn btn-secondary"><a class="text-white" href="edituser.php?id=<?php echo $row['id']; ?>">Edit</a></button></td>
    <td><button class="btn btn-danger"><a class="text-white" href="deleteuser.php?id=<?php echo $row['id']; ?>"  onclick="return confirm('Are you sure to Delete?')">Delete</a></button></td>
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

$(document).on("keyup", ".search_cus", function () {
                var search_cus = $(".search_cus").val();
                $.ajax({
                    url: 'getData.php',
                    type: 'POST',
                    data: {search_cus:search_cus},
                    success: function (data) {
                        $("#tbl_body").html(data);
                    }
                });
            });
  </script>
  </body>
</html>