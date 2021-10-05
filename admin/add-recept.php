<?php include('delovi/header-admin.php');
    $sql_category = "SELECT * FROM tbl_category WHERE food = 'yes'";
    $res_category = mysqli_query($conn, $sql_category);

?>
<?php
    if($role == 'admin'){ 
        if($status=='active'){        
?>
        <main>
        <div class="row">
            <div class="row margin_bottom_10">
                <h3>Ubacivanje novog recepta!</h3>
            </div>
        </div>
        <div class="jedan">
           
            <div class="row">
            <div class="empty-container">
                    <?php
                        $sql_sastojci = "SELECT * FROM sastojci WHERE status = 'active'";
                        $res_sastojci = mysqli_query($conn, $sql_sastojci);
                    ?>
                        <form action="" method="POST" class="forma">
                            <div class="row">
                                <label for="">Naziv jela</label>
                                <br>
                                <input type="text" name="ime" placeholder="Unesite naziv jela">
                            </div>
                            <div class="row">
                                <h4>Sastojci: </h4>
                            </div>
                            <br>
                            <div class="row row_sastojci">
                                <?php
                                while($rows_sastojci=mysqli_fetch_assoc($res_sastojci))
                                {
                                    $ime_sastojci = $rows_sastojci['name'];
                                    $image_sastojci = $rows_sastojci['image'];
                                ?>
                                    <div class="col-md-4 sastojci">
                                        <div class="form-group">
                                            <img src="../img/<?php echo $image_sastojci?>" height='70px' width='100px' alt="">
                                            <input type="checkbox" name="prilog[]" value="<?php echo $ime_sastojci ?>"> <label for=""><?php echo $ime_sastojci ?></label>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="row row_sastojci">
                                <div class="col-md-4">
                                    <label for="">Kategorija</label>
                                    <select name="kategorija" id="">
                                        <?php 
                                            while($rows_category=mysqli_fetch_assoc($res_category))
                                            {
                                                $category_id = $rows_category['id'];
                                                $category_name = $rows_category['title'];
                                        ?>
                                        <option value="<?php echo $category_id; ?>" ><?php echo $category_id . ' - ' . $category_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                </div>
                            </div>
                            <div class="row row_sastojci">
                                <div class="col-md-4">
                                   <textarea name="opis" id="" cols="50" rows="10" placeholder="Opiši proceduru pripremanja recepta..." name="opis"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="cold-md-4 button-row">
                                    <input type="submit" class="btn-update" value="Upiši novi recept" name='submit'>
                                </div>
                            </div>
                        </form>
                        <?php
                             if(isset($_POST['submit']))
                             {
                                     if(isset($_POST['prilog']))
                                     {
                                         $prilog = $_POST['prilog'];
                                         $opis = $_POST['opis'];
                                         $kategorija = $_POST['kategorija'];
                                         $prilozi = 'Prilozi: ';
                                         $ime = $_POST['ime'];
                                         foreach($prilog as $prilozi1)
                                         {
                                             $prilozi = $prilozi . ' ' . $prilozi1. ',';
                                         }
                                         $sastojci = $prilozi;
         
                                         $upit_membership = $conn->prepare("INSERT INTO recepti SET
                                         naziv = '$ime',
                                         kategorija = '$kategorija',
                                         sastojci = '$sastojci',
                                         opis = '$opis'
                                         ");
                                         $upit_membership->execute();
                                         if($upit_membership)
                                         {
                                            $_SESSION['add_recept'] = "Uspešno ste dodali recept!";
                                            ?>
                                            <script>window.location.href = "recepti.php";</script>
                                            <?php
                                         }
                                     }else{
                                        ?> 
                                            <script>
                                                alert('Morate izabrati neki prilog!');
                                                window.location.href = "add-recept.php"
                                            </script> 
                                        <?php
                                     }
                             }
                        ?> 
                    </div>
                   
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




