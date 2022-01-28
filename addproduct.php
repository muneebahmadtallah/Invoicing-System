<?php
 require_once("dbConfig.php");


//Setup an empty array.
$errors = array(); 

//If our form has been submitted.
if(isset($_POST['submit'])){

    //Get the values of our form fields.

    //ternary operator, which basically equates to:
// $variableName = (TRUE OR FALSE CONDITION) ? (IF TRUE, DO THIS) : (IF FALSE, DO THIS)

    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;

    //Check the name and make sure that it isn't a blank/empty string.
    if(strlen(trim($title)) === 0){
        //Blank string, add error to $errors array.
        $errors[] = "You must enter product's name!";
    }
     //Check the quantity and make sure that it isn't a blank/empty string.
     if(strlen(trim($quantity)) === 0){
      //Blank string, add error to $errors array.
      $errors[] = "You must enter product's Quantity!";
  }

    //If our $errors array is empty, we can assume that everything went fine.
    if(empty($errors)){
        //Send email or insert data into database.
        $sql = "INSERT INTO `products`(`title`, `quantity`) VALUES ('$title','$quantity')";

if (mysqli_query($con, $sql)) {
  // echo "New record created successfully";
  mysqli_close($con); // Close connection
  header("location:allproduct.php"); // redirects to all records page
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
  <h1 class="text-orange"> Add Prodcuts </h1><br><br><br>
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
      <label for="title">Medicine Title</label>
      <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group col-md-6">
      <label for="quantity">Qauntity</label>
      <input type="text" class="form-control" name="quantity">
    </div>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Save</button>
</form>

</div>

</div>



     
</body>
</html>