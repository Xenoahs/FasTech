<?php
	include 'includes/session.php';

	$output = '';

	$conn = $ftdb->open();

	$stmt = $conn->prepare("SELECT * FROM category");
	$stmt->execute();

	foreach($stmt as $row){
		$output .= "
			<option value='".$row['category_id']."' class='append_items'>".$row['category_name']."</option>
		";
	}

	$ftdb->close();
	echo json_encode($output);

?>