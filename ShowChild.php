<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$ORGEmail = $decodedData['Email'];
// Creating SQL command to fetch all records from Table.
$sql = "SELECT * FROM orgchildren where OrgChildEmail = '$ORGEmail'";

$result = $conn->query($sql);

if ($result->num_rows >0) {
 
 
 while($row[] = $result->fetch_assoc()) {
 
 $response = $row;
 
 $json = json_encode($response);
 
 }
 
} else {
 echo "No Results Found.";
}
 echo $json;
$conn->close();
?>