<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$Emailorg = $decodedData['Email'];
// Creating SQL command to fetch all records from Table.
$sql = "SELECT * FROM followers where UserEmail = '$Emailorg'";
$result = $conn->query($sql);
$num=$result->num_rows;
if ($result->num_rows >0) {
 while($row = $result->fetch_assoc()) {
 $emailorg = $row ['OrgEmail'];
 $sql1 = "SELECT * FROM org WHERE orgEmail = '$emailorg'";
 $exeSQL = mysqli_query($conn, $sql1);
 $arrayu = mysqli_fetch_array($exeSQL);
 $response[] = array("id" => $row['id'],"image" => $arrayu['image'],"number" =>$num,
 "orgName" => $arrayu['orgName'],"orgEmail" =>$emailorg,"orgPhone" =>$arrayu['orgPhone'],"orgCity" =>$arrayu['orgCity'] );
 $json = json_encode($response);//."".$response2
 
 }
 
} else {
	$response="No Results Found";
 $json = json_encode($response);
}
 echo $json;
$conn->close();
?>