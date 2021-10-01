<?php include('delovi/header-admin.php');
    $id=$_GET['id'];
    $sql_update = "SELECT * FROM tbl_admin WHERE id = '$id'";
    $res_update = mysqli_query($conn, $sql_update);
    if($res_update==TRUE){
        $count_update = mysqli_num_rows($res_update); 
        if($count>0){
            $rows_update=mysqli_fetch_assoc($res_update);
            $full_name=$rows_update['full_name'];
            $username=$rows_update['username'];
            $password=$rows_update['password'];
            $status=$rows_update['status'];
            $role1=$rows_update['role'];
            $email=$rows_update['email'];
        }
    }
?>
<?php
    if($role == 'admin'){  
        if($role_status=='active'){
?>
    <main>
        <div class="jedan">
            <?php
                // Prikazivanje poruka
                if(isset($_SESSION['update_greska']))
                {?>
                    <div class="row error_message">
                        <?php
                        echo $_SESSION['update_greska'];
                        unset($_SESSION['update_greska']);
                        ?>
                    </div>
                    <?php
                }
            ?>
            <div class="row">
                <form action="" method="POST" class="forma">
                    <div class="row margin_bottom_10">
                            <h5>Izmena podataka za korisnika <?php echo $username; ?></h5>
                        </div>
                    </div>
                    <div class="row margin_bottom_10">
                        <div class="col-md-6 width_50">
                            <label for="">Ime</label>
                            <br>
                            <input type="text" name="ime" value="<?php echo $full_name?>">
                        </div>
                        <?php if($role1=='admin') {}else{ ?>
                        <div class="col-md-6">
                            <label for="">Role</label>
                            <br>
                            <input type="radio" name="role" value="korisnik" <?php if($role1 == 'korisnik'){ ?>checked<?php }?>> Korisnik
                            <input type="radio" name="role" value="kuvar" <?php if($role1 == 'kuvar'){ ?>checked<?php }?>> Kuvar
                            <input type="radio" name="role" value="dostavljac" <?php if($role1 == 'dostavljac'){ ?>checked<?php }?>> Dostavljač
                        </div>
                        <?php } ?>
                    </div>
                    <div class="row margin_bottom_10">
                        <div class="col-md-6 width_50">
                            <label for="">E-mail</label>
                            <br>
                            <input type="text" name="email" value="<?php echo $email?>" >
                        </div>
                        <?php if($role1=='admin') {}else{ ?>
                        <div class="col-md-6">
                            <label for="">Status</label>
                            <br>
                            <input type="radio" name="status" value="active" <?php if($status == 'active'){ ?>checked<?php }?>> Aktivan
                            <input type="radio" name="status" value="inactive" <?php if($status == 'inactive'){ ?>checked<?php }?>> Neaktivan
                        </div>
                        <?php } ?>
                    </div>   
                    <div class="row margin_bottom_10">
                        <div class="col-md-6 width_50">
                            <label for="">Username</label>
                            <br>
                            <input type="text" name="username" class="readonly_button" value="<?php echo $username?>" readonly>
                        </div>
                    </div>  
                    <div class="row margin_bottom_10">
                        <div class="col-md-6 width_50">
                            <label for="">Password</label>
                            <br>
                            <input type="password" name="password" placeholder="Ovde unosite novi password.">
                        </div>
                    </div>
                    <div class="row margin_bottom_10">
                        <div class="col-md-6 btn-update width_50">
                            <input type="submit" value="Azuriraj" name="update">
                        </div>
                    </div>
                </form>
                <?php
                    if(isset($_POST['update']))
                    {
                        $ime1 = $_POST['ime'];
                        $username1 = $_POST['username'];
                        $email1=$_POST['email'];
                        if($role1=='admin') {$status1='active';}else{
                        $status1 = $_POST['status'];
                        }
                        if($role1=='admin') {$role1='admin';}else{
                        $role1=$_POST['role'];
                        }
                        $pass = $_POST['password'];
                        if($pass == '')
                         {
                            $password1=$password;
                        }else{
                            $password1=md5($_POST['password']);
                        }

                        if($ime1 !='' && $username1 !='' && $email1 !='' && $role1 !='')
                        {
                             $stmt = $conn->prepare("UPDATE tbl_admin SET
                            full_name = '$ime1', password = '$password',
                            email = '$email1', status = '$status1', role = '$role1', password = '$password1' WHERE id = '$id'");
                            $stmt->execute();
    
                            if($stmt)
                            {   
                                $_SESSION['succes_update_user']="Uspešno ste ažurirali podatke.";
                                ?>
                                    <script>window.location.href='users.php';</script>
                                <?php
                            }else{
                                ?>
                                    <script>window.location.href='users.php';</script>
                                <?php
                            }
                        }else{
                            $_SESSION['update_greska'] = "Morate popuniti sva obavezna polja.";
                            ?>
                                 <script>window.location.href='update-user.php?id=<?php echo $id; ?>';</script>
                            <?php
                        }
                    }
                ?>        
            </div>
        </div>
    </main>
    </body>
    <?php 
    }else{
        $_SESSION['inactive_status'] = "Vaš nalog nije više aktivan. Kontaktirajte podršku za više informacija.";
        header('location: login.php');
    }     
}else{
        header('location: index.php');
    } ?>
</html>




