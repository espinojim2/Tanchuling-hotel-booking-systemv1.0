<?php
require_once("../../includes/initialize.php");
$id=$_POST['id'];
$imgid=$_POST['imgid'];
$description=$_POST['description'];
$isactive=$_POST['isactive'];

$msg="";
$sql="";

if($imgid==""){ $msg="Please choose an Image"; }




$q=@mysql_query("select * from tbl_slide_img where id='$id'");
if(mysql_num_rows($q)==0){
$sql.="insert into tbl_slide_img values('','$imgid','$isactive','$description','1');";	
}
else{
$sql.="update tbl_slide_img set imgid='$imgid',status='$isactive',description='$description' where id='$id';";	
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