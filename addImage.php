<?php
include('db.php');

// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
 // Getting the received JSON into $json variable.
 $json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
 $decodedData= json_decode($json,true);
 $id = $decodedData['id'];
 $pic = $decodedData['pic']; 
  // Creating SQL query and insert the record into MySQL database table.
$Sql_Query = "update events set pic='$pic' where id='$id'";
 
// Converting the message into JSON format.
if(mysqli_query($conn,$Sql_Query)){
$MSG = 'add image' ; 


$json = json_encode($MSG,JSON_UNESCAPED_UNICODE);
 
// Echo the message.
echo $json ;
}
 else{
 
 echo 'Try Again';
 
 }
 mysqli_close($conn);
?>