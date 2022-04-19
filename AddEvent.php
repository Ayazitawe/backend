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
 $des = $decodedData['des'];
 $date1 = $decodedData['date1'];
 $date = $decodedData['date'];
 $st = $decodedData['st'];
 $et = $decodedData['et'];
  $loca = $decodedData['loc1'].$decodedData['loc2'];;

 
 // Creating SQL query and insert the record into MySQL database table.
$Sql_Query = "insert into events (nameEvent,stEvent,etEvent,sdEvent,desEvent,locEvent,Email,edEvent) values ('$Name','$st','$et','$date','$des','$loca','$ORGEmail','$date1')";
 
// Converting the message into JSON format.
if(mysqli_query($conn,$Sql_Query)){
$MSG = 'تم إضافة مناسبة جديدة' ; 


$json = json_encode($MSG,JSON_UNESCAPED_UNICODE);
 
// Echo the message.
echo $json ;
}
 else{
 
 echo 'Try Again';
 
 }
 mysqli_close($conn);
?>