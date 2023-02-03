<?php
include 'include/session.php';

$id = $_POST['id'];

$conn = $ftdb->open();

$output = array('list'=>'');

$stmt = $conn->prepare("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id LEFT JOIN sales ON sales.id=details.sales_id WHERE details.sales_id=:id");
$stmt->execute(['id'=>$id]);

$total = 0;
foreach($stmt as $row){
    $output['transaction'] = $row['pay_id'];
    $output['date'] = date('M d, Y', strtotime($row['sales_date']));
    $subtotal = $row['product_price']*$row['quantity'];
    $total += $subtotal;
    $output['list'] .= "
			<tr class='prepend_items'>
				<td>".$row['product_name']."</td>
				<td>&#8369; ".number_format($row['product_price'], 2)."</td>
				<td>".$row['quantity']."</td>
				<td>&#8369; ".number_format($subtotal, 2)."</td>
			</tr>
		";
}

$output['total'] = '<b>&#8369; '.number_format($total, 2).'<b>';
$ftdb->close();
echo json_encode($output);

?>