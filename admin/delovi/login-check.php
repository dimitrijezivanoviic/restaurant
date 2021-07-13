<?php 

    if(!isset($_SESSION['user']))
    {

        $_SESSION['no-login-message'] = "<div class='error'>Please login to access Admin Panel. </div>";

        header('location:'.'login.php');


    }else if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' ";


        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);
        $rows_session = mysqli_fetch_assoc($res);
        $role = $rows_session['role'];
        $status = $rows_session['status'];
    }


?>