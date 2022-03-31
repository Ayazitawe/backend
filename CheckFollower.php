<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$Email = $decodedData['Email'];
$org = $decodedData['org'];
// Creating SQL command to fetch all records from Table.

$sql = " SELECT flagConfirm FROM followers WHERE UserEmail = '$Email' and OrgEmail='$org'";
$result = $conn->query($sql);

$row = $result->fetch_assoc();
$json = json_encode($row);
 
 echo $json;
$conn->close();
?>