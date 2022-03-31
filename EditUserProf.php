<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
 // Getting the received JSON into $json variable.
 $json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
 $decodedData= json_decode($json,true);
$UserEmail = $decodedData['Email'];
 $Name = $decodedData['Name']; 
$City = $decodedData['City'];
 $Phone = $decodedData['Phone'];
 $Image = $decodedData['Image'];
 //$ChildNum = $decodedData['ChildNum'];
 $password = $decodedData['password'];
 // Creating SQL query and insert the record into MySQL database table.
$Sql_Query = "UPDATE user SET userName = '$Name', userphone= '$Phone',
              userPassword='$password',image='$Image',city='$City'
              WHERE  userEmail='$UserEmail'";
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