
<?php include "availability_search.php"; ?>
   <!-- Projects Row -->
        <div class="row" style='padding:2%;'>
            <div class="col-md-9 img-portfolio">
            <div class="page-header"><h1>Welcome to our Hotel</h1></div>
             
            <div class="col-md-8">
               <a href="portfolio-item.html">
                    <img class="img-rounded" src="<?php echo WEB_ROOT; ?>images/slider_img/img/tanchuling.jpg" alt="">
                </a>  
            </div>
                




                <div class="col-md-4">
                 <h3>Contact Info</h3>
      <div class="space"></div>
      <p><i class="fa fa-map-marker fa-fw pull-left fa-2x"></i>Jazmin Street, Imperial Court Subdivision
          <br>
          Legazpi City, Albay Philippines 4500
          </p>
      <div class="space"></div>
      <p><i class="fa fa-phone fa-fw pull-left fa-2x"></i>Telephone: +63 (52) 820-2912 </p>
      <div class="space"></div>
      <p><i class="fa fa-fax fa-fw pull-left fa-2x"></i>Fax: +63 (52) 480 6003 </p>
                </div>
            </div>
          
            <div class="col-md-3 img-portfolio" style='padding:1%;'> 
           <div class="page-header"><h3>Type Of Rooms</h3></div>
              <div class="roomdesc">
                       <ul  class="a"> 
                      <?php
                          $query = "SELECT distinct(ROOM) FROM `tblroom` ";
                         $mydb->setQuery($query);
                         $cur = $mydb->loadResultList();  
                            ?>
                            
                      <?php  foreach ($cur as $result) { ?>
                       <li><h4><a  href="<?php echo WEB_ROOT; ?>index.php?p=rooms&q=<?php echo $result->ROOM; ?>" ><p ><?php echo $result->ROOM; ?></p></a></h4></li> 
                      <?php  } ?>
                                
                   
                    </ul>
              </div>
       
          </div>


 
          </div>  
<div class='row' style='padding:2%;'>
<div style='padding:2%;' ><h3>Location</h3></div>
<div style='padding:2%;'>
<iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJyy9aMNUDoTMRVTCdjPcqFjM&key=AIzaSyBciIFWiciSFEwSszQ0Cxkvf7AEeQhD9qI" allowfullscreen></iframe>
      
</div>
</div>
