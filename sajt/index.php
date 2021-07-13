<?php include('delovi/header-index.php');?>

<section class="home-section" id="home">
    <div class="home-bg"></div>
    <div class="container">
        <div class="row min-vh-100 align-items-center">
            <div class="home-text">
                <h1>Mi nudimo najbržu dostavu</h1>
                <a href="#our-menu" class="btn btn-default">Naš jelovnik</a>
            </div>
        </div>
    </div>
</section>

<section class="status-section" id="status">
    <div class="row" data-aos="fade-up">
        <div class="section-title margin_bottom_30">
            <h2 class="black_color">Kako poručiti?</h2>
        </div>
    </div>
    <div class="row align-items-center" id="div_status" data-aos="fade-up">
        <div class="column_status margin_bottom_30">
            <img src="img/status11.png" height="150px" width="150px" alt="">
            <br>
            <h4>1. Odabereš svoju omiljenu hranu iz našeg restorana</h4>
        </div>
        <div class="column_status margin_bottom_30">
            <img src="img/status12.png"  height="170px" width="200px" alt="">
            <br>
            <h4>2. Uneseš adresu gde želiš da ti bude dostavljeno</h4>
        </div>
        <div class="column_status margin_bottom_30">
            <img src="img/status3.png"  height="150px" width="150px" alt="">
            <br>
            <h4>3. U roku od sat vremena kurir će ti dostaviti hranu!</h4>
        </div>
    </div>
</section>
<!-- O nama sekcija pocetak -->
<section class="about-section sec-padding" id="about">
    <div class="container">
        <div class="row">
            <div class="section-title" data-aos="zoom-in">
                <h2 data-title="our story">O nama</h2>
            </div>
        </div>
        <div class="row">
            <div class="about-text" data-aos="fade-right">
                <h3>Dobrodošli...</h3>
                <p>
                Ono kada zbog previše obaveza nemaš vremena da spremiš hranu ili posetiš naš restoran.. 
                Znamo taj osećaj! Zato smo mi sada tu, da ti na tvoju adresu brzo, jednostavno i sigurno dostavimo najukusnija jela iz našeg restorana!
                </p>
                <a href="#our-menu" class="btn btn-default">Jelovnik</a>
            </div>
            <div class="about-img">
                <div class="img-box" data-aos="fade-left">
                    <img src="img/about-us.jpeg" alt="about-image">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- O nama sekcija kraj -->
