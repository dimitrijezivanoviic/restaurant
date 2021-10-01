<?php include('delovi/header-admin.php');
    $id=$_GET['id'];
    $sql = "SELECT * FROM sastojci WHERE id = '$id'";
    $res = mysqli_query($conn, $sql);

    if($res==TRUE){
        $count = mysqli_num_rows($res); 
        if($count>0){
            $rows=mysqli_fetch_assoc($res);
            $title=$rows['name'];
            $category=$rows['categoryID'];
            $image_name=$rows['image'];
            $active=$rows['status'];
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
                        <h5>Izmena sastojka</h5>
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
                        
                        if(isset($_SESSION['empty_update_sastojak']))
                        {?>
                            <div class="row error_message">
                                <?php
                                echo $_SESSION['empty_update_sastojak'];
                                unset($_SESSION['empty_update_sastojak']);
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
                            <input type="radio" name="status" value="active" <?php if($active == 'active'){ ?>checked<?php }?>> Aktivan
                            <input type="radio" name="status" value="inactive" <?php if($active == 'inactive'){ ?>checked<?php }?>> Neaktivan
                        </div>
                    </div>
                    <div class="row margin_bottom_10">
                        <div class="col-md-6 width_50">
                            <label for="">Naziv slike</label>
                            <br>
                            <input type="file" name="file" id="file">
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
                        <div class="col-md-6 width_50 image-preview" id="imagePreview">
                            <label for="">Slika</label>
                            <br>
                            <img src="" class="image-preview__image" alt="Image Preview" >
                            <img src="/img/<?php echo $image_name; ?>" id="slika_prikazana"  alt="">
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
                            $active_update = $_POST['status'];
                            $category_update = $_POST['kategorija'];

                            if($_FILES['file']['name'])
                            {
                                $file_name = $_FILES['file']['name'];
                            }else{
                                                
                                $file_name = $_POST['image_hidden'];
                            }
                            
                            if($title_update!='' && $active_update!='' && $file_name !='')
                            {

                                $stmt = $conn->prepare("UPDATE sastojci SET
                                name = '$title_update', image = '$file_name', status = '$active_update', categoryID = '$category_update' WHERE id = '$id'");
                                $stmt->execute();
        
                                if($stmt)
                                {   
                                    $_SESSION['succes_update_sastojak']="Uspešno ste ažurirali sastojak.";
                                    ?>
                                        <script>window.location.href='sastojci.php';</script>
                                    <?php
                                }else{
                                    ?>
                                        <script>window.location.href='sastojci.php';</script>
                                    <?php
                                }
                            }else{
                                    $_SESSION['empty_update_sastojak']="Moraju sva polja biti popunjena!";
                                    ?>
                                        <script>window.location.href='update-sastojak.php?id=<?php echo $id; ?>';</script>
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




