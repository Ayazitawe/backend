<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$id = $decodedData['id'];
// Creating SQL command to fetch all records from Table.
$sql = "delete FROM orgchildren where id = '$id'";

$result = $conn->query($sql);

if ($result) {
$MSG = 'تم حذف الطفل' ;
$json = json_encode($MSG,JSON_UNESCAPED_UNICODE);
 
} else {
	$json="No Results Found";

}
 echo $json;
$conn->close();
?>