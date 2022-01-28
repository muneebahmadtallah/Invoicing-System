 
 <?php
	
	// include database connection file

	include_once "dbConfig.php";

	// autocomplete textbox jquery ajax in PHP
	
	if (isset($_POST['uname'])) {



  		$output = "";
  		$user = $_POST['uname'];
  		$query = "SELECT * FROM users WHERE name LIKE '%$user%'";
  		
		  $result = mysqli_query($con, $query);

  		$output = '<ul class="list-unstyled">';	
		  
	
		  if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
  				$output .= '<li>'.ucwords($row['name']).'</li>'.'<hr>';
				  $output .= "<input type='hidden' name='user_id' value='".$row['id']."'>";
  			}
  		}else{
  			  $output .= '<li> User not Found</li>';
  		}
  		
	  	$output .= '</ul>';
	  	echo $output;
		 
	}


?>