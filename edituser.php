
<?php
 require_once("dbConfig.php");

 $id = $_GET['id']; // get id through query string

 $qry = mysqli_query($con,"select * from users where id='$id'"); // select query

 $data = mysqli_fetch_array($qry); // fetch data
 
 if(isset($_POST['update'])) // when click on Update button
 {
    $name = $_POST['name'];
  $contact = $_POST['contact'];
  $address = $_POST['address'];
     
     $edit = mysqli_query($con,"update users set name='$name', contact_number='$contact', address='$address' where id='$id'");
     
     if($edit)
     {
         mysqli_close($con); // Close connection
         header("location:alluser.php"); // redirects to all records page
         exit;
     }
     else
     {
         echo mysqli_error($con); 
     }    	
 }
 

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>A.A. TRADERS</title>
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
  <h1 class="text-orange"> Update Users </h1><br><br><br>
  <form action="" method="POST">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="name" value="<?php echo $data['name'] ?>" Required>
    </div>
    <div class="form-group col-md-6">
      <label for="contact_number">Contact Number</label>
      <input type="text" class="form-control" name="contact"  value="<?php echo $data['contact_number'] ?>" Required>
    </div>
  </div>
  <div class="form-group">
    <label for="ddress">Address</label>
    <input type="text" class="form-control" name="address"  value="<?php echo $data['address'] ?>" Required>
  </div>
  <button type="submit" name="update" class="btn btn-primary">Update</button>
</form>

</div>

</div>



     

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>