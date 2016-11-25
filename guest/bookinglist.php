
<?php
require_once ("../includes/initialize.php");
  if (!isset($_SESSION['GUESTID'])){
      redirect("index.php");
     }

 ?>

 
 
		<table>
			<tr>
			<!-- 	<td align="center"> 
				<img src="../images/images/5page-img1.png"  height="90px" style="-webkit-border-radius:5px; -moz-border-radius:5px;" alt="Image">
        		</td> -->
				<td width="87%" align="center">
				<!-- <h3 >Monbela Tourist Inn</h3> -->
				<h2>Booked Rooms Transactions 
				</h2>
				</td>
			</tr>
		</table>
		<!-- <h2 class="modal-title" id="myModalLabel">Billing Details </h2> -->
		
 
<?php 

		
?> 
<div style='width:100%; height:400px; overflow:auto;'>
		<table id="table" class="fixnmix-table">
			<thead>
				<tr>
					<th>Confirmation Code</th>
					<th align="center" width="120">Room</th>
		              <th align="center" width="120">Check In</th>
		              <th align="center" width="120">Check Out</th> 
		              <th  width="120">Price</th> 
		              <th align="center" width="120">Nights</th>
		              <th align="center" width="90">Amount</th>
		              <th align="center" width="90">TOTAL PAYMENT</th>
		              <th>Status</th>
		            <th></th>
		              <th></th>
				</tr>
				</thead>
				<tbody>
 
				<?php
				 
			 $query="SELECT * 
				FROM  `tblreservation` r,   `tblroom` rm, tblaccomodation a
				WHERE r.`ROOMID` = rm.`ROOMID` 
				AND a.`ACCOMID` = rm.`ACCOMID`  
				AND  r.`GUESTID` = ".$_SESSION['GUESTID'];
				$mydb->setQuery($query);
				$res = $mydb->loadResultList();

foreach ($res as $result) {
		 $day = (dateDiff($result->ARRIVAL,$result->DEPARTURE)>0)?dateDiff($result->ARRIVAL,$result->DEPARTURE):'1';
			 
						echo '<tr>';  
						 echo '<td>'. $result->CONFIRMATIONCODE.'</td>';
				  		 echo '<td>'. $result->ROOM.' '. $result->ROOMDESC.' </td>';
                        echo '<td>'.date_format(date_create($result->ARRIVAL),"m/d/Y").'</td>';
                        echo '<td>'.date_format(date_create($result->DEPARTURE),"m/d/Y").'</td>';
                        echo '<td > &#8369 '. $result->PRICE.'</td>'; 
                        echo '<td>'.$day.'</td>';
                        echo '<td > &#8369 '. $result->RPRICE.'</td>';
				  echo '<td > &#8369 '. ($result->RPRICE*$day).'</td>';
				  
				  		echo '<td >'. $result->STATUS.'</td>';
				  	   echo "<td><a href='".WEB_ROOT."index.php?p=transactedit&type=notadmin&status=".$result->STATUS."&code=".$result->CONFIRMATIONCODE."'>Edit</a></td>";
				  		echo "<td><a href='".WEB_ROOT."guest/readprint2.php?code=".$result->CONFIRMATIONCODE."' target='_blank'>Print</a></td>";
				  		echo '</tr>';
				 
				}
				?> 
			</tbody>
	 
       </table>  
 
  </div>