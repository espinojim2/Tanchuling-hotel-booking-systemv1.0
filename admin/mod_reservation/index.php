<?php
require_once("../../includes/initialize.php");
 if (!isset($_SESSION['ADMIN_ID'])){
 	redirect(WEB_ROOT ."admin/login.php");
 }
//checkAdmin();
$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
$title ="Reservation";
switch ($view) {
	case 'list' :
		$content    = 'list.php';		
		break;

	case 'add' :
		$content    = 'add.php';		
		break;

	case 'edit' :
		$content    = 'edit.php';		
		break;
    case 'view' :
		$content    = 'view.php';		
		break;
	case 'extenddate':
	$content = 'extenddate.php';
	break;
	default :
		$content    = 'list.php';		
}
  include '../modal.php';
require_once '../themes/backendTemplate.php';
?>
<script type="text/javascript">
$(document).ready(function(){
	
});
function updatePaymentStatus(cnt) {
	var paystat=$('#paymentstat'+cnt).val();
	var code=$('#ccode'+cnt).val();
	var ptype=$('#tblptype'+cnt).val();
	
	$.post("ChangePayStatus.php",{ptype:ptype,code:code,paystat:paystat}).done(function(data){
		alert(data);

	});
}
</script>

  
