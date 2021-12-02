<?php include('delovi/header.php'); ?>
<?php

if($role == 'admin' || $role == 'korisnik')
{
    if($status == 'active')
    {
?>
<section class="menu-section sec-padding myaccount-background" id="our-menu">
    <div class="container-account">
        <div class="row">
            <div class="section-title">
                <h3>Moj nalog</h3>
            </div>
        </div>
        <div class="row">
            <div id="message"></div>
            <div class="menu-tabs user_kartice">
                <button type="button" class="menu-tabs-item inline_menu active" data-target="#podaci">Moji podaci</button>
                <button type="button" class="menu-tabs-item inline_menu" data-target="#narudzbine">Narudžbine</button>
                <button type="button" class="menu-tabs-item inline_menu" data-target="#clanstvo">Članstvo</button>
            </div>
        </div>

        <!-- Podaci pocetak -->
        <div class="row account-tab-content active" id="podaci">
            <div class="jedan">
                <div class="information-user">
                    <img src="img/user.png" alt="" height="50px" width="50px">
                    <br>
                    <h4>Zdravo, <?php echo $full_name ?>!</h4>
                </div>
            </div>
            <div class="jedan">
                <?php 
                    if(isset($_SESSION['error_update_profile']))
                    {?>
                        <div class="row error_message account_message">
                            <?php
                            echo $_SESSION['error_update_profile'];
                            unset($_SESSION['error_update_profile']);
                            ?>
                        </div>
                        <?php
                    }

                    if(isset($_SESSION['success_update_profile']))
                    {?>
                        <div class="row succes_message account_message">
                            <?php
                            echo $_SESSION['success_update_profile'];
                            unset($_SESSION['success_update_profile']);
                            ?>
                        </div>
                        <?php
                    }

                    if(isset($_SESSION['empty_update_profile']))
                    {?>
                        <div class="row error_message account_message">
                            <?php
                            echo $_SESSION['empty_update_profile'];
                            unset($_SESSION['empty_update_profile']);
                            ?>
                        </div>
                        <?php
                    }
                
                ?>
                <div class="row">
                    <form action="" method="POST" class="forma">
                        <div class="row">
                            <div class="title_podaci">
                                <h5><i class="far fa-address-card"></i> Vaši podaci</h5>
                                <small>Ovde možete izmeniti neke od svojih podataka.</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Ime</label>
                                <br>
                                <input type="text" name="ime" value="<?php echo $full_name?>">
                            </div>
                            <div class="col-md-6">
                                <label for="">Username</label>
                                <br>
                                <input type="text" name="username" class="readonly_button" value="<?php echo $username?>" readonly="readonly">
                                <br>
                                <small>Username se ne moze izmeniti.</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 email_col">
                                <label for="">E-mail</label>
                                <br>
                                <input type="email" name="email" value="<?php echo $email?>" >
                            </div>
                        </div>   
                        <div class="row">
                            <div class="col-md-6 div_btn margin_bottom_30">
                                <input type="submit" value="Ažuriraj" class="btn-update" name="update">
                            </div>
                        </div>
                    </form>
                </div>

                <?php
                    if(isset($_POST['update']))
                    {
                        $ime1 = $_POST['ime'];
                        $username1 = $_POST['username'];
                        $email1=$_POST['email'];
                        if($ime1 !='' && $email1 !='')
                        {   
                            $stmt = $conn->prepare("UPDATE tbl_admin SET
                            full_name = '$ime1', password = '$password',
                            email = '$email1' WHERE username = '$username1'");
                            $stmt->execute();

                            if($stmt)
                            {
                                $_SESSION['success_update_profile']="Uspešno ste ažurirali svoje podatke."
                                ?>
                                    <script>window.location.href='myaccount.php';</script>
                                <?php
                            }else{
                                $_SESSION['error_update_profile']="Došlo je do greške, pokušajte ponovo."
                                ?>
                                    <script>window.location.href='myaccount.php';</script>
                                <?php
                            }
                        }else{
                                $_SESSION['empty_update_profile']="Moraju sva polja biti popunjena."
                                ?>
                                    <script>window.location.href='myaccount.php';</script>
                                <?php
                            }
                    }
                ?>        
                <?php 
                
                    if(isset($_SESSION['error_password_profile']))
                    {?>
                        <div class="row error_message account_message">
                            <?php
                            echo $_SESSION['error_password_profile'];
                            unset($_SESSION['error_password_profile']);
                            ?>
                        </div>
                        <?php
                    }

                    if(isset($_SESSION['success_password_profile']))
                    {?>
                        <div class="row succes_message account_message">
                            <?php
                            echo $_SESSION['success_password_profile'];
                            unset($_SESSION['success_password_profile']);
                            ?>
                        </div>
                        <?php
                    }
                    
                    if(isset($_SESSION['empty_profile']))
                    {?>
                        <div class="row error_message account_message">
                            <?php
                            echo $_SESSION['empty_profile'];
                            unset($_SESSION['empty_profile']);
                            ?>
                        </div>
                        <?php
                    }

                    if(isset($_SESSION['error_newpassword']))
                    {?>
                        <div class="row error_message account_message">
                            <?php
                            echo $_SESSION['error_newpassword'];
                            unset($_SESSION['error_newpassword']);
                            ?>
                        </div>
                        <?php
                    }
                    
                ?>
                <div class="row">
                    <form action="" method="POST" class="forma">
                        <div class="row">
                            <div class="title_podaci">
                                <h5><i class="fas fa-unlock-alt"></i> Promena lozinke</h5>
                            </div>
                        </div>
                        <div class="row">
                             <div class="col-md-6 margin_bottom_10">
                                <label for="">Trenutna šifra</label>
                                <br>
                                <input type="password" name="current_password" placeholder="Unesite trenutnu sifru">
                             </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 margin_bottom_10">
                                <label for="">Nova šifra</label>
                                <br>
                                <input type="password" name="new_password1" placeholder="Unesite novu sifru">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 margin_bottom_10">
                                <label for="">Ponovi šifru</label>
                                <br>
                                <input type="password" name="new_password2" placeholder="Ponovite novu sifru">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 div_btn">
                                <input type="submit" value="Ažuriraj" class="btn-update" name="update_password">
                            </div>
                        </div>
                    </form>

                    <?php
                        $upit = $conn->prepare("SELECT password FROM tbl_admin WHERE username = '$username'");
                        $upit->execute();
                        $rezultat = $upit->get_result();
                        $red = $rezultat->fetch_assoc();

                        $old_password=$red['password'];

                        if(isset($_POST['update_password']))
                        {
                            $current_password = $_POST['current_password'];
                            $new_password1 = $_POST['new_password1'];
                            $new_password2=$_POST['new_password2'];

                            $current_password_decrypted = md5($current_password);
                            $new_password_decrypted = md5($new_password2);

                            if($current_password!='' && $new_password1!='' && $new_password2!='')
                            {
                                if($old_password == md5($current_password))
                                {
                                    if($new_password1==$new_password2)
                                    {
                                        $stmt1 = $conn->prepare("UPDATE tbl_admin SET
                                        password='$new_password_decrypted' WHERE username = '$username' AND password='$current_password_decrypted'");
                                        $stmt1->execute();
                                        if($stmt1)
                                        {
                                            $_SESSION['success_password_profile']="Uspešno ste ažurirali lozinku."
                                            ?>
                                                <script>window.location.href='myaccount.php';</script>
                                            <?php
                                        }

                                    }else{
                                            $_SESSION['error_newpassword']="Ponovljena lozinka se ne podudara sa novom."
                                            ?>
                                                <script>window.location.href='myaccount.php';</script>
                                            <?php
                                        }
                                }else{
                                        $_SESSION['error_password_profile']="Uneta trenutna lozinka je neispravna."
                                        ?>
                                            <script>window.location.href='myaccount.php';</script>
                                        <?php
                                    }
                            }else{
                                     $_SESSION['empty_profile']="Morate popuniti sva polja."
                                    ?>
                                    <script>window.location.href='myaccount.php';</script>
                                    <?php
                                }
                        }
                    ?>
                </div>
            </div>
        </div>
        <!-- Podaci kraj -->

        <!-- Narudzbine POCETAK -->
        <div class="row account-tab-content" id="narudzbine">
            <div class="row">
                <div class="naslov">
                    <h3>Narudžbine u toku</h3>
                    <small class="black_color">*Mogu se otkazati samo narudžbine koje su u statusu ORDERED</small>
                </div>
            </div>
            <div class="row row_tabela">
                <div class="table-grid" >
                    <div class="table-responsive">
                        <table width="100%" class="content-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Narudžbenica</th>
                                    <th>Cena</th>
                                    <th>Status</th>
                                    <th>Predviđena dostava</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                            $sql = "SELECT * FROM orders WHERE usernameID='$id_username' AND (order_status = 'ordered' || order_status = 'priprema' || order_status = 'ceka dostavu' || order_status = 'preuzeo dostavljac')";
                            $res = mysqli_query($conn, $sql);

                            if($res==TRUE){
                                $count = mysqli_num_rows($res); 
                                if($count>0){
                                    while($rows=mysqli_fetch_assoc($res))
                                    {
                                        $id=$rows['id_order'];
                                        $amount_paid=$rows['amount_paid'];
                                        $products=$rows['products'];
                                        $status=$rows['order_status'];
                                        $time_ordered=$rows['time'];
                                        $time_show = date("H:i",strtotime($time_ordered));
                                        ?>
                                            <!-- Ispisivanje vrednosti u tabelu -->
                                            <tr>
                                                <td data-label="ID"><?php echo $id; ?></td>
                                                <td data-label="Porudžbenica"><?php echo $products; ?></td>
                                                <td data-label="Ukupna cena"><?php echo $amount_paid; ?> RSD</td>
                                                <td data-label="Status"><div class="pending-status">
                                                        <i class="fas fa-clock"></i>
                                                        <?php echo $status; ?>
                                                    </div>
                                                </td>
                                                <td data-label="Okvirno vreme dostave">
                                                    <?php echo 'Oko ' . $time_show . 'h'; ?>
                                                </td>
                                                <td colspan="2" data-label="Akcija">
                                                    <?php
                                                    if($status=='ordered')
                                                    {
                                                    ?>
                                                        <a onclick="return confirm('Da li ste sigurni da želite da otkažete?');" href="cancel-order.php?id=<?php echo $id; ?>" class="btn-danger"><i class="fas fa-trash"></i> Otkaži porudžbinu</a>
                                                    <?php
                                                    } 
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }else{
                                    ?>
                                        <tr class="text-center">
                                            <td><h3><?php echo 'Nema aktivnih porudžbina!'; ?></h3></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="naslov">
                    <h3>Završene narudzbine</h3>
                    <small class="black_color">Narudžbine statusa Completed i Canceled.</small>
                </div>
            </div>
            <div class="row row_tabela">
                <div class="table-grid" >
                    <div class="table-responsive">
                        <table width="100%" class="content-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Narudžbenica</th>
                                    <th>Cena</th>
                                    <th>Završeno</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT * FROM orders WHERE usernameID='$id_username' AND (order_status='completed' || order_status='canceled')";
                            $res = mysqli_query($conn, $sql);
                            $i=0;
                            if($res==TRUE){
                                $count = mysqli_num_rows($res); 
                                if($count>0){
                                    while($rows=mysqli_fetch_assoc($res))
                                    {
                                        $id=$rows['id_order'];
                                        $amount_paid=$rows['amount_paid'];
                                        $products=$rows['products'];
                                        $status=$rows['order_status'];
                                        $membership=$rows['membership_order'];
                                        $time_ordered=$rows['time'];
                                        $time_show = date("d/m/Y H:i",strtotime($time_ordered));

                                        if($status!='canceled' && $membership != 'yes') $i++;
                                ?>
                                            <tr>
                                                <!-- Ispisivanje vrednosti u tabelu -->
                                                <td data-label="ID"><?php echo $id; ?></td>
                                                <td data-label="Porudžbenica"><?php echo $products; ?></td>
                                                <td data-label="Ukupno"><?php echo $amount_paid; ?> RSD</td>
                                                <td data-label="Vreme"><?php echo $time_show ?>h</td>
                                                <td data-label="Status">
                                                    <?php
                                                    if($status=='canceled')
                                                    {
                                                    ?>
                                                    <div class="canceled-status">
                                                        <i class="fas fa-ban"></i>
                                                        <?php
                                                            echo $status;
                                                        ?>
                                                    </div>
                                                    <?php
                                                    }else if($status=='completed'){
                                                        ?>
                                                        <div class="completed-status">
                                                            <i class="fas fa-check-circle"></i>
                                                        <?php
                                                            echo $status;
                                                        ?>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                    <?php
                                    }
                                }else{
                                    ?>
                                        <tr class="text-center">
                                            <td colspan="2"><h3><?php echo 'Niste do sada kupovali kod nas! :('; ?></h3></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Narudzbine KRAJ -->

        <!-- Clanstvo pocetak -->
        <div class="row account-tab-content" id="clanstvo">
            <?php
                $sql_amount = "SELECT * FROM orders WHERE usernameID='$id_username' AND membership_order = 'yes' AND order_status != 'canceled'";
                $res_amount = mysqli_query($conn, $sql_amount);
                $p = 0;
                $count_amount = mysqli_num_rows($res_amount); 
                if($count>0){
                    while($row_amount=mysqli_fetch_assoc($res_amount))
                    {
                         $p+=5;
                    }
                }

                $sql_clanstvo = "SELECT * FROM orders WHERE usernameID='$id_username'";
                $res_clanstvo = mysqli_query($conn, $sql_clanstvo);
                $total_price_clanstvo = 0;
                while($rows_clanstvo=mysqli_fetch_assoc($res_clanstvo))
                {
                    $total_price_clanstvo += $rows_clanstvo['amount_paid'];
                }
                $brojac = $i - $p;
                if($brojac >= 5)
                {
                    ?>
                        <div class="empty-container">
                    <?php
                        $sql_sastojci = "SELECT * FROM sastojci WHERE status = 'active' AND categoryID='9'";
                        $res_sastojci = mysqli_query($conn, $sql_sastojci);
                    ?>
                        <form action="" method="POST" class="forma">
                            <div class="row">
                                <div class="title">
                                    <h3>OSTVARILI STE <strong>GOLD</strong> MEMBERSHIP</h3>
                                    <small>Za svaku 5. kupovinu dobijate pravo da birate sami sadržaj pice koju dobijate besplatno!</small>
                                </div>
                            </div>
                            <div class="row">
                                <h5>Veličina pice: </h5>
                            </div>
                            <div class="row row_sastojci">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <img src="img/mala.png" alt="" height='70px' width='100px'>
                                        <input type="radio" name="radio-btn" value="Mala" checked> <label for="">Mala</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <img src="img/velika.png" alt="" height='70px' width='100px'>
                                        <input type="radio" name="radio-btn" value="Velika"> <label for="">Velika</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h5>Prilozi: </h5>
                            </div>
                            <div class="row row_sastojci">
                                <?php
                                while($rows_sastojci=mysqli_fetch_assoc($res_sastojci))
                                {
                                    $ime_sastojci = $rows_sastojci['name'];
                                    $image_sastojci = $rows_sastojci['image'];
                                ?>
                                    <div class="col-md-4 sastojci">
                                        <div class="form-group">
                                            <img src="img/<?php echo $image_sastojci?>" height='70px' width='100px' alt="">
                                            <input type="checkbox" name="prilog[]" value="<?php echo $ime_sastojci ?>"> <label for=""><?php echo $ime_sastojci ?></label>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Adresa*</h5>
                                        <input type="text" name="adresa" placeholder="Unesi adresu za isporuku" required><br>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Broj telefona*</h5>
                                        <input type="text" name="broj_telefona" placeholder="Unesi telefon za isporuku" required><br>
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4 flex_membership">
                                    <div class="form-group">
                                        <div class="cold-md-4">
                                            <h5>Ukupna cena: 0 RSD</h5>
                                        </div>
                                        <div class="cold-md-4 button-row">
                                            <input type="submit" class="btn-update" value="Naruči picu" name='submit'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                <?php
                    if(isset($_POST['submit']))
                    {
                        $adresa_narudzbine = $_POST['adresa'];
                        $broj_telefona = $_POST['broj_telefona'];

                        if($adresa_narudzbine != '' && $broj_telefona != '')
                        {
                            if (isset($_POST['radio-btn']))
                            {
                                $velicina = 'Veličina pice: ' . $_POST['radio-btn'] . '<br>';
                            }else{
                                $velicina = 'Veličina pice: bilo koja <br>';
                            }

                            if(isset($_POST['prilog']))
                            {
                                $prilog = $_POST['prilog'];
                                $prilozi = 'Prilozi: ';
                                foreach($prilog as $prilozi1)
                                {
                                    $prilozi = $prilozi . ' ' . $prilozi1. ',';
                                }
                            }else{
                                $prilozi = 'Prilozi: bilo koji';
                            }

                            $porudzbina = $velicina . $prilozi;
                            echo $porudzbina;
                            date_default_timezone_set('CET');
                            $start = date("Y/m/d H:i:s");
                            $ordered_time = date('Y/m/d H:i:s',strtotime('+45 minutes',strtotime($start)));

                            $upit_membership = $conn->prepare("INSERT INTO orders SET
                            email = '$email',
                            name = '$full_name',
                            usernameID = '$id_username',
                            phone = '$broj_telefona',
                            address = '$adresa_narudzbine',
                            pmode = '',
                            products = '$porudzbina',
                            amount_paid = '0',
                            order_status = 'ordered',
                            membership_order = 'yes',
                            time = '$ordered_time'
                            ");
                            $upit_membership->execute();
                            if($upit_membership)
                            {
                                ?>
                                <script>
                                    alert("Uspešno ste poručili membership pizzu!");
                                    window.location.href = "myaccount.php";
                                </script>
                                <?php
                            }
                                    
                                $i-=5;
                        }else{
                            echo 'greska';
                        }
                    }
            }else{ //if($brojac >=5) linija broj 480
                ?>
                    <div class="empty_container">
                        <div class="naslov">
                            <h3>Moje članstvo</h3>
                        </div> 
                        <div class="empty_main">
                            <i class="fas fa-dolly"></i>
                            <br>
                            <h2>Nemate <strong>GOLD</strong> nivo!</h2>
                            <small>Na svakih pet kompletiranih porudžbina možete sami birati sastojke pice koju dobijate BESPLATNO!</small>
                            <br>
                            <button class="btn-update"><a href="index.php#our-menu">Napravi porudžbinu</a></button>
                        </div>           
                    </div>
            <?php
                }
            ?>
        </div>
    <!-- Clanstvo KRAJ -->
    </div> 
</section>

<?php
    }else{
        ?>
            <script>
                alert("Vaš status je neaktivan. Kontaktirajte korisničku podršku u vezi ovoga.");
                window.location.replace("login.php");
            </script>
            <?php
    }
}else{
 header('location: login.php');
}
?>
<?php include('delovi/footer.php'); ?>

<script type="text/javascript">
  $(document).ready(function() {

    load_cart_item_number();

    load_cart_item_number();

    function load_cart_item_number() {
        $.ajax({
        url: 'action.php',
        method: 'get',
        data: {
            cartItem: "cart_item"
        },
        success: function(response) {
            $("#cart-item").html(response);
        }
        });
    }
  });
</script>
<script src="js/script1.js"></script>
</body>
</html>
