<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$Email = $decodedData['Email'];
$org = $decodedData['org'];
$id = $decodedData['id'];
// Creating SQL command to fetch all records from Table.

$sql = " SELECT * FROM goingevent WHERE userEmail = '$Email' and orgEmail='$org' and id='$id'";
$check = mysqli_fetch_array(mysqli_query($conn,$sql));


if(isset($check)){

 $emailExistMSG = 'true';

 // Converting the message into JSON format.
$emailExistJson = json_encode($emailExistMSG,JSON_UNESCAPED_UNICODE);
 
// Echo the message.
 echo $emailExistJson ; 

 }
 else {
	 $emailExistMSG = 'false';

 // Converting the message into JSON format.
$emailExistJson = json_encode($emailExistMSG,JSON_UNESCAPED_UNICODE);
 
// Echo the message.
 echo $emailExistJson ; 

 }

$conn->close();
?>