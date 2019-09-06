
<?php
session_start();
require_once 'settings/class.user.php';

$user_home = new USER();

$stmt = $user_home->runQuery("SELECT vehicle.vno,vehicle.vname,vehicle.year,vehicle.sold_price,vehicle.image FROM vehicle INNER JOIN seller ON vehicle.sid=seller.sid WHERE vehicle.status=:st");
 $stmt->execute(array(":st"=>"N"));
 $row = $stmt->fetchAll();
 class detail {
	public $vno;
    public $model;
    public $year;
	public $price;
	public $image;

  }

 ?>

 





 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Used Bikes Pondicherry</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }

/*    width: 100px;
    height: 100px;
    position: relative;
    -webkit-animation-name: example; /* Safari 4.0 - 8.0 
    -webkit-animation-duration: 8s; /* Safari 4.0 - 8.0 
    -webkit-animation-iteration-count: 3; Safari 4.0 - 8.0 
    animation-name: example;
    animation-duration: 8s;
    animation-iteration-count: 3;
}

/* Safari 4.0 - 8.0 
@-webkit-keyframes example {
    0%   { left:0px; top:0px;}
    50%  { left:1200px; top:0px;}
    100% { left:0px; top:0px;}
}
*/
  </style>
</head>
<body>

<div class="jumbotron" style="background-color:green;">
  <div class="container text-center"style="color:yellow;">
    <h1>Jupiter & Consultancy One</h1>      
    <p><h2 style="color:white;">Used Bikes In Pondicherry</h2></p>
  </div>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"><h3>JC</h3></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#"><h3>Home</h3></a></li>
        <li><a href="#"><h3>Products</h3></a></li>
        <li><a href="#"><h3>Deals</h3></a></li>
        <li><a href="#"><h3>Stores</h3></a></li>
        <li><a href="#"><h3>Contact</h3></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span><h3> Your Account</h3></a></li>
        <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span><h3> Cart</h3></a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container" style="background-color:white;">    
<h2><b> These are the available Bikes in our store</b></h2>
<div class="row">
<?php
	 $i=0;
foreach($row as $data) {
	$all[$i]=new detail();
	 $all[$i]->vno = $data['vno'];
	 $all[$i]->model = $data['vname'];
	 $all[$i]->price = $data['sold_price'];
	 $all[$i]->image = $data['image'];
	 $all[$i]->year = $data['year'];
	 echo '   
    <div class="col-sm-4">
      <div class="panel" style="background-color:green;">
	  <div class="panel-heading" style="color:white;"><b><h3>'.$all[$i]->model.'<h3></b></div>
	    <div class="panel-body"><img src="images/bikes/'.$all[$i]->image.'" alt="'.$all[$i]->model.'"  class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer" style="background-color:#00cc00;color:white;"><b><h3><p>'.$all[$i]->model.'</p></b></h3><br><b><h3>₹:   '.$all[$i]->price .'</b></h3></div>
      </div>
    </div>';
     $i++;
 }

 echo ' </div></div>';
?>
     

<footer class="container-fluid text-center">
  <p>Online Store Copyright</p>  
  <form class="form-inline">Get deals:
    <input type="email" class="form-control" size="50" placeholder="Email Address">
    <button type="button" class="btn btn-danger">Sign Up</button>
  </form>
</footer>

</body>
</html>


