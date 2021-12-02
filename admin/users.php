<?php include('delovi/header-admin.php'); ?>
<?php
    if($role == 'admin'){ 
        if($status=='active'){
?>
        <main>
            <div class="row row_column">
                <h3>Upravljanje korisnicima</h3>
                <p>Spisak svih admina, korisnika i radnika.</p>
            </div>
            <div class="row">
                <a href="add-user.php" class="btn-primary"><i class="las la-user-plus"></i> Dodaj novog</a>
            </div>
            <?php
                //Ispisivanje poruka
                if(isset($_SESSION['succes_update_user']))
                {?>
                    <div class="row succes_message">
                        <?php
                        echo $_SESSION['succes_update_user'];
                        unset($_SESSION['succes_update_user']);
                        ?>
                    </div>
                    <?php
                }
                
                if(isset($_SESSION['succes_add']))
                {?>
                    <div class="row succes_message">
                        <?php
                        echo $_SESSION['succes_add'];
                        unset($_SESSION['succes_add']);
                        ?>
                    </div>
                    <?php
                }

                if(isset($_SESSION['delete_user']))
                {?>
                    <div class="row succes_message">
                        <?php
                        echo $_SESSION['delete_user'];
                        unset($_SESSION['delete_user']);
                        ?>
                    </div>
                    <?php
                }

                if(isset($_SESSION['delete_user_error']))
                {?>
                    <div class="row error_message">
                        <?php
                        echo $_SESSION['delete_user_error'];
                        unset($_SESSION['delete_user_error']);
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
                                <th>Ime</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th>Role</th>
                                <th>Akcije</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                        $sql = "SELECT * FROM tbl_admin";
                        $res = mysqli_query($conn, $sql);

                        if($res==TRUE){
                            $count = mysqli_num_rows($res); 

                            if($count>0){
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];
                                    $role=$rows['role'];
                                    $status=$rows['status'];
                                    $email=$rows['email'];
                                    $amount_paid = 0;
                                    $sql_count_orders = "SELECT * from orders WHERE email = '$email' AND order_status = 'completed'";
                                    $res_count_orders = mysqli_query($conn, $sql_count_orders);
            
                                    if($res_count_orders==TRUE){
                                            $count_count_orders = mysqli_num_rows($res_count_orders); 
                                            if($count_count_orders>0){
                                                while($rows_count_orders=mysqli_fetch_assoc($res_count_orders))
                                                {
                                                    $amount = $rows_count_orders['amount_paid'];
                                                    $amount_paid +=$amount;
                                                }
                                            }
                                    }
                                        
                                    ?>
                                        <!-- Ispisivanje vrednosti u tabelu -->
                                        <tr>
                                            <td data-label="ID"><?php echo $id; ?></td>
                                            <td data-label="Ime"><?php echo $full_name; ?></td>
                                            <td data-label="Username"><?php echo $username; ?></td>
                                            <td data-label="Status"><?php echo $status; ?></td>
                                            <td data-label="Rola"><?php echo $role; ?></td>
                                            <td colspan="2" data-label="Akcije">
                                                <a href="update-user.php?id=<?php echo $id; ?>" class="btn-secondary"><span class="las la-edit"></a>
                                                <?php if($role=='admin'){ }else { ?>
                                                        <a onclick="return confirm('Da li želite da obrišete korisnika koji je u vašem restoranu imao porudžbine u vrednosti od <?php echo $amount_paid; ?> RSD?');" href="delete-user.php?id=<?php echo $id; ?>" class="btn-danger"><span class="las la-trash"></a>
                                                    <?php 
                                                    
                                                }
                                                     ?>
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
