<style type="text/css">
#img_here{ 

}
</style>
<div>
<input type='hidden' id='slide_imgid' value="">
<input type='hidden' id='slide_id' value="">
<div id='msg'></div>
<div id='img_here'>

</div>

<div class='row' style='margin-bottom:2%;'>
	<div class='col-sm-7'><input type='file' class='form-control' name='slidepic' id='slidepic' onchange='SYS_imageUpload()'></div>
</div>
<div class='row' style='margin-bottom:2%;'>
	<div class='col-sm-7'>
		<label>Description</label>
		<input type='text' id='slide_description' class='form-control'>
	</div>
</div>
<div class='row' style='margin-bottom:2%;'>
		<div class='col-sm-7'>
<label>Make a priority Slide</label>
<select class='form-control' id='slide_isactive'>
<option value='1'>Yes</option>
<option value='2'>No</option>
</select>
</div>
</div>

<div class='row' style='padding:1%;'>
<button class='btn btn-default' onclick='back_sliderlist()'><b>Back</b></button>
<button class='btn btn-default' onclick='Save_Slide_details()'><b>Save</b></button>
</div>



</div>