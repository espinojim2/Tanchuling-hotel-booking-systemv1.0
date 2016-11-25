<?php
require_once("../../includes/initialize.php");

$roomid=$_POST['roomid'];
$msg="";

@mysql_query("update tbl_promos set remark='0' where ROOMID='$roomid'");






?>