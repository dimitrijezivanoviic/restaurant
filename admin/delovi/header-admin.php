<?php include('config/constants.php'); ?>

<?php include('login-check.php'); ?>

<?php
 
 $username = $_SESSION['user'];
 $sql = "SELECT * FROM tbl_admin WHERE username = '$username' ";
 
 $res = mysqli_query($conn, $sql);
 
 $count = mysqli_num_rows($res);
 $rows_session = mysqli_fetch_assoc($res);
 $role = $rows_session['role'];
 $id_username = $rows_session['id'];
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Accusoft admin</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="css/style-admin.css">
</head>

<body>


    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="las la-hamburger"></span><span>Le Jardin</span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="index.php"><span class="las la-home"></span>
                        <span>Home</span></a>
                </li>
                <?php if ($role == 'admin'){ ?>
                <li>
                    <a href="users.php"><span class="las la-user"></span>
                        <span>Korisnici</span></a>
                </li>
                <?php } ?>
                <?php if ($role == 'admin'){ ?>       
                <li>
                    <a href="food.php"><span class="las la-utensils"></span>
                        <span>Menu</span></a>
                </li>
                <?php } ?>
                <?php if ($role == 'admin'){ ?>
                <li>
                    <a href="category.php"><span class="las la-shopping-bag"></span>
                        <span>Kategorije</span></a>
                </li>
                <?php } ?>
                <?php if ($role == 'admin' || $role == 'kuvar' || $role == 'dostavljac'){ ?>
                <li>
                    <a href="sve-porudzbine.php"><span class="las la-tasks"></span>
                        <span>Sve porudžbine</span></a>
                </li>
                <?php } ?>
                <?php if ($role == 'admin'){ ?>
                <li>
                    <a href="sastojci.php"><span class="las la-cookie-bite"></span>
                        <span>Sastojci</span></a>
                </li>
                <?php } ?>
                <?php if ($role == 'admin'){ ?>
                <li>
                    <a href="kuponi.php"><span class="las la-ticket-alt"></span>
                        <span>Kuponi</span></a>
                </li>
                <?php } ?>
                <?php if ($role == 'kuvar' || $role == 'admin'){ ?>
                <li>
                    <a href="porudzbine.php"><span class="las la-clipboard-list"></span>
                        <span>Porudžbine</span></a>
                </li>
                <?php } ?>
                <?php if ($role == 'dostavljac' || $role == 'admin'){ ?>
                <li>
                    <a href="dostave.php"><span class="las la-shipping-fast"></span>
                        <span>Dostave</span></a>
                </li>
                <?php } ?>
                <br><br>
                <li>
                    <a href="logout.php"><span class="las la-power-off"></span><span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="main-content">
        <header>
            <h2>
                <div class="header-title">
                    <label for="nav-toggle">
                        <span class="las la-bars"></span>
                    </label>
                </div>
            </h2>

            <div class="header-wrapper">
                <h3>Dashboard</h3>
            </div>

            <div class="logout-wrapper">
                <div class="logoutButton">
                   <!-- <a href="logout.php"><span class="las la-power-off"></span><h5>Logout</h5></a>  -->
                   <img src="images/user.png" alt="" heigh="50px" width="50px">
                   <br>
                   <?php echo $username; ?>
                </div>
            </div>
        </header>
