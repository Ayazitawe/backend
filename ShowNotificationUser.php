<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$Email = $decodedData['Email'];
// Creating SQL command to fetch all records from Table.
$sql = "SELECT * FROM followers where UserEmail = '$Email' and flagConfirm='true'";
$result = $conn->query($sql);
if ($result->num_rows >0) {
 while($row = $result->fetch_assoc()) {
 $emailorg = $row ['OrgEmail'];
 $sql1 = "SELECT * FROM org WHERE orgEmail = '$emailorg'";
 $exeSQL = mysqli_query($conn, $sql1);
 $arrayu = mysqli_fetch_array($exeSQL);
 $response[] = array("id" => $row['id'],"date" => $row['date'],"image" => $arrayu['image'],"orgName" => $arrayu['orgName'],"text" => "وافقت على طلب الإشتراك الخاص بك");
 $json = json_encode($response);
 
 }
 
} else {
	$response="No Results Found";
 $json = json_encode($response);
}
 echo $json;
$conn->close();
?>