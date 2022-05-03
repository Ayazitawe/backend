<?php
include('db.php');

// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
 // Getting the received JSON into $json variable.
 $json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
 $decodedData= json_decode($json,true);
 $ORGEmail = $decodedData['Email'];
 $Name = $decodedData['Name']; 
 $Name1 = $decodedData['Name1'];  //descr
 $Name2 = $decodedData['Name2']; //money
 $date1 = $decodedData['date1'];
 $picD = $decodedData['picD']; 
 // Creating SQL query and insert the record into MySQL database table.
$Sql_Query = "insert into donate (picD,Name,descr,date,email,money,donation,flagNotification) values ('$picD','$Name','$Name1','$date1','$ORGEmail','$Name2',0,'true')";
 
// Converting the message into JSON format.
if(mysqli_query($conn,$Sql_Query)){
$MSG = 'تم إضافة تبرع جديد' ; 


$json = json_encode($MSG,JSON_UNESCAPED_UNICODE);
 
// Echo the message.
echo $json ;
}
 else{
 
 echo 'Try Again';
 
 }
 mysqli_close($conn);
?>