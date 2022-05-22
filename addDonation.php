<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$Email = $decodedData['Email'];
$org = $decodedData['org'];
$id = $decodedData['id'];
$money = $decodedData['money'];
// Creating SQL command to fetch all records from Table.
//Checking email is already exist or not using SQL query.
$CheckSQL = "SELECT * FROM donation WHERE UserEmail='$Email' and id='$id'";

// Executing SQL Query.
$check = mysqli_fetch_array(mysqli_query($conn,$CheckSQL));


if(isset($check)){
$Sql_Query = "update donation set DonationMoney=DonationMoney+'$money',flagNotification='true' where id='$id' and UserEmail='$Email'";
$result = $conn->query($Sql_Query);
$Sql_Query = "update donate set donation=donation+'$money' where id='$id'";
$result = $conn->query($Sql_Query);
if ($result) {
$MSG = 'add exist donation' ;
$json = json_encode($MSG,JSON_UNESCAPED_UNICODE);
 
} else {
	$json="No Results Found";

}
 }
 else {
$sql = "insert into donation (UserEmail,OrgEmail,id,DonationMoney,date,flagNotification) values ('$Email','$org','$id','$money',now(),'true')";
$result = $conn->query($sql);
$Sql_Query = "update donate set donation=donation+'$money' where id='$id'";
$result = $conn->query($Sql_Query);
if ($result) {
$MSG = 'add donation' ;
$json = json_encode($MSG,JSON_UNESCAPED_UNICODE);
 
} else {
	$json="No Results Found";

}	 
 }

 echo $json;
$conn->close();
?>