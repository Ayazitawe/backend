<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$Email = $decodedData['Email'];
$id= $decodedData['id'];
// Creating SQL command to fetch all records from Table.
$Sql_Query = "update orgchildren set ekfalTimes=ekfalTimes+1, flagEkfalNoti='true' where id='$id'";
if(mysqli_query($conn,$Sql_Query)){
$MSG = 'تم الدفع' ; 


$json = json_encode($MSG,JSON_UNESCAPED_UNICODE);
 
// Echo the message.
echo $json ;
}
 else{
 
 echo 'Try Again';
 
 }
$conn->close();
?>