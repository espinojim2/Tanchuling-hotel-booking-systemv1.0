<?php
require_once("../../includes/initialize.php");

$id=$_POST['id'];
$msg="";
$sql="";
$sql.="update tbl_slide_img set remark='0' where id='$id';";


if($msg==""){
$e=explode(";",$sql); $b=true;

@mysql_query("begin;");
for($y=0;$y<count($e)-1;$y++){
$q1=@mysql_query($e[$y]);
$b=$b && $q1;  
}
if($b){ @mysql_query("commit;"); }else{ @mysql_query("rollback;"); }
}


$a['msg']=$msg;
echo json_encode($a);



?>