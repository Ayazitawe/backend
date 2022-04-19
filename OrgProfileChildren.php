<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
 // Getting the received JSON into $json variable.
 $json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
 $decodedData= json_decode($json,true);
 $ORGEmail = $decodedData['Email'];
 $ChildName = $decodedData['Name']; 
 $ChildBD = $decodedData['BD'];
 $ChildStory = $decodedData['Story'];
 $ChildImage = $decodedData['Image'];
 $Childgender = $decodedData['gender'];
 $ChildMoney = $decodedData['Money'];
 // Creating SQL query and insert the record into MySQL database table.
$Sql_Query = "insert into orgchildren (ChildName,OrgChildEmail,ChildGender,ChildBD,ChildStory,ChildMoney,ChildImage,userEkfal) values ('$ChildName','$ORGEmail','$Childgender','$ChildBD','$ChildStory','$ChildMoney','$ChildImage','empty')";
 
// Converting the message into JSON format.
if(mysqli_query($conn,$Sql_Query)){
$MSG = 'تم اضافة الطفل' ; 


$json = json_encode($MSG,JSON_UNESCAPED_UNICODE);
 
// Echo the message.
echo $json ;
}
 else{
 
 echo 'Try Again';
 
 }
 mysqli_close($conn);
?>