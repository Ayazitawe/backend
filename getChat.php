<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$Emailuser = $decodedData['Email'];
$Emailorg = $decodedData['org'];

$sql = "SELECT * FROM chat where userEmail='$Emailuser' and orgEmail='$Emailorg'";
$result = $conn->query($sql);
$num=$result->num_rows;
if ($result->num_rows >0) {
 while($row = $result->fetch_assoc()) {

 $response[] = array("id" => $row['id'],"orgEmail" => $row['orgEmail'],"userEmail" =>$row['userEmail'],"message" => $row['message']);
 $json = json_encode($response);//."".$response2
 
 }
 
} else {
	$response="No Results Found";
 $json = json_encode($response);
}
 echo $json;
$conn->close();
?>