<?php
include('db.php');

// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
 // Getting the received JSON into $json variable.
 $json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
$decodedData= json_decode($json,true);
$id = $decodedData['id'];
$Name = $decodedData['Name'];
$Name1 = $decodedData['Name1'];
$Name2 = $decodedData['Name2'];
$date1 = $decodedData['date1'];
$picD = $decodedData['picD'];

  // Creating SQL query and insert the record into MySQL database table.(picD,Name,descr,date,email,money)
$Sql_Query = "update donate set Name='$Name',picD='$picD',descr='$Name1'
,date='$date1' ,money='$Name2' where id='$id'";
 
// Converting the message into JSON format.
if(mysqli_query($conn,$Sql_Query)){
$MSG = 'edit' ; 


$json = json_encode($MSG,JSON_UNESCAPED_UNICODE);
 
// Echo the message.
echo $json ;
}
 else{
 
 echo 'Try Again';
 
 }
 mysqli_close($conn);
?>