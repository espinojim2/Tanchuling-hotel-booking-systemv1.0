<?php
require_once("../../includes/initialize.php");

$roomid=$_POST['roomid'];
$promoprice=$_POST['promoprice'];
$startdate=$_POST['startdate'];
$enddate=$_POST['enddate'];


$msg="";
$sql="";
if(trim($promoprice)==""){ $msg="Please complete the form"; }
else if(trim($startdate)==""){ $msg="Please complete the form"; }
else if(trim($enddate)==""){ $msg="Please complete the form"; }
else if($enddate < $startdate){ $msg="Start date must be a day before End date or during"; }	



$q=@mysql_query("select * from tbl_promos where ROOMID='$roomid' and promo_price='$promoprice' and start_date='$startdate' and end_date='$enddate'");
if(@mysql_num_rows($q)==0){
$sql.="insert into tbl_promos values('','$roomid','$promoprice','$startdate','$enddate','1');";

}
else{
$msg="Promo Already Exists";	
}



if($msg==""){
$e=explode(";",$sql); $b=true;
mysql_query("begin;");
for($y=0;$y<count($e)-1;$y++){
$q1=mysql_query($e[$y]);
$b=$b && $q1;  
}
if($b){ mysql_query("commit"); }else{ mysql_query("rollback"); }
}


$a['msg']=$msg;
echo json_encode($a);



?>