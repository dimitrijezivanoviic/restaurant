<?php include('delovi/header-admin.php'); ?>
<?php
    if($role == 'admin'){ 
        if($status=='active'){
?>
<main>
    <div class="row row_column">
        <h3>Kuponi</h3>
        <p>Ovde možete upravljati kuponima.</p>
    </div>
    <div class="row">
        <a href="add-kupon.php" class="btn-primary"><i class="las la-plus-circle"></i> Dodaj kupon</a>
    </div>
    <?php

        if(isset($_SESSION['succes_add_kupon']))
        {?>
             <div class="row succes_message">
                <?php
                echo $_SESSION['succes_add_kupon'];
                unset($_SESSION['succes_add_kupon']);
                ?>
            </div>
        <?php
        }

        if(isset($_SESSION['delete_kupon']))
        {?>
            <div class="row error_message">
                <?php
                echo $_SESSION['delete_kupon'];
                unset($_SESSION['delete_kupon']);
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
                        <th>Code</th>
                        <th>Iznos</th>
                        <th>Akcija</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT * FROM coupons";
                    $res = mysqli_query($conn, $sql);

                    if($res==TRUE){
                        $count = mysqli_num_rows($res); 

                        if($count>0){
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                $id=$rows['id_coupons'];
                                $code=$rows['code'];
                                $percentage=$rows['percentage'];
                                ?>
                                    <!-- Ispisivanje vrednosti u tabelu -->
                                    <tr>
                                        <td data-label="ID"><?php echo $id; ?></td>
                                        <td data-label="Kod"><?php echo $code; ?></td>
                                        <td data-label="Iznos"><?php echo $percentage; ?></td>
                                        <td colspan="2"  data-label="Akcija">
                                            <a href="delete-kupon.php?id=<?php echo $id; ?>" class="btn-danger"><span class="las la-trash"></a>
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