<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
 // Getting the received JSON into $json variable.
 $json = file_get_contents('php://input');
  // decoding the received JSON and store into $obj variable.
 $decodedData= json_decode($json,true);
  $UserEmail = $decodedData['Email'];
  $SQL = "SELECT * FROM user WHERE userEmail = '$UserEmail'";
    $exeSQL = mysqli_query($conn, $SQL);
	
//$result = $conn->query($sql);
 $arrayu = mysqli_fetch_array($exeSQL);

	if ($exeSQL->num_rows >0) {
   
    $response[] = array("Message0" => $arrayu['userName'],"Message1" => $arrayu['userphone'],"Message2" => $arrayu['userPassword'],"Message3" => $arrayu['image'],
"Message4" => $arrayu['city'],"Message5" => $arrayu['BD'],"Message6" => $arrayu['WorkPlace'],"Message7" => $arrayu['gender'],"userEmail" => $arrayu['userEmail']
    );}
	else {
	$response="No Results Found";
 $json = json_encode($response);
}
echo json_encode($response);
  mysqli_close($conn);
?>