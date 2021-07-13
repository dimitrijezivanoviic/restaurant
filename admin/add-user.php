<!-- SREDJENO SVE!!! -->
<?php include('delovi/header-admin.php');
?>
<?php
    if($role == 'admin'){ 
        if($status=='active'){
?>
    <main>
    <div class="row">
        <div class="row margin_bottom_10">
            <h3>Ubacivanje novog korisnika u bazu</h3>
        </div>
    </div>
    <div class="jedan">
        <?php
            // Ispisivanje poruka
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

            if(isset($_SESSION['exist_username']))
            {?>
                <div class="row error_message">
                    <?php
                    echo $_SESSION['exist_username'];
                    unset($_SESSION['exist_username']);
                    ?>
                </div>
                <?php
            }
        ?>
        <div class="row">
            <form action="" method="POST" class="forma">
                <div class="row margin_bottom_10">
                    <div class="col-md-6 width_50">
                        <label for="">Ime</label>
                        <br>
                        <input type="text" name="ime" placeholder="Unesite ime">
                    </div>
                    <div class="col-md-6">
                        <label for="">Role</label>
                        <br>
                        <input type="radio" name="role" value="admin"> Admin
                        <input type="radio" name="role" value="korisnik" checked> Korisnik
                        <input type="radio" name="role" value="admin"> Kuvar
                        <input type="radio" name="role" value="user"> Dostavljac
                    </div>
                </div>
                <div class="row margin_bottom_10">
                    <div class="col-md-6 width_50">
                        <label for="">E-mail</label>
                        <br>
                        <input type="email" name="email" placeholder="Unesite e-mail" >
                    </div>
                    <div class="col-md-6">
                        <label for="">Status</label>
                        <br>
                        <input type="radio" name="status" value="active" checked> Aktivan
                        <input type="radio" name="status" value="inactive"> Neaktivan
                    </div>
                </div>   
                <div class="row margin_bottom_10">
                    <div class="col-md-6 width_50">
                        <label for="">Username</label>
                        <br>
                        <input type="text" name="username" placeholder="Unesite username">
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
                        <input type="submit" value="Dodaj korisnika" name="add">
                    </div>
                </div>
            </form>
            <?php
                if(isset($_POST['add']))
                {
                    $ime1 = $_POST['ime'];
                    $username1 = $_POST['username'];
                    $email1=$_POST['email'];
                    $status1 = $_POST['status'];
                    $role1=$_POST['role'];
                    $pass = $_POST['password'];

                    // Napravljena jos jedna jer ako bih stavio md5 za $pass, ne bi prikazivao kao prazan string u if upitu ispod
                    $md5_pass = md5($pass);
                    
                    //provera da li vec imamo korisnika sa ovim username
                    $sql_check = "SELECT * FROM tbl_admin WHERE username = '$username1'";
                    $res_check = mysqli_query($conn, $sql_check);
                    if($res_check==TRUE){
                        $count_check = mysqli_num_rows($res_check); 
                        if($count_check>0){
                            $_SESSION['exist_username'] = "Vec imamo registrovanog korisnika sa ovim username-om.";
                            ?>
                                <script>window.location.href='add-user.php';</script>
                            <?php
                                                        
                        }else{
                            if($ime1!='' && $username1!='' && $email1!='' && $status1!='' && $role1!='' && $pass!='')
                                {
                                    $stmt = $conn->prepare("INSERT INTO tbl_admin SET
                                    full_name = '$ime1', username = '$username1', password = '$md5_pass',
                                    email = '$email1', status = '$status1', role = '$role1'");
                                    $stmt->execute();
                
                                    if($stmt)
                                    {   
                                        $_SESSION['succes_add']="Uspesno ste dodali korisnika.";
                                        ?>
                                            <script>window.location.href='admin.php';</script>
                                        <?php
                                    }else{
                                        ?>
                                            <script>window.location.href='admin.php';</script>
                                        <?php
                                    }
                                }else{
                                    $_SESSION['update_greska'] = "Morate popuniti sva polja.";
                                    ?>
                                        <script>window.location.href='add-user.php';</script>
                                    <?php
                                }
                        }
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




