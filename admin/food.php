<?php include('delovi/header-admin.php'); ?>
<?php
    if($role == 'admin'){  
        if($status=='active'){
?>
<main>
    <div class="row row_column">
        <h3>Jelovnik</h3>
        <p>Ovde možete upravljati svim jelima i pićima iz restorana.</p>
    </div>
    <div class="row">
        <a href="add-food.php" class="btn-primary"><i class="las la-plus-circle"></i> Dodaj hranu/piće</a>
    </div>
    <?php
             
        if(isset($_SESSION['succes_update_food']))
        {?>
            <div class="row succes_message">
                 <?php
                echo $_SESSION['succes_update_food'];
                unset($_SESSION['succes_update_food']);
                ?>
            </div>
            <?php
        }

        if(isset($_SESSION['succes_add_food']))
        {?>
             <div class="row succes_message">
                <?php
                echo $_SESSION['succes_add_food'];
                unset($_SESSION['succes_add_food']);
                ?>
            </div>
            <?php
        }

        if(isset($_SESSION['delete_food']))
        {?>
            <div class="row error_message">
                <?php
                echo $_SESSION['delete_food'];
                unset($_SESSION['delete_food']);
                ?>
            </div>
            <?php
        }
                
    ?>
        <div class="table-grid">
            <div class="table-responsive">
                <table width="100%" class="content-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Sastojci</th>
                            <th>Cena</th>
                            <th>Image name</th>
                            <th>Kategorija</th>
                            <th>Aktivno</th>
                            <th>Akcije</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    $sql = "SELECT * FROM tbl_food";
                    $res = mysqli_query($conn, $sql);

                    if($res==TRUE){
                        $count = mysqli_num_rows($res); 
                        if($count>0){
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                $id=$rows['id'];
                                $title=$rows['title'];
                                $description=$rows['description'];
                                $price=$rows['price'];
                                $image_name=$rows['image_name'];
                                $active=$rows['active'];
                                $category=$rows['categoryID'];

                                $sql_category = "SELECT * FROM tbl_category WHERE id = '$category'";
                                $res_category = mysqli_query($conn, $sql);
                                $rows_category=mysqli_fetch_assoc($res_category);

                                $category_name = $rows_category['title'];

                                ?>
                                    <!-- Ispisivanje vrednosti u tabelu -->
                                    <tr>
                                        <td data-label="ID"><?php echo $id; ?></td>
                                        <td data-label="Naziv"><?php echo $title; ?></td>
                                        <td data-label="Opis"><?php echo $description; ?></td>
                                        <td data-label="Cena"><?php echo $price; ?> RSD</td>
                                        <td data-label="Slika"><img src="../sajt/img/<?php echo $image_name; ?>" heigh="50px" width="100px" alt=""></td>
                                        <td data-label="Kategorija"><?php echo $category; ?></td>
                                        <td data-label="Status"><?php echo $active; ?></td>
                                        <td colspan="2" data-label="Akcija">
                                            <a href="update-food.php?id=<?php echo $id; ?>" class="btn-secondary"><span class="las la-edit"></a>
                                            <a href="delete-food.php?id=<?php echo $id; ?>" class="btn-danger"><span class="las la-trash"></a>
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                    }
                ?>
                    </tbody>
                </table>
            </div>
        </div>
</main>
    <?php 
    }else{
        $_SESSION['inactive_status'] = "Vaš nalog nije više aktivan. Kontaktirajte podršku za više informacija.";
        header('location: login.php');
    }     
}else{
        header('location: index.php'); 
}
    ?>
</body>
</html>