<?php

//connection
$host_name = 'db763714931.hosting-data.io';
$database = 'db763714931';
$user_name = 'dbo763714931';
$password = '3HEJI@ll19';

$conn = mysqli_connect($host_name, $user_name, $password, $database);

// vars from script
$centValue = $_POST['centValue'];
$centRange = $_POST['centRange'];
$hdMin = $_POST['hdMin'];
$hdMax = $_POST['hdMax'];
$filter3 = $_POST['filter3'];
$filter5 = $_POST['filter5'];
$filter7 = $_POST['filter7'];
$filter11 = $_POST['filter11'];
$filter13 = $_POST['filter13'];
$filter17 = $_POST['filter17'];
$filter19 = $_POST['filter19'];
$filter23 = $_POST['filter29'];
$maxAcc = $_POST['maxAcc'];
$currentRefNote = $_POST['currentRefNote'];
$currentRefAccidental = $_POST['currentRefAccidental'];
$sort = $_POST['sort'];

// getting data from table

$centSearch = "SELECT * FROM enharmonictable WHERE cents>=($centValue-$centRange) AND cents<=($centValue+$centRange) AND (hd>=$hdMin) AND (hd<=$hdMax) AND $filter3 AND $filter5 AND $filter7 AND $filter11 AND $filter13 AND $filter17 AND $filter19 AND $filter29 AND (acc<=$maxAcc) $sort;";
$result = mysqli_query($conn, $centSearch);

// storing in array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
	$data[] = $row;
}

$j = count($data);
for ($i = 0; $i < $j; $i++) {
	$data[$i]["delta"] = abs($centValue - $data[$i]["cents"]);
	$five = $data[$i]["monzo5"] + $data[$i]["monzo17"] + $data[$i]["monzo29"];
	$data[$i]["diat"] = $currentRefNote + $data[$i]["diat"] - 3;
	if ($currentRefAccidental == 0) {
		if ($data[$i]["acc_3"] <= -2 || ($data[$i]["acc_3"] == 0 && $five == 0)) {
			$data[$i]["acc"] = $data[$i]["acc"] + 1;
		}	
		if ($data[$i]["acc_3"] >= 3 || ($data[$i]["acc_3"] == 1 && $five == 0)) {
			$data[$i]["acc"] = $data[$i]["acc"] - 1;
		}
	}
	if ($currentRefAccidental == 2) {
		if ($data[$i]["acc_3"] >= 2 || ($data[$i]["acc_3"] == 0 && $five == 0)) {
			$data[$i]["acc"] = $data[$i]["acc"] + 1;
		}
		if ($data[$i]["acc_3"] == -3 || ($data[$i]["acc_3"] == -1 && $five == 0)) {
			$data[$i]["acc"] = $data[$i]["acc"] - 1;
		}
	}
	$data[$i]["acc_3"] = $currentRefAccidental + $data[$i]["acc_3"] - 1;
	if ($data[$i]["diat"] > 6) {
		$data[$i]["diat"] = $data[$i]["diat"] - 7;
		$data[$i]["acc_3"] = $data[$i]["acc_3"]  + 1;
		if ($data[$i]["acc_3"] >= 3 || ($data[$i]["acc_3"] == 1 && $five == 0)) {
			$data[$i]["acc"] = $data[$i]["acc"] + 1;
		} else if ($data[$i]["acc_3"] == 0 && $five == 0) {
			$data[$i]["acc"] = $data[$i]["acc"] - 1;
		}
	} else if ($data[$i]["diat"] < 0) {
		$data[$i]["diat"] = $data[$i]["diat"] + 7;
		$data[$i]["acc_3"]  = $data[$i]["acc_3"]  - 1;
		if ($data[$i]["acc_3"] <= -3 || ($data[$i]["acc_3"] == -1 && $five == 0)) {
			$data[$i]["acc"] = $data[$i]["acc"] + 1;
		} else if ($data[$i]["acc_3"] == 0 && $five == 0) {
			$data[$i]["acc"] = $data[$i]["acc"] - 1;
		}
	}
}

// sort by absolute value delta
function compare_deltas($a, $b) {
		return ($a["delta"] > $b["delta"]);
		}

if ($sort == "ORDER BY cents ASC") {
	usort($data, "compare_deltas");
	}

$datafilter = array();
$j = count($data);
$k = 0;
for ($i = 0; $i < $j; $i++) {
	if ($data[$i]["acc"] <= $maxAcc) {
		$datafilter[$k] = $data[$i];
		$k = $k + 1;
	}
}

// returning response in JSON format

echo json_encode($datafilter);

// Free result set
mysqli_free_result($result);
mysqli_close($conn);
?>