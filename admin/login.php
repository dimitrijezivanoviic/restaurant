<?php include('config/constants.php'); ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="style1.css">
    </head>

    <body>

    <div class="login">
        <h1>Login</h1>

        <?php
        
            if(isset($_SESSION['inactive_status']))
            {?>
                <div class="row error_message">
                    <?php
                    echo $_SESSION['inactive_status'];
                    unset($_SESSION['inactive_status']);
                    ?>
                </div>
            <?php
            }
        
        ?>

        <br><br>
    <form action="" method="POST">


    Username: 
    <br>
    <input type="text" name="username" placeholder="Enter Username">
    <br>
    Password:
    <br>
    <input type="password" name="password" placeholder="Enter your password">

    <input type="submit" name="submit" value="Login">



    </form>

        <p>Created By <a href="www.dimitrije.com">Dica</a></p>
    </div>
        
    </body>
</html>

<?php 

if(isset($_POST['submit'])){


$username = $_POST['username'];
$password = md5($_POST['password']);


$sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password' ";


$res = mysqli_query($conn, $sql);

$count = mysqli_num_rows($res);
$rows_session = mysqli_fetch_assoc($res);
$_SESSION['role'] = $rows_session['role'];

if($count == 1){

$_SESSION['login'] = "<div class='success'>Login Successful.</div>";
$_SESSION['user'] = $username;

header('location:'.'index.php');



}else {

    $_SESSION['login'] = "<div class='error'>Login Failed.</div>";

    header('location:'.'login.php');



}

}




?>