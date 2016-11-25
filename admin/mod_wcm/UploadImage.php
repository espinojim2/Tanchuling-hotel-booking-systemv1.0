<?php
require_once("../../includes/initialize.php");

$uploadname=$_POST['uploadname']; /*Name of input file*/

$img=addslashes(file_get_contents($_FILES["$uploadname"]['tmp_name']));
$type=$_FILES["$uploadname"]['type'];
$e=explode("/",$type);
$imgid="";
$msg="";


if($e[1]=="jpeg" || $e[1]=="gif" || $e[1]=="jpg" || $e[1]=="png"){}
else{ $msg="Invalid File format"; }


//print_r($_FILES);
if($e[1]=="jpeg" || $e[1]=="gif" || $e[1]=="jpg" || $e[1]=="png")
{

$imgid=fimagecrop($_FILES["$uploadname"]['tmp_name'],$_FILES["$uploadname"]['name'],$_FILES["$uploadname"]['type'],600,500);
 
       $date=date("Y-m-d");
       $filename=$date."".$imgid.".jpg";
       $sql="";
       $sql.="insert into tbl_image values('$imgid','$type','img/All_images/$filename');";
      	mysql_query($sql) or die(mysql_error());

}
$a['filename']=$filename;
$a['msg']=$msg;
$a['imgid']=$imgid;
echo json_encode($a);





function fimagecrop($img_name,$newname,$type,$modwidth,$modheight)
{
$imgid=getMaxId("tbl_image","imgid")+1;
$date=date("Y-m-d");
$filename=$date."".$imgid.".jpg";
if(file_exists("../img/All_images")){

}else{ mkdir("../img/All_images"); }
$newname="../img/All_images/".$filename;


move_uploaded_file($img_name,"$newname");



/*list($width,$height)=getimagesize($img_name);
$tn=imagecreatetruecolor($modwidth,$modheight);
//$tn=imagecreatetruecolor($width,$height);
if(!strcmp("image/png",$type)){
imagealphablending($tn,false); 
imagesavealpha($tn,true);
}
if(!strcmp("image/jpg",$type) || !strcmp("image/jpeg",$type) || !strcmp("image/pjp",$type)) $src_img=imagecreatefromjpeg($img_name);  
if(!strcmp("image/png",$type)) $src_img=imagecreatefrompng($img_name);   
if(!strcmp("image/gif",$type)) $src_img=imagecreatefromgif($img_name);
imagecopyresized($tn,$src_img,0,0,0,0,$modwidth,$modheight,$width,$height);
//imagecopyresized($tn,$src_img,0,0,0,0,$width,$height,$width,$height);
if(!strcmp("image/png",$type)){ imagesavealpha($src_img,true); $ok=imagepng($tn,$newname); }
else if(!strcmp("image/gif",$type)){ $ok=imagegif($tn,$newname); } 
else{ $ok=imagejpeg($tn,$newname); }
if($ok==1){    }*/
return $imgid;
}


function getMaxId($tbl,$id){ /*Gets maximum Id from any table*/
$q=@mysql_query("select max($id) as id from $tbl");
$r=@mysql_fetch_assoc($q);
return ($r['id']==NULL)?"0":$r['id'];
}




?>