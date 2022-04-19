<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$ORGEmail = $decodedData['Email'];
// Creating SQL command to fetch all records from Table.
$sql = "SELECT * FROM donation where OrgEmail = '$ORGEmail' ";
$result = $conn->query($sql);

if ($result->num_rows >0) {
while($row = $result->fetch_assoc()) {
	$rr=$row['id'];
 $sql1 = "SELECT * FROM donate where id ='$rr'";
$exeSQL = mysqli_query($conn, $sql1);
 $arrayu = mysqli_fetch_array($exeSQL);
 $emailuser = $row ['UserEmail'];
$sql2= "SELECT * FROM user WHERE userEmail = '$emailuser'";
$exeSQL2 = mysqli_query($conn, $sql2);
 $arrayu2 = mysqli_fetch_array($exeSQL2);
 

 $response[] = array("id" => $row['id'],"OrgEmail" => $row['OrgEmail'],"UserEmail" => $row['UserEmail'],
 "Name" => $arrayu['Name'],"money" => $arrayu['money'],
 "image" => $arrayu2['image'],"userName" => $arrayu2['userName'],"date" => $row['date']);
 $json = json_encode($response);//."".$response2

 }
 
} else {
	$response="No Results Found";
 $json = json_encode($response);
}
 echo $json;
$conn->close();
?>