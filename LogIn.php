<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
 // Getting the received JSON into $json variable.
 $json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
 $decodedData= json_decode($json,true);
 $UserEmail = $decodedData['Email'];
$UserPW = ($decodedData['Password']); //password is hashed

$SQL = "SELECT * FROM user WHERE userEmail = '$UserEmail'";
$exeSQL = mysqli_query($conn, $SQL);
$checkEmail =  mysqli_num_rows($exeSQL);

if ($checkEmail != 0) {
    $arrayu = mysqli_fetch_array($exeSQL);
    if ($arrayu['userPassword'] != $UserPW) {
         $Message = "pw WRONG";
    } else {
        $Message = "Success";
    }
} else {
	$SQL = "SELECT * FROM org WHERE userEmail = '$UserEmail'";
    $exeSQL = mysqli_query($conn, $SQL);
    $checkEmail =  mysqli_num_rows($exeSQL);
   
	if ($checkEmail != 0) {
    $arrayu = mysqli_fetch_array($exeSQL);
    if ($arrayu['orgPassword'] != $UserPW) {
        $Message = "pw WRONG";
    } else {
        $Message = "Success";
    }
    }
   else  $Message = "No account yet";
}

//$response[] = array("Message" => $Message);
$response[] = array("Message" => $Message);
echo json_encode($response);
 mysqli_close($conn);
?>