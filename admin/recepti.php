<?php include('delovi/header-admin.php'); ?>
<?php
    if($role == 'admin' || $role == 'kuvar'){ 
        if($status=='active'){
?>
        <main>
            <div class="row row_column">
                <h3>Recepti</h3>
                <p>Spisak svih recepata.</p>
            </div>
            <div class="row">
                <a href="add-recept.php" class="btn-primary"><i class="las la-plus-circle"></i> Dodaj novi</a>
            </div>
            <?php
                //Ispisivanje poruka
                
                if(isset($_SESSION['add_recept']))
                {?>
                    <div class="row succes_message">
                        <?php
                        echo $_SESSION['add_recept'];
                        unset($_SESSION['add_recept']);
                        ?>
                    </div>
                    <?php
                }


                if(isset($_SESSION['delete_recept']))
                {?>
                    <div class="row error_message">
                        <?php
                        echo $_SESSION['delete_recept'];
                        unset($_SESSION['delete_recept']);
                        ?>
                    </div>
                    <?php
                }

            ?>
            <div class="table-grid" >
                <div class="table-responsive">
                    <table width="100%" class="content-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kategorija</th>
                                <th>Sastojci</th>
                                <th>Opis</th>
                                <th>Akcije</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                        $sql = "SELECT * FROM recepti";
                        $res = mysqli_query($conn, $sql);

                        if($res==TRUE){
                            $count = mysqli_num_rows($res); 

                            if($count>0){
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $id=$rows['id'];
                                    $kategorija=$rows['kategorija'];
                                    $sastojci=$rows['sastojci'];
                                    $opis=$rows['opis'];

                                    // trazenje imena kategorije po prethodno dobijenom id-u iznad
                                    $sql_cat_name = "SELECT * FROM tbl_category WHERE id='$kategorija'";
                                    $res_cat_name = mysqli_query($conn, $sql_cat_name);

                                    if($res_cat_name==TRUE){
                                        $count_cat_name = mysqli_num_rows($res_cat_name); 

                                        if($count_cat_name>0){
                                            $rows_cat_name=mysqli_fetch_assoc($res_cat_name);
                                            $ime_kategorije=$rows_cat_name['title'];
                                        }
                                    }
                                        
                                    ?>
                                        <!-- Ispisivanje vrednosti u tabelu -->
                                        <tr>
                                            <td data-label="ID"><?php echo $id; ?></td>
                                            <td data-label="Kategorija"><?php echo $ime_kategorije; ?></td>
                                            <td data-label="Sastojci"><?php echo $sastojci; ?></td>
                                            <td data-label="Opis"><?php echo $opis; ?></td>
                                            <td colspan="2" data-label="Akcije">
                                                <a onclick="return confirm('Da li ste sigurni da želite obrisati ovaj recept?');" href="delete-recept.php?id=<?php echo $id; ?>" class="btn-danger"><span class="las la-trash"></a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }else{
                                ?>
                                    <tr>
                                        <td>Nema zapisanih recepata!</td>
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
