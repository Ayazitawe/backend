<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$Email = $decodedData['Email'];
$flag="END";

// Creating SQL command to fetch all records from Table.
$sql ="SELECT * FROM goingevent where userEmail ='$Email'";
$result = $conn->query($sql);
$num=$result->num_rows;

if ($result->num_rows >0) {
while($row = $result->fetch_assoc()) {
	$id = $row ['id'];
 $sql1 = "SELECT * FROM events WHERE id = '$id'";
 $exeSQL = mysqli_query($conn, $sql1);
 $arrayu = mysqli_fetch_array($exeSQL);
 
$date2 = date("d-m-Y");  
$dateend=$arrayu['edEvent'];

$iparr =  explode("/",$dateend);
 
 $int_day = (int) $iparr[0];
  $int_mounth = (int) $iparr[1];
   $int_year = (int) $iparr[2];
 $iparr1 =  explode("-",$date2);
 
 $int_day1 = (int) $iparr1[0];
  $int_mounth1 = (int) $iparr1[1];
   $int_year1 = (int) $iparr1[2];
   
   if ($int_year1 < $int_year)  $flag="ST";
 if (   $int_year1==$int_year){
	if   ($int_mounth1 < $int_mounth) $flag="ST";
	 else if  ($int_mounth1 ==$int_mounth) {
		if   ($int_day1 < $int_day) $flag="ST";
	} 
}
   $response[] = array("id" => $row['id'],"org" => $arrayu['Email']
,"nameEvent" => $arrayu['nameEvent']
,"stEvent" =>$arrayu['stEvent'],
 "etEvent" => $arrayu['etEvent'],"edEvent" =>$arrayu['edEvent'],"sdEvent" =>$arrayu['sdEvent'],"desEvent" =>$arrayu['desEvent'],"locEvent" =>$arrayu['locEvent'],
 "pic" =>$arrayu['pic'],"flag" =>$flag);
 $json = json_encode($response);//."".$response2
}
 
} else {
	
	$response="No Results Found";
 $json = json_encode($response);
}
 echo $json;
$conn->close();
?>