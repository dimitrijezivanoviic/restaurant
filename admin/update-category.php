<?php include('delovi/header-admin.php');
    $id=$_GET['id'];
    $sql = "SELECT * FROM tbl_category WHERE id = '$id'";
    $res = mysqli_query($conn, $sql);

    if($res==TRUE){
        $count = mysqli_num_rows($res); 
        if($count>0){
            $rows=mysqli_fetch_assoc($res);
            $title=$rows['title'];
        }
    }

    if($role == 'admin'){  
        if($status=='active'){
?>
    <main>
        <div class="jedan">
            <div class="row">
                <form action="" method="POST" class="forma" enctype="multipart/form-data">
                    <div class="row margin_bottom_10">
                        <h5>Izmena podataka kategorije <?php echo $title; ?></h5>
                    </div>
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
                        
                        if(isset($_SESSION['empty_update_category']))
                        {?>
                            <div class="row error_message">
                                <?php
                                echo $_SESSION['empty_update_category'];
                                unset($_SESSION['empty_update_category']);
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                    </div>
                    <input type="hidden" name="image_hidden" value="<?php echo $image_name?>">
                    <div class="row margin_bottom_10">
                        <div class="col-md-6 width_50">
                            <label for="">Naziv</label>
                            <br>
                            <input type="text" name="title" value="<?php echo $title?>">
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
                            $title_update = $_POST['title'];

                            if($title_update!='')
                            {
                                $stmt = $conn->prepare("UPDATE tbl_category SET
                                title = '$title_update' WHERE id = '$id'");
                                $stmt->execute();
        
                                if($stmt)
                                {   
                                    $_SESSION['succes_update_category']="Uspešno ste ažurirali kategoriju " . $title;
                                    ?>
                                        <script>window.location.href='category.php';</script>
                                    <?php
                                }else{
                                    ?>
                                        <script>window.location.href='food.php';</script>
                                    <?php
                                }
                            }else{
                                    $_SESSION['empty_update_category']="Moraju sva polja biti popunjena!";
                                    ?>
                                            <script>window.location.href='update-category.php?id=<?php echo $id; ?>';</script>
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
    } 
?>
</html>




