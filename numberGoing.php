<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);

$id = $decodedData['id'];
// Creating SQL command to fetch all records from Table.

$sql = " SELECT * FROM goingevent WHERE id='$id'";
$result = $conn->query($sql);
$num=$result->num_rows;



 // Converting the message into JSON format.
$emailExistJson = json_encode($num,JSON_UNESCAPED_UNICODE);
 
// Echo the message.
 echo $emailExistJson ; 


$conn->close();
?>