<?php
require_once("includes/initialize.php");

 $code=$_POST['code'];
 $arrival=$_POST['arrival'];
 $departure=$_POST['departure'];
 $imgid=$_POST['imgid'];
 $ptype=$_POST['ptype'];

$msg="";
$sql="";

$day = (dateDiff($arrival,$departure)>0)?dateDiff($arrival,$departure):'1';
	

$q2=@mysql_query("select * from tblreservation where CONFIRMATIONCODE='$code'");
$r2=@mysql_fetch_assoc($q2);
$rprice=(@mysql_num_rows($q2)==0)?"":$r2['RPRICE'];
$sprice=$rprice*$day;



$sql.="update tblpayment set SPRICE='$sprice' where CONFIRMATIONCODE='$code';";

$sql.="update tblreservation set ARRIVAL='$arrival',DEPARTURE='$departure' where CONFIRMATIONCODE='$code';";
$sql.="update tblpayment_type set ptype='$ptype' where CONFIRMATIONCODE='$code';";
$sql.="update tblpayment_image set imgid='$imgid' where CONFIRMATIONCODE='$code';";



if($msg==""){
$e=explode(";",$sql); $b=true;
@mysql_query("begin;");
for($y=0;$y<count($e)-1;$y++){
$q1=@mysql_query($e[$y]);
$b=$b && $q1;  
}
if($b){ @mysql_query("commit"); }else{ @mysql_query("rollback"); }
}


$a['msg']=$msg;
echo json_encode($a);





?>