<?php include('config/constants.php'); ?>
<?php 
if(isset($_SESSION['user']))
{
    $username=$_SESSION['user'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dine Out - Restaurant</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style-sajt.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>

<!-- Loader pri ucitavanju stranica -->
<div class="page-loader">
    <img src="img/logo-jardin.png" alt="wqdwqd">
</div>

<!-- header start -->
<header class="header transparent" id="header_transparent">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="logo">
                <a href="index.php"><img src="img/transparent-logo.png" alt="logo" ></a>
            </div>
                
            <div class="user-cart">
                <a href="myaccount.php"><i class="las la-user"></i><small><?php if(isset($_SESSION['user'])) echo $username ?> </small> </a>
                <a href="cart.php"><i class="las la-shopping-cart"></i><span id="cart-item" class="badge-danger"></span></a>
            </div>
            
            <button type="button" class="nav-toggler">
                <span></span>
            </button>
            <nav class="nav">
                <ul>
                    <img src="img/logo-transparent.png" alt="" class="margin_bottom_30">
                    <li class="nav-item"><a href="index.php#home">Home</a></li>
                    <li class="nav-item"><a href="index.php#status">Kako poručiti?</a></li>
                    <li class="nav-item"><a href="index.php#about">O nama</a></li>
                    <li class="nav-item"><a href="index.php#our-menu">Jelovnik</a></li>
                    <li class="nav-item"><a href="index.php#team">Naš tim</a></li>
                    <br><br>
                    <?php 
                    //Provera da li ima ulogovanog korisnika
                    if(!isset($_SESSION['user']))
                    {
                    ?>
                        <li class="nav-item"><a href="login.php" id="login">Login</a></li>
                    <?php 
                    }
                    //Provera da li ima ulogovanog korisnika
                    if(isset($_SESSION['user']))
                    {
                    ?>
                        <li class="nav-item"><a href="logout.php" id="logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</header>