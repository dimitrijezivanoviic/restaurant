<?php include('delovi/header-admin.php'); ?>
<?php
    if($role == 'kuvar' || $role == 'admin'){  
        if($status=='active'){
?>
        <main>
            <?php 
                if(isset($_SESSION['status_priprema']))
                {
                    ?>
                    <div class="row succes_message">
                        <?php
                        echo $_SESSION['status_priprema'];
                        unset($_SESSION['status_priprema']);
                        ?>
                    </div>
                    <?php
                }

                if(isset($_SESSION['status_zavrsena_priprema']))
                {
                    ?>
                    <div class="row succes_message">
                        <?php
                        echo $_SESSION['status_zavrsena_priprema'];
                        unset($_SESSION['status_zavrsena_priprema']);
                                ?>
                    </div>
                    <?php
                }
            ?>
            <div class="row row_column">
                <h3>Poručene porudžbine</h3>
                <p>Spisak svih porudžbina prispelih za pripremu.</p>
            </div>
            <div class="table-grid" >
                <div class="table-responsive">
                    <table width="100%" class="content-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Porudzbenica</th>
                                <th>Akcija</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sql = "SELECT * FROM orders INNER JOIN tbl_admin ON orders.usernameID=tbl_admin.id WHERE order_status = 'ordered'";
                            $res = mysqli_query($conn, $sql);
                            if($res==TRUE){
                                $count = mysqli_num_rows($res); 
                                if($count>0){
                                    while($rows=mysqli_fetch_assoc($res))
                                    {
                                        $id=$rows['id_order'];
                                        $username=$rows['username'];
                                        $porudzbina=$rows['products'];
                                        ?>
                                            <tr>
                                                <td data-label="ID"><?php echo $id; ?></td>
                                                <td data-label="username"><?php echo $username; ?></td>
                                                <td data-label="Porudzbenica"><?php echo $porudzbina; ?></td>
                                                <td colspan="1">
                                                    <a href="preuzmi.php?id=<?php echo $id; ?>" class="btn-success"><i class="las la-check-circle"></i> Preuzmi</a>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }else{
                                    ?>
                                        <tr class="text-center">
                                        <td><h3><?php echo 'Nema poručenih! '; ?></h3></td>
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

            <div class="row row_column">
                <h3>Porudžbine u pripremi</h3>
                <p>Spisak svih porudžbina koje su trenutno u pripremi .</p>
            </div>
            <div class="table-grid" >
                <div class="table-responsive">
                    <table width="100%" class="content-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Porudzbenica</th>
                                <th>Akcija</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sql_priprema = "SELECT * FROM orders INNER JOIN tbl_admin ON orders.usernameID=tbl_admin.id WHERE order_status = 'priprema'";
                            $res_priprema = mysqli_query($conn, $sql_priprema);
                            if($res_priprema==TRUE){
                                $count_priprema = mysqli_num_rows($res_priprema); 
                                if($count_priprema>0){
                                    while($rows_priprema=mysqli_fetch_assoc($res_priprema))
                                    {
                                        $id=$rows_priprema['id_order'];
                                        $username=$rows_priprema['username'];
                                        $porudzbina=$rows_priprema['products'];
                                        ?>
                                            <tr>
                                                <td data-label="ID"><?php echo $id; ?></td>
                                                <td data-label="Username"><?php echo $username; ?></td>
                                                <td data-label="Porudzbenica"><?php echo $porudzbina; ?></td>
                                                <td colspan="1">
                                                    <a href="za_dostavljaca.php?id=<?php echo $id; ?>" class="btn-success"><i class="las la-check-circle"></i> Pošalji dostavljaču</a>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }else{
                                    ?>
                                        <tr class="text-center">
                                        <td><h3><?php echo 'Sve je pripremljeno! :)'; ?></h3></td>
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