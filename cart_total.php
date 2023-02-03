<?php
include 'include/session.php';

if(isset($_SESSION['user'])){
    $conn = $ftdb->open();

    $stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products on products.id=cart.product_id WHERE user_id=:user_id");
    $stmt->execute(['user_id'=>$user['id']]);

    $total = 0;
    foreach($stmt as $row){
        $subtotal = $row['product_price'] * $row['quantity'];
        $total += $subtotal;
    }

    $ftdb->close();

    echo json_encode($total);
}
?>