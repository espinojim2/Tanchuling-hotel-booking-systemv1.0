<style type="text/css">
.ws_cont{ visibility:hidden; }
</style>
<script type="text/javascript">
$(document).ready(function(){
setCont(1);
});


function setCont(n){
$('.ws_cont').css({'visibility':'hidden'}).hide();	
$('#ws_cont'+n).css({'visibility':'visible'}).show();	
}

function addSliderImage(){
	$('#slide_imgid').val("");
$('#slide_id').val("");
$('#slide_description').val("");
$('#slide_isactive').val("2");
$('#img_here').html("");
setCont(2);
}
function back_sliderlist(){
setCont(1);	
}

function SYS_imageUpload(){
$('#slidepic').upload("UploadImage.php",{uploadname:"slidepic"},function(success){ 
n=JSON.parse(success);
$('#slide_imgid').val(n.imgid);
var filenm=n.filename;
//   setTimeout(function(){ getImage(); 
 //  	 },200);

$('#img_here').html("<img src='../img/All_images/"+filenm+"' style='width:30%;'>");

   });	
}


function Save_Slide_details(){
var imgid=$('#slide_imgid').val();
var description=$('#slide_description').val();
var isactive=$('#slide_isactive').val();
var id=$('#slide_id').val();
$.post('slider_save.php',{imgid:imgid,description:description,isactive:isactive,id:id}).done(function(data){
var n=JSON.parse(data);
if(n.msg==""){   alert("Done Saving"); setCont(1); setSliderList();  }
else{
$('#msg').html("<div class='alert alert-warning'>"+n.msg+"</div>");	
}
});


}


function setSliderList(){
$.post('slider_list_content.php').done(function(data){
var n=JSON.parse(data);	
$('.slidetbl tbody').html(n.cont);
});	
}


function slide_edit(x){
var id=$('#slide_id'+x).val();
var imgid=$('#slide_imgid'+x).val();
var location=$('#slide_location'+x).val();
var description=$('#slide_description'+x).val();
var status=$('#slide_status'+x).val();
$('#slide_imgid').val(imgid);
$('#slide_id').val(id);
$('#slide_description').val(description);
$('#slide_isactive').val(status);
$('#img_here').html("<img src='../"+location+"' style='width:30%;'>");
setCont(2);
}

function slide_remove(x){
var id=$('#slide_id'+x).val();
if(confirm("Are you sure?")==true){
$.post("slider_delete.php",{id:id}).done(function(data){ 
var n=JSON.parse(data);
if(n.msg==""){ alert("Done Deleting");  setSliderList(); }
});	
}
}


</script>
<h3>Website Slider</h3>
<hr>
<div id='ws_cont1' class='ws_cont'><?php   require("slider_list.php"); ?></div>
<div id='ws_cont2' class='ws_cont'><?php   require("slider_form.php"); ?></div>