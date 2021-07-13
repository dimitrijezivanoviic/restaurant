<?php
include('config/constants.php');
include('delovi/login-check.php');

if(isset($_SESSION['user'])){
    $username = $_SESSION['user'];
    $sql_role = "SELECT * FROM tbl_admin WHERE username = '$username' ";


    $res_role = mysqli_query($conn, $sql_role);

    $count = mysqli_num_rows($res);
    $rows_session = mysqli_fetch_assoc($res_role);
    $role = $rows_session['role'];
    $status = $rows_session['status'];
}
if($role=='admin' && $status == 'active')
{ 
    $id=$_GET['id'];

    $sql_name = "SELECT * FROM tbl_food WHERE id=$id";
    $res_name = mysqli_query($conn, $sql_name);
    $rows_name=mysqli_fetch_assoc($res_name);

    $title = $rows_name['title'];
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn, $sql);


    if($res_name==true)
    {
        $_SESSION['delete_food'] = "Obrisan/a je " . $title . " iz jelovnika!";
        header('location: food.php');
    }
}else{
    header('location: login.php');
}

?>