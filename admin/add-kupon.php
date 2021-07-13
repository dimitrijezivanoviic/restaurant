<?php include('delovi/header-admin.php');?>
<?php
    if($role == 'admin'){ 
        if($status=='active'){        
?>
    <main>
        <div class="row">
            <div class="row margin_bottom_10">
                <h3>Ubacivanje novog kupona</h3>
            </div>
        </div>
        <div class="jedan">
            <?php
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

                if(isset($_SESSION['exist_kupon']))
                {?>
                    <div class="row error_message">
                        <?php
                        echo $_SESSION['exist_kupon'];
                        unset($_SESSION['exist_kupon']);
                        ?>
                    </div>
                    <?php
                }
            ?>
            <div class="row">
                <form action="" method="POST" class="forma" enctype="multipart/form-data"> 
                    <div class="row margin_bottom_10">
                        <div class="col-md-6 width_50">
                            <label for="">Kod</label>
                            <br>
                            <input type="text" name="code" placeholder="Unesite kod">
                        </div>
                        <div class="col-md-6 width_50">
                            <label for="">Procenat</label>
                            <br>
                            <input type="text" name="percentage" placeholder="Unesite procenat">
                        </div>
                    </div>
                    <div class="row margin_bottom_10">
                        <div class="col-md-6 btn-update width_50">
                            <input type="submit" value="Dodaj kupon" name="add">
                        </div>
                    </div>
                </form>
                <?php
                    if(isset($_POST['add']))
                    {
                        $code = $_POST['code'];
                        $percentage = $_POST['percentage'];

                        if($code !='' && $percentage !='')
                        {
                            
                            //provera da li vec imamo ovu kategoriju
                            $sql_check = "SELECT * FROM coupons WHERE code = '$code'";
                            $res_check = mysqli_query($conn, $sql_check);
                            if($res_check==TRUE){
                                $count_check = mysqli_num_rows($res_check); 
                                if($count_check>0){
                                    $_SESSION['exist_kupon'] = "Već imamo ovaj kupon.";
                                    ?>
                                        <script>window.location.href='add-kupon.php';</script>
                                    <?php
                                                                
                                }else{
                                    $stmt = $conn->prepare("INSERT INTO coupons SET
                                    code = '$code',
                                    percentage = '$percentage'");
                                    $stmt->execute();
                        
                                    if($stmt)
                                    {   
                                        $_SESSION['succes_add_kupon']="Uspešno ste dodali kupon!";
                                        ?>
                                            <script>window.location.href='kuponi.php';</script>
                                        <?php
                                    }else{
                                        ?>
                                            <script>window.location.href='index.php';</script>
                                        <?php
                                    }
                                }
                            }

                        }else{
                            $_SESSION['update_greska'] = "Morate popuniti sva obavezna polja.";
                            ?>
                                <script>window.location.href='add-kupon.php';</script>
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




