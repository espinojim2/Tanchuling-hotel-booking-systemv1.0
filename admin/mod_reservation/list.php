<?php date_default_timezone_set("Asia/Manila"); ?>
<script type="text/javascript">
$(document).ready(function(){
$('#trdatecol').click();
$('#trdatecol').click();
$('#table').css({'visibility':'visible'});
});
</script>
<div class="container">
<!-- <div class="panel panel-primary"> -->
			<div class="panel-body" >
<form  method="post" action="processreservation.php?action=delete">
	<div style='width:100%; overflow:auto; font-size:11px;'>
	<table id="table" style='visibility:hidden; font-size:12px;' class="table table-striped" cellspacing="0">
<thead>
<tr>
<td width="5%">#</td>	

<td width="90"><strong>Guest</strong></td>
<!--<td width="10"><strong>Confirmation</strong></td>-->
<td width="80" id='trdatecol'><strong>Transaction Date</strong></td>
<td width="80"><strong>Confimation Code</strong></td>
<td width="70"><strong>Total Rooms</strong></td>
<td width="80"><strong>Total Price</strong></td>
<td width="80"><strong>Total Installment</strong></td>
<td width="80"><strong>Payment Type</strong></td>
<td width="80"><strong>Payment Image</strong></td>
<td width="20"><strong>Payment Status</strong></td>
<td width="20"><strong>Status</strong></td>
<td width="100"><strong>Action</strong></td>
</tr>
</thead>
<tbody>
<?php
//$mydb->setQuery("SELECT *,roomName,firstname, lastname FROM reservation re,room ro,guest gu  WHERE re.roomNo = ro.roomNo AND re.guest_id=gu.guest_id");
// $mydb->setQuery("SELECT * 
// 				FROM  `tblreservation` r,  `tblguest` g,  `tblroom` rm, tblaccomodation a
// 				WHERE r.`ROOMID` = rm.`ROOMID` 
// 				And a.`ACCOMID` = rm.`ACCOMID` 
// 				AND g.`GUESTID` = r.`GUESTID`  
// 				ORDER BY r.`STATUS`='pending'");
$mydb->setQuery("SELECT  `G_FNAME` ,  `G_LNAME` ,  `G_ADDRESS` ,  `TRANSDATE` ,  `CONFIRMATIONCODE` ,  `PQTY` ,  `SPRICE`,`INSTALLMENT_PRICE` ,`STATUS`
				FROM  `tblpayment` p,  `tblguest` g
				WHERE p.`GUESTID` = g.`GUESTID`   
				ORDER BY p.`STATUS`='pending' desc");
$cnt=0;
$cur = $mydb->loadResultList();
				  			// `RESERVEID`, `TRANSNUM`, `TRANSDATE`, `ROOMID`, `ARRIVAL`, `DEPARTURE`, `RPRICE`, `GUESTID`, `PRORPOSE`, `STATUS`, `BOOKDATE`, `REMARKS`, `USERID`SELECT * FROM `tblreservation` WHERE 1
foreach ($cur as $result) {
?>
<tr>
<td width="5%" align="center"></td>
<td><?php echo $result->G_FNAME." ".$result->G_LNAME; ?></td>
<td><?php echo $result->TRANSDATE; ?></td>
<!-- <td><?php echo date_format(date_create($result->ARRIVAL),'m/d/Y'); ?></td>
<td><?php echo date_format(date_create($result->DEPARTURE),'m/d/Y'); ?></td> -->
<!--<td><?php echo $result->roomName; ?></td>-->
<!-- <td><?php echo $result->ACCOMODATION; ?></td> -->
<!-- <td><?php echo dateDiff($result->ARRIVAL,$result->DEPARTURE); ?></td> -->
<td><?php echo $result->CONFIRMATIONCODE; ?></td>
<td><?php echo $result->PQTY; ?></td>
<td><?php echo number_format($result->SPRICE,2); ?></td>
<td><?php echo number_format($result->INSTALLMENT_PRICE,2); ?></td>
<td>
<?php
$q3=mysql_query("select * from tblpayment_type where CONFIRMATIONCODE='".$result->CONFIRMATIONCODE."'");
$r3=mysql_fetch_assoc($q3);
echo ($r3['ptype']=='1' || $r3['ptype']=='0' || (count($r3)==0 || count($r3)==1) )?"Pay Total Price":"Installment";
$ptype1=($r3['ptype']=='1' || $r3['ptype']=='0' || (count($r3)==0 || count($r3)==1) )?"1":"2";

?>
<input type='hidden' id='tblptype<?= $cnt; ?>' value='<?= $ptype1; ?>'>
</td>
<td>
<?php
$q=mysql_query("select * from tblpayment_image where CONFIRMATIONCODE='".$result->CONFIRMATIONCODE."'");
$r=mysql_fetch_assoc($q);
$pimgid=$r['imgid'];
$q1=mysql_query("select * from tbl_image where imgid='$pimgid'");
$r1=mysql_fetch_assoc($q1);
$location=$r1['location'];
echo ($pimgid==0 || $pimgid=="")?"":"<a title='click to view' href='../$location' target='_blank'><img src='../$location' style='width:100px;'></a>";
?>
</td>

<td >
<?php
$opt="";
if($r3['pay_status']=='1' && $result->STATUS!='Cancelled'){
$opt="
<option value='2' >Payment Incomplete</option>
<option value='1' selected>Paid</option>
";
}
else if($r3['pay_status']=='2' && $result->STATUS!='Cancelled'){
$opt="
<option value='2' selected>Payment Incomplete</option>
<option value='1' >Paid</option>
";
}else if($result->STATUS=='Cancelled'){
$opt="<option value='3'>Cancelled</option>";	
}else{
$opt="
<option value='2' selected>Payment Incomplete</option>
<option value='1'>Paid</option>
";	
}


?>
<input type='hidden' id='ccode<?= $cnt; ?>' value="<?= $result->CONFIRMATIONCODE; ?>">
<select id='paymentstat<?= $cnt; ?>' onchange='updatePaymentStatus(<?= $cnt; ?>)'>
<?= $opt; ?>
</select>
</td>

<td><?php echo $result->STATUS; ?></td> 
<!--<td><a class="btn btn-default toggle-modal-reserve" href="#reservationr<?php echo $result->reservation_id; ?>" role="button" >View</a></td>-->
<td >
	<?php 

$code1=$result->CONFIRMATIONCODE;
$query1="SELECT * 
				FROM  `tblreservation` r,  `tblguest` g,  `tblroom` rm, tblaccomodation a
				WHERE r.`ROOMID` = rm.`ROOMID` 
				AND a.`ACCOMID` = rm.`ACCOMID` 
				AND g.`GUESTID` = r.`GUESTID`  AND r.`STATUS`<>'Cancelled'
				AND  `CONFIRMATIONCODE` = '".$code1."'";



$q2=mysql_query($query1);
$r2=mysql_fetch_assoc($q2);


$arrival=$r2['ARRIVAL'];

$date1=new Datetime($r2['DEPARTURE']);
$departure=$date1->format("Y-m-d");;


$cdate=date("Y-m-d");

$disp="";
if($cdate > $departure){ $disp="display:none"; }





		if($result->STATUS == 'Confirmed'){ ?>
		<!-- <a class="cls_btn" id="<?php echo $result->reservation_id; ?>" data-toggle='modal' href="#profile" title="Click here to Change Image." ><i class="icon-edit">test</a> -->
			<div><a href="index.php?view=view&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-primary btn-xs" ><i class="icon-edit">View</a></div>
			<div style=''><a href="controller.php?action=cancel&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-primary btn-xs" ><i class="icon-edit">Cancel</a></div>
			<div style='<?= $disp; ?>'><a href="controller.php?action=checkin&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-success btn-xs" ><i class="icon-edit">Check in</a></div>
			<div ><a href="index.php?view=extenddate&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-primary btn-xs" ><i class="icon-edit">Extend Date</a></div>
		<?php
		}elseif($result->STATUS == 'Checkedin'){
	?>
			<div><a href="index.php?view=view&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-primary btn-xs" ><i class="icon-edit">View</a></div>
			<div ><a href="controller.php?action=checkout&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-danger btn-xs" ><i class="icon-edit">Check out</a></div>
			<div ><a href="index.php?view=extenddate&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-primary btn-xs" ><i class="icon-edit">Extend Date</a></div>
	<?php
		}elseif($result->STATUS == 'Checkedout' ){ ?>
			<div><a href="index.php?view=view&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-primary btn-xs" ><i class="icon-edit">View</a></div>
			
	<?php }

		elseif($result->STATUS == 'Cancelled' ){ ?>
			<div><a href="index.php?view=view&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-primary btn-xs" ><i class="icon-edit">View</a></div>
			
	<?php }
	else{
			?>
			<div><a href="index.php?view=view&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-primary btn-xs" ><i class="icon-edit">View</a></div>
			<div><a href="controller.php?action=cancel&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-primary btn-xs" ><i class="icon-edit">Cancel</a></div>
			<div style='<?= $disp; ?>'><a href="controller.php?action=confirm&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-success btn-xs"  ><i class="icon-edit">Confirm</a></div>
			<div ><a href="index.php?view=extenddate&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-primary btn-xs" ><i class="icon-edit">Extend Date</a></div>
	<?php
		}

	?>
	
	
</td>

<?php
$cnt+=1;
 }
?>
  
		<div class="modal fade" id="profile" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						

						<div class="alert alert-info">Profile:</div>
					</div>

					<form action="#"  method=
					"post">
						<div class="modal-body">
					
												
								<div id="display">
									
										<p>ID : <div id="infoid"></div></p><br/>
											Name : <div id="infoname"></div><br/>
											Email Address : <div id="Email"></div><br/>
											Gender : <div id="Gender"></div><br/>
											Birthday : <div id="bday"></div>
										</p>
										
								</div>
						</div>

						<div class="modal-footer">
							<button class="btn btn-default" data-dismiss="modal" type=
							"button">Close</button>
						</div>
					</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

</table>
</div>
</form>
<!-- </div> -->
</div>