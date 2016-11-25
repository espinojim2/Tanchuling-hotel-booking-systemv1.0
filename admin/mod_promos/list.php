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

function addPromo(){
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


function Save_promo_details(){
var roomid=$('#promo_rooms').val();
var promoprice=$('#promo_promoprice').val();
var startdate=$('#promo_startdate').val();
var enddate=$('#promo_enddate').val();

$.post("promo_save.php",{
roomid:roomid,
promoprice:promoprice,
startdate:startdate,
enddate:enddate	
}).done(function(data){
var n=JSON.parse(data);
if(n.msg==""){ alert('Saving Successful'); setCont(1); setPromoList(); }
else{
	alert(n.msg);
}
});
}


function setPromoList(){
$.post('promo_list_content.php').done(function(data){ 
var n=JSON.parse(data);	
$('.slidetbl tbody').html(n.cont);
});	
}


function promo_delete(x){
var roomid=$('#tblroomid'+x).val();

if(confirm("Do you wish to proceed?")==true)
{
$.post("promo_delete.php",{roomid:roomid}).done(function(data){
alert("Done Deleting"); setPromoList();
});
}

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

<div id='ws_cont1' class='ws_cont'><?php   require("promo_list.php"); ?></div>
<div id='ws_cont2' class='ws_cont'><?php   require("promo_form.php"); ?></div>