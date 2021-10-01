<?php include('delovi/header-admin.php'); ?>
<?php
    if($role == 'admin'){  
        if($status=='active'){
?>
<main>
    <div class="row row_column">
        <h3>Sastojci</h3>
        <p>Ovde možete upravljati svim sastojcima</p>
    </div>
    <div class="row">
        <a href="add-sastojak.php" class="btn-primary"><i class="las la-plus-circle"></i> Dodaj sastojke</a>
    </div>
    <?php
             
        if(isset($_SESSION['succes_update_sastojak']))
        {?>
            <div class="row succes_message">
                 <?php
                echo $_SESSION['succes_update_sastojak'];
                unset($_SESSION['succes_update_sastojak']);
                ?>
            </div>
            <?php
        }

        if(isset($_SESSION['succes_add_sastojak']))
        {?>
             <div class="row succes_message">
                <?php
                echo $_SESSION['succes_add_sastojak'];
                unset($_SESSION['succes_add_sastojak']);
                ?>
            </div>
            <?php
        }

        if(isset($_SESSION['delete_sastojak']))
        {?>
            <div class="row error_message">
                <?php
                echo $_SESSION['delete_sastojak'];
                unset($_SESSION['delete_sastojak']);
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
                            <th>Naziv</th>
                            <th>Slika</th>
                            <th>Status</th>
                            <th>Akcija</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    $sql = "SELECT * FROM sastojci";
                    $res = mysqli_query($conn, $sql);

                    if($res==TRUE){
                        $count = mysqli_num_rows($res); 
                        if($count>0){
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                $id=$rows['id'];
                                $name=$rows['name'];
                                $status=$rows['status'];
                                $image=$rows['image'];


                                ?>
                                    <!-- Ispisivanje vrednosti u tabelu -->
                                    <tr>
                                        <td data-label="ID"><?php echo $id; ?></td>
                                        <td data-label="Naziv"><?php echo $name; ?></td>
                                        <td data-label="Slika"><img src="/img/<?php echo $image; ?>" heigh="50px" width="100px" alt=""></td>
                                        <td data-label="Status"><?php echo $status; ?></td>
                                        <td colspan="2" data-label="Akcija">
                                            <a href="update-sastojak.php?id=<?php echo $id; ?>" class="btn-secondary"><span class="las la-edit"></a>
                                            <a onclick="return confirm('Da li ste sigurni da želite obrisati?');" href="delete-sastojak.php?id=<?php echo $id; ?>" class="btn-danger"><span class="las la-trash"></a>
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


