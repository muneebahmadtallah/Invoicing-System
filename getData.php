<?php
require_once("dbConfig.php");

if (isset($_POST['search_param'])) {
    $search_param = mysqli_real_escape_string($con, $_POST['search_param']);
    $query = mysqli_query($con, "SELECT invoices.id, invoices.invoice_no, invoices.date, invoices.GrossTotal, invoices.ExtraBonus, invoices.NetTotal, users.name
FROM invoices
INNER JOIN users ON invoices.user_id = users.id where users.name like '%$search_param%' order by invoices.id desc");

    // $query = mysqli_query($con, "SELECT * FROM users where name like '%$search_param%' or email like '%$search_param%' or username like '%$search_param%' or mobile like '%$search_param%' order by id limit 20");
    $output = '';
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_array($query)) {
            $output .= '<tr>
    <td>' . $row['invoice_no'] . '</td>
    <td>' . $row['name'] . '</td>
    <td>' . $row['date'] . '</td>
    <td>' . $row['GrossTotal'] . '</td>
    <td>' . $row['ExtraBonus'] . '</td>
    <td>' . $row['NetTotal'] . '</td>
    <td><button class="btn btn-secondary"><a class="text-white" href="editinvoice.php?id=' . $row['id'] . ' ">Edit</a></button></td>
    <td><button class="btn btn-primary"><a class="text-white" href="new.php?id=' . $row['id'] .' ">Details</a></button></td>
    <td><button class="btn btn-danger"><a class="text-white" href="deleteinvoice.php?id=' . $row['id'] . ' "  onclick="return checkDelete()">Delete</a></button></td>
  </tr>';
        }
    } else {
        $output = '
  <tr>
    <td colspan="4"> No result found. </td>   
  </tr>';
    }
    echo $output;
}

