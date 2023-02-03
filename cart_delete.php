<?php
include 'include/session.php';

$conn = $ftdb->open();

$output = array('error'=>false);
$id = $_POST['id'];

if(isset($_SESSION['user'])){
    try{
        $stmt = $conn->prepare("DELETE FROM cart WHERE id=:id");
        $stmt->execute(['id'=>$id]);
        $output['message'] = 'Deleted';

    }
    catch(PDOException $e){
        $output['message'] = $e->getMessage();
    }
}
else{
    foreach($_SESSION['cart'] as $key => $row){
        if($row['productid'] == $id){
            unset($_SESSION['cart'][$key]);
            $output['message'] = 'Deleted';
        }
    }
}

$ftdb->close();
echo json_encode($output);

?>