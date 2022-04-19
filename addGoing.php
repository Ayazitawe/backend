<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$Email = $decodedData['Email'];
$org = $decodedData['org'];
$id = $decodedData['id'];
// Creating SQL command to fetch all records from Table.
$sql = "insert into goingevent (userEmail,orgEmail,id,flagNotification,date) values ('$Email','$org','$id','true',now())";
$result = $conn->query($sql);

if ($result) {
$MSG = 'add going event' ;
$json = json_encode($MSG,JSON_UNESCAPED_UNICODE);
 
} else {
	$json="No Results Found";

}
 echo $json;
$conn->close();
?>