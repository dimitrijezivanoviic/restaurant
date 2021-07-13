<?php include('delovi/header-admin.php');?>
<?php
    if($role == 'admin'){ 
        if($status=='active'){        
?>
    <main>
        <div class="row">
            <div class="row margin_bottom_10">
                <h3>Ubacivanje nove kategorije</h3>
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

                if(isset($_SESSION['exist_title']))
                {?>
                    <div class="row error_message">
                        <?php
                        echo $_SESSION['exist_title'];
                        unset($_SESSION['exist_title']);
                        ?>
                    </div>
                    <?php
                }
            ?>
            <div class="row">
                <form action="" method="POST" class="forma" enctype="multipart/form-data"> 
                    <div class="row margin_bottom_10">
                        <div class="col-md-6 width_50">
                            <label for="">Naziv</label>
                            <br>
                            <input type="text" name="title" placeholder="Unesite naziv">
                        </div>
                    </div>
                    <div class="row margin_bottom_10">
                        <div class="col-md-6 btn-update width_50">
                            <input type="submit" value="Dodaj kategoriju" name="add">
                        </div>
                    </div>
                </form>
                <?php
                    if(isset($_POST['add']))
                    {
                        $title = $_POST['title'];

                        if($title !='')
                        {
                            //Uzimanje poslednje vrednosti id-a za kategoriju kako bismo za naredni uradili increment
                            $sql_brojac_kategorija = "SELECT id FROM tbl_category ORDER BY id DESC LIMIT 1";
                            $res_brojac_kategorija = mysqli_query($conn, $sql_brojac_kategorija);
                            if($res_brojac_kategorija == TRUE){
                                $count_brojac_kategorija = mysqli_num_rows($res_brojac_kategorija); 
                                if($count_brojac_kategorija>0){
                                    $rows_brojac_kategorija=mysqli_fetch_assoc($res_brojac_kategorija);
                                    $id_brojac_kategorija=$rows_brojac_kategorija['id'];
                                    $id_brojac = $id_brojac_kategorija + 1;
                                }else{
                                    $id_brojac = 1;
                                }
                            }
                            //provera da li vec imamo ovu kategoriju
                            $sql_check = "SELECT * FROM tbl_category WHERE title = '$title'";
                            $res_check = mysqli_query($conn, $sql_check);
                            if($res_check==TRUE){
                                $count_check = mysqli_num_rows($res_check); 
                                if($count_check>0){
                                    $_SESSION['exist_title'] = "Već imamo ovu kategoriju.";
                                    ?>
                                        <script>window.location.href='add-category.php';</script>
                                    <?php
                                                                
                                }else{
                                    $stmt = $conn->prepare("INSERT INTO tbl_category SET
                                    id = '$id_brojac',
                                    title = '$title'");
                                    $stmt->execute();
                        
                                    if($stmt)
                                    {   
                                        $_SESSION['succes_add_category']="Uspešno ste dodali kategoriju " . $title . ".";
                                        ?>
                                            <script>window.location.href='category.php';</script>
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
                                <script>window.location.href='add-category.php';</script>
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




