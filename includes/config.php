<?php

defined('DB_SERVER') ? null : define("DB_SERVER","localhost");//define our database server
defined('DB_USER') ? null : define("DB_USER","root");		  //define our database user	
defined('DB_PASS') ? null : define("DB_PASS","");			  //define our database Password	
defined('DB_NAME') ? null : define("DB_NAME","southgatedb"); //define our database Name

$thisFile = str_replace('\\', '/', __FILE__);
$docRoot =$_SERVER['DOCUMENT_ROOT'];

$webRoot  = str_replace(array($docRoot, 'includes/config.php'), '', $thisFile);
$srvRoot  = str_replace('config/config.php','', $thisFile);

define('WEB_ROOT', $webRoot);
define('SRV_ROOT', $srvRoot);


$myemail="jcoderapps@gmail.com";
$myemailpass="jcoderapp@yahoo.com";

define('MYEMAIL',$myemail); ////Ilagay dito yung default email address na gagamitin sa system
define('MYEMAIL_PASSWORD',$myemailpass); //Ilagay dito yung default email password na gagamitin sa system

define('CELLNUM', "09273537254"); //ilagay dito yung cp num na ginamit sa itext.com
define('CELLNUM_ACCESSCODE', "JEAMS537254_ACPU3"); /*Mag register sa itext.com para makakuha ng API_CODE ilagay dito yung api_code*/

?>