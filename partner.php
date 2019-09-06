<?php
session_start();
require_once 'settings/class.user.php';

$user_home = new USER();

if(!$user_home->is_logged_in())
{
	header("Location: index.php");exit; 
}
?>
<style>

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
<table style="width:100%">
    <caption><label><b>Accounts</b></label></caption>
  <tr>
    <th>Serial No</th>
    <th>Vehicle Name</th>
    <th>Vehicle No</th> 
    <th>Buying Price</th>
	<th>Expense</th>
	<th>Selling Price</th>
    <th>Partner Amount</th>
	<th>Profit</th>

  </tr>
<?php
$st="Y";
$pt="partner";
 $stmt = $user_home->runQuery("SELECT vehicle.vname,vehicle.vno,vehicle.initial_price,vehicle.expense,vehicle.sold_price FROM vehicle INNER JOIN seller ON vehicle.sid=seller.sid WHERE vehicle.status=:st AND seller.acctype=:acc");
 $stmt->execute(array(":st"=>$st,":acc"=>$pt));
 $row = $stmt->fetchAll();
 class detail {
	public $vno;
    public $vname;
    public $ip;
	public $ex;
    public $sp;
	public $part;
    public $profit;
  }


 $i=0;
foreach($row as $data) {
	$all[$i]=new detail();
	 $all[$i]->vno = $data['vno'];
	 $all[$i]->vname = $data['vname'];
	 $all[$i]->ip = $data['initial_price'];
	 $all[$i]->ex = $data['expense'];
     $all[$i]->sp = $data['sold_price'];
     $all[$i]->partner=($all[$i]->sp<1000)?1000:1500;
	 $all[$i]->profit = $all[$i]->sp-($all[$i]->ip+$all[$i]->ex+$all[$i]->partner);
echo'<tr>
    <th>'.($i+1).'.</th>
    <th>'.$all[$i]->vname.'</th>
    <th>'.$all[$i]->vno .'</th> 
    <th>'.$all[$i]->ip.'</th>
	<th>'. $all[$i]->ex.'</th>
	<th>'. $all[$i]->sp.'</th>
	<th>'. $all[$i]->partner.'</th>
	<th>'. $all[$i]->profit.'</th>

  </tr>';

	 $i++;
 }
?>

</table>