<!-- Prikaz menija restorana -->
<section class="menu-section sec-padding" id="our-menu">
    <div class="container">
        <div class="row">
            <div class="section-title" data-aos="zoom-in">
                <h2 data-title="order now">Jelovnik</h2>
            </div>
        </div>
        <div class="row" data-aos="fade-up">
            <div id="message"></div>
            <div class="menu-tabs">
                <?php 
                    //INLINE IMENA KATEGORIJA
                    //uzimanje samo prve kategorije da bi joj se dodelila klasa active
                    $sql_only_first = "SELECT * FROM tbl_category ORDER BY id ASC LIMIT 1";
                    $res_only_first = mysqli_query($conn, $sql_only_first);
                    if($res_only_first==TRUE){
                        $count_only_first = mysqli_num_rows($res_only_first); 
                        if($count_only_first>0){
                            while($rows_only_first=mysqli_fetch_assoc($res_only_first))
                            {
                                $id_only_first=$rows_only_first['id'];
                                $title_only_first=$rows_only_first['title'];
                            ?>
                                 <button type="button" class="menu-tabs-item active" data-target="#<?php echo $title_only_first; ?>"><?php echo $title_only_first; ?></button>
                            <?php
                            }
                        }
                    }
                    
                    //INLINE IMENA KATEGORIJA
                    //uzimanje svih ostalih kategorija osim prve, sve ostale nece biti klase active (tek kada se klikne na njih postace active)
                    $sql_except_first = "SELECT * FROM tbl_category WHERE id NOT IN (SELECT MIN(id) FROM tbl_category)";
                    $res_except_first = mysqli_query($conn, $sql_except_first);

                    if($res_except_first==TRUE){
                        $count_except_first = mysqli_num_rows($res_except_first); 
                        if($count_except_first>0){
                            while($rows_except_first=mysqli_fetch_assoc($res_except_first))
                            {
                                $id_except_first = $rows_except_first['id'];
                                $title_except_first=$rows_except_first['title'];

                                //provera da li ima uopste u jelovniku stavki sa datom kategorijom, ako nema ta kategorija se ne prikazuje
                                $sql_check_is_empty = "SELECT * FROM tbl_food WHERE categoryID = '$id_except_first' AND active = 'yes'";
                                $res_check_is_empty = mysqli_query($conn, $sql_check_is_empty);
                                $count_check_is_empty = mysqli_num_rows($res_check_is_empty);
                                if($count_check_is_empty>0){
                                ?>
                                    <button type="button" class="menu-tabs-item" data-target="#<?php echo $title_except_first; ?>"><?php echo $title_except_first; ?></button>
                                <?php
                                }
                            }
                        }
                    }
                ?>
            </div>
        </div>
        
        <!-- PRIKAZIVANJE JELOVNIKA ZA AKTIVNU KATEGORIJU -->
        <!-- uzimanje prve kategorije iz baze kako bi ona bila aktivna pri ucitavanju stranice -->
        <div class="row menu-tab-content active" id="<?php echo $title_only_first; ?>"  data-aos="fade-up">
            <?php

                $stmt = $conn->prepare("SELECT * FROM tbl_food WHERE categoryID = '$id_only_first' AND active = 'yes'");
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()):

            ?>
                    <div class="card-container">
                        <div class="card-image">
                            <img src="img/<?php echo $row['image_name'] ?>" alt="">
                        </div>

                        <div class="card-information">
                            <h1 class="heading"><?php echo $row['title'] ?></h1>
                            <p class="para"><?php echo $row['description'] ?></p>
                        </div>

                        <div class="detail-box">
                            <h3><?php echo $row['price']?> RSD</h3>
                        </div>

                        <form action="" class="form-submit">
                            <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                            <input type="hidden" class="pname" value="<?= $row['title'] ?>">
                            <input type="hidden" class="pprice" value="<?= $row['price'] ?>">
                            <input type="hidden" class="pimage" value="<?= $row['image_name'] ?>">
                            <input type="hidden" class="pcode" value="<?= $row['id'] ?>">
                            <button data-aos="zoom-in" class="poruci" type="submit"><i class="las la-cart-arrow-down"></i>  Add to cart</button>
                        </form>
                    </div>
            <?php endwhile; ?>
        </div>
            <!-- PRIKAZIVANJE JELOVNIKA ZA OSTALE KATEGORIJE -->
            <!-- Uzimanje svih ostalih kategorija osim prve koja je vec prikazana, ostale nisu aktivne pri ucitavanju stranice -->
            <?php 
                $sql_category = "SELECT * FROM tbl_category WHERE id NOT IN (SELECT MIN(id) FROM tbl_category)";
                // $res_category = mysqli_query($conn, $sql_category);
                $res_category1 = mysqli_query($conn, $sql_category);
                    if($res_category1==TRUE){
                        $count_category1 = mysqli_num_rows($res_category1); 
                        if($count_category1>0){
                            while($rows_category1=mysqli_fetch_assoc($res_category1))
                            {
                                $id_category1=$rows_category1['id'];
                                $title_category1=$rows_category1['title'];
            ?>
                                <!-- Prikazivanje proizvoda koji pripadaju datoj kategoriji iznad i aktivni su -->
                                <div class="row menu-tab-content" id="<?php echo $title_category1; ?>"  data-aos="fade-up">
                                    <?php
                                        $stmt = $conn->prepare("SELECT * FROM tbl_food WHERE categoryID = '$id_category1' AND active = 'yes'");
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        while ($row = $result->fetch_assoc()):
                                            ?>
                                            <div class="card-container">
                                                <div class="card-image">
                                                    <img src="img/<?php echo $row['image_name'] ?>" alt="">
                                                </div>

                                                <div class="card-information">
                                                    <h1 class="heading"><?php echo $row['title'] ?></h1>
                                                    <p class="para"><?php echo $row['description'] ?></p>
                                                </div>

                                                <div class="detail-box">
                                                        <h3><?php echo $row['price']?> RSD</h3>
                                                </div>

                                                <form action="" class="form-submit">
                                                    <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                                                    <input type="hidden" class="pname" value="<?= $row['title'] ?>">
                                                    <input type="hidden" class="pprice" value="<?= $row['price'] ?>">
                                                    <input type="hidden" class="pimage" value="<?= $row['image_name'] ?>">
                                                    <input type="hidden" class="pcode" value="<?= $row['id'] ?>">
                                                    <button data-aos="zoom-in" class="poruci" type="submit"><i class="las la-cart-arrow-down"></i>  Add to cart</button>
                                                </form>
                                            </div>
                                    <?php endwhile; ?>
                                </div>
                    <?php   
                            }
                        }
                    }
                    ?>
    </div>
