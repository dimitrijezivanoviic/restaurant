<?php

include('config/constants.php');
include('delovi/login-check.php');

$id=$_GET['id'];

$upit = $conn->prepare("SELECT * FROM orders WHERE id_order = '$id'");
$upit->execute();
$rezultat = $upit->get_result();
$red = $rezultat->fetch_assoc();

date_default_timezone_set('CET');
$start = date("Y/m/d h:i:s");
$ordered_time = date('Y/m/d h:i:s',strtotime('+30 minutes',strtotime($start)));

$status1 = $red['order_status'];

if($status1 == 'ordered')
{
$stmt = $conn->prepare("UPDATE orders SET order_status = 'priprema', time = '$ordered_time' WHERE id_order = '$id'");
$stmt->execute();

    if($stmt)
    {
        $_SESSION['status_priprema']="Uspešno ste počeli pripremanje porudžbine broj #" . $id . '.';
        header('location:'.'porudzbine.php');
    }

}else if($status1 == 'completed' || $status1 == 'canceled'){
    echo '<script>alert("Greska")</script>';
    header('location:'.'myaccount.php');
}


?>