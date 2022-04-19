<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$Emailorg = $decodedData['Email'];
// Creating SQL command to fetch all records from Table.
$sql = "SELECT * FROM events where Email = '$Emailorg'";
$result = $conn->query($sql);
$num=$result->num_rows;

if ($result->num_rows >0) {
while($row = $result->fetch_assoc()) {
	$rr=$row['id'];
$sql1 = "SELECT * FROM goingevent where id ='$rr'";
$result1 = $conn->query($sql1);
$num1=$result1->num_rows;
	
$response[] = array("id" => $row['id']
,"nameEvent" => $row['nameEvent']
,"stEvent" =>$row['stEvent'],
 "etEvent" => $row['etEvent'],"edEvent" =>$row['edEvent'],"sdEvent" =>$row['sdEvent'],"desEvent" =>$row['desEvent'],"locEvent" =>$row['locEvent'],
 "pic" =>$row['pic'],"num" => $num1);
 $json = json_encode($response);//."".$response2
}
 
} else {
	
	$response="No Results Found";
 $json = json_encode($response);
}
 echo $json;
$conn->close();
?>