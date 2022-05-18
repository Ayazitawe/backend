<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$Emailorg = $decodedData['Email'];
// Creating SQL command to fetch all records from Table.
$sql = "SELECT * FROM followers where OrgEmail = '$Emailorg'";
$result = $conn->query($sql);
if ($result->num_rows >0) {
 while($row = $result->fetch_assoc()) {
 $emailuser = $row ['UserEmail'];
 $sql1 = "SELECT * FROM user WHERE userEmail = '$emailuser'";
 $exeSQL = mysqli_query($conn, $sql1);
 $arrayu = mysqli_fetch_array($exeSQL);
$response1[] = array("id" => $row['id'],"date" => $row['date'],"image" => $arrayu['image'],
"userName" => $arrayu['userName'],"text" => "طلب الإشتراك في جمعيتك",
 "userEmail" =>$emailuser,"flagConfirm" => $row['flagConfirm']);
$response="No Results Found";
 $json = json_encode($response);//."".$response2
 
 }
 
} else {
	$response="No Results Found";
 $json = json_encode($response);
}
 echo $json;
$conn->close();
?>