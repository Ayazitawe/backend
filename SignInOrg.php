<?php
 
// Importing DBConfig.php file.
include 'db.php';
 
// Creating connection.
 $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
 // Getting the received JSON into $json variable.
 $json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
 $obj = json_decode($json,true);
 
 // Populate User name from JSON $obj array and store into $name.
$name = $obj['name'];
 
// Populate User email from JSON $obj array and store into $email.
$email = $obj['email'];
 
// Populate Password from JSON $obj array and store into $password.
$password = $obj['password'];

$phone=$obj['phone'];
$city=$obj['city'];
$pic='https://thumbs.dreamstime.com/b/illustration-building-icon-white-background-building-icon-white-background-107844010.jpg';
//Checking email is already exist or not using SQL query.
$CheckSQL = "SELECT * FROM org WHERE orgEmail='$email'";

// Executing SQL Query.
$check = mysqli_fetch_array(mysqli_query($con,$CheckSQL));



if(isset($check)){

 $emailExistMSG = '!المستخدم موجود فعليا';

 // Converting the message into JSON format.
$emailExistJson = json_encode($emailExistMSG,JSON_UNESCAPED_UNICODE);
 
// Echo the message.
 echo $emailExistJson ; 

 }
 else{
 
 // Creating SQL query and insert the record into MySQL database table.
$Sql_Query = "insert into org (orgName,orgEmail,orgPassword,orgCity,orgPhone,image,OrgFollower,ChildNum) values ('$name','$email','$password','$city','$phone','$pic','0','0')";
 
 
 if(mysqli_query($con,$Sql_Query)){
 
 // If the record inserted successfully then show the message.
$MSG = 'تم إنشاء الحساب بنجاح' ; 
 
// Converting the message into JSON format.
$json = json_encode($MSG,JSON_UNESCAPED_UNICODE);
 
// Echo the message.
 echo $json ;
 
 }
 else{
 
 echo 'Try Again';
 
 }
 }
 mysqli_close($con);
?>