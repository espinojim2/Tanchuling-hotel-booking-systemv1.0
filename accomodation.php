  <?php
$msg = "";

if(isset($_POST['booknow'])){

    $days =0;
    $day = dateDiff($_SESSION['arrival'],$_SESSION['departure']);  

   if($day <= 0){
      $totalprice = $_POST['ROOMPRICE'] *1;
      $days = 1;
    }else{
      $totalprice = $_POST['ROOMPRICE'] * $day;
      $days = $day;
    }
     
      addtocart($_POST['ROOMID'],$days, $totalprice,$_SESSION['arrival'],$_SESSION['departure']);

      redirect(WEB_ROOT. 'booking/'); 

}
 

 if(!isset($_SESSION['arrival'])){
   $_SESSION['arrival'] = date_create('Y-m-d');
 }
if(!isset($_SESSION['departure'])) {
  $_SESSION['departure'] =  date_create('Y-m-d') ;
}


if(isset($_POST['booknowA'])){ 


 $days = dateDiff($_POST['arrival'],$_POST['departure']); 

if($days <= 0){
  $msg = 'Available room today';
}else{
   $msg =  'Available room From:'.$_POST['arrival']. ' To: ' .$_POST['departure'];

} 


$_SESSION['arrival'] = date_format(date_create( $_POST['arrival']),"Y-m-d");
$_SESSION['departure'] =date_format(date_create($_POST['departure']),"Y-m-d");


 
 $query = "SELECT * FROM `tblroom` r ,`tblaccomodation` a WHERE r.`ACCOMID`=a.`ACCOMID` AND `ACCOMODATION`='" . $_GET['q'] . "' AND `NUMPERSON` = " . $_POST['person'];
    

}elseif(isset($_GET['q'])){

    $query = "SELECT * FROM `tblroom` r ,`tblaccomodation` a WHERE r.`ACCOMID`=a.`ACCOMID` AND `ACCOMODATION`='" . $_GET['q'] . "'"; 
   
 
  
  }

   $accomodation = ' | ' . $_GET['q'];
  ?>



<div id="accom-title"  > 
    <div  class="pagetitle">   
            <h1  ><?php print $title ; ?>
                <small><?php print  $accomodation; ?></small>
                 
            </h1> 
        </div> 
  </div>

<div id="bread">
   <ol class="breadcrumb">
      <li><a href="<?php echo WEB_ROOT ;?>index.php">Home</a>
      </li>
      <li class="active"><?php print $title  ; ?></li>
      <li  style="color: #02aace; float:right"> <?php print  $msg; ?></li>
  </ol> 
</div>
   
  <div id="main" class="site-main clr" style='padding:2%;'> 
    <div id="primary" class="content-area clr"> 
        <div id="content-wrap">
          <!--  <h1 class="page-title"><?php print $title . $accomodation; ?></h1>  --> 
           
           <div class="col-lg-9">
            <div class="tabs-wrapper clr"> 
               <div class="row"> 
               
                <?php 
 
                  $arrival =  $_SESSION['arrival'];
                  $departure =  $_SESSION['departure'] ;

                   $mydb->setQuery($query);
                   $cur = $mydb->loadResultList(); 
                      foreach ($cur as $result) { 


// filtering the rooms
 // ======================================================================================================
                    $mydb->setQuery("SELECT * FROM `tblreservation`     WHERE ((
                        '$arrival' >= DATE_FORMAT(`ARRIVAL`,'%Y-%m-%d')
                        AND  '$arrival' <= DATE_FORMAT(`DEPARTURE`,'%Y-%m-%d')
                        )
                        OR (
                        '$departure' >= DATE_FORMAT(`ARRIVAL`,'%Y-%m-%d')
                        AND  '$departure' <= DATE_FORMAT(`DEPARTURE`,'%Y-%m-%d')
                        )
                        OR (
                        DATE_FORMAT(`ARRIVAL`,'%Y-%m-%d') >=  '$arrival'
                        AND DATE_FORMAT(`ARRIVAL`,'%Y-%m-%d') <=  '$departure'
                        )
                        )
                        AND ROOMID =".$result->ROOMID);

                  $curs = $mydb->loadResultList(); 
                     
                     $resNum = $result->ROOMNUM - count($curs) ;
                         


                    $stats = $mydb->executeQuery();
                    $rows = mysql_fetch_assoc($stats);
                    $status=$rows['STATUS'];

                     
                    //$availRoom = $result->ROOMNUM;


              if($resNum<=0){

             if($status=='Confirmed'){
                $btn =  '<div style="margin-top:10px; color: rgba(0,0,0,1); font-size:16px;"><strong>Fully Reserve!</strong></div>';
                 $img_title = ' 

                           <figcaption class="img-title-active">
                                <h5>Reserve!</h5>    
                            </figcaption>


                    ';
              }elseif($status=='Checkedin'){
                $btn =  '<div style="margin-top:10px; color: rgba(0,0,0,1); font-size:16px;"><strong>Fully Book!</strong></div>';
                 $img_title = ' 

                           <figcaption class="img-title-active">
                                <h5>Book!</h5>    
                            </figcaption>


                    ';
              }else{
                // <input type="submit" class="btn monbela-btn  btn-primary btn-sm" id="booknow" name="booknow" onclick="return validateBook();" value="Book Now!"/>
                           
                 $btn =  '
                 <div class="form-group">
                        <div class="row">
                          <div class="col-xs-12 col-sm-12">
                              <div style="margin-top:10px; color: rgba(0,0,0,1); font-size:16px;"><strong>Fully Reserve!</strong></div>
                           </div>
                        </div>
                      </div>';
                    $img_title = ' 

                           <figcaption class="img-title">
                                <h5>'.$result->ROOM . ' <br/> '.$result->ROOMDESC.'  <br/>
                                ' . $result->ACCOMODATION .' <br/> 
                                '.$result->ACCOMDESC . '<br/>  
                                Number of Person:' . $result->NUMPERSON .' <br/> 
                                Price:'.$result->PRICE.'</h5>    
                            </figcaption>
                    ';
                   



              }
                   
              }else{
                $btn =  '
                 <div class="form-group">
                        <div class="row">
                          <div class="col-xs-12 col-sm-12">
                            <input type="submit" class="btn monbela-btn  btn-primary btn-sm" id="booknow" name="booknow" onclick="return validateBook();" value="Book Now!"/>
                                                   
                           </div>
                        </div>
                      </div>';
                    $img_title = ' 

                           <figcaption class="img-title">
                                <h5>'.$result->ROOM . ' <br/> '.$result->ROOMDESC.'  <br/>
                                ' . $result->ACCOMODATION .' <br/> 
                                '.$result->ACCOMDESC . '<br/>  
                                Number of Person:' . $result->NUMPERSON .' <br/> 
                                Price:'.$result->PRICE.'</h5>    
                            </figcaption>


                    ';
                   

              }      
