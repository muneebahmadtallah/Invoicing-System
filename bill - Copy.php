<?php
 require_once("dbConfig.php");

 $id = $_GET['id']; // get id through query string

$slct= "SELECT invoices.invoice_no, invoices.user_id, invoices.date, invoices.GrossTotal, invoices.ExtraBonus, invoices.NetTotal, 
users.name,users.address
FROM invoices 
INNER JOIN users 
ON invoices.user_id = users.id 
WHERE invoices.id = '$id'";

  $result=mysqli_query($con, $slct);
  $data =mysqli_fetch_array($result);
///////////////////////////////////////////////////////////////////////////////////////////

$output = '
<table width="100%" cellpadding="5" cellspacing="0" style="margin-left: auto;
margin-right: auto;">

<tr>
<td colspan="2" align="center" style="font-size:18px"><h1> A.A.TRADERS</h1></td>
</tr>

<tr>
<td colspan="2">


<table width="100%" cellpadding="5">
<tr>
<td width="68%">

<b>RECEIVER (BILL TO)</b><br />
Name :<b> '.$data['name'].'</b><br />
Billing Address :<b> '.$data['address'].'</b><br />
</td>
<td width="32%">
Invoice No. :<b> '.$data['invoice_no'].'</b><br />
Invoice Date : <b>'.$data['date'].'</b><br />
</td>
</tr>
</table>

<hr>
<br>



<table width="100%" border="1" cellpadding="5" cellspacing="0">
<tr>
<th align="left">Sr No.</th>
<th align="left">Description</th>
<th align="left">Price</th>
<th align="left">Percent Price</th>
<th align="left">Quantity</th>
<th align="left">Sub Total</th>
</tr>';

 $count =0;
 $slct2 = "SELECT invoice_products.id, invoice_products.product_id, invoice_products.ItemPrice,
 invoice_products.PercentPrice, invoice_products.Quantity, invoice_products.SubTotal, products.title
 FROM invoice_products
 INNER JOIN products 
 ON products.id = invoice_products.product_id 
 WHERE invoice_products.invoice_id= '$id'";
 $result2=mysqli_query($con, $slct2);
 if(mysqli_num_rows($result2) > 0)
 {
  while($data2 = mysqli_fetch_assoc($result2)) {
    $count ++;
  
$output .= '
<tr>
<th align="left">'.$count.'</th>
<td align="left">'.$data2["title"].'</td>
<td align="left">'.$data2["ItemPrice"].'</td>
<td align="left">'.$data2["PercentPrice"].'</td>
<td align="left">'.$data2["Quantity"].'</td>
<td align="left">'.$data2["SubTotal"].'</td>
</tr>';  

  }}

$output .= '
<tr>
<td align="right" colspan="5"><b>Gross Total</b></td>
<td align="left">'.$data["GrossTotal"].'</td>
</tr>
<tr>
<td align="right" colspan="5"><b>Extra Bonus</b></td>
<td align="left">'.$data["ExtraBonus"].'</td>
</tr>
<tr>
<td align="right" colspan="5"><b>Net Total</b></td>
<td align="left"><b>'.$data["NetTotal"].'</b></td>
</tr>';
$output .= '
</table>
</td>
</tr>

</table>';  

//create pdf of invoice
$invoiceFileName = 'Invoice-'.$data['name'].'-'.$data['date'].'.pdf';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));

?>