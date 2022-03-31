<?php
include('db.php');
// Creating connection.
 $conn= mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
$decodedData= json_decode($json,true);
$org = $decodedData['org'];
// Creating SQL command to fetch all records from Table.
$sql = "update org set OrgFollower=OrgFollower+1 where orgEmail='$org'";
$result = $conn->query($sql);

if ($result) {
	$SQL = "SELECT * FROM org WHERE orgEmail = '$org'";
    $exeSQL = mysqli_query($conn, $SQL);
    $arrayu = mysqli_fetch_array($exeSQL);
    $response[] = array("Message0" => $arrayu['OrgFollower']  );
	
echo json_encode($response);

}
else {
		$json="No Results Found";
		 echo $json;
} 
$conn->close();
?>