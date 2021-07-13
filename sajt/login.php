<?php include('delovi/header-index.php'); ?>

<body>
    <section class="sec-padding login-background">
        <div class="container-account  login-page">
            <h2>Drago nam je što te vidimo!</h2>
            <div class="form-container">
                <?php 
                    if(isset($_SESSION['succes_registration']))
                    {?>
                        <div class="row succes_message registration_message" >
                        <i class="las la-check-circle"></i>
                            <?php
                            echo $_SESSION['succes_registration'];
                            unset($_SESSION['succes_registration']);
                            ?>
                        </div>
                        <?php
                    }

                    if(isset($_SESSION['error_registration']))
                    {?>
                        <div class="row error_message registration_message">
                            <?php
                            echo $_SESSION['error_registration'];
                            unset($_SESSION['error_registration']);
                            ?>
                        </div>
                        <?php
                    }

                    if(isset($_SESSION['empty_registration']))
                    {?>
                        <div class="row error_message registration_message">
                            <?php
                            echo $_SESSION['empty_registration'];
                            unset($_SESSION['empty_registration']);
                            ?>
                        </div>
                        <?php
                    }

                    if(isset($_SESSION['existing_registration']))
                    {?>
                        <div class="row error_message registration_message">
                            <?php
                            echo $_SESSION['existing_registration'];
                            unset($_SESSION['existing_registration']);
                            ?>
                        </div>
                        <?php
                    }

                    if(isset($_SESSION['login_error_username']))
                    {?>
                        <div class="row error_message registration_message">
                            <?php
                            echo $_SESSION['login_error_username'];
                            unset($_SESSION['login_error_username']);
                            ?>
                        </div>
                        <?php
                    }

                    if(isset($_SESSION['login_error_password']))
                    {?>
                        <div class="row error_message registration_message">
                            <?php
                            echo $_SESSION['login_error_password'];
                            unset($_SESSION['login_error_password']);
                            ?>
                        </div>
                        <?php
                    }

                    if(isset($_SESSION['empty_login']))
                    {?>
                        <div class="row error_message registration_message">
                            <?php
                            echo $_SESSION['empty_login'];
                            unset($_SESSION['empty_login']);
                            ?>
                        </div>
                        <?php
                    }
                    
                ?>
                <div class="form-btn">
                    <span onclick="login()">Prijavi se</span>
                    <span onclick="register()">Registracija</span>
                    <hr id="Indicator">
                </div>
                <div class="social-links">
                        <a href="https://www.facebook.com"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.twitter.com"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.linkedin.com"><i class="fab fa-linkedin-in"></i></a>
                </div>

                <form action="" class="login_register" id="LoginForm" method="POST"> 
                    <div class="input_field">
                        <i class="las la-user"></i>
                        <input type="text" name="username" placeholder="Username">
                    </div>
                    <div class="input_field">
                        <i class="las la-lock"></i>
                        <input type="password" name="password" placeholder="Lozinka">
                    </div>
                    <button type="submit" class="btn" name="login">Login</button>
                </form>
                
                <form action="" class="login_register" id="RegisterForm" method="POST">
                    <div class="input_field" id="input_field">
                        <i class="las la-user"></i>
                        <input type="text" name="name_reg" placeholder="Ime">
                    </div>
                    <div class="input_field" id="input_field">
                        <i class="las la-user"></i>
                        <input type="text" name="username_reg" placeholder="Username">
                    </div>
                    <div class="input_field" id="input_field">
                        <i class="las la-envelope"></i>
                        <input type="email" name="email_reg" id="email_reg" placeholder="E-mail">
                    </div>
                    <div class="input_field" id="input_field">
                        <i class="las la-lock"></i>
                        <input type="password" name="password_reg"placeholder="Lozinka">
                    </div>
                    <button type="submit" class="btn" name="register">Register</button>
                </form>

                <?php 
                    if(isset($_POST['register']))
                    {
                        $username_reg = $_POST['username_reg'];
                        $email_reg = $_POST['email_reg'];
                        $password_reg = md5($_POST['password_reg']);
                        $name_reg = $_POST['name_reg'];
                        
                        if($username_reg!='' && $email_reg!='' && $_POST['password_reg']!='' && $name_reg!='')
                        {
                            $sql_usercheck = "SELECT * FROM tbl_admin WHERE username='$username_reg'";
                            $res_usercheck = mysqli_query($conn, $sql_usercheck);

                            if($res_usercheck==TRUE){
                                $count_usercheck = mysqli_num_rows($res_usercheck); 
                                if($count_usercheck>0)
                                {
                                    $_SESSION['existing_registration'] = "Već imamo korisnika sa ovim usernameom!"
                                    ?>
                                    <script> window.location.href='login.php';</script>
                                    <?php
                                }else{
                                    $stmt = $conn->prepare("INSERT INTO tbl_admin SET full_name = '$name_reg', username = '$username_reg', email = '$email_reg', password = '$password_reg', role = 'korisnik', status = 'active'");
                                    $stmt->execute();

                                    if($stmt)
                                    {   
                                        $_SESSION['succes_registration'] = " Uspesno ste se registrovali!"
                                        ?>
                                            <script>window.location.href='login.php';</script>
                                        <?php
                                    }else{
                                        $_SESSION['error_registration'] = "Doslo je do greske!"
                                        ?>
                                        <script> window.location.href='login.php';</script>
                                        <?php
                                    }
                                }
                            }
                        }else{
                                $_SESSION['empty_registration'] = "Morate popuniti sva polja!"
                                ?>
                                <script> window.location.href='login.php';</script>
                                <?php
                            }
                    }
                ?>
            </div>
        </div>
    </section>
<?php include('delovi/footer.php'); ?>
    <script type="text/javascript" src="js/script.js"></script>
    <script>
        // Pomeranje indicatora na klik
        var LoginForm = document.getElementById("LoginForm");
        var RegisterForm = document.getElementById("RegisterForm");
        var Indicator = document.getElementById("Indicator");

        function register(){
            RegisterForm.style.transform="translateX(0px)";
            LoginForm.style.transform="translateX(0px)";
            Indicator.style.transform="translateX(100px)";
        }

        function login(){
            RegisterForm.style.transform="translateX(350px)";
            LoginForm.style.transform="translateX(350px)";
            Indicator.style.transform="translateX(-12px)";
        }
    </script>
</body>
</html>

<?php 
    // Logovanje
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        if($username !='' && $password !='')
        {
            $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password' ";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $rows_session = mysqli_fetch_assoc($res);
            
            $_SESSION['role'] = $rows_session['role'];

            if($count == 1){
                $_SESSION['user'] = $username;
                ?>
                    <script>window.location.href="index.php";</script>
                <?php
            }else{

                $sql_loginusername = "SELECT * FROM tbl_admin WHERE username = '$username'";
                $res_loginusername = mysqli_query($conn, $sql_loginusername);
                $count_loginusername = mysqli_num_rows($res_loginusername);
                $rows__loginusername = mysqli_fetch_assoc($res_loginusername);

                $password_loginusername= $rows_loginusername['password'];

                if($count_loginusername<1)
                {
                    $_SESSION['login_error_username'] = "Username je nevažeći."
                    ?>
                        <script>window.location.href="login.php";</script>
                    <?php
                }else if($password != $password_loginusername)
                {
                    $_SESSION['login_error_password'] = "Password je neispravan."
                    ?>
                        <script>window.location.href="login.php";</script>
                    <?php
                }
            }
        }else{
            $_SESSION['empty_login'] = "Morate popuniti sva polja!"
            ?>
            <script> window.location.href='login.php';</script>
            <?php
        }
    }
?>



    



