<?php
require_once("../../includes/initialize.php");

$q=@mysql_query("select * from tbl_promos where remark='1'");
$str="";
$x=0;
while($r=@mysql_fetch_assoc($q)){

$roomid=$r['ROOMID'];
$promoprice=number_format($r['promo_price'],2);
$start_date=$r['start_date'];
$end_date=$r['end_date'];


$q1=@mysql_query("select * from tblroom where ROOMID='$roomid'");
$r1=@mysql_fetch_assoc($q1);

$room=$r1['ROOM'];
$roomdesc=$r1['ROOMDESC'];
$price=number_format($r1['PRICE'],2);


$str.="
<tr>
<td>
<input type='hidden' id='tblroomid$x' value='$roomid'>
</td>
<td>$start_date to $end_date</td>
<td>$room $roomdesc</td>
<td>$price</td>
<td>$promoprice</td>
<td><button class='btn' style='width:100%; background:rgba(0,0,0,0);' onclick='promo_delete($x)'><span class='glyphicon glyphicon-remove'></span></button></td>
</tr>
";	


$x++;
}



$a['cont']=$str;
echo json_encode($a);


?>