<?php include('delovi/header-admin.php'); ?>

<?php
    // Racunanje ukupnog broja porudzbina da bi se prikazalo u kontejneru
    $broj_porudzbina = 0;
    $sql_porudzbine = "SELECT * FROM orders WHERE id_order!=''";
    $res_porudzbine = mysqli_query($conn, $sql_porudzbine);

    while($rows_porudzbine=mysqli_fetch_assoc($res_porudzbine))
    {
        $broj_porudzbina = $broj_porudzbina +1;
    }
    
    // Racunanje ukupnog broja stavki da bi se prikazalo u kontejneru
    $broj_jelovnik = 0;
    $sql_jelovnik = "SELECT * FROM tbl_food WHERE id!=''";
    $res_jelovnik = mysqli_query($conn, $sql_jelovnik);

    while($rows_jelovnik=mysqli_fetch_assoc($res_jelovnik))
    {
        $broj_jelovnik = $broj_jelovnik +1;
    }

    // Racunanje ukupnog broja korisnika da bi se prikazalo u kontejneru
    $broj_korisnik = 0;
    $sql_korisnik = "SELECT * FROM tbl_admin WHERE id!=''";
    $res_korisnik = mysqli_query($conn, $sql_korisnik);

    while($rows_korisnik=mysqli_fetch_assoc($res_korisnik))
    {
        $broj_korisnik = $broj_korisnik +1;
    }

    // Sql upit za poslednjih 10 porudzbina
    $sql = "SELECT * FROM orders INNER JOIN tbl_admin ON orders.usernameID=tbl_admin.id ORDER BY orders.id_order LIMIT 10";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res); 

    $sql_kategorije = "SELECT * FROM tbl_category";
    $res_kategorije = mysqli_query($conn, $sql_kategorije);
    $count_kategorije = mysqli_num_rows($res_kategorije); 

?>

<?php
    if($role == 'admin' || $role == 'kuvar' || $role == 'dostavljac'){  
        if($status=='active'){
?>
        <main>
            <div class="cards">
                <div class="card-single">
                    <div>
                        <h1>
                        <?php 
                            echo $broj_jelovnik;
                        ?>
                        </h1>
                        <span>Broj hrane i pića u jelovniku</span>
                    </div>
                    <div>
                        <span class="las la-utensils"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>
                        <?php 
                            echo $broj_korisnik;
                        ?>
                        </h1>
                        <span>Broj admina, korisnika i radnika</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>
                        <?php 
                            echo $broj_porudzbina;
                        ?>
                        </h1>
                        <span>Ukupan broj porudžbina</span>
                    </div>
                    <div>
                        <span class="las la-clipboard-list"></span>
                    </div>
                </div>
            </div>
            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Poslednjih 10 porudžbina</h3>
                            <a href="sve-porudzbine.php">Pogledaj sve</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%" id="tabela_index">
                                    <thead>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Porudžbenica</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        if($count>0){
                                            while($rows=mysqli_fetch_assoc($res))
                                            {
                                                $id = $rows['id_order'];
                                                $username = $rows['username'];
                                                $porudzbina = $rows['products'];
                                                $status = $rows['order_status'];
                                    ?>
                                                <tr>
                                                    <td data-label="ID"><?php echo $id; ?></td>
                                                    <td data-label="Username"><?php echo $username; ?></td>
                                                    <td data-label="Porudžbina"><?php echo $porudzbina; ?></td>
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
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="customers">
                    <div class="card">
                        <div class="card-header">
                            <h3>Kategorije</h3>
                        </div>
                        <div class="table-responsive">
                            <table width="100%" id="tabela_index">
                                <thead>
                                    <th>ID</th>
                                    <th>Naziv</th>
                                </thead>
                                <tbody>
                                <?php 
                                if($count_kategorije>0){
                                    while($rows_kategorija=mysqli_fetch_assoc($res_kategorije))
                                    {
                                        $id_kategorija = $rows_kategorija['id'];
                                        $title_kategorija = $rows_kategorija['title'];
                                    ?>
                                    <tr>
                                        <td data-label="ID"><?php echo $id_kategorija; ?></td>
                                        <td data-label="Naziv"><?php echo $title_kategorija; ?></td>
                                    </tr>
                                    <?php 
                                    }
                                }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php 
        }else{
            $_SESSION['inactive_status'] = "Vaš nalog nije više aktivan. Kontaktirajte podršku za više informacija.";
            header('location: login.php');
        }     
    }else{
            header('location: login.php'); 
        }
        ?>
    </body>
</html>