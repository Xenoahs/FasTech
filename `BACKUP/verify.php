<?php
include 'include/session.php';
$conn = $ftdb->open();

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    try{

        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM customers WHERE email = :email");
        $stmt->execute(['email'=>$email]);
        $row = $stmt->fetch();
        if($row['numrows'] > 0){
            if($row['status']){
                if(password_verify($password, $row['password'])){
                    if($row['type']){
                        $_SESSION['admin'] = $row['id'];
                    }
                    else{
                        $_SESSION['user'] = $row['customer_id'];
                    }
                }
                else{
                    $_SESSION['error'] = 'Incorrect Password';
                }
            }
            else{
                $_SESSION['error'] = 'Account not activated.';
            }
        }
        else{
            $_SESSION['error'] = 'Email not found';
        }
    }
    catch(PDOException $e){
        echo "There is some problem in connection: " . $e->getMessage();
    }

}
else{
    $_SESSION['error'] = 'Input login credentails first';
}

$ftdb->close();

header('location: login.php');

?>