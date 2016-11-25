<style type="text/css">
#img_here{ 

}
</style>
<div style='margin-top:3%;'>
<input type='hidden' id='slide_imgid' value="">
<input type='hidden' id='slide_id' value="">
<div id='msg'></div>

<div class='row' style='margin-bottom:2%;'>
		<div class='col-sm-7'>
<label>Rooms</label>
<select class='form-control' id='promo_rooms'>
<?php
$q=@mysql_query("select * from tblroom");
$opt="";
while($r=@mysql_fetch_assoc($q)){
$roomid=$r['ROOMID'];
$room=$r['ROOM'];
$roomdesc=$r['ROOMDESC'];
$price=number_format($r['PRICE'],2);

$opt.="<option value='$roomid'>$room $roomdesc - Price: $price</option>";
}


echo $opt;
?>
</select>
</div>
</div>


<div class='row' style='margin-bottom:2%;'>
	<div class='col-sm-7'>
		<label>Promo Price</label>
		<input type='text' id='promo_promoprice' class='form-control'>
	</div>
</div>

<div class='row' style='margin-bottom:2%;'>
	<div class='col-sm-7'>
		<label>Start date(YYYY-mm-dd)</label>
		<input type='text' id='promo_startdate' class='form-control datepicker' data-date-format="yyyy-mm-dd" data-link-field="any" 
                           data-link-format="yyyy-mm-dd">
	</div>
</div>


<div class='row' style='margin-bottom:2%;'>
	<div class='col-sm-7'>
		<label>End date(YYYY-mm-dd)</label>
		<input type='text' id='promo_enddate' class='form-control datepicker' data-date-format="yyyy-mm-dd" data-link-field="any" 
                           data-link-format="yyyy-mm-dd">
	</div>
</div>

<div class='row' style='padding:1%;'>
<button class='btn btn-default' onclick='back_sliderlist()'><b>Back</b></button>
<button class='btn btn-default' onclick='Save_promo_details()'><b>Save</b></button>
</div>



</div>