<?php

include('config/constants.php');
include('delovi/login-check.php');

$id=$_GET['id'];

$upit = $conn->prepare("SELECT * FROM orders WHERE id_order = '$id'");
$upit->execute();
$rezultat = $upit->get_result();
$red = $rezultat->fetch_assoc();

$status1 = $red['order_status'];
$start = date("Y/m/d H:i:s");

if($status1 == 'preuzeo dostavljac')
{
$stmt = $conn->prepare("UPDATE orders SET order_status = 'completed', time = '$start' WHERE id_order = '$id'");
$stmt->execute();

    if($stmt)
    {
        $_SESSION['completed_order']="Uspešno je dostavljena porudžbina broj #" . $id . ".";
        header('location:'.'dostave.php');
    }

}else if($status1 == 'completed' || $status1 == 'canceled'){
    echo '<script>alert("Greska")</script>';
    header('location:'.'myaccount.php');
}

?>