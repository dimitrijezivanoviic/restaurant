<?php
	session_start();
	require 'config.php';
	if(isset($_SESSION['user']))
	{
		$username=$_SESSION['user'];
		$sql_admin = "SELECT * FROM tbl_admin WHERE username='$username'";
		$res_admin = mysqli_query($conn, $sql_admin);
		$row_admin=mysqli_fetch_array($res_admin);

		$id_username=$row_admin['id'];

		// Dodavanje proizvoda u korpu
		if (isset($_POST['pid'])) {
		$pid = $_POST['pid'];
		$pname = $_POST['pname'];
		$pprice = $_POST['pprice'];  
		$pimage = $_POST['pimage'];
		$pcode = $_POST['pcode'];
		$pqty = $_POST['pqty'];
		$total_price = $pprice * $pqty;
		$broj_nasumicno = 128;

		$stmt = $conn->prepare('SELECT product_code FROM cart WHERE product_code=? AND usernameID=?');
		$stmt->bind_param('ss',$pcode,$id_username);
		$stmt->execute();
		$res = $stmt->get_result();
		$r = $res->fetch_assoc();
		$code = $r['product_code'] ?? '';

		if (!$code) {
			$query = $conn->prepare('INSERT INTO cart (product_name,product_price,product_image,qty,total_price,product_code,usernameID) VALUES (?,?,?,?,?,?,?)');
			$query->bind_param('sssssss',$pname,$pprice,$pimage,$pqty,$total_price,$pcode,$id_username);
			$query->execute();

			echo '<div class="succes_message">
							<strong>Proizvod je uspešno dodat u korpu!</strong>
							</div>';
		} else {
			echo '<div class="error_message">
							<strong>Proizvod je već dodat u korpu!</strong>
							</div>';
			}
		}
	}

	// Racunanje broja proizvoda u korpi
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	  $stmt = $conn->prepare('SELECT * FROM cart WHERE usernameID=?');
	  $stmt->bind_param('s',$id_username);
	  $stmt->execute();
	  $stmt->store_result();
	  $rows = $stmt->num_rows;

	  echo $rows;
	}

	// Brisanje proizvoda iz korpe
	if (isset($_GET['remove'])) {
	  $id = $_GET['remove'];

	  $stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
	  $stmt->bind_param('i',$id);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';
	  header('location:cart.php');
	}


	// Postavljanje total_price za proizvod kada se kolicina promeni
	if (isset($_POST['qty'])) {
	  $qty = $_POST['qty'];
	  $pid = $_POST['pid'];
	  $pprice = $_POST['pprice'];

	  $tprice = $qty * $pprice;

	  $stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
	  $stmt->bind_param('isi',$qty,$tprice,$pid);
	  $stmt->execute();
	}

	// Ubacivanje porudzbine u tabelu order
	if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$products = $_POST['products'];
		$product_prikaz = $_POST['products_prikaz'];
		$grand_total = $_SESSION['total_popust'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		// $pmode = $_POST['pmode'];
		$status = 'ordered';
		$membership = 'no';
		date_default_timezone_set('CET');
		$start = date("Y/m/d H:i:s");
		$vreme_porudzbine = date("H:i:s");
		$ordered_time = date('Y/m/d H:i:s',strtotime('+45 minutes',strtotime($start)));

		$name = $first_name . ' ' . $last_name;
		
  
		$data = '';
  
		$stmt = $conn->prepare('INSERT INTO orders (name,email,usernameID,phone,city,address,products,amount_paid,order_status,membership_order,time)VALUES(?,?,?,?,?,?,?,?,?,?,?)');
		$stmt->bind_param('sssssssssss',$name,$email,$id_username,$phone,$city,$address,$products,$grand_total,$status,$membership,$ordered_time);
		$stmt->execute();
		$stmt2 = $conn->prepare('DELETE FROM cart WHERE usernameID=?');
		$stmt2->bind_param('s',$id_username);
		$stmt2->execute();
		$data .= '<section class="successfull_order">
						<img src="img/ordered.png">
								  <h2>Kod vas će biti za 45 minuta!</h2>
								  <small>Vreme porudžbine ' . $vreme_porudzbine . '</small>
								  <div class="row margin_bottom_10">
								 	<div class="col-md-4"><h4><i class="fas fa-hamburger"></i> Proizvodi:</h4></div> 
									 <div class="col-md-4" id="spisak" ><h4>' . $product_prikaz . '</h4></div>
								  </div>
								  <h4><i class="fas fa-map-marker-alt"></i> Vaše ime: ' . $name . '</h4>
								  <h4><i class="fas fa-phone-alt"></i> Broj telefona: ' . $phone . '</h4>
								  <h4><i class="far fa-credit-card"></i> Ukupna cena: ' . number_format($grand_total,2) . ' RSD</h4>
							</section>';
		echo $data;
	  }
?>