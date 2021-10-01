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
$ordered_time = date('Y/m/d H:i:s',strtotime('+10 minutes',strtotime($start)));

if($status1 == 'ceka dostavu')
{
$stmt = $conn->prepare("UPDATE orders SET order_status = 'preuzeo dostavljac', time = '$ordered_time' WHERE id_order = '$id'");
$stmt->execute();

        if($stmt)
        {
            $_SESSION['status_za_dostavu']="Uspešno ste preuzeli pošiljku broj #" . $id . " za dostavu.";
            header('location:'.'dostave.php');
        }

}else if($status1 == 'completed' || $status1 == 'canceled'){
    header('location:'.'porudzbine.php');
}

?>