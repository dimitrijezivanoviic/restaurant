<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style-admin.css">
  </head>
  <body>
  <section class="login-background" id="status">
    <div class="center">
      <h1>Admin panel</h1>
      <form method="post">
        <div class="txt_field">
          <input type="text" name="username" required>
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password" required>
          <span></span>
          <label>Password</label>
        </div>
        <input type="submit" name="login" value="Login">
        
      </form>
    </div>
</section>
  </body>
</html>
<?php 
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        if($username !='' && $password !='')
        {
            $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password' ";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            
            

            if($count == 1){
                $sql_session = "SELECT * FROM tbl_admin WHERE username = '$username' ";
                $res_session = mysqli_query($conn, $sql_session);
                $rows_session = mysqli_fetch_assoc($res_session);
                $role_session = $rows_session['role'];
                if($role_session=='admin' || $role_session=='kuvar' || $role_session=='dostavljac')
                {
                    $_SESSION['user'] = $username;
                    ?>
                        <script>
                            alert("Uspešno ste se ulogovali");
                            window.location.href="index.php";
                        </script>
                    <?php
                }else{
                    ?>
                        <script>
                            alert("Morate imati rolu admina, kuvara ili dostavljaca!");
                            window.location.href="../login.php";
                        </script>
                    <?php
                }
                
            }else{

                $sql_loginusername = "SELECT * FROM tbl_admin WHERE username = '$username'";
                $res_loginusername = mysqli_query($conn, $sql_loginusername);
                $count_loginusername = mysqli_num_rows($res_loginusername);
                

                if($count_loginusername<1)
                {
                    
                    ?>
                        <script>
                            alert("Username je nevažeći.");
                            window.location.href="login.php";
                        </script>
                    <?php
                }else 
                {
                    ?>
                        <script>
                            alert("Password je neispravan");
                            window.location.href="login.php";
                        </script>
                    <?php
                }
            }
        }else{
            
            ?>
                <script>
                    alert("Morate popuniti sva polja");
                    window.location.href='login.php';
                </script>
            <?php
        }
    }
?>
