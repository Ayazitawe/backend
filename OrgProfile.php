<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
 // Getting the received JSON into $json variable.
 $json = file_get_contents('php://input');
  // decoding the received JSON and store into $obj variable.
 $decodedData= json_decode($json,true);
  $UserEmail = $decodedData['Email'];
  $SQL = "SELECT * FROM org WHERE orgEmail = '$UserEmail'";
    $exeSQL = mysqli_query($conn, $SQL);
    $arrayu = mysqli_fetch_array($exeSQL);
    $response[] = array("Message0" => $arrayu['orgName'],
       "Message1" => $arrayu['orgPhone'],
     "Message2" => $arrayu['orgCity'],
	"Message3" => $arrayu['image'],
	"Message4" => $arrayu['orgPassword'],
	"Message5" => $arrayu['ChildNum'],
	"Message6" => $arrayu['OrgFollower'],
	);
echo json_encode($response);
  mysqli_close($conn);
?>
 