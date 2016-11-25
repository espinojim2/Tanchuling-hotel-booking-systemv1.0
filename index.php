<?php
require_once("includes/initialize.php");
$content='home.php';
$view = (isset($_GET['p']) && $_GET['p'] != '') ? $_GET['p'] : '';
$account = 'guest/update.php';
$small_nav = 'theme/small-navbar.php';
switch ($view) {

  case '1' :
        $title="Home";  
        $content='home.php';    
    break;
  case '2' :
      $title="Gallery"; 
    $content ='gallery.php';
    break;
  case '3' :
      $title="About Us";  
    $content = 'about.php';   
    break;

   case 'rooms' :
    $title="Rooms and Rates";  
    $content ='room_rates.php';    
    break;

  case 'contact' :
      $title="Contacts";  
    $content ='contact.php';    
    break;

 case 'booking' :
      $title="Book A Room";  
    $content ='bookAroom.php';    
    break;
        
     case 'accomodation' :
      $title="Accomodation";  
      $content='accomodation.php';
    break;  
  
  case 'largeview' :
      // $title="View";  
    $content ='largeimg.php';
    break;
  case 'transactedit':
    $content="transactedit.php";
  break;

  default :
      $title="Home";  
    $content ='home.php';   
}

require_once ('theme/template.php');

?>
 <script type="text/javascript" language="javascript" src="<?php echo WEB_ROOT; ?>admin/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo WEB_ROOT; ?>admin/assets/uploadz.js" charset="UTF-8"></script>


<script type="text/javascript">

function SYS_imageUpload1(n){

$('#slidepic'+n).upload("Uploadimage.php",{uploadname:"slidepic"+n},function(success){ 
var nn=JSON.parse(success);
alert(success);
$('#slide_imgid'+n).val(nn.imgid);
var filenm=nn.filename;
//   setTimeout(function(){ getImage(); 
 //    },200);

$('#img_here'+n).html("<img src='admin/img/All_images/"+filenm+"' style='width:30%;'>");

   });  
}


function SaveBookingchanges(){
var code=$('#code').val();
var arrival=$('#date_pickerfrom').val();
var departure= $('#date_pickerto').val(); 
var imgid=$('#slide_imgid0').val();
var ptype=$('#ptype').val();

$.post("BookingUpdateSave.php",{
 code:code,
 arrival:arrival,
 departure:departure,
 imgid:imgid,
 ptype:ptype 
}).done(function(data){
var nn=JSON.parse(data);
if(nn.msg==""){ alert("Done Saving"); }
else{
  alert("Error");
}
});
}


function CancelBookingSave(){
var code=$('#code').val();  
 if(confirm("Are you Sure?")==true){
$.post("BookingCancel.php",{code:code}).done(function(data){ alert(data);
alert("Booking Cancelled!");
});
 } 
}
</script>