<?php
include('config/constants.php');
include('delovi/login-check.php');

if(isset($_SESSION['user'])){
    $username = $_SESSION['user'];
    $sql_role = "SELECT * FROM tbl_admin WHERE username = '$username' ";


    $res_role = mysqli_query($conn, $sql_role);

    $count = mysqli_num_rows($res);
    $rows_session = mysqli_fetch_assoc($res_role);
    $status = $rows_session['status'];
}
if($role=='admin' && $status == 'active')
{ 
    $id=$_GET['id'];
    $sql = "DELETE FROM coupons WHERE id_coupons=$id";
    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $_SESSION['delete_kupon'] = "Uspešno ste obrisali kupon.";
        header('location: kuponi.php');
    }else{
        header('location: kuponi.php');
    }
}else{
    header('location: login.php');
}
?>