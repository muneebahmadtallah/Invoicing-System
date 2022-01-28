<?php
 require_once("dbConfig.php");

 //Setup an empty array.
$errors = array(); 

//If our form has been submitted.
if(isset($_POST['submit'])){

    //Get the values of our form fields.

    //ternary operator, which basically equates to:
// $variableName = (TRUE OR FALSE CONDITION) ? (IF TRUE, DO THIS) : (IF FALSE, DO THIS)

    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $contact = isset($_POST['contact']) ? $_POST['contact'] : null;
    $address = isset($_POST['address']) ? $_POST['address'] : null;

    //Check the name and make sure that it isn't a blank/empty string.
    if(strlen(trim($name)) === 0){
        //Blank string, add error to $errors array.
        $errors[] = "You must enter Customer's Name!";
    }
    //Check the quantity and make sure that it isn't a blank/empty string.
    if(strlen(trim($contact)) === 0){
     //Blank string, add error to $errors array.
     $errors[] = "You must enter Customer's Contact!";
 }
     //Check the quantity and make sure that it isn't a blank/empty string.
     if(strlen(trim($address)) === 0){
      //Blank string, add error to $errors array.
      $errors[] = "You must enter Customer's Address!";
  }

    //If our $errors array is empty, we can assume that everything went fine.
    if(empty($errors)){
        //Send email or insert data into database.
        $sql = "INSERT INTO `users`(`name`, `contact_number`, `address`) VALUES ('$name','$contact','$address')";

        if (mysqli_query($con, $sql)) {
          echo "New record created successfully";
          mysqli_close($con); // Close connection
          header("location:alluser.php"); // redirects to all records page
          exit;
        }
         else {
          echo "Error: " . $sql . "<br>" . mysqli_error($con);
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
  <h1 class="text-orange"> Add Users </h1><br><br><br>
  <?php 
if(!empty($errors)){ 
    echo '<h4 style="color:red">Error(s)!</h4>';
    foreach($errors as $errorMessage){
        echo  $errorMessage . '<br>';
    }
} 
?><br>
  <form action="" method="POST">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="name">
    </div>
    <div class="form-group col-md-6">
      <label for="contact_number">Contact Number</label>
      <input type="text" class="form-control" name="contact">
    </div>
  </div>
  <div class="form-group">
    <label for="ddress">Address</label>
    <input type="text" class="form-control" name="address">
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Save</button>
</form>

</div>

</div>


  </body>
</html>