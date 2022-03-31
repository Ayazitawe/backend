<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$UserEmail = $decodedData['Email'];
// Creating SQL command to fetch all records from Table.
$sql = "SELECT * FROM followers where UserEmail = '$UserEmail' and flagConfirm='true' and flagConfirmNoti='false'";
$result = $conn->query($sql);
$Sql_Query = "UPDATE followers SET flagConfirmNoti='true' WHERE  UserEmail='$UserEmail' and flagConfirm='true'";
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