</section>
<!-- kraj prikazivanja menija restorana -->

<!-- subscription pocetak -->
<section class="subscription-section" id="subscription">
    <div class="subscribe" data-aos="zoom-in">
        <form action="" method="POST">
            <div class="row" id="subscribe">
                <h3>Pretplati se na naš newsletter!</h3>
            </div>
            <div class="row" id="subscribe">
                <p>Pretplati se na naš newsletter i dobijaš kod za <strong>10%</strong> popusta! Pored toga slaćemo ti sve akcije koje budemo imali u našem restoranu!</p>
            </div>
            <div class="row" id="subscribe">
                <input type="email" name="email_subscribe" placeholder="Unesi svoju e-mail adresu">
                <button type="submit" name="subscribe">Pretplati se</button>
            </div>
        </form>
        <?php 
        if(isset($_POST['subscribe']))
        {
            $email_subscribe = $_POST['email_subscribe'];
            if($email_subscribe!='')
            {
                $sql_subscribe = $conn->prepare("INSERT INTO subscription SET email = '$email_subscribe'");
                $sql_subscribe->execute();

                if($sql_subscribe)
                {
                    // $_SESSION['success_subscription'] = "Hvala na pretplati! Dobili ste kupon sa 10% popusta! Kupon: <strong>OFF10</strong>";
                    ?>
                    <script>
                        alert("Kupon kod je: POPUST10");
                        // window.location.href='index.php#subscription';
                    </script>
                    <?php
                }else{
                    $_SESSION['error_subscription'] = "Doslo je do greske";
                    ?>
                    <script>window.location.href='add-user.php';</script>
                    <?php
                }
            }
        }
        ?>
	</div>
</section>
<!-- subscription kraj -->

<!-- kuvari pocetak -->
<section class="team-section-sec-padding" id="team">
    <div class="container">
        <div class="row">
            <div class="section-title" data-aos="zoom-in">
                <h2 data-title="our story" class="black_color">Naši kuvari</h2>
            </div>
        </div>
        <div class="row" >
            <div class="team-item" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                <img src="img/chef3.jpg" alt="">
                <div class="team-item-info">
                    <h3>Miloš Janković</h3>
                    <p>Šef kuhinje</p>
                </div>
            </div>
            <div class="team-item" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                <img src="img/chef6.jpg" alt="">
                <div class="team-item-info">
                    <h3>Aleksa Milošević</h3>
                    <p>Glavni kuvar</p>
                </div>
            </div>
            <div class="team-item" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                <img src="img/chef9.jpg" alt="">
                <div class="team-item-info">
                    <h3>Nikola Avramović</h3>
                    <p>Pomoćni kuvar</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('delovi/footer.php'); ?>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

<script type="text/javascript">
  $(document).ready(function() {

    // Slanje podataka na action.php
    $(".poruci").click(function(e) {
      e.preventDefault();
      var $form = $(this).closest(".form-submit");
      var pid = $form.find(".pid").val();
      var pname = $form.find(".pname").val();
      var pprice = $form.find(".pprice").val();
      var pimage = $form.find(".pimage").val();
      var pcode = $form.find(".pcode").val();
    
      var pqty = 1;

      $.ajax({
        url: 'action.php',
        method: 'post',
        data: {
          pid: pid,
          pname: pname,
          pprice: pprice,
          pqty: pqty,
          pimage: pimage,
          pcode: pcode
        },
        success: function(response) {
          $("#message").html(response);
        load_cart_item_number();
        }
      });
    });
    
    // Ucitavanje broja proizvoda u korpi
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
<script src="js/script.js"></script>
<script src="js/aos.js"></script>
</html>