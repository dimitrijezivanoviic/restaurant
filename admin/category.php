<?php include('delovi/header-admin.php'); ?>
<?php
    if($role == 'admin'){ 
        if($status=='active'){
?>
<main>
    <div class="row row_column">
        <h3>Kategorije</h3>
        <p>Ovde možete upravljati svim kategorijama hrane i pića iz restorana.</p>
    </div>
    <div class="row">
        <a href="add-category.php" class="btn-primary"><i class="las la-plus-circle"></i> Dodaj kategoriju</a>
    </div>
    <?php
        
        if(isset($_SESSION['succes_update_category']))
        {?>
            <div class="row succes_message">
                <?php
                echo $_SESSION['succes_update_category'];
                unset($_SESSION['succes_update_category']);
                ?>
            </div>
        <?php
        }

        if(isset($_SESSION['succes_add_category']))
        {?>
             <div class="row succes_message">
                <?php
                echo $_SESSION['succes_add_category'];
                unset($_SESSION['succes_add_category']);
                ?>
            </div>
        <?php
        }

        if(isset($_SESSION['delete_category']))
        {?>
            <div class="row error_message">
                <?php
                echo $_SESSION['delete_category'];
                unset($_SESSION['delete_category']);
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
                        <th>Naziv</th>
                        <th>Akcija</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT * FROM tbl_category";
                    $res = mysqli_query($conn, $sql);

                    if($res==TRUE){
                        $count = mysqli_num_rows($res); 

                        if($count>0){
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                $id=$rows['id'];
                                $title=$rows['title'];
                                ?>
                                    <!-- Ispisivanje vrednosti u tabelu -->
                                    <tr>
                                        <td data-label="ID"><?php echo $id; ?></td>
                                        <td data-label="Naslov"><?php echo $title; ?></td>
                                        <td colspan="2"  data-label="Akcija">
                                            <a href="update-category.php?id=<?php echo $id; ?>" class="btn-secondary"><span class="las la-edit"></a>
                                            <a href="delete-category.php?id=<?php echo $id; ?>" class="btn-danger"><span class="las la-trash"></a>
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