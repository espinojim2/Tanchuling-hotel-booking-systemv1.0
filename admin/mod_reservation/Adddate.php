<?php
$dep1=$_POST['dep1'];
$nodaye=$_POST['nodaye'];

$date = new DateTime($dep1);
$date->modify("+$nodaye days");
echo $date->format('Y-m-d');



?>