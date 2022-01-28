 
 <?php
	
	// include database connection file

	include_once "dbConfig.php";

	// autocomplete textbox jquery ajax in PHP
	
	if (isset($_POST['pname'])) {

  		$output = "";
  		$product = $_POST['pname'];
  		$query = "SELECT * FROM products WHERE title LIKE '%$product%'";
  		$result = mysqli_query($con, $query);

  		$output = '<ul class="list-unstyled">';	
		  
	
		  if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
  				$output .= '<li>'.ucwords($row['title']).'</li>'.'<hr>';
				  $output .= "<input type='hidden' name='product_id[]' value='".$row['id']."'>";
  			}
  		}else{
  			  $output .= '<li> prodcut not Found</li>';
  		}
  		
	  	$output .= '</ul>';
	  	echo $output;
		 
	}


    
?>