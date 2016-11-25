<style type="text/css">
#example tr{ border-bottom:none; }
</style>
<script type="text/javascript">
$(document).ready(function(){
setPromoList();	
});
</script>
<div style='margin-bottom:2%; '>
<button onclick='addPromo()' class='btn btn-default' style='font-size:12px;'><span class='glyphicon glyphicon-plus'></span> <b>Add New Promo</b></button>
</div>
<div class='table-responsive' style='font-size:12px;'>
<table class='table table-bordered table-condensed table-striped slidetbl' style='font-size:12px;' id="example">
<thead>
<tr>
<th width="5%"></th>	
<th>Date(YYYY-mm-dd)</th>
<th>Room</th>
<th>Original Amount </th>
<th>Promo Amount </th>
<th width="5%">Delete</th>
</tr>
</thead>
<tbody>

</tbody>
</table>
</div>