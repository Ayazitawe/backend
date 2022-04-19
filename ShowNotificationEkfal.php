<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$Emailorg = $decodedData['Email'];
// Creating SQL command to fetch all records from Table.
$sql = "SELECT * FROM orgchildren where OrgChildEmail = '$Emailorg' and userEkfal !='empty'";
$result = $conn->query($sql);
if ($result->num_rows >0) {
 while($row = $result->fetch_assoc()) {
 $userEkfal = $row ['userEkfal'];
 $sql1 = "SELECT * FROM user WHERE userEmail = '$userEkfal'";
 $exeSQL = mysqli_query($conn, $sql1);
 $arrayu = mysqli_fetch_array($exeSQL);
 $response[] = array("id" => $row['id'],"date" => $row['dateEkfal'],"image" => $arrayu['image'],
 "userName" => $arrayu['userName'],"text" => " قام بكفالة الطفل",
 "ChildName" => $row['ChildName']);
 $json = json_encode($response);//."".$response2
 
 }
 
} else {
	$response="No Results Found";
 $json = json_encode($response);
}
 echo $json;
$conn->close();
?>