<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$email = $decodedData['Email'];
// Creating SQL command to fetch all records from Table.
$sql = "SELECT * FROM donation where UserEmail = '$email'";
$result = $conn->query($sql);
if ($result->num_rows >0) {
 while($row = $result->fetch_assoc()) {
 $id = $row ['id'];
 $sql1 = "SELECT * FROM donate WHERE id = '$id'";
 $exeSQL = mysqli_query($conn, $sql1);
 $arrayu = mysqli_fetch_array($exeSQL);
 $response[] = array("id" => $row['id'],"picD" => $arrayu['picD'],
 "DonationMoney" => $row['DonationMoney'],"Name" =>$arrayu['Name'],
 "descr" => $arrayu['descr'],"date" =>$arrayu['date'],"money" =>$arrayu['money'],"donation" =>$arrayu['donation']);
 $json = json_encode($response);//."".$response2
 
 }
 
} else {
	$response="No Results Found";
 $json = json_encode($response);
}
 echo $json;
$conn->close();
?>