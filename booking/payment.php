<script type="text/javascript" language="javascript" src="<?php echo WEB_ROOT; ?>admin/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo WEB_ROOT; ?>admin/assets/uploadz.js" charset="UTF-8"></script>


<?php

if (!isset($_SESSION['monbela_cart'])) {
  # code...
  redirect(WEB_ROOT.'index.php');
}

function createRandomPassword() {

    $chars = "abcdefghijkmnopqrstuvwxyz023456789";

    srand((double)microtime()*1000000);

    $i = 0;

    $pass = '' ;
    while ($i <= 7) {

        $num = rand() % 33;

        $tmp = substr($chars, $num, 1);

        $pass = $pass . $tmp;

        $i++;

    }

    return $pass;

}

 $confirmation = createRandomPassword();
$_SESSION['confirmation'] = $confirmation;



// $arival    = $_SESSION['from']; 
// $departure = $_SESSION['to'];
// echo $name      = $_SESSION['name']; 
// echo $last      = $_SESSION['last'];
// echo $nationality   = $_SESSION['nationality'];
// // echo // $city      = $_SESSION['city'] ;
// echo $address   =  $_SESSION['city'] . ' ' . $_SESSION['address'];
// echo $zip       = $_SESSION['zip'] ;
// echo $phone     = $_SESSION['phone'];
// echo $username     = $_SESSION['username'];
// echo $company     = $_SESSION['company'];
// echo $caddress     = $_SESSION['caddress'];
// echo $password  = $_SESSION['pass'];
// echo $dbirth   = $_SESSION['dbirth'];


 $count_cart = count($_SESSION['monbela_cart']);

if(isset($_POST['btnsubmitbooking'])){
  // $message = $_POST['message'];

 $imgid=(isset($_POST['slide_imgid0']))?$_POST['slide_imgid0']:"";
$ptype=(isset($_POST['ptype']))?$_POST['ptype']:"";
$totalinstallment_val=$_SESSION['total_installment'];
//    $count_cart = count($_SESSION['monbela_cart']);

//   for ($i=0; $i < $count_cart  ; $i++) {     
//   $mydb->setQuery("SELECT * FROM room where roomNo=". $_SESSION['monbela_cart'][$i]['monbelaroomid']);
//   $rmprice = $mydb->executeQuery();
//   while($row = mysql_fetch_assoc($rmprice)){
//     $rate = $row['price']; 
//   }  
// }
//   $payable= $rate*$days;
//   $_SESSION['pay']= $payable;

if(!isset($_SESSION['GUESTID'])){


$guest = New Guest();
$guest->G_FNAME          = $_SESSION['name'];    
$guest->G_LNAME          = $_SESSION['last'];  
$guest->G_CITY           = $_SESSION['city'];
$guest->G_ADDRESS        = $_SESSION['address'] ;        
$guest->DBIRTH           = date_format(date_create($_SESSION['dbirth']), 'Y-m-d');   
$guest->G_PHONE          = $_SESSION['phone'];    
$guest->G_NATIONALITY    = $_SESSION['nationality'];          
$guest->G_COMPANY        = $_SESSION['company'];      
$guest->G_CADDRESS       = $_SESSION['caddress'];        
$guest->G_TERMS          = 1;    
$guest->G_UNAME          = $_SESSION['username'];    
$guest->G_PASS           = sha1($_SESSION['pass']);    
$guest->ZIP              = $_SESSION['zip'];
$guest->create(); 

  $lastguest=mysql_insert_id(); 
   
$_SESSION['GUESTID'] =   $lastguest;

}
 
    $count_cart = count($_SESSION['monbela_cart']);
  

    for ($i=0; $i < $count_cart  ; $i++) { 

            // $rm = new Room();
            // $result = $rm->single_room($_SESSION['monbela_cart'][$i]['monbelaroomid']);

            // if($result->ROOMNUM>0){

            //   $room = new Room(); 
            //   $room->ROOMNUM    = $room->ROOMNUM - 1; 
            //   $room->update($_SESSION['monbela_cart'][$i]['monbelaroomid']); 
      
            // }
            

            $reservation = new Reservation();
            $reservation->CONFIRMATIONCODE  = $_SESSION['confirmation'];
            $reservation->TRANSDATE         = date('Y-m-d h:i:s'); 
            $reservation->ROOMID            = $_SESSION['monbela_cart'][$i]['monbelaroomid'];
            $reservation->ARRIVAL           = date_format(date_create( $_SESSION['monbela_cart'][$i]['monbelacheckin']), 'Y-m-d');  
            $reservation->DEPARTURE         = date_format(date_create( $_SESSION['monbela_cart'][$i]['monbelacheckout']), 'Y-m-d'); 
            $reservation->RPRICE            = $_SESSION['monbela_cart'][$i]['monbelaroomprice']; 
            $reservation->RINSTALLMENT      = $_SESSION['monbela_cart'][$i]['monbelaroominstallmentprice'];
            $reservation->GUESTID           = $_SESSION['GUESTID']; 
            $reservation->PRORPOSE          = 'Travel';
            $reservation->STATUS            = 'Pending';
            $reservation->create(); 

            
            @$tot += $_SESSION['monbela_cart'][$i]['monbelaroomprice'];
            }

           $item = count($_SESSION['monbela_cart']);

      $sql = "INSERT INTO `tblpayment` (`TRANSDATE`,`CONFIRMATIONCODE`,`PQTY`, `GUESTID`, `SPRICE`,`INSTALLMENT_PRICE`,`MSGVIEW`,`STATUS`)
       VALUES ('" .date('Y-m-d h:i:s')."','" . $_SESSION['confirmation'] ."',".$item."," . $_SESSION['GUESTID'] . ",".$tot.",'$totalinstallment_val',0,'Pending')" ;
        mysql_query($sql);

       mysql_query("insert into tblpayment_image values('','$imgid','" . $_SESSION['confirmation'] ."')");
        mysql_query("insert into tblpayment_type values('" . $_SESSION['confirmation'] ."','$ptype','2')");


     // $mydb->setQuery($sql);
     // $msg = $mydb->executeQuery();

    //   $lastreserv=mysql_insert_id(); 
    //   $mydb->setQuery("INSERT INTO `comments` (`firstname`, `lastname`, `email`, `comment`) VALUES('$name','$last','$email','$message')");
    //   $msg = $mydb->executeQuery();
    //   message("New [". $name ."] created successfully!", "success");

  //  unsetSessions();

            unset($_SESSION['monbela_cart']);
            // unset($_SESSION['confirmation']);
            unset($_SESSION['pay']);
             unset($_SESSION['total_installment']);
            unset($_SESSION['from']);
            unset($_SESSION['to']);
            $_SESSION['activity'] = 1;

            ?> 

<script type="text/javascript"> alert("Booking is successfully submitted!");</script>

            <?php
            
    redirect( WEB_ROOT."index.php");


}
?>

