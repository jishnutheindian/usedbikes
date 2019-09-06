<?php

  echo'	<div class="modal-header"><h1 style="align:right"> Reset Password</h1>  
          <h4 class="modal-title"><h2></h2></h4>
        </div>
        <div class="modal-body">
		         <form class="form-signin" method="post" id="login-form">
		          <input type="password"  id="oldpass"  class="old password" class="form-control" placeholder="Current Password" name="oldpass" required />
                  <input type="password"  id="newpass"  class="password" class="form-control" placeholder="New Password" name="newpass" required />
	              <input type="password"    id="repass"  class="confirm_password" placeholder="Re-type New Password" name="repass"  required />
				   <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="btn-login" id="btn-login">Reset</button>
				 </form>
        </div>
       <script>
	   
$(document).ready(function(){
$("#btn-login").click(function(){
var oldpass = $("#oldpass").val();
var newpass = $("#newpass").val();
var repass = $("#repass").val();

// Returns successful data submission message when the entered information is stored in database.
var dataString ="oldpass="+ oldpass + "&newpass="+ newpass + "&repass="+ repass ;

if(oldpass==""||newpass==""||repass=="")
{
alert("Please Fill All Fields");
}
else if(newpass!=repass)
{
alert("check passwords you typed");

}
else if(newpass==oldpass)
{
alert("try a password other than old password");

}
else
{

$.ajax({
type: "POST",
url: "checkreset.php",
data: dataString,
beforeSend: function()
			{	
				$("#error").fadeOut();
				$("#btn-login").html("resetting...");
			},
cache: false,
success: function(result){
if(result=="ok"){
									
						$("#btn-login").html("password changed successfully");
						
					}
				
					else{
									
						$("#error").fadeIn(1000, function(){						
											$("#btn-login").html()=result;
									});
					}
}
});
}
return false;
});
});
	   </script>

';
?>