// ============================================================================================================================


 
                ?>
                 <form method="POST" action="index.php?p=accomodation">
                 <input type="hidden" name="ROOMPRICE" value="<?php echo $result->PRICE ;?>">
                  <input type="hidden" name="ROOMID" value="<?php echo $result->ROOMID ;?>">

                  <div id="roomimg" class="col-md-6 img-portfolio">
                    <div  class="wrapper clearfix">
                    <a href="#" >
                        <figure class="gallery-item ">
                   
                            <img class="img-responsive img-hover"  src="<?php echo WEB_ROOT .'admin/mod_room/'.$result->ROOMIMAGE; ?>">
                    
                             <!-- <?php echo $img_title; ?> -->
                            <figcaption class="img-title-active">
                                  
                            </figcaption>

             
                        </figure> 
                       </a>  
                    </div> 
                      <h4><p><?php echo $result->ROOM ;?></p></h4>
                     

 <?php
                      $date=date("Y-m-d");
                      $q1=@mysql_query("select * from tbl_promos where (start_date <= '$date' and end_date >= '$date') and remark='1' and ROOMID='".$result->ROOMID."'");
                      if(@mysql_num_rows($q1)!=0)
                      {
                      $r1=mysql_fetch_assoc($q1);
                      $start_date=$r1['start_date'];
                      $end_date=$r1['end_date'];
                      $promoprice=$r1['promo_price'];  
                      
                     // if($start_date<=$date && $end_date >=$date)
                      //{
                        echo "
                        <h5 style='color:green;'>Promo Price:  &#8369 $promoprice (Limited offer!)</h5> 
                        <h5>Original Price:  &#8369 ".$result->PRICE."</h5> 
                        ";
                      //}
                      }
                      else{
                      echo "
                        <h5>Price:  &#8369 ".$result->PRICE."</h5> 
                        ";
                        
                      }
                      ?>





                    
                       <?php if($result->INSTALLMENT_AMOUNT!="0.00"){ ?>
                          <h5>Installment amount: &#8369<?php echo "  ". number_format($result->INSTALLMENT_AMOUNT,2)  ;?></h5>
                       <?php
                        }
                     
                       ?>
                      <div class="descRoom">
                        <ul>
                        <li><?php echo $result->ROOMDESC ;?></li>
                        <li>Number Person : <?php echo $result->NUMPERSON ;?></li>
                         <li>Remaining Rooms :<?php echo  ($resNum<=0)?"0":$resNum; ?></li>   
                        <li style="list-style:none;"><?php echo $btn ;?></li>  
                        </ul>
                    </div>
                </div> 

              </form>
                <?php  
 
                 }

                ?>

              </div> 
          </div>
    
         </div>

             <div class="col-lg-3"> 
        <div class="row">
          <?php  require_once('sidebar.php') ; ?>
        </div>
      </div>
    
    </div>
    </div>
   
  </div>

 