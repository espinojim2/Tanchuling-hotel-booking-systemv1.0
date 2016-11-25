<?php
require_once("includes/initialize.php");
$status=$_GET['status'];
$code=$_GET['code'];
$type=$_GET['type'];

if($status=='Confirmed' && $type=='notadmin'){
echo "<div class='alert alert-warning'>You cannot edit this Transaction</div>";
}
else if($status=='CheckedIn' && $type=='notadmin'){
echo "<div class='alert alert-warning'>You cannot edit this Transaction. Got to the Administrator to do this for you</div>";	
}
else if($status=='Cancelled'){
echo "<div class='alert alert-warning'>You cannot edit this Transaction because its cancelled</div>";	
}
else if($status=='Checkout'){
echo "<div class='alert alert-warning'>You cannot edit this Transaction</div>";	
}
else{


	 $query="SELECT * 
				FROM  `tblreservation` as r,   `tblroom` as rm, tblaccomodation as a
				WHERE r.`ROOMID` = rm.`ROOMID` 
				AND a.`ACCOMID` = rm.`ACCOMID` 
				AND r.`CONFIRMATIONCODE`='".$code."'"; 
				
$q=mysql_query($query);
$r=mysql_fetch_assoc($q);



$q0=mysql_query("select * from tblpayment_type where CONFIRMATIONCODE='$code';");
$r0=mysql_fetch_assoc($q0);
$ptype=$r0['ptype'];

$q1=mysql_query("select * from tblpayment_image where CONFIRMATIONCODE='$code';");
$r1=mysql_fetch_assoc($q1);


$imgid1=$r1['imgid'];

$q2=mysql_query("select * from tbl_image where imgid='$imgid1'");
$r2=mysql_fetch_assoc($q2);

$location=$r2['location'];
$loc=(count($r2)==0)?"":"<img src='admin/$location' style='width:30%;'>";

$d1=new Datetime($r['ARRIVAL']);
$arrival111=$d1->format("Y-m-d");


$d2=new Datetime($r['DEPARTURE']);
$departure111=$d2->format("Y-m-d");
?>
<div class='row' style='padding:2%;'>
<div  class='col-sm-7'>
<h3>Edit Booking Info</h3><hr>



<?php


$day = (dateDiff($arrival111,$departure111)>0)?dateDiff($arrival111,$departure111):'1';




echo "
<div style='padding:3%;'>
<div class='row'>
<div class='col-sm-12'>
<label>Confirmation Code : </label>
".$r['CONFIRMATIONCODE']."
</div>
</div>

<div class='row'>
<div class='col-sm-12'>
<label>Room : </label>
".$r['ROOM']."
 ".$r['ROOMDESC']."
</div>
</div>


<div class='row'>
<div class='col-sm-12'>
<label>Amount : </label>
".$r['RPRICE']."
</div>
</div>

<div class='row'>
<div class='col-sm-12'>
<label>Installment Amount : </label>
".$r['RINSTALLMENT']."
</div>
</div>

<div class='row'>
<div class='col-sm-12'>
<label>Days : </label>
".$day."
</div>
</div

<div class='row'>
<div class='col-sm-12'>
<label>Total Amount : </label>
".($r['RPRICE']*$day)."
</div>
</div


<div class='row'>
<div class='col-sm-12'>
<label>Status : </label>
".$r['STATUS']."
</div>
</div>
</div><hr>
";






?>





<input type='hidden' id='code' value='<?= $code; ?>'>
<div style='margin:2%;'>
<div class='row'>
<div class='col-sm-12'>
<label>Arrival/Check-In Date</label>
 <input type="text" data-date="" data-date-format="yyyy-mm-dd" data-link-field="any" 
                               data-link-format="yyyy-mm-dd"
                               name="arrival" id="date_pickerfrom"  
                               value="<?php echo isset($arrival111) ? $arrival111 :date('Y-m-d');?>"
                                readonly="true" class=" input-sm form-control">

</div>
</div>


<div class='row'>
<div class='col-sm-12'>
<label>Departure/Check-Out Date</label>
 <input type="text" data-date="" data-date-format="yyyy-mm-dd" data-link-field="any" 
                               data-link-format="yyyy-mm-dd"
                               name="departure" id="date_pickerto"  
                               value="<?php echo isset($departure111) ? $departure111 :date('Y-m-d');?>"
                                readonly="true" class=" input-sm form-control">

</div>
</div>

  
<div><h3>Payment Image</h3></div>
<div>
  <input type='text' style='visibility:hidden;' id='slide_imgid0' name='slide_imgid0' value='<?= $imgid1; ?>'>
            <div id="img_here0"><?= $loc; ?></div>
            <div><input type='file' name='slidepic0' id='slidepic0' onchange='SYS_imageUpload1(0)'></div>
</div>
 
<script type="text/javascript">
<?php
echo "$(document).ready(function(){
	$('#ptype').val($ptype);
});

";
?>
</script>
 <div class='row' style='padding:2%;'>
<label>Payment Type</label>
<select id='ptype' name='ptype' onchange='setTotalOption()'>
  <option value='1'>Pay Total Amount</option>
 
<?php
  echo ($_SESSION['total_installment']!="0")?"<option value='2'>Installment</option>":"";
?>

</select>
 </div>

 <div class='row' style='padding:2%;'>
<button class='btn btn-primary' onclick='SaveBookingchanges()'>Save</button>
<button class='btn btn-default' onclick='CancelBookingSave()'>Cancel Booking</button>
 </div>


</div>
<div class='col-sm-5'>
</div>
</div>
</div>
<?php
}

?>
<script type="text/javascript">
$(document).ready(function(){
 $('#date_pickerfrom').datetimepicker({
  format: 'yyyy-mm-dd',
    language:  'en',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1, 
    startView: 2,
    minView: 2,
    forceParse: 0 

    });


$('#date_pickerto').datetimepicker({
  format: 'yyyy-mm-dd',
    language:  'en',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1, 
    startView: 2,
    minView: 2,
    forceParse: 0   

    }); 
});
</script>
