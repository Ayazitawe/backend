<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$id = $decodedData['id'];
// Creating SQL command to fetch all records from Table.
$sql = "SELECT * FROM goingevent where id = '$id'";
$result = $conn->query($sql);
if ($result->num_rows >0) {
 while($row = $result->fetch_assoc()) {
 $emailuser = $row ['userEmail'];
 $sql1 = "SELECT * FROM user WHERE userEmail = '$emailuser'";
 $exeSQL = mysqli_query($conn, $sql1);
 $arrayu = mysqli_fetch_array($exeSQL);
 $response[] = array("id" => $row['id'],"image" => $arrayu['image'],
 "userName" => $arrayu['userName']);
 $json = json_encode($response);//."".$response2
 
 }
 
} else {
	$response="No Results Found";
 $json = json_encode($response);
}
 echo $json;
$conn->close();
?>