<!--  <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="LA2U4NA99P5BC">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/payment.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
 -->
 
 <div id="accom-title"  > 
    <div  class="pagetitle">   
            <h1 >Billing Details 
                 
            </h1> 
        </div> 
  </div>
 
<div id="bread">
   <ol class="breadcrumb">
      <li><a href="<?php echo WEB_ROOT ;?>index.php">Home</a> </li> 
      <li><a href="<?php echo WEB_ROOT ;?>booking/">Booking Cart</a></li> 
      <!-- <li  ><a href="<?php echo WEB_ROOT ;?>booking/index.php?view=logininfo">Verify Accounts</a></li> -->
       <li class="active">Booking Details</li>
   </ol> 
</div> 


<form action="index.php?view=payment" method="post"  name="personal" >

 
<div class="col-md-12" style='padding:4%;'>

  <div class="row">
    <div class="col-md-8 col-sm-4">
       <div class="col-md-12">
          <label>Name:</label>
          <?php echo $_SESSION['name'] . ' '. $_SESSION['last']; 
   echo $count_cart;
           ?>
        </div>
        <div class="col-md-12">
          <label>Address:</label>
          <?php echo isset($_SESSION['city']) ? $_SESSION['city']: ' '. ' ' . isset($_SESSION['address'])  ? $_SESSION['address'] : ' '; ?> 
        </div>
        <div class="col-md-12"> 
        <label>Phone #:</label>
         <?php echo $_SESSION['phone'] ; ?>
        </div>
    </div> 
    <div class="col-md-4 col-sm-2">
      <div class="col-md-12">
        <label>Transaction Date:</label>
       <?php echo date("m/d/Y") ; ?>
      </div>
       <div class="col-md-12">
        <label>Transaction Id:</label>
       <?php echo $_SESSION['confirmation']; ?>
      </div>
      
    </div>
  </div> 
  <br/>




<div class="row">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <td>Room</td>
          <td>Arrival</td>
          <td>Departure</td>
          <td>Price</td>
          <td>Installment Amount</td>
          <td>Night(s)</td>
          <td>Total Price</td>
          <td>Total Installment Amount</td>
          
        </tr>
      </thead> 
      <tbody>
