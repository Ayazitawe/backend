<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$Email = $decodedData['Email'];
// Creating SQL command to fetch all records from Table.
$sql = "SELECT * FROM orgchildren where userEkfal = '$Email'";
$result = $conn->query($sql);

if ($result->num_rows >0) {
 while($row = $result->fetch_assoc()) {
  $str = strtotime($row['dateEkfal']);
  $date=date('d-m-Y', $str);
  $org=$row['OrgChildEmail'];
   $SQL = "SELECT * FROM org WHERE orgEmail = '$org'";
    $exeSQL = mysqli_query($conn, $SQL);
    $arrayu = mysqli_fetch_array($exeSQL);
	$Message=$arrayu['orgName'];
 for ($x=0;$x<$row['ekfalTimes']; $x++){
	 $date2 = date('d-m-Y', strtotime($date. ' + 1 months'));
	 $date=$date2;
 }

	 $dateE = date("d-m-Y");  
    $dateTimestamp1 = strtotime($date2);
    $dateTimestamp2 = strtotime($dateE);
  if ($dateTimestamp1 == $dateTimestamp2){
	  	 $date2 = date('Y-m-d', strtotime($date2. ' + 0 months'));
		$response[] = array("id" => $row['id'],"date" => $row['dateEkfal'],"ChildImage" => $row['ChildImage'],
        "ChildMoney" => $row['ChildMoney'],"text" => " تذكير بكفالة الطفل",
          "ChildName" => $row['ChildName'], "OrgName" => $Message, "flagTime" => 'true',"today" => $date2." 08:00:00");
	   $json = json_encode($response);
  }
 
 }
 
} else {
	$response="No Results Found";
 $json = json_encode($response);
}
 echo $json;
$conn->close();
?>