<?php
require_once("includes/initialize.php");
$code=$_POST['code'];
$msg="";
mysql_query("update tblreservation set STATUS='Cancelled' where CONFIRMATIONCODE='$code';");


?>