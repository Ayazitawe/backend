<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$UserEmail = $decodedData['Email'];
$flag = $decodedData['flag'];
if ($flag==1)  $sql = "SELECT * FROM chat where userEmail = '$UserEmail' and flagNotificationO='true'";
else $sql = "SELECT * FROM chat where orgEmail = '$UserEmail' and flagNotification='true'";

$result = $conn->query($sql);
if ($flag==1) $Sql_Query = "UPDATE chat SET flagNotificationO='false' WHERE  userEmail='$UserEmail'";
else   $Sql_Query = "UPDATE chat SET flagNotification='false' WHERE  orgEmail='$UserEmail'";
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