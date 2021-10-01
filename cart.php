<?php include('delovi/header.php'); ?>
<?php
    if($role == 'admin' || $role == 'korisnik')
    {
        if($status == 'active')
        {
?>
<body>
    <div class="small-container cart-page">
        <?php
        $stmt = $conn->prepare('SELECT * FROM cart WHERE usernameID=?');
        $stmt->bind_param('s',$id_username);
        $stmt->execute();
        $result = $stmt->get_result();
        $grand_total = 0;

        if(mysqli_num_rows($result)>0)
        {
        ?>
            <table class="tabela-cart">
                <tr>
                    <th>Proizvod</th>
                    <th>Količina</th>
                    <th>Ukupno</th>
                </tr>
                <?php
                    while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td>
                        <div class="cart-info">
                            <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                            <img src="img/<?= $row['product_image'] ?>" alt="" height="100px" width="150px">
                            <div>
                                <p><?= $row['product_name'] ?></p>
                                <small><?= number_format($row['product_price'],2); ?> RSD</small>
                                <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                                <br>
                                <a href="action.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('Obrisaće se cela količina ovog proizvoda iz korpe! Da li ste sigurni?');">Obriši proizvod</a>
                            </div>
                        </div>
                    </td>
                    <td><input type="number" class="form-control itemQty" name="kolicina" value="<?= $row['qty'] ?>" min=1 style="width:75px;"></td>
                    <td><h3><?= number_format($row['total_price'],2);?> RSD</h3></td>
                    <?php $grand_total += $row['total_price']; ?>
                </tr>
                <?php endwhile; ?>
            </table>

            <div class="row">
                <div class="col-md-6" id="div_coupon">
                    <?php
                        if(isset($_SESSION['error_code']))
                        {?>
                            <div class="row error_message registration_message">
                                <?php
                                    echo $_SESSION['error_code'];
                                    unset($_SESSION['error_code']);
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                    <form action="" method="POST" class="margin_bottom_30">
                        <input type="text" id="kupon" class="margin_bottom_30" name="coupon_code" placeholder="KUPON KOD" required>
                        <button type="submit" name="coupon_submit" class="btn btn-info" >Primeni kupon</button>
                    </form>
                </div>
                <?php 
                    if(isset($_POST['coupon_submit']))
                    {
                        $coupon_code = $_POST['coupon_code'];

                        // provera da li je unesen kupon validan
                        $sql_coupon = "SELECT * FROM coupons WHERE code = '$coupon_code'";
                        $res_coupon = mysqli_query($conn, $sql_coupon);
                        if($res_coupon==TRUE){
                            $count_coupon = mysqli_num_rows($res_coupon); 
                            if($count_coupon>0){
                                $rows_coupon=mysqli_fetch_assoc($res_coupon);
                                $percentage_coupon = $rows_coupon['percentage'];

                                $grand_total_prikaz = $grand_total * $percentage_coupon;
                                $popust = $grand_total_prikaz - $grand_total;

                                //postavljanje sesije za cenu sa popustom kako bi se prikazala na checkout.php
                                $_SESSION['total_popust'] = $grand_total_prikaz;
                            }else{
                                $_SESSION['total_popust'] = $grand_total;

                                $_SESSION['error_code'] = "Uneti kupon nije validan!";
                                ?>
                                <script>window.location.href='cart.php';</script>
                                <?php
                            }
                        }

                    }else{
                        $grand_total_prikaz = $grand_total;
                        $popust = 0;
                        $_SESSION['total_popust'] = $grand_total;
                    }
                ?>
                <div class="col-md-6" id="ukupna_cena">
                    <div class="total-price">
                        <table class="price-table">
                            <tr>
                                <td>Ukupno za proizvode</td>
                                <td> <?= number_format($grand_total,2); ?> RSD</td>
                            </tr>
                            <tr>
                                <td>Poštarina</td>
                                <td>0.00 RSD</td>
                            </tr>
                            <tr>
                                <td>Popust</td>
                                <td><?php echo number_format($popust,2); ?> RSD</td>
                            </tr>
                            <tr>
                                <td>Ukupno</td>
                                <td> <?= number_format($grand_total_prikaz,2); ?> RSD</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6" id="ukupna_cena">
                    <div class="cart-actions">
                        <a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                        <a href="index.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Nastavi kupovinu</a>
                    </div>
                </div>
            </div>
    </div>
    <?php
        //Ako je korpa prazna
        }else{
    ?>
            <div class="empty_container">
                <div class="naslov">
                    <h3>Tvoja korpa</h3> 
                </div>
                <div class="empty_main">
                    <i class="fas fa-cart-arrow-down"></i>
                    <br>
                    <h3>KORPA JE PRAZNA</h3>
                    <small>Da li si za burger, picu ili neki napitak? Dodaj nešto iz naše ponude u svoju korpu!</small>
                    <br>
                    <button class="btn-update"><a href="index.php#our-menu">Napravi porudžbinu</a></button>
                </div>           
            </div>
    <?php
        }
    ?>
        </div>
        <?php include('delovi/footer.php'); ?>

    <?php
        }else{
            $_SESSION['proba1'] = "Vas status je neaktivan. Kontaktirajte korisnicku podrsku u vezi ovoga.";
            header('location: login.php');
        }
    }else{
    header('location: login.php');
    }
    ?>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
        <script src="js/script.js"></script>

        <script type="text/javascript">

                // Onemoguciti da se kolicina upisuje sa tastature
                $("[type='number']").keypress(function (evt) {
                    evt.preventDefault();
                });

            $(document).ready(function() {

                // Promena kolicine proizvoda
                $(".itemQty").on('change', function() {

                    var $el = $(this).closest('tr');
                    var pid = $el.find(".pid").val();
                    var pprice = $el.find(".pprice").val();
                    var qty = $el.find(".itemQty").val();
                    location.reload(true);
                    $.ajax({
                        url: 'action.php',
                        method: 'post',
                        cache: false,
                        data: {
                            qty: qty,
                            pid: pid,
                            pprice: pprice
                        },
                        success: function(response) {
                            console.log(response);
                        }
                        });
                    });

                // Ucitavanje broja proizovda u korpi
                load_cart_item_number();

                load_cart_item_number();

                function load_cart_item_number() {
                    $.ajax({
                    url: 'action.php',
                    method: 'get',
                    data: {
                        cartItem: "cart_item"
                    },
                    success: function(response) {
                        $("#cart-item").html(response);
                    }
                    });
                }
            });
        </script>
    </body>
</html>
