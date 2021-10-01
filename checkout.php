<?php include('delovi/header.php');?>
<?php
	
    //prenos vrednosti sa stranice cart.php preko sesije
    $grand_total = $_SESSION['total_popust'];

    $porudzbenica = '';
    $porudzbenica_baza = '';

	$sql = "SELECT * FROM cart WHERE usernameID = '$id_username'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
    $porudzbenica = $porudzbenica . ' ' . $row['product_name'] . ' x ' . $row['qty'] . '<br>';
    $porudzbenica_baza = $porudzbenica_baza . ' ' . $row['product_name'] . ' x ' . $row['qty'] . ', ';
    }
    
    $count = mysqli_num_rows($result);
    if($count > 0)
    {
?>
<section class="checkout_section checkout-background">
    <div class="container-account" id="checkout">

        <div class="row margin_bottom_30">
            <a href="cart.php"><i class="fas fa-angle-left"></i> Vrati se na korpu</a>
        </div>

        <div class="row">
            <h2>Checkout</h2>
        </div>

        <div class="row checkout-content"  id="order">
            <!-- Unosenje podataka  -->
            <div class="checkout-column">
                <div class="row">
                    <h4> <i class="fas fa-user-alt"></i> Unesite podatke za dostavu</h4>
                </div>
                <div class="row">
                    <form action="" method="POST" class="forma" id="placeOrder"> 
                        <input type="hidden" name="products_prikaz" value="<?= $porudzbenica; ?>">
                        <input type="hidden" name="products" value="<?= $porudzbenica_baza; ?>">
                        <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">

                        <div class="div_checkout margin_bottom_30" id="double_input">
                            <div class="col-md-6">
                                <div class="row" id="checkout_row">
                                    <label for="">Ime*</label>
                                </div>
                                <div class="row" id="checkout_row">
                                    <input type="text" name="first_name" placeholder="Ime" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row" id="checkout_row">
                                    <label for="">Prezime*</label>
                                </div>
                                <div class="row" id="checkout_row">
                                    <input type="text" name="last_name" placeholder="Prezime" required>
                                </div>
                            </div>
                        </div>

                        <div class="div_checkout margin_bottom_30" id="double_input">
                            <div class="col-md-6">
                                <div class="row" id="checkout_row">
                                    <label for="">Mesto*</label>
                                </div>
                                <div class="row" id="checkout_row">
                                    <select name="city" id="">
                                        <option value="Beograd">Beograd</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row" id="checkout_row">
                                    <label for="">Adresa*</label>
                                </div>
                                <div class="row" id="checkout_row">
                                    <input type="text" name="address" placeholder="primer: Knez Mihailova 9" required>
                                </div>
                            </div>
                        </div>

                        <div class="div_checkout margin_bottom_30">
                            <div class="row" id="checkout_row">
                                <label for="">Broj telefona*</label>
                            </div>
                            <div class="row" id="checkout_row">
                                <input type="text" name="phone" placeholder="06x/xxxx xxx" required>
                            </div>
                        </div>
                        <div class="div_checkout margin_bottom_30">
                            <div class="row" id="checkout_row">
                                <label for="">E-mail*</label>
                            </div>
                            <div class="row" id="checkout_row">
                                <input type="email" name="email" value="<?php echo $email;?>" readonly="readonly">
                            </div>
                        </div>

                        <div class="row order-btn">
                            <button name="order"><i class="fas fa-shopping-cart"></i> Poruči</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Unosenje podataka KRAJ -->
            <!-- Prikaz spiska porudzbine -->
            <div class="checkout-column margin_bottom_30">
                <table class="tabela-cart">
                    <tr>
                        <th colspan="2">Porudžbenica</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="cart-info margin_bottom_30">
                                <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                                <div>
                                    <p><?php echo $porudzbenica ?></p>
                                </div>
                            </div>
                            <div class="total-price">
                                <table class="price-table">
                                    <tr>
                                        <td>Ukupno</td>
                                        <td> <?= number_format($grand_total,2); ?> RSD</td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <!-- Prikaz spiska porudzbine KRAJ -->
        </div>
    </div>
</section>
<?php include('delovi/footer.php'); ?>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
  <script src="js/script.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {

    // Sending Form data to the server
    $("#placeOrder").submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: 'action.php',
        method: 'post',
        data: $('form').serialize() + "&action=order",
        success: function(response) {
          $("#checkout").html(response);
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
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
  <?php 
    }else{
        header('location: cart.php');
    }
  ?>
</body>

</html>