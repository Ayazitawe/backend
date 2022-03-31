<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$Email = $decodedData['Email'];
$org = $decodedData['org'];
// Creating SQL command to fetch all records from Table.

$sql = " UPDATE followers SET flagConfirm='true',flagConfirmNoti='false' WHERE UserEmail = '$Email' and OrgEmail='$org'";
$result = $conn->query($sql);

if ($result) {
$MSG = 'add' ;
$json = json_encode($MSG,JSON_UNESCAPED_UNICODE);
 
} else {
	$json="No Results Found";

}
 echo $json;
$conn->close();
?>