<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$code=$_GET['code'];

$q=@mysql_query("select * from tblreservation where CONFIRMATIONCODE='$code';");
$r=@mysql_fetch_assoc($q);

$date11=new Datetime($r['DEPARTURE']);
$departure=$date11->format("Y-m-d");

$date22=new Datetime($r['DEPARTURE']);
$arrival=$date22->format("Y-m-d");





?>
<script type="text/javascript">
function changenoofDay(){
var dep1=$('#date_picker1').val();
var nodaye=$('#additionalday').val();
$.post("Adddate.php",{dep1:dep1,nodaye:nodaye}).done(function(data){
$('#date_dep2').val(data);
});
}
</script>

<?php
if(isset($_POST['submit'])){
$addday=$_POST['additionalday'];
$newdate=$_POST['date_dep12'];
$code1=$_POST['code'];


$msg="";




$day = (dateDiff($arrival,$departure)>0)?dateDiff($arrival,$departure):'1';
    

$q2=@mysql_query("select * from tblreservation where CONFIRMATIONCODE='$code'");
$r2=@mysql_fetch_assoc($q2);
$rprice=(@mysql_num_rows($q2)==0)?"":$r2['RPRICE'];
$rinstallment=(@mysql_num_rows($q2)==0)?"":$r2['RINSTALLMENT'];
$sprice=$rprice*$day;
$sinstallment=$rinstallment*$day;
$sql="";

$sql.="update tblpayment set SPRICE='$sprice',INSTALLMENT_PRICE='$sinstallment' where CONFIRMATIONCODE='$code1';";

$sql.="update tblreservation set ARRIVAL='$arrival',DEPARTURE='$newdate' where CONFIRMATIONCODE='$code1';";









if($msg==""){
$e=explode(";",$sql); $b=true;
@mysql_query("begin;");
for($y=0;$y<count($e)-1;$y++){
$q1=@mysql_query($e[$y]);
$b=$b && $q1;  
}
if($b){ @mysql_query("commit"); }else{ @mysql_query("rollback"); }

echo "<div class='alert alert-success'>Saved Successfully <a href='index.php'>Go back to Reservations</a></div>";

}
else{
echo "<div class='alert alert-error'>Error in saving</div>";    
}








}



?>
<form method='POST' >
	<hr>
	<input type='text' style='visibility:hidden;' name='code' value="<?= $code; ?>">


<div class='row'>
<div class='col-sm-12'>
<label>Arrival/Checkin Date (YYYY-mm-dd): <?= $arrival; ?></label>
</div>
</div>


<div class='row'>
<div class='col-sm-7'>
<div class='row'>
<div class='col-sm-12'>
<label>Departure/Checkout Date (YYYY-mm-dd)</label>
<input type="text" data-date="" data-date-format="yyyy-mm-dd" data-link-field="any" data-link-format="yyyy-mm-dd" name="arrival" id="date_picker1" value="<?= $departure; ?>" readonly="true" class="dbirth input-sm form-control" disabled>
</div>
</div>

<div class='row' style='margin-top:2%; margin-bottom:2%;'>
<div class='col-sm-12'>
<label>Additional No. of Day/s</label>
<input type="number" id='additionalday' name='additionalday' min='0' value='0'  onchange='changenoofDay()'>
</div>
</div>


<div class='row'>
<div class='col-sm-12'>
<label>New Departure/Checkout Date (YYYY-mm-dd)</label>
<input type="text" data-date="" data-date-format="yyyy-mm-dd" data-link-field="any" data-link-format="yyyy-mm-dd"  name='date_dep12' id="date_dep2" value="<?= $departure; ?>"  class=" input-sm form-control" >
</div>
</div>




<div class='row' style='margin-top:2%;'>
<div class='col-sm-12'>
<input type='submit'id='save11' name='submit' value='Save'  class='btn btn-primary'>
</div>
</div>
</div>
<div class='col-sm-5'></div>
</div>
</form>

<br>
<div class="row">
            <ul class="pager">
                </li>
              
            </ul>
        </div>
        <!-- /.row -->

        <hr>