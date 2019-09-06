<?php
session_start();
require_once 'settings/class.user.php';

$user_home = new USER();

if(!$user_home->is_logged_in())
{
	header("Location: index.php");exit; 
}



$stmt = $user_home->runQuery("SELECT vehicle.vno,vehicle.vname,vehicle.cno,vehicle.eno,vehicle.year FROM vehicle INNER JOIN seller ON vehicle.sid=seller.sid WHERE vehicle.status=:st");
 $stmt->execute(array(":st"=>"N"));
 $row = $stmt->fetchAll();
 class detail {
	public $vno;
    public $cno;
	public $eno;
    public $model;
    public $year;
  }


 $i=0;
foreach($row as $data) {
	$all[$i]=new detail();
	 $all[$i]->vno = $data['vno'];
	 $all[$i]->model = $data['vname'];
	 $all[$i]->cno = $data['cno'];
	 $all[$i]->eno = $data['eno'];
	 $all[$i]->year = $data['year'];
     $i++;
 }

 $myJSON = json_encode($all);
 echo $myJSON;
$i--;





?>