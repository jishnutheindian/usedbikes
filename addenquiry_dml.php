<?php
session_start();
require_once 'settings/class.user.php';
$ok=1;
$user_home = new USER();

$sname=$user_home->test_input($_POST["sname"]);
$sphone=$user_home->test_input($_POST["ph1"]);
$req=$user_home->test_input($_POST["req"]);
$price=$user_home->test_input($_POST["price"]);

$stmt=$user_home->runQuery("INSERT INTO enquiry (name,phone,requirement,pricerange) VALUES(:sname,:phone,:requirement,:pricerange)");
  if($stmt->execute(array(":sname"=>$sname,":phone"=>$sphone,":requirement"=>$req,":pricerange"=>$price)))
  {echo'ok';}







?>