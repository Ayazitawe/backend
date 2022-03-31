<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$ORGEmail = $decodedData['Email'];
// Creating SQL command to fetch all records from Table.
$sql = "SELECT * FROM followers where OrgEmail = '$ORGEmail' and flag='true' and flagConfirm='false'";
$result = $conn->query($sql);
$Sql_Query = "UPDATE followers SET flag='false' WHERE  OrgEmail='$ORGEmail'";
// Converting the message into JSON format.
$rs=mysqli_query($conn,$Sql_Query);


if ($result->num_rows >0) {
 
 
 while($row[] = $result->fetch_assoc()) {
 
 $response = $row;
 
 $json = json_encode($response);
 
 }
 
} else {
	$response="No Results Found";
 $json = json_encode($response);
}
 echo $json;
$conn->close();
?>