<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$ORGEmail = $decodedData['Email'];
// Creating SQL command to fetch all records from Table.
$sql = "SELECT * FROM donation where OrgEmail = '$ORGEmail' and flagNotification='true'";
$result = $conn->query($sql);
$Sql_Query = "UPDATE donation SET flagNotification='false' WHERE  OrgEmail='$ORGEmail'";
// Converting the message into JSON format.
$rs=mysqli_query($conn,$Sql_Query);


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
 "Name" => $arrayu['Name'],"money" => $row['DonationMoney'],
 "image" => $arrayu2['image'],"userName" => $arrayu2['userName']);
 $json = json_encode($response);//."".$response2

 }
 
} else {
	$response="No Results Found";
 $json = json_encode($response);
}
 echo $json;
$conn->close();
?>