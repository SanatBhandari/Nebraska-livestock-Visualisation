<?php
$servername = "cse.unl.edu";
$username = "sbhandari";
$password = "dg4:fA";
$dbname = "sbhandari";

// Get values from ajax
$year = $_POST['val'];
echo "SOMETHING";
$livestock_string = $_POST['livestock'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Create query to get countries and data
$countryQ = "SELECT country, sum( year".$year." ) as sum_year".$year." FROM dwfi_data WHERE year".$year." != 0 and country!='World Total' and commodity IN ". $livestock_string ." group by country;" ;
// Create query to get geolocations
$geoQ = "SELECT latitude, longitude FROM sbhandari.countries WHERE latitude != 0;";
$countryRS = $conn->query($countryQ);
$geoRS = $conn->query($geoQ);

// Parse result into array and then json
if ($countryRS->num_rows > 0) {
    // output data of each row
	$finalArray[0] = array('Country', 'Livestock Exported (million tons)');
	$i = 1;
    while($row = $countryRS->fetch_assoc()) {
		$array = array(
		$row["country"] , (int)$row["sum_year".$year],
		);
		$finalArray[$i] = $array;
		$i = $i + 1;
    }
    // convert this into a JSON object
    // then use $finalArray then echo json_encode(whatever)
    $countryJson = json_encode($finalArray, JSON_PRETTY_PRINT);
    echo $countryJson;
} else {
    echo "0 results";
}
// Parse result into array and then json
if ($geoRS->num_rows > 0) {
    // output data of each row
	//$finalArray[0] = array('Country', 'Livestock Exported (million tons)');
	$i = 1;
    while($row = $geoRS->fetch_assoc()) {
		$array2 = array(
		(double)$row["latitude"] , (double)$row["longitude"],
		);
		$finalArray2[$i] = $array2;
		$i = $i + 1;
    }
    $geoJson = json_encode($finalArray2, JSON_PRETTY_PRINT);
    echo $geoJson;
} else {
    echo "0 results";
}

$conn->close();
?>
