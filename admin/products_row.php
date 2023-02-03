<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		
		$conn = $ftdb->open();

		$stmt = $conn->prepare("SELECT *, products.id AS prodid, products.product_name AS prodname, category.category_name AS catname FROM products LEFT JOIN category ON category.category_id=products.category_id WHERE products.id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();
		
		$ftdb->close();

		echo json_encode($row);
	}
?>