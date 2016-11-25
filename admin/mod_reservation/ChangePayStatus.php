<?php
require_once("../../includes/initialize.php");

$paystat=$_POST['paystat'];
$code=$_POST['code'];
$ptype=$_POST['ptype'];


$q=mysql_query("select * from tblpayment_type where CONFIRMATIONCODE='$code'");
if(mysql_num_rows($q)==0){
mysql_query("insert into tblpayment_type values('$code','$ptype','$paystat');");	
}
else{
mysql_query("update tblpayment_type set pay_status='$paystat',ptype='$ptype' where CONFIRMATIONCODE='$code';");	
}

echo "Updated Successfully!";


?>