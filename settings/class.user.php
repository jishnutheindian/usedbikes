<?php

require_once 'dbconfig.php';

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	
	public function login($email,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM users WHERE userEmail=:email_id");
			$stmt->execute(array(":email_id"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['userStatus']=="Y")
				{
					if($userRow['userPass']==md5($upass))
					{
						$_SESSION['userSession'] = $userRow['userEmail'];
						return true;
					}
					else
					{
						header("Location: index.php?error");
						exit;
					}
				}
				else
				{
					header("Location: index.php?inactive");
					exit;
				}	
			}
			else
			{
				header("Location: index.php?error");
				exit;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function resetpassword($email,$upass,$newpass)
	{
		try
		{ 
			$s= $this->conn->prepare("SELECT * FROM users WHERE userEmail=:email_id");
			$s->execute(array(":email_id"=>$email));
			$us=$s->fetch(PDO::FETCH_ASSOC);
			
				if($us['userPass']==md5($upass))
				{
				    $pass=md5($newpass);
			        $stmt = $this->conn->prepare("UPDATE users SET userPass=:user_pass WHERE userEmail=:email_id");
			        $stmt->bindparam(":email_id",$email);
			        $stmt->bindparam(":user_pass",$pass);				
                    $stmt->execute();	
			       	return true;

				}
					else
					{
					
					echo 'old password incorrect';
				        
					}
			  	
		 }
		
	catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}



	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}
	
	  function test_input($data)
    {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
    }

	function filedelete($dir,$pic)
	{$target_dir = "images/".$dir."/";	
    $file = $target_dir.$pic;
    if (unlink($file))
       {
       return true;
       }
    else
      {
       return false;
      }
	}
	function fileupload($dir,$pic)
	{	
        $target_dir = "images/".$dir."/";
        $target_file = $target_dir . basename($_FILES[$pic]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
       // Check if image file is a actual image or fake image
      
               $check = getimagesize($_FILES[$pic]["tmp_name"]);
               if($check !== false) {
                  //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
               } else {
                  echo "notimage.";
                  $uploadOk = 0;return 1;
                   }
           
           // Check if file already exists
           if (file_exists($target_file)) {
              echo "alreadyexists.";
              $uploadOk = 0;return 1;
              }
          // Allow certain file formats
           if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
                  echo "notallowed.";
                  $uploadOk = 0;return 1;
                 }
         // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
				return 1;
             //  if everything is ok, try to upload file
               } else {
				   

                       if (move_uploaded_file($_FILES[$pic]["tmp_name"], $target_file)) {
                            //echo "The file ". basename($_FILES[$pic]["name"]). " has been uploaded.";
						    return 0;
                        } else {
                             echo "error";
				            return 1;
                          }
			          }

    }	
	
	function send_mail($email,$message,$subject)
	{						
		require_once('mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "ssl";                 
		$mail->Host       = "plus.smtp.mail.yahoo.com";      
		$mail->Port       = 465;             
		$mail->AddAddress($email);
		$mail->Username="jishnutheindian@yahoo.com";  
		$mail->Password="TheINDIAN";            
		$mail->SetFrom('jishnutheindian@yahoo.com','miontech');
		$mail->AddReplyTo("jishnutheindian@gmail.com","miontech");
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
	}
	function contactus($email,$message,$subject)
	{						
		require_once('mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "ssl";                 
		$mail->Host       = "localhost";      
		$mail->Port       = 465;             
		$mail->AddAddress($email);
		$mail->Username="user@miontech.in";  
		$mail->Password="jishnu9345(#$%";            
		$mail->SetFrom('$email','miontech');
		$mail->AddReplyTo("support@miontech.in","support");
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
		return true;
	}


	
}
