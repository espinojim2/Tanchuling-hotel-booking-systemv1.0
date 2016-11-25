<style type="text/css">
.ncont{ display:none; }
</style>
<script type="text/javascript">
$(document).ready(function(){
setcont(1);
});

function setcont(n){
$('.nav-tabs li[nv=n]').attr("class","");
$('#n'+n).attr("class","active");

$('.ncont').css({'display':'none'});
$('#ncont'+n).css({'display':'block'});
}

</script>
<ul class="nav nav-tabs">
 <li id='n1' onclick="setcont(1)" role="presentation" nv="n" class="active"><a href="#">Information</a></li>
 <li id='n2' onclick="setcont(2)" role="presentation" nv="n" ><a href="#">Book Room\s</a></li>
 <li id='n3' onclick="setcont(3)" role="presentation" nv="n" ><a href="#">Payment</a></li>
</ul> 
</li> 
</ul>
<div id='ncont1' class='ncont'><?php require(""); ?></div>
<div id='ncont2' class='ncont'>fghf</div>
<div id='ncont3' class='ncont'>fgh</div>