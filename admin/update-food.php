<?php include('delovi/header-admin.php');
    $id=$_GET['id'];
    $sql = "SELECT * FROM tbl_food WHERE id = '$id'";
    $res = mysqli_query($conn, $sql);

    if($res==TRUE){
        $count = mysqli_num_rows($res); 
        if($count>0){
            $rows=mysqli_fetch_assoc($res);
            $title=$rows['title'];
            $description=$rows['description'];
            $category=$rows['categoryID'];
            $image_name=$rows['image_name'];
            $active=$rows['active'];
            $price=$rows['price'];
        }
    }
    $sql_category = "SELECT * FROM tbl_category";
    $res_category = mysqli_query($conn, $sql_category);
?>
<?php
    if($role == 'admin'){  
        if($status=='active'){
?>
        <main>
        <div class="jedan">
            <div class="row">
                <form action="" method="POST" class="forma" enctype="multipart/form-data">
                    <div class="row margin_bottom_10">
                        <h5>Izmena podataka za u jelovniku</h5>
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
                        
                        if(isset($_SESSION['empty_update_food']))
                        {?>
                            <div class="row error_message">
                                <?php
                                echo $_SESSION['empty_update_food'];
                                unset($_SESSION['empty_update_food']);
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                    <input type="hidden" name="image_hidden" value="<?php echo $image_name?>">
                    <div class="row margin_bottom_10">
                        <div class="col-md-6 width_50">
                            <label for="">Naziv</label>
                            <br>
                            <input type="text" name="title" value="<?php echo $title?>">
                        </div>
                        <div class="col-md-6">
                            <label for="">Aktivno</label>
                            <br>
                            <input type="radio" name="status" value="yes" <?php if($active == 'yes'){ ?>checked<?php }?>> Aktivan
                            <input type="radio" name="status" value="no" <?php if($active == 'no'){ ?>checked<?php }?>> Neaktivan
                        </div>
                    </div>
                    <div class="row margin_bottom_10">
                        <div class="col-md-6 width_50">
                            <label for="">Sastojci</label>
                            <br>
                            <input type="text" name="description" value="<?php echo $description?>">
                        </div>
                        <div class="col-md-6 width_50">
                            <label for="">Kategorija</label>
                            <br>
                            <select name="kategorija" id="">
                            <?php 
                                while($rows_category=mysqli_fetch_assoc($res_category))
                                {
                                    $category_id = $rows_category['id'];
                                    $category_name = $rows_category['title'];
                            ?>
                                    <option value="<?php echo $category_id; ?>" <?php if($category_id == $category){?> selected <?php } ?>><?php echo $category_id . ' - ' . $category_name; ?></option>
                                    <?php } ?>
                            </select>
                        </div>
                    </div>   
                    <div class="row margin_bottom_10">
                        <div class="col-md-6 width_50">
                            <label for="">Izaberi sliku</label>
                            <br>
                            <input type="file" name="file" id="file">
                        </div>
                        <div class="col-md-6 width_50">
                            <label for="">Cena</label>
                            <br>
                            <input type="text" name="price"  value="<?php echo $price?>">
                        </div>
                    </div>  
                    <div class="row margin_bottom_10">
                        <div class="col-md-6 width_50 image-preview" id="imagePreview">
                            <label for="">Slika</label>
                            <br>
                            <img src="" class="image-preview__image" alt="Image Preview" >
                            <img src="../img/<?php echo $image_name; ?>" id="slika_prikazana"  alt="">
                        </div>
                    </div>
                    <div class="row margin_bottom_10">
                        <div class="col-md-6 btn-update width_50">
                            <input type="submit" value="Ažuriraj" name="update">
                        </div>
                    </div>
                </form>
                    <?php
                        if(isset($_POST['update']))
                        {
                            $title_update = $_POST['title'];
                            $description_update = $_POST['description'];
                            $category_update = $_POST['kategorija'];
                            $active_update = $_POST['status'];
                            $price_update = $_POST['price'];

                            if($_FILES['file']['name'])
                            {
                                $file_name = $_FILES['file']['name'];
                            }else{
                                                
                                $file_name = $_POST['image_hidden'];
                            }
                            
                            if($title_update!='' && $description_update!='' && $active_update!='' && $price_update!='' )
                            {

                                $stmt = $conn->prepare("UPDATE tbl_food SET
                                title = '$title_update',
                                description = '$description_update',
                                price = '$price_update',
                                categoryID = '$category_update',
                                image_name = '$file_name',
                                active = '$active_update' WHERE id = '$id'");
                                $stmt->execute();
        
                                if($stmt)
                                {   
                                    $_SESSION['succes_update_food']="Uspešno ste ažurirali podatke.";
                                    ?>
                                        <script>window.location.href='food.php';</script>
                                    <?php
                                }else{
                                    ?>
                                        <script>window.location.href='food.php';</script>
                                    <?php
                                }
                            }else{
                                    $_SESSION['empty_update_food']="Moraju sva polja biti popunjena!";
                                    ?>
                                        <script>window.location.href='update-food.php?id=<?php echo $id; ?>';</script>
                                    <?php
                            }
                        }
                    ?>        
            </div>
        </div>
        </main>

        <script>
            //prikazivanje slike kada se uploaduje
            const inpFile = document.getElementById("file");
            const previewContainer = document.getElementById("imagePreview");
            const previewImage = previewContainer.querySelector(".image-preview__image");
            const slikaPrikazana = document.getElementById("slika_prikazana");

            inpFile.addEventListener("change", function() {
                const file = this.files[0];

                if (file)
                {
                    const reader = new FileReader();
                    
                    slikaPrikazana.style.display="none";
                    previewImage.style.display="block";

                    reader.addEventListener("load",function(){
                        previewImage.setAttribute("src", this.result);
                    });

                    reader.readAsDataURL(file);

                }else{
                    slikaPrikazana.style.display=null;
                    previewImage.style.display=null;
                    previewImage.setAttribute("src","");
                }
            });
        </script>
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




