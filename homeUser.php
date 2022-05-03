<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$EmailUser = $decodedData['Email'];
// Creating SQL command to fetch all records from Table.
$sql = "SELECT * FROM followers where UserEmail = '$EmailUser'";
$result = $conn->query($sql);

if ($result->num_rows >0) {
 while($row = $result->fetch_assoc()) {
	 
 $emailorg = $row ['OrgEmail'];
 $SQLOrg = "SELECT * FROM org WHERE orgEmail = '$emailorg'";
 $exeSQLOrg = mysqli_query($conn, $SQLOrg);
 $arrayuOrg = mysqli_fetch_array($exeSQLOrg);
/////////////////////////////////////////////////////////////////////////////////////////////////////


$sqlD = "SELECT * FROM donate where email = '$emailorg'";
$resultD= $conn->query($sqlD);
if ($resultD->num_rows >0) {
while($rowD = $resultD->fetch_assoc()) {
$rrD=$rowD['id'];
$sqlDD = "SELECT * FROM donation where id ='$rrD'";
$resultDD = $conn->query($sqlDD);
$numDD=$resultDD->num_rows;
$textD=$rowD['Name'].",".$rowD['descr'].",".$rowD['date'].",".$rowD['money'].",".$rowD['donation'].",".$numDD;
//$responseD[] = array("type" =>"D","image" => $rowD['picD'],"OrgName" =>$arrayuOrg['orgName'],"OrgImage" =>$arrayuOrg['image'],"text" =>$textD);
$responseD[] = array("type" =>"D","OrgName" =>$arrayuOrg['orgName'],"text" =>$textD);

}
}
else $responseD[] = array("type" =>"D","OrgName" =>"","text" =>"");;

//////////////////////////////////////////////////////////////////////

$sqlE = "SELECT * FROM events where Email = '$emailorg'";
$resultE= $conn->query($sqlE);

if ($resultE->num_rows >0) {
while($rowE = $resultE->fetch_assoc()) {
	
$rrE=$rowE['id'];
$sqlEE = "SELECT * FROM goingevent where id ='$rrE'";
$resultEE = $conn->query($sqlEE);
$numEE=$resultEE->num_rows;
$textE=$rowE['nameEvent'].",".$rowE['stEvent'].",".$rowE['etEvent'].",".$rowE['edEvent'].",".$rowE['sdEvent'].",".$rowE['locEvent'].",".$rowE['desEvent'].",".$numEE;
//$responseE[] = array("type" =>"E","image" => $rowE['pic'],"OrgName" =>$arrayuOrg['orgName'],"OrgImage" =>$arrayuOrg['image'],"text" =>$textE);
$responseE[] = array("type" =>"E","OrgName" =>$arrayuOrg['orgName'],"text" =>$textE);

}
}
else $responseE[] = array("type" =>"E","OrgName" =>"","text" =>"");;
//////////////////////////////////////////////////////////////////////

$sqlC = "SELECT * FROM orgchildren where OrgChildEmail = '$emailorg'";
$resultC= $conn->query($sqlC);
if ($resultC->num_rows >0) {
while($rowC = $resultC->fetch_assoc()) {
$textC=$rowC['ChildName'].",".$rowC['ChildBD'].",".$rowC['ChildStory'].",".$rowC['ChildMoney'].",".$rowC['ChildGender'];
//$responseC[] = array("type" =>"C","image" => $rowC['ChildImage'],"OrgName" =>$arrayuOrg['orgName'],"OrgImage" =>$arrayuOrg['image'],"text" =>$textC);
$responseC[] = array("type" =>"C","OrgName" =>$arrayuOrg['orgName'],"text" =>$textC);

}
}
else $responseC[] = array("type" =>"C","OrgName" =>"","text" =>"");



$response[] = array("id" => $row['id'],"D" => $responseD,"E" =>$responseE,"C" =>$responseC );
$json = json_encode($response);//."".$response2
//$responseE=reset($responseE);
unset($responseE);
unset($responseD);
unset($responseC);
 //$array = array_diff( $responseE, $responseE);
 }
 
} else {
	$response="No Results Found";
 $json = json_encode($response);
}

  echo $json;
$conn->close();
?>