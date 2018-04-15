<?php
$servername = "cse.unl.edu";
$username = "sbhandari";
$password = "dg4:fA";
$dbname = "sbhandari";

$year = $_POST['val'];
$livestock_string = $_POST['livestock'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//$year= slider's val
$sql = "SELECT country, sum( year".$year." ) as sum_year".$year." FROM dwfi_data WHERE year".$year." != 0 and country!='World Total' and commodity IN ". $livestock_string ." group by country;" ;
$sql2 = "SELECT latitude, longitude FROM sbhandari.countries WHERE latitude != 0;";
$result = $conn->query($sql);
$result2 = $conn->query($sql2);

if ($result->num_rows > 0) {
    // output data of each row
	$finalArray[0] = array('Country', 'Livestock Exported (million tons)');
	$i = 1;
    while($row = $result->fetch_assoc()) {
		$array = array(
		$row["country"] , (int)$row["sum_year".$year],
		);
		$finalArray[$i] = $array;
		$i = $i + 1;
    }
    // convert this into a JSON object
    // then use $finalArray then echo jason_encode(whatever)
    $json = json_encode($finalArray, JSON_PRETTY_PRINT);
    //echo json_encode($json, JSON_PRETTY_PRINT);
    echo $json;
} else {
    echo "0 results";
}

// Adding the functionality to fetch the latitudes and Longitudes of each country
if ($result2->num_rows > 0) {
    // output data of each row
	//$finalArray[0] = array('Country', 'Livestock Exported (million tons)');
	$i = 1;
    while($row = $result2->fetch_assoc()) {
		$array2 = array(
		(double)$row["latitude"] , (double)$row["longitude"],
		);
		$finalArray2[$i] = $array2;
		$i = $i + 1;
    }

    $json2 = json_encode($finalArray2, JSON_PRETTY_PRINT);
    //echo json_encode($json2, JSON_PRETTY_PRINT);
    echo $json2;
} else {
    echo "0 results";
}

$conn->close();
?>
