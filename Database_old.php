<?php
$servername = "cse.unl.edu";
$username = "sbhandari";
$password = "dg4:fA";
$dbname = "sbhandari";

// $year = $_POST['val'];
// $livestock_string = $_POST['livestock'];
$year = "2002";
$livestock_string = "('04 Dairy Prods; Birds Eggs; Honey; Ed Animal Pr Nesoi', '0103 Swine, Live', '1005 Corn (maize)', '100590 Corn (maize), Other Than Seed Corn', '110220 Corn (maize) Flour', '151529 Corn (maize) Oil, Refined, & Fractions, Not Modif', '230670 Corn Germ Oilcake Othr Solid Residue Wh/not Ground')"
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//$year= slider's val
$sql = "SELECT country, sum( year".$year." ) as sum_year".$year." FROM dwfi_data WHERE year".$year." != 0 and country!='World Total' and commodity IN ". $livestock_string ." group by country;" ;
$result = $conn->query($sql);
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
    $json = json_encode($finalArray);
    echo $json;
} else {
	echo "error";
    echo $year;
	echo $livestock;
}

$conn->close();
?>