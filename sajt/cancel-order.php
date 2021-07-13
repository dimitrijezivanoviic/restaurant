<?php

include('config/constants.php');
$id=$_GET['id'];

$upit = $conn->prepare("SELECT * FROM orders WHERE id_order = '$id'");
$upit->execute();
$rezultat = $upit->get_result();
$red = $rezultat->fetch_assoc();

$status1 = $red['order_status'];

if($status1 == 'ordered')
{
    $stmt = $conn->prepare("UPDATE orders SET order_status = 'canceled' WHERE id_order = '$id'");
    $stmt->execute();

    if($stmt)
    {
        $_SESSION['update_status']="Uspesno ste otkazali Vašu porudzbinu.";
        header('location:'.'index.php');
    }

}


?>