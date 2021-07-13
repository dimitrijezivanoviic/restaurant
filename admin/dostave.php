<?php include('delovi/header-admin.php'); ?>
<?php
    if($role == 'dostavljac' || $role == 'admin'){ 
        if($status=='active'){
?>
        <main>
        <?php 
            if(isset($_SESSION['status_za_dostavu']))
            {
                ?>
                <div class="row succes_message">
                    <?php
                    echo $_SESSION['status_za_dostavu'];
                    unset($_SESSION['status_za_dostavu']);
                    ?>
                </div>
                <?php
            }
                        
            if(isset($_SESSION['completed_order']))
            {
                ?>
                <div class="row succes_message">
                    <?php
                    echo $_SESSION['completed_order'];
                    unset($_SESSION['completed_order']);
                    ?>
                </div>
                <?php
            }
        ?>
            <div class="row row_column">
                <h3>Porudžbine za dostavljača</h3>
                <p>Spisak svih porudžbina koji čekaju da ih dostavljač preuzme.</p>
            </div>
            <div class="table-grid" >
                    <div class="table-responsive">
                        <table width="100%" class="content-table">
                             <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Porudžbenica</th>
                                    <th>Adresa</th>
                                    <th>Broj telefona</th>
                                    <th>Za naplatu</th>
                                    <th>Akcija</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $sql = "SELECT * FROM orders INNER JOIN tbl_admin ON orders.usernameID=tbl_admin.id WHERE order_status = 'ceka dostavu'";
                                $res = mysqli_query($conn, $sql);

                                if($res==TRUE){
                                    $count = mysqli_num_rows($res); 
                                    if($count>0){
                                        while($rows=mysqli_fetch_assoc($res))
                                        {
                                            $id=$rows['id_order'];
                                            $username=$rows['username'];
                                            $porudzbina=$rows['products'];
                                            $address=$rows['address'];
                                            $phone=$rows['phone'];
                                            $amount_paid=$rows['amount_paid'];
                                            ?>
                                                <tr>
                                                    <td data-label="ID"><?php echo $id; ?></td>
                                                    <td data-label="Username"><?php echo $username; ?></td>
                                                    <td data-label="Porudžbenica"><?php echo $porudzbina; ?></td>
                                                    <td data-label="Adresa"><?php echo $address; ?></td>
                                                    <td data-label="Broj telefona"><?php echo $phone; ?></td>
                                                    <td data-label="Za naplatu"><?php echo $amount_paid; ?> RSD</td>
                                                    <td colspan="1">
                                                        <a href="kod_dostavljaca.php?id=<?php echo $id; ?>" class="btn-success"><i class="las la-check-circle"></i> Preuzmi</a>
                                                    </td>
                                                </tr>
                                            <?php
                                        }

                                    }else{
                                        ?>
                                            <tr class="text-center">
                                                <td><h3><?php echo 'Nema spremljenih porudžbina! '; ?></h3></td>
                                                <td></td>
                                                <td></td>
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

                <div class="row row_column">
                    <h3>Preuzete porudžbine</h3>
                    <p>Spisak svih porudžbina koje se nalaze kod dostavljača.</p>
                </div>
                <div class="table-grid" >
                    <div class="table-responsive">
                        <table width="100%" class="content-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Porudžbenica</th>
                                    <th>Adresa</th>
                                    <th>Broj telefona</th>
                                    <th>Za naplatu</th>
                                    <th>Akcija</th>
                                 </tr>
                            </thead>
                            <tbody>
                            <?php
                                $sql = "SELECT * FROM orders INNER JOIN tbl_admin ON orders.usernameID=tbl_admin.id WHERE order_status = 'preuzeo dostavljac'";
                                $res = mysqli_query($conn, $sql);

                                if($res==TRUE){
                                    $count = mysqli_num_rows($res); 
                                    if($count>0){
                                        while($rows=mysqli_fetch_assoc($res))
                                        {
                                            $id=$rows['id_order'];
                                            $username=$rows['username'];
                                            $porudzbina=$rows['products'];
                                            $address=$rows['address'];
                                            $phone=$rows['phone'];
                                            $amount_paid=$rows['amount_paid'];
                                            ?>
                                                <tr>
                                                    <td data-label="ID"><?php echo $id; ?></td>
                                                    <td data-label="Username"><?php echo $username; ?></td>
                                                    <td data-label="Porudžbenica"><?php echo $porudzbina; ?></td>
                                                    <td data-label="Adresa"><?php echo $address; ?></td>
                                                    <td data-label="Broj telefona"><?php echo $phone; ?></td>
                                                    <td data-label="Za naplatu"><?php echo $amount_paid; ?> RSD</td>
                                                    <td colspan="1">
                                                        <a href="kompletirano.php?id=<?php echo $id; ?>" class="btn-success"><i class="las la-check-circle"></i> Potvrdi dostavu</a>
                                                    </td>
                                                </tr>
                                            <?php
                                        }

                                    }else{
                                        ?>
                                            <tr class="text-center">
                                                <td><h3><?php echo 'Sve je isporučeno! :) '; ?></h3></td>
                                                <td></td>
                                                <td></td>
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