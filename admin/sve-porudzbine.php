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
                <br>
                <p>Ovde su prikazane sve porudžbine u prethodnih 30 dana!</p>
            </div>
            <br>
            <div class="row">
                <select name="state" id="maxRows">
                    <option value="5000">Show All</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                </select>
            </div>
            <div class="row" id="search_orders">
                <form action="" method="POST" class="forma">
                    <input type="text" name="search_username" placeholder="Pretraži po username">
                    <button>Pretraži</button>
                </form>
            </div>
                <div class="table-grid" >
                    <div class="table-responsive">
                        <table width="100%" class="content-table" id="mytable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Korisnik</th>
                                    <th>Narudžbenica</th>
                                    <th>Cena</th>
                                    <th>Završeno</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if(isset($_POST['search_username']))
                                {
                                    $searchKey_username = $_POST['search_username'];

                                    $sql = "SELECT * FROM orders INNER JOIN tbl_admin ON orders.usernameID=tbl_admin.id WHERE username = '$searchKey_username' AND DATE(time) > (NOW() - INTERVAL 30 DAY);";
                                }else{
                                    $sql = "SELECT *
                                    FROM orders
                                    INNER JOIN tbl_admin ON orders.usernameID=tbl_admin.id WHERE DATE(time) > (NOW() - INTERVAL 30 DAY);";
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
                <div class="pagination-container">
                    <nav>
                        <ul class="pagination">

                        </ul>
                    </nav>
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
        <script src="../js/jquery.min.js"></script>
        <script>
        var table = '#mytable'
        $('#maxRows').on('change',function(){
            $('.pagination').html('')
            var trnum = 0
            var maxRows = parseInt($(this).val())
            var totalRows = $(table+' tbody tr').length
            $(table+' tr:gt(0)').each(function(){
                trnum++
                if(trnum > maxRows){
                    $(this).hide()
                }
                if(trnum <= maxRows){
                    $(this).show()
                }
            })
            if(totalRows > maxRows){
                var pagenum = Math.ceil(totalRows/maxRows)
                for(var i=1;i<=pagenum;){
                    $('.pagination').append('<li data-page="'+i+'">\<span>'+ i++ +'<span class="sr-only">(current)</span></span>\</li>').show()
                
                }
            }

            $('.pagination li:first-child').addClass('active')
            $('.pagination li').on('click',function(){
                var pageNum = $(this).attr('data-page')
                var trIndex = 0;
                $('.pagination li').removeClass('active')
                $(this).addClass('active')
                $(table+' tr:gt(0)').each(function(){
                    trIndex++
                    if(trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
                        $(this).hide()
                    } else{
                        $(this).show()
                    }
                })
            })    
        })
        
        $(function(){
            $('table tr:eq(0)').prepend('<th>ID</th>')
            var id=0;
            $('table tr:gt(0)').each(function(){
                id++
                $(this).prepend('<td>'+id+'</td>')
            })
        })
        </script>
    </body>
</html>
