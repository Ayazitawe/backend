<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$Emailorg = $decodedData['Email'];
$Emailuser = $decodedData['EmailUser'];

// Creating SQL command to fetch all records from Table.
$sql = "SELECT * FROM events where Email = '$Emailorg'";
$result = $conn->query($sql);
$num=$result->num_rows;
$f=false;
if ($result->num_rows >0) {
while($row = $result->fetch_assoc()) {
		$flag=true; $flag2=false;
	$rr=$row['id'];
$sql1 = "SELECT * FROM goingevent where id ='$rr'";
$result1 = $conn->query($sql1);
$num1=$result1->num_rows;
if ($result1->num_rows >0) {
while($row1 = $result1->fetch_assoc()) {
	if($row1['userEmail']==$Emailuser){
		$flag=false;
	}
}}
$date2 = date("d-m-Y");  
$dateend=$row['edEvent'];

$iparr =  explode("/",$dateend);
 
 $int_day = (int) $iparr[0];
  $int_mounth = (int) $iparr[1];
   $int_year = (int) $iparr[2];
 $iparr1 =  explode("-",$date2);
 
 $int_day1 = (int) $iparr1[0];
  $int_mounth1 = (int) $iparr1[1];
   $int_year1 = (int) $iparr1[2];
   
   if ($int_year1 < $int_year)  $flag2=true;
 if (   $int_year1==$int_year){
	if   ($int_mounth1 < $int_mounth) $flag2=true;
	 else if  ($int_mounth1 ==$int_mounth) {
		if   ($int_day1 < $int_day) $flag2=true;
	} 
}
   
 
if(	$flag==true and $flag2==true){
	$f=true;
$response[] = array("id" => $row['id']
,"nameEvent" => $row['nameEvent']
,"stEvent" =>$row['stEvent'],"pic" => $row['pic'],
 "etEvent" => $row['etEvent'],"edEvent" =>$row['edEvent'],"sdEvent" =>$row['sdEvent'],"desEvent" =>$row['desEvent'],"locEvent" =>$row['locEvent'],
 "num" => $num1);
 
}
	

}
 
}
if($f==true) {
$json = json_encode($response);//."".$response2
echo $json;}
else echo json_encode("no result");
$conn->close();
?>