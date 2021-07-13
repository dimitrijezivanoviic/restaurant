<?php include('delovi/header-admin.php'); ?>
<?php
    if($role == 'kuvar' || $role == 'admin' || $role == 'dostavljac'){  
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
                <h3>Spisak svih porudžbina</h3>
            </div>
            <div class="row" id="search_orders">
                <form action="" method="POST" class="forma">
                    <input type="text" name="search_username" placeholder="Pretraži po username">
                    <button>Pretraži</button>
                </form>
            </div>
                <div class="table-grid" >
                    <div class="table-responsive">
                        <table width="100%" class="content-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Korisnik</th>
                                    <th>Narudzbenica</th>
                                    <th>Cena</th>
                                    <th>Zavrseno</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if(isset($_POST['search_username']))
                                {
                                    $searchKey_username = $_POST['search_username'];

                                    $sql = "SELECT * FROM orders INNER JOIN tbl_admin ON orders.usernameID=tbl_admin.id WHERE username = '$searchKey_username'";
                                }else{
                                    $sql = "SELECT *
                                    FROM orders
                                    INNER JOIN tbl_admin ON orders.usernameID=tbl_admin.id;";
                                    $searchKey_id = "";
                                    $searchKey_username = "";
                                }

                                    $res = mysqli_query($conn, $sql);
                                    if($res==TRUE){
                                        $count = mysqli_num_rows($res); 
                                        if($count>0){
                                            while($rows=mysqli_fetch_assoc($res))
                                            {
                                                $id=$rows['id_order'];
                                                $username=$rows['username'];
                                                $amount_paid=$rows['amount_paid'];
                                                $products=$rows['products'];
                                                $status=$rows['order_status'];
                                                $membership=$rows['membership_order'];
                                                $time_ordered=$rows['time'];
                                                $time_show = date("d/m/Y H:i",strtotime($time_ordered));
                                                ?>

                                                <tr>
                                                    <!-- Ispisivanje vrednosti u tabelu -->
                                                    <td data-label="ID"><?php echo $id; ?></td>
                                                    <td data-label="Username"><?php echo $username; ?></td>
                                                    <td data-label="Proizvodi"><?php echo $products; ?></td>
                                                    <td data-label="Ukupna cena"><?php echo $amount_paid; ?> RSD</td>
                                                    <td data-label="Vreme"><?php echo $time_show ?>h</td>
                                                    <td data-label="Status">
                                                    <?php
                                                    if($status=='canceled')
                                                    {
                                                ?>
                                                    <div class="canceled-status">
                                                    <i class="fas fa-ban"></i>
                                                        <?php
                                                            echo $status;
                                                        ?>
                                                    </div>
                                                    <?php
                                                    }else if($status=='completed'){
                                                        ?>
                                                        <div class="completed-status">
                                                        <i class="fas fa-check-circle"></i>
                                                        <?php
                                                            echo $status;
                                                        ?>
                                                        </div>
                                                        <?php
                                                    }else{
                                                        ?>
                                                    <div class="pending-status">
                                                    <i class="fas fa-clock"></i>
                                                    <?php
                                                        echo $status;
                                                    }
                                                        ?>
                                                    </div>
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
