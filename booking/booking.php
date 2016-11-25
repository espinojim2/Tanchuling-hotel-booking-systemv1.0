
<?php

// if (@$_SESSION['from']==""){
//   message("Please Choose check in Date and Check out Out date to continue reservation!", "error");
//   redirect(WEB_ROOT.'index.php?page=5');
 
// }
// if (@$_SESSION['to']==""){
//   message("Please Choose check in Date and Check out Out date to continue reservation!", "error");
//   redirect(WEB_ROOT.'index.php?page=5');
// }


//   $arrival = $_SESSION['from']; 
//  $departure = $_SESSION['to'];


 /*if(!isset($_POST['adults'])){
    message("Choose from Adults!", "error");  
    redirect(".WEB_ROOT. 'booking/");
    //exit;
 }*/
 /* if(isset($_POST['adults'])&&isset($_POST['child'])){
    $_SESSION['roomid']=$_POST['roomid'];
  $_SESSION['adults'] = $_POST['adults'];
  $_SESSION['child']  = $_POST['child'];
   */

if(isset($_GET['id'])){
    removetocart($_GET['id']);
}

 
 if (isset($_POST['clear'])){
   unset($_SESSION['pay']);
   unset($_SESSION['monbela_cart']);
   message("The cart is empty.","success");
  redirect(WEB_ROOT."booking/");

 }

 
 
?>
 
 <div id="accom-title"  > 
    <div  class="pagetitle">   
            <h1  >Your Booking Cart 
                 
            </h1> 
        </div> 
  </div>
<div id="bread">
   <ol class="breadcrumb">
      <li><a href="<?php echo WEB_ROOT ;?>index.php">Home</a>
      </li>
      <li class="active">Booking Cart</li>
      <!-- <li  style="color: #02aace; float:right"> <?php print  $msg; ?></li> -->
  </ol> 
</div>

 <div style='padding:2%;'>
          <table class="table table-hover">

             <thead>
              <tr  bgcolor="#999999">
              <!-- <th width="10">#</th> -->
              <th align="center" width="120">Room</th>
              <th align="center" width="120">Check In</th>
              <th align="center" width="120">Check Out</th> 
              <th  width="120">Installment Amount</th>
              <th  width="120">Price</th> 
              <th align="center" width="120">Nights</th>
              <th align="center" width="90">Total Amount</th>
              <th align="center" width="90">Total Installment Amount</th>
              <th align="center" width="90">Action</th> 
            </tr> 
          </thead>
          <tbody>
              
            <?php 

             $payable = 0;  $total_installment=0;
            if (isset( $_SESSION['monbela_cart'])){


             $count_cart = count($_SESSION['monbela_cart']);

                for ($i=0; $i < $count_cart  ; $i++) {  

                    $query = "SELECT * FROM `tblroom` r ,`tblaccomodation` a WHERE r.`ACCOMID`=a.`ACCOMID` AND ROOMID=" . $_SESSION['monbela_cart'][$i]['monbelaroomid'];
                     $mydb->setQuery($query);
                     $cur = $mydb->loadResultList(); 
                      foreach ($cur as $result) { 

                        $totinstall=($_SESSION['monbela_cart'][$i]['monbeladay']*$result->INSTALLMENT_AMOUNT);


                      $date=date("Y-m-d");
                      $q1=@mysql_query("select * from tbl_promos where (start_date <= '$date' and end_date >= '$date') and ROOMID='".$result->ROOMID."' and remark='1'");
                      $r1=@mysql_fetch_assoc($q1);
                        $price=(@mysql_num_rows($q1)==0)?$result->PRICE:$r1['promo_price'];

                         echo '<tr>'; 
                        // echo '<td></td>';
                        echo '<td>'. $result->ROOM.' '. $result->ROOMDESC.' </td>';
                        echo '<td>'.date_format(date_create( $_SESSION['monbela_cart'][$i]['monbelacheckin']),"m/d/Y").'</td>';
                        echo '<td>'.date_format(date_create( $_SESSION['monbela_cart'][$i]['monbelacheckout']),"m/d/Y").'</td>';
                        
                         echo '<td > &#8369 '. $result->INSTALLMENT_AMOUNT.'</td>'; 
                        echo '<td > &#8369 '. $price.'</td>';
                        $_SESSION['monbela_cart'][$i]['monbelaroomprice']=$price;
                        echo '<td>'.$_SESSION['monbela_cart'][$i]['monbeladay'].'</td>';
                        echo '<td > &#8369 '. $_SESSION['monbela_cart'][$i]['monbelaroomprice'].'</td>';
                        echo '<td > &#8369 '.$totinstall.'</td>';
                        echo '<td ><a href="index.php?view=processcart&id='.$result->ROOMID.'">Remove</td>';


                        
                          
                      }
                          
                    $_SESSION['monbela_cart'][$i]['monbelaroominstallmentprice']=$totinstall;
                      $payable += $_SESSION['monbela_cart'][$i]['monbelaroomprice'] ;
                     $total_installment+=$totinstall;

 

                 
                }

                $_SESSION['pay'] = $payable;
                $_SESSION['total_installment'] = $total_installment;
  
              } 
            ?>
          </tbody>
          <tfoot>
            <tr>
           <td colspan="5"><h4 align="right">Total :</h4></td>
           <td colspan="5">
             <h4><b> <?php  echo isset($_SESSION['pay']) ? ' &#8369 '. number_format($_SESSION['pay'],2) :'Your booking cart is empty.';?></b></h4>
                         
            </td>
            </tr>
            <tr>
           <td colspan="5"><h4 align="right">Total (Installment):</h4></td>
           <td colspan="5">
             <h4><b> <?php  echo isset($_SESSION['total_installment']) ? ' &#8369 '. number_format($_SESSION['total_installment'],2) :'';?></b></h4>
                         
            </td>
            </tr>
          </tfoot>  
        </table> 
        <form method="post" action="">
             <div class="col-xs-12 col-sm-12" align="right">
             <?php
             if (isset($_SESSION['monbela_cart'])){
              ?>
                <a  href="<?php echo WEB_ROOT; ?>index.php?p=rooms" class="btn btn-primary" align="right"name="clear">Add Another Room</a>
             <button type="submit" class="btn btn-primary" align="right"name="clear">Clear Cart</button>
             <?php
             
              if (isset($_SESSION['GUESTID'])){
                ?>
                <a href="<?php echo WEB_ROOT; ?>booking/index.php?view=payment" class="btn btn-primary" align="right"name="continue">Continue Booking</a>
               <?php 
              }else{ ?>
                 <a href="<?php echo WEB_ROOT; ?>booking/index.php?view=logininfo" class="btn btn-primary"   align="right"name="continue">Continue Booking</a>
             <?php
              }
            }else{


            }

             ?>
     
               
          </div>
                  
        </form>
       </div>