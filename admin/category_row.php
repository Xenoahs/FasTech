<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		
		$conn = $ftdb->open();

		$stmt = $conn->prepare("SELECT * FROM category WHERE category_id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();
		
		$ftdb->close();

		echo json_encode($row);
	}
?>