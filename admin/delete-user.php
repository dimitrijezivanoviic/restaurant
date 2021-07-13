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
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $_SESSION['delete_user'] = "Uspešno ste obrisali korisnika!";
        header('location: users.php');
    }else{
        $_SESSION['delete_user_error'] = "Došlo je do greške, korisnik nije obrisan!";
        header('location: users.php');
    }

}else{
    header('location: login.php');
}
?>
