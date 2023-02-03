<?php
	include 'includes/session.php';

	$output = '';

	$conn = $ftdb->open();

	$stmt = $conn->prepare("SELECT * FROM products");
	$stmt->execute();
	foreach($stmt as $row){
		$output .= "
			<option value='".$row['id']."' class='append_items'>".$row['product_name']."</option>
		";
	}

	$ftdb->close();
	echo json_encode($output);

?>