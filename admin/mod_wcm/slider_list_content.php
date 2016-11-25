<?php
require_once("../../includes/initialize.php");
$str="";
$q=mysql_query("select * from  tbl_slide_img JOIN tbl_image on tbl_slide_img.imgid=tbl_image.imgid and tbl_slide_img.remark='1'");
$x=1;
while($r=mysql_fetch_assoc($q)){

$img=$r['location'];
$description=$r['description'];
$imgid=$r['imgid'];
$id=$r['id'];
$status=$r['status'];
$stat=($status=='1')?"Yes":"No";



$str.="
<tr>
<td>$x
<input type='hidden' id='slide_id$x' value='$id'>
<input type='hidden' id='slide_imgid$x' value='$imgid'>
<input type='hidden' id='slide_location$x' value='$img'>
<input type='hidden' id='slide_description$x' value='$description'>
<input type='hidden' id='slide_status$x' value='$status'>
</td>
<td><img style='width:100px; ' src='../$img'></td>
<td>$description</td>
<td>$stat</td>
<td><button class='btn' onclick='slide_edit($x)' style='width:100%; background:rgba(0,0,0,0);'><span class='glyphicon glyphicon-edit'></span></button></td>
<td><button class='btn' onclick='slide_remove($x)' style='width:100%; background:rgba(0,0,0,0);'><span class='glyphicon glyphicon-remove'></span></button></td>
</tr>
";

$x+=1;
}


$a['cont']=$str;
echo json_encode($a);


?>