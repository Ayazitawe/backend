<?php
include('db.php');

// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
 // Getting the received JSON into $json variable.
 $json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
 $decodedData= json_decode($json,true);
 $ORGEmail = $decodedData['org'];
 $UserEmail = $decodedData['Email']; 
 $Message = $decodedData['message'];
 $flag = $decodedData['flag'];

$CheckSQL = "SELECT * FROM chat WHERE userEmail='$UserEmail' and orgEmail='$ORGEmail'";

// Executing SQL Query.
$check = mysqli_fetch_array(mysqli_query($conn,$CheckSQL));


if(isset($check)){
if($flag==1) $Sql_Query = "update chat set message='$Message', flagNotification='true' where userEmail='$UserEmail' and orgEmail='$ORGEmail'";
else $Sql_Query = "update chat set message='$Message', flagNotificationO='true' where userEmail='$UserEmail' and orgEmail='$ORGEmail'";
 if(mysqli_query($conn,$Sql_Query)){
$MSG = 'edit' ; 
$json = json_encode($MSG,JSON_UNESCAPED_UNICODE);
echo $json ;
}
}
 else {
	 // Creating SQL query and insert the record into MySQL database table.
$Sql_Query = "insert into chat (orgEmail,message,userEmail,flagNotification) values ('$ORGEmail','$Message','$UserEmail','false')";
 
// Converting the message into JSON format.
if(mysqli_query($conn,$Sql_Query)){
$MSG = 'تم إضافة محادثة جديدة' ; 
$json = json_encode($MSG,JSON_UNESCAPED_UNICODE);
echo $json ;
 }
}

 mysqli_close($conn);
?>