<?php

function connect() {
	$db = new mysqli('localhost', 'USER', 'PASSWORD', 'DB_NAME');
    return $db;
}

# ensures that proper database and table has been initialized
function ensureTableInit($db) {
	// check that DB and table exist, creates if they don't
	$initFile = 'init.sql';
	$initQuery = file_get_contents($initFile);
	$db->query($initQuery);
}

function checkConnection($db) {
	// check connection for errors 
	if ($db->connect_errno) {
	printf("Connection failed: %s\n", $db->connect_errno);
	exit();
	}
}

// executes package of functions so that each source file need only call one function to get access to MySQL
function getDBAccess() {
	$db = connect();
	checkConnection($db);
	ensureTableInit($db);
	return $db;
}

function echoTableHeader() {
	echo '<thead>';
	echo '<tr>';
	echo '	<th>ID</th> <th>First name</th> <th>Last name</th> <th>Phone</th> <th>Location</th>';
	echo '</tr>';
	echo '</thead>';
}

// The following function is deprecated
/*
function displayRowContents($id, $fname, $lname, $phone, $location) {
	echo '<br>';
	printf("ID: %s", $id);
    echo '<br>';
	printf("First name: %s", $fname);
    echo '<br>';
	printf("Last name: %s", $lname);
    echo '<br>';
	printf("Phone #: %s", $phone);
    echo '<br>';
	printf("Location: %s", $location);
    echo '<br>';
}
*/

// displays an employee record
function displayRow($id, $fname, $lname, $phone, $location) {
	$cellTemplate = '<td>%s</td> ';
	echo '<tr>';
	// print a cell containing the ID number along with a radio button that submits the ID number
	printf($cellTemplate, '<label><input type="radio" name="id" value="'.$id.'">'.$id.'</label>');
	//printf($cellTemplate, $id);
	// print cells of the other data from the row, as text fields
	printf($cellTemplate, '<input type="text" name="fname" size="30" tabindex="10" value="'.$fname.'">');
	printf($cellTemplate, '<input type="text" name="lname" size="30" tabindex="20" value="'.$lname.'">');
	printf($cellTemplate, '<input type="text" name="phone" size="10" tabindex="30" value="'.$phone.'">');
	printf($cellTemplate, '<input type="text" name="phone" tabindex="40" value="'.$location.'">'); // this will be made a dropdown later
	echo '</tr>';
} 

// display employees table
function displayTable() {
	$db = getDBAccess();
	$selectQueryText = "SELECT * FROM employees;";
	$selectQuery = $db->prepare($selectQueryText);
	$selectQuery->execute();
	$selectQuery->bind_result($id, $fname, $lname, $phone, $location);
	echo "<script type='text/javascript' src='radioFunction.js'></script>";
	echo '<form name="editTable" action="deleteAndConfirm.php" method="post">';
	echo '<table>';
	echo '<caption>Results</caption>';
	echoTableHeader();
	echo '<tbody>';
	while($selectQuery->fetch()) {
		displayRow($id, $fname, $lname, $phone, $location);
	}
	echo '</tbody>';
	echo '</table>';
	echo '<p>';
	echo '<input type="radio" name="function"> Update ';
	echo '<input type="radio" name="function"> Delete ';
	echo '</p>';
	echo '<p><input type="submit" value="Send" onClick="return whichFunction()"></p>';
	echo '</form>';
}
?>
