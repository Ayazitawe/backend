<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

// Creating SQL command to fetch all records from Table.
$sql = "SELECT * FROM org";

$result = $conn->query($sql);

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