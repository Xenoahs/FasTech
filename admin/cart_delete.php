<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$userid = $_POST['userid'];
		$cartid = $_POST['cartid'];
		
		$conn = $ftdb->open();

		try{
			$stmt = $conn->prepare("DELETE FROM cart WHERE id=:id");
			$stmt->execute(['id'=>$cartid]);

			$_SESSION['success'] = 'Product deleted from cart';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
		$ftdb->close();

		header('location: cart.php?user='.$userid);
	}

?>