if (isset($_POST['search_parami'])) {
  $search_parami = mysqli_real_escape_string($con, $_POST['search_parami']);
  $query = mysqli_query($con, "SELECT invoices.id, invoices.invoice_no, invoices.date, invoices.GrossTotal, invoices.ExtraBonus, 
  invoices.NetTotal, users.name
FROM invoices
INNER JOIN users ON invoices.user_id = users.id where invoices.invoice_no like '%$search_parami%' order by invoices.id desc");

  // $query = mysqli_query($con, "SELECT * FROM users where name like '%$search_param%' or email like '%$search_param%' or username like '%$search_param%' or mobile like '%$search_param%' order by id limit 20");
  $output = '';
  if (mysqli_num_rows($query) > 0) {
      while ($row = mysqli_fetch_array($query)) {
          $output .= '<tr>
  <td>' . $row['invoice_no'] . '</td>
  <td>' . $row['name'] . '</td>
  <td>' . $row['date'] . '</td>
  <td>' . $row['GrossTotal'] . '</td>
  <td>' . $row['ExtraBonus'] . '</td>
  <td>' . $row['NetTotal'] . '</td>
  <td><button class="btn btn-secondary"><a class="text-white" href="editinvoice.php?id=' . $row['id'] . ' ">Edit</a></button></td>
  <td><button class="btn btn-primary"><a class="text-white" href="new.php?id=' . $row['id'] .' ">Details</a></button></td>
  <td><button class="btn btn-danger"><a class="text-white" href="deleteinvoice.php?id=' . $row['id'] . ' " onclick="return checkDelete()">Delete</a></button></td>
</tr>';
      }
  } else {
      $output = '
<tr>
  <td colspan="4"> No result found. </td>   
</tr>';
  }
  echo $output;
}

if (isset($_POST['search_paramdd'])) {
  $search_paramdd = mysqli_real_escape_string($con, $_POST['search_paramdd']);
  $query = mysqli_query($con, "SELECT invoices.id, invoices.invoice_no, invoices.date, invoices.GrossTotal, invoices.ExtraBonus, 
  invoices.NetTotal, users.name
FROM invoices
INNER JOIN users ON invoices.user_id = users.id where invoices.date like '%$search_paramdd%' order by invoices.id desc");

  // $query = mysqli_query($con, "SELECT * FROM users where name like '%$search_param%' or email like '%$search_param%' or username like '%$search_param%' or mobile like '%$search_param%' order by id limit 20");
  $output = '';
  if (mysqli_num_rows($query) > 0) {
      while ($row = mysqli_fetch_array($query)) {
          $output .= '<tr>
  <td>' . $row['invoice_no'] . '</td>
  <td>' . $row['name'] . '</td>
  <td>' . $row['date'] . '</td>
  <td>' . $row['GrossTotal'] . '</td>
  <td>' . $row['ExtraBonus'] . '</td>
  <td>' . $row['NetTotal'] . '</td>
  <td><button class="btn btn-secondary"><a class="text-white" href="editinvoice.php?id=' . $row['id'] . ' ">Edit</a></button></td>
  <td><button class="btn btn-primary"><a class="text-white" href="new.php?id=' . $row['id'] .' ">Details</a></button></td>
  <td><button class="btn btn-danger"><a class="text-white" href="deleteinvoice.php?id=' . $row['id'] . ' " onclick="return checkDelete()">Delete</a></button></td>
</tr>';
      }
  } else {
      $output = '
<tr>
  <td colspan="4"> No result found. </td>   
</tr>';
  }
  echo $output;
}



////////////////////////////////////////////////////////////////
if (isset($_POST['search_paramm'])) {
  $search_paramm = mysqli_real_escape_string($con, $_POST['search_paramm']);
  $query2 = mysqli_query($con, "SELECT invoice_products.id, invoice_products.ItemPrice, invoice_products.PercentPrice, invoice_products.Quantity, invoice_products.SubTotal,
  users.name, products.title, invoices.date, invoices.invoice_no
  FROM invoice_products
  INNER JOIN users ON invoice_products.user_id = users.id
  INNER JOIN products ON invoice_products.product_id = products.id  
  INNER JOIN invoices ON invoice_products.invoice_id = invoices.id
   where products.title like '%$search_paramm%' 
   order by invoice_products.id desc");

  $output = '';
  if (mysqli_num_rows($query2) > 0) {
      while ($row = mysqli_fetch_array($query2)) {
          $output .= '<tr>
  <td>' . $row['name'] . '</td>
  <td>' . $row['invoice_no'] . '</td>
  <td>' . $row['title'] . '</td>
  <td>' . $row['ItemPrice'] . '</td>
  <td>' . $row['PercentPrice'] . '</td>
  <td>' . $row['Quantity'] . '</td>
  <td>' . $row['SubTotal'] . '</td>
  <td>' . $row['date'] . '</td>
</tr>';
      }
  } else {
      $output = '
<tr>
  <td colspan="4"> No result found. </td>   
</tr>';
  }
  echo $output;
}




if (isset($_POST['search_paramu'])) {
  $search_paramu = mysqli_real_escape_string($con, $_POST['search_paramu']);
  $query2 = mysqli_query($con, "SELECT invoice_products.id, invoice_products.ItemPrice, invoice_products.PercentPrice, invoice_products.Quantity, invoice_products.SubTotal,
  users.name, products.title, invoices.date, invoices.invoice_no
  FROM invoice_products
  INNER JOIN users ON invoice_products.user_id = users.id
  INNER JOIN products ON invoice_products.product_id = products.id  
  INNER JOIN invoices ON invoice_products.invoice_id = invoices.id
   where users.name like '%$search_paramu%' 
   order by invoice_products.id desc");

  $output = '';
  if (mysqli_num_rows($query2) > 0) {
      while ($row = mysqli_fetch_array($query2)) {
          $output .= '<tr>
  <td>' . $row['name'] . '</td>
  <td>' . $row['invoice_no'] . '</td>
  <td>' . $row['title'] . '</td>
  <td>' . $row['ItemPrice'] . '</td>
  <td>' . $row['PercentPrice'] . '</td>
  <td>' . $row['Quantity'] . '</td>
  <td>' . $row['SubTotal'] . '</td>
  <td>' . $row['date'] . '</td>
</tr>';
      }
  } else {
      $output = '
<tr>
  <td colspan="4"> No result found. </td>   
</tr>';
  }
  echo $output;
}




if (isset($_POST['search_paramd'])) {
  $search_paramd = mysqli_real_escape_string($con, $_POST['search_paramd']);
  $query2 = mysqli_query($con, "SELECT invoice_products.id, invoice_products.ItemPrice, invoice_products.PercentPrice, invoice_products.Quantity, invoice_products.SubTotal,
  users.name, products.title, invoices.date, invoices.invoice_no
  FROM invoice_products
  INNER JOIN users ON invoice_products.user_id = users.id
  INNER JOIN products ON invoice_products.product_id = products.id  
  INNER JOIN invoices ON invoice_products.invoice_id = invoices.id
   where invoices.date like '%$search_paramd%' 
   order by invoice_products.id desc");

  $output = '';
  if (mysqli_num_rows($query2) > 0) {
      while ($row = mysqli_fetch_array($query2)) {
          $output .= '<tr>
  <td>' . $row['name'] . '</td>
  <td>' . $row['invoice_no'] . '</td>
  <td>' . $row['title'] . '</td>
  <td>' . $row['ItemPrice'] . '</td>
  <td>' . $row['PercentPrice'] . '</td>
  <td>' . $row['Quantity'] . '</td>
  <td>' . $row['SubTotal'] . '</td>
  <td>' . $row['date'] . '</td>
</tr>';
      }
  } else {
      $output = '
<tr>
  <td colspan="4"> No result found. </td>   
</tr>';
  }
  echo $output;
}

///////////////////////////////////////////


if (isset($_POST['search_product'])) {
  $count=0;
  $search_product = mysqli_real_escape_string($con, $_POST['search_product']);
  $query2 = mysqli_query($con, "SELECT * FROM products where title like '%$search_product%' 
   order by id desc");

  $output = '';
  if (mysqli_num_rows($query2) > 0) {
      while ($row = mysqli_fetch_array($query2)) {
        $count++;
          $output .= '<tr>
          <td>' . $count . '</td>
  <td>' . $row['title'] . '</td>
  <td>' . $row['quantity'] . '</td>
  <td><button class="btn btn-secondary"><a class="text-white" href="editproduct.php?id=' . $row['id'] . ' ">Edit</a></button></td>
  <td><button class="btn btn-danger"><a class="text-white" href="deleteproduct.php?id=' . $row['id'] . ' " onclick="return checkDelete()">Delete</a></button></td>

</tr>';
      }
  } else {
      $output = '
<tr>
  <td colspan="4"> No result found. </td>   
</tr>';
  }
  echo $output;
}


/////////////////////////////////



if (isset($_POST['search_cus'])) {
  $count=0;
  $search_cus = mysqli_real_escape_string($con, $_POST['search_cus']);
  $query2 = mysqli_query($con, "SELECT * FROM users where name like '%$search_cus%' 
   order by id desc");

  $output = '';
  if (mysqli_num_rows($query2) > 0) {
      while ($row = mysqli_fetch_array($query2)) {
        $count++;
          $output .= '<tr>
          <td>' . $count . '</td>
  <td>' . $row['name'] . '</td>
  <td>' . $row['contact_number'] . '</td>
  <td>' . $row['address'] . '</td>
  <td><button class="btn btn-secondary"><a class="text-white" href="edituser.php?id=' . $row['id'] . ' ">Edit</a></button></td>
  <td><button class="btn btn-danger"><a class="text-white" href="deleteuser.php?id=' . $row['id'] . ' " onclick="return checkDelete()">Delete</a></button></td>

</tr>';
      }
  } else {
      $output = '
<tr>
  <td colspan="4"> No result found. </td>   
</tr>';
  }
  echo $output;
}



?>


  <script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure to delete?');
}
</script>
