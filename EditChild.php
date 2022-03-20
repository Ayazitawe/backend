<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
 // Getting the received JSON into $json variable.
 $json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
 $decodedData= json_decode($json,true);
 $ChildId = $decodedData['Id'];
 $ORGEmail = $decodedData['Email'];
 $ChildName = $decodedData['Name']; 
 $ChildBD = $decodedData['BD'];
 $ChildStory = $decodedData['Story'];
 $ChildImage = $decodedData['Image'];
 $Childgender = $decodedData['gender'];
 $ChildMoney = $decodedData['Money'];
 // Creating SQL query and insert the record into MySQL database table.
$Sql_Query = "UPDATE orgchildren SET ChildName = '$ChildName', ChildGender= '$Childgender',
              ChildBD='$ChildBD',ChildStory='$ChildStory',ChildMoney='$ChildMoney',ChildImage='$ChildImage'
              WHERE id = '$ChildId' and OrgChildEmail='$ORGEmail'";
// Converting the message into JSON format.
if(mysqli_query($conn,$Sql_Query)){
$MSG = 'تم التعديل' ; 


$json = json_encode($MSG,JSON_UNESCAPED_UNICODE);
 
// Echo the message.
echo $json ;
}
 else{
 
 echo 'Try Again';
 
 }
 mysqli_close($conn);
?>