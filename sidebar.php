<!doctype html>
<html lang="en">
  <head>
  	<title>Sidebar 02</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/custom.css">
		
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<!-- <div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div> -->
				<div class="p-4 pt-5">
		  		<h1><a href="index.html" class="logo"> <img height="140px" width="140px" src="images/logo.png" > </a></h1>
		
				  <ul class="list-unstyled components mb-5">
	          <li class="active">
	            <a href="index.php">Home</a>
	            
	          </li>	  

			  <ul class="list-unstyled components mb-5">
	          <li>
	            <a href="#invoiceSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Invoice</a>
	            <ul class="collapse list-unstyled" id="invoiceSubmenu">
                <li>
                    <a href="createinvoice.php">New Invoice</a>
                </li>
                <li>
                    <a href="allinvoices.php">All invoice</a>
                </li>
                <li>
                    <a href="allinvoicesproduct.php">All Products Invoices</a>
                </li>

	            </ul>
	          </li> 
			  
	        <ul class="list-unstyled components mb-5">
	          <li>
	            <a href="#userSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">User</a>
	            <ul class="collapse list-unstyled" id="userSubmenu">
                <li>
                    <a href="alluser.php">All User</a>
                </li>
                <li>
                    <a href="adduser.php">Add User</a>
                </li>
	            </ul>
	          </li>

	          <li>
              <a href="#productSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Product</a>
              <ul class="collapse list-unstyled" id="productSubmenu">
			  <li>
                    <a href="allproduct.php">All Product</a>
                </li>
                <li>
                    <a href="addproduct.php">Add Products</a>
                </li>
              </ul>
	          </li>
	          <li>
              <a href="#">Stats</a>
	          </li>
	        </ul>

	        <div class="mb-5">
						<h3 class="h6">Search</h3>
						<form action="#">
	            <div class="form-group d-flex">
	            	<div class="icon"><span class="icon-paper-plane"></span></div>
	              <input type="text" class="form-control" placeholder="Search">
	            </div>
	          </form>
					</div>

	        <div class="footer">
	        	<p>
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
						  </p>
	        </div>

	      </div>
    	</nav>

        <!-- Page Content  -->
      <!-- <div id="content" class="p-4 p-md-5 pt-5">

		</div> -->

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/jquery.js"></script>
  </body>
</html>