<?php
$payable = 0; $totalinstallment=0;
if (isset( $_SESSION['monbela_cart'])){ 
$count_cart = count($_SESSION['monbela_cart']);


for ($i=0; $i < $count_cart  ; $i++) {  

  $query = "SELECT * FROM `tblroom` r ,`tblaccomodation` a WHERE r.`ACCOMID`=a.`ACCOMID` AND ROOMID=" . $_SESSION['monbela_cart'][$i]['monbelaroomid'];
   $mydb->setQuery($query);
   $cur = $mydb->loadResultList(); 
    foreach ($cur as $result) { 

     $totinstall=($_SESSION['monbela_cart'][$i]['monbeladay'] * $result->INSTALLMENT_AMOUNT);



 $date=date("Y-m-d");
                      $q1=@mysql_query("select * from tbl_promos where (start_date <= '$date' and end_date >= '$date') and remark='1' and ROOMID='".$result->ROOMID."'");
                      $r1=@mysql_fetch_assoc($q1);
                        $price=(@mysql_num_rows($q1)==0)?$result->PRICE:$r1['promo_price'];

?>

      
        <tr>
          <td><?php echo  $result->ROOM.' '. $result->ROOMDESC; ?></td>
          <td><?php echo  date_format(date_create( $_SESSION['monbela_cart'][$i]['monbelacheckin']),"m/d/Y"); ?></td>
          <td><?php echo  date_format(date_create( $_SESSION['monbela_cart'][$i]['monbelacheckout']),"m/d/Y"); ?></td>
          <td><?php echo  ' &#8369 '. $price; ?></td>
          <td><?php echo  ' &#8369 '. $result->INSTALLMENT_AMOUNT; ?></td>
          <td><?php echo   $_SESSION['monbela_cart'][$i]['monbeladay']; ?></td>
          <?php $_SESSION['monbela_cart'][$i]['monbelaroomprice']=$price; ?>
          <td><?php echo ' &#8369 '.   $_SESSION['monbela_cart'][$i]['monbelaroomprice']; ?></td>
          <td><?php echo ' &#8369 '. $totinstall;  ?></td>
             </tr>
<?php
       $payable += $_SESSION['monbela_cart'][$i]['monbelaroomprice'] ;
     $totalinstallment+=$totinstall;
      }

    } 
     $_SESSION['pay'] = $payable;
     $_SESSION['total_installment']=$totalinstallment;
 } 
 ?> 
      </tbody>
    </table>
    <input type='hidden' id='billingcnt' value='<?= $count_cart; ?>'>
  </div> 
</div>

  
<div><h3>Payment Image</h3></div>
<div>
  <input type='text' style='visibility:hidden;' id='slide_imgid0' name='slide_imgid0' value=''>
            <div id="img_here0"></div>
            <div><input type='file' name='slidepic0' id='slidepic0' onchange='SYS_imageUpload1(0)'></div>
</div>
 

 <div class='row' style='padding:2%;'>
<label>Payment Type</label>
<select id='ptype' name='ptype' onchange='setTotalOption()'>
  <option value='1'>Pay Total Amount</option>
 
<?php
  echo ($_SESSION['total_installment']!="0")?"<option value='2'>Installment</option>":"";
?>

</select>
 </div>
<!-- <div class="row">
  <div class="col-md-6 col-sm-3">
      <label>Addons:</label>
        <div class="col-md-12">
           <label>Bed:</label>
        </div>
        <div class="col-md-12">
           <label>Person:</label>
        </div>
        <div class="col-md-12">
          
        </div>
        <div class="col-md-12">
          
        </div>
  </div>
<div class="col-md-6 col-sm-3"></div> 
</div>
<hr/> -->
<script type="text/javascript">
$(document).ready(function(){
total_shwing(1);
});
function setTotalOption(){
 var ptype=$('#ptype').val();
 total_shwing(ptype); 
}
function total_shwing(n){
$('.totala').hide();
$('#total'+n).show();
}

</script>


<div class="row totala" id='total1'> 
  <h3 align="right">Total: &#8369 <?php echo   number_format($_SESSION['pay'],2); ?></h3>
</div>

<div class="row totala" id='total2'> 
  <h3 align="right">Total (Installment): &#8369 <?php echo   number_format($_SESSION['total_installment'],2); ?></h3>
</div>
    <div class="pull-right">
       <button type="submit" class="btn btn-primary" align="right" name="btnsubmitbooking">Submit Booking</button>
    </div>
  </div>   
</form>

 



