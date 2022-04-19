<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$Emailorg = $decodedData['Email'];
// Creating SQL command to fetch all records from Table.
$sql = "SELECT * FROM donate where email = '$Emailorg'";
$result = $conn->query($sql);
$num=$result->num_rows;

if ($result->num_rows >0) {
while($row = $result->fetch_assoc()) {
	$rr=$row['id'];
$sql1 = "SELECT * FROM donation where id ='$rr'";
$result1 = $conn->query($sql1);
$num1=$result1->num_rows;

$response[] = array(
"id" => $row['id']
,"picD" => $row['picD']
,"Name" =>$row['Name'],
 "descr" => $row['descr'],"date" =>$row['date'],"money" =>$row['money'],"donation" =>$row['donation'],"num" => $num1);
 $json = json_encode($response);//."".$response2

}
} else {
	
	$response="No Results Found";
 $json = json_encode($response);
}
 echo $json;
$conn->close();
?>