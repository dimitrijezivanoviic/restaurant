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

    //Brisanje svih namirnica sa datom kategorijom zbog spoljnog kljuca
    $sql_delete_foreignkey = "DELETE FROM tbl_food WHERE categoryID=$id";
    $res_delete_foreignkey = mysqli_query($conn, $sql_delete_foreignkey);

   

    $sql = "DELETE FROM tbl_category WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $_SESSION['delete_category'] = "Uspešno ste obrisali kategoriju.";
        header('location: category.php');
    }else{
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later.</div>";
        header('location: food.php');
    }
}else{
    header('location: login.php');
}
?>