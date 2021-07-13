<?php include('delovi/header-admin.php');
    $sql_category = "SELECT * FROM tbl_category";
    $res_category = mysqli_query($conn, $sql_category);

?>
<?php
    if($role == 'admin'){ 
        if($status=='active'){        
?>
        <main>
        <div class="row">
            <div class="row margin_bottom_10">
                <h3>Ubacivanje sastojaka u bazu</h3>
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
                <form action="" method="POST" class="forma" enctype="multipart/form-data"> 
                    <div class="row margin_bottom_10">
                        <div class="col-md-6 width_50">
                            <label for="">Naziv</label>
                            <br>
                            <input type="text" name="title" placeholder="Unesite naziv">
                        </div>
                        <div class="col-md-6">
                            <label for="">Status</label>
                            <br>
                            <input type="radio" name="status" value="active" checked> Aktivno
                            <input type="radio" name="status" value="inactive"> Neaktivno
                        </div>
                    </div>
                   
                    <div class="row margin_bottom_10">
                        <div class="col-md-6 width_50 image-preview" id="imagePreview">
                            <label for="">Slika</label>
                            <br>
                            <input type="file" name="file" id="file">
                            <br>
                            <img src="" class="image-preview__image" alt="Image Preview" >
                        </div>
                    </div>
                    <div class="row margin_bottom_10">
                        <div class="col-md-6 btn-update width_50">
                            <input type="submit" value="Dodaj sastojak" name="add">
                        </div>
                    </div>
                </form>
                    <?php
                        if(isset($_POST['add']))
                        {
                            $title = $_POST['title'];
                            $status = $_POST['status'];
                            $file_name = $_FILES['file']['name'];
                            
                            if($title !='' && $status !='' && $file_name !='')
                            {
                                $stmt = $conn->prepare("INSERT INTO sastojci SET
                                name = '$title', image = '$file_name', status = '$status'");
                                $stmt->execute();
                
                                if($stmt)
                                {   
                                    $_SESSION['succes_add_sastojak']="Uspešno ste dodali sastojak.";
                                    ?>
                                        <script>window.location.href='sastojci.php';</script>
                                    <?php
                                }else{
                                    ?>
                                        <script>window.location.href='add-sastojak.php';</script>
                                    <?php
                                }
                            }else{
                                $_SESSION['update_greska'] = "Morate popuniti sva obavezna polja.";
                                ?>
                                    <script>window.location.href='add-sastojak.php';</script>
                                <?php
                            }
                        }
                    ?>        
            </div>
        </div>
    </main>
        
    <script>
         //prikazivanje slike
         const inpFile = document.getElementById("file");
         const previewContainer = document.getElementById("imagePreview");
         const previewImage = previewContainer.querySelector(".image-preview__image");

         inpFile.addEventListener("change", function() {
             const file = this.files[0];

             if (file)
             {
                 const reader = new FileReader();
                 
                 previewImage.style.display="block";

                 reader.addEventListener("load",function(){
                     previewImage.setAttribute("src", this.result);
                 });

                 reader.readAsDataURL(file);

             }else{
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
} 
?>
</html>




