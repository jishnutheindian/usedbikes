<?php
session_start();
require_once 'settings/class.user.php';
$ok=1;
$user_home = new USER();
$vno=$user_home->test_input($_POST["vno"]);
$sname=$user_home->test_input($_POST["sname"]);
$fname=$user_home->test_input($_POST["fname"]);
$address=$user_home->test_input($_POST["address"]);
$sphone=$user_home->test_input($_POST["ph1"]);
$cphone=$user_home->test_input($_POST["ph2"]);
$price=$user_home->test_input($_POST["price"]);
$prooftype=$user_home->test_input($_POST["ptype"]);
$proofno=$user_home->test_input($_POST["proof"]);
$model=$user_home->test_input($_POST["model"]);
$year=$user_home->test_input($_POST["vyear"]);
$acc=$user_home->test_input($_POST["acctype"]);
$proof=array($prooftype,$proofno);
$proof=serialize($proof);
$cno=$user_home->test_input($_POST["cno"]);
$eno=$user_home->test_input($_POST["eno"]);
$dover=$user_home->test_input($_POST["dover"]);
$spic=basename($_FILES["spic"]["name"]);
$bpic=basename($_FILES["bpic"]["name"]);
$sid="";
if($user_home->fileupload("bikes","bpic")==0)
{$ok=0;}
else{$ok=1;}
if($ok==0 && $user_home->fileupload("users","spic")==0)
{$ok=0;}
else{$ok=1;$user_home->filedelete("bikes",$bpic);}

	if($ok==0)
    {    $stmt=$user_home->runQuery("INSERT INTO seller (vno,sname,fname,address,phone,cphone,price,proof,docs,image,acctype)                     VALUES(:vid,:sname,:fname,:address,:phone,:cphone,:price,:proof,:docs,:image,:acc)");

      if($stmt->execute(array(":vid"=>$vno,":sname"=>$sname,":fname"=>$fname,":address"=>$address,":phone"=>$sphone,":cphone"=>$cphone,":price"=>$price,":proof"=>$proof,":docs"=>$dover,":image"=>$spic,":acc"=>$acc)))
	  {       $sid=$user_home->lasdID();
             $stmt=$user_home->runQuery("INSERT INTO vehicle (vname,vno,cno,eno,year,sid,initial_price,image) VALUES(:vname,:vno,:cno,:eno,:year,:sid,:initial_price,:image)");
         if($stmt->execute(array(":vname"=>$model,":vno"=>$vno,":cno"=>$cno,":eno"=>$cno,":year"=>$year,":sid"=>$sid,":initial_price"=>$price,":image"=>$bpic)))
			{echo "ok"; exit;}
		 else{ $user_home->filedelete("bikes",$bpic);
		       $user_home->filedelete("users",$spic);
		       $stmt=$user_home->runQuery("DELETE FROM seller WHERE sid=:sid");
               $stmt->execute(array(":sid"=>$sid));
		    }
	   }
	   else
	   { $user_home->filedelete("users",$spic);
	     $user_home->filedelete("bikes",$bpic);
	   }
	}
    else
	{$user_home->filedelete("users",$spic);
	echo 'bikeimage not uploaded';}







?>