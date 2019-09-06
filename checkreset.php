<?php
      session_start();
       require_once 'settings/class.user.php';
       $user_home = new USER();
       $email=$_SESSION['userSession'];
       $upass =$_POST['oldpass'];
	  $newpass=$_POST['newpass'];
	  $repass=$_POST['repass'];
	
	
		   if($user_home->resetpassword($email,$upass,$newpass))
		   {echo 'ok';
		   }
	 
	   else{
		   echo 'check your old password';

	        }



      
?>