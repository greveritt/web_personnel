<?php

function connect() {
	$parameters = file('dbInfo.inc.php');
	$db = new mysqli(trim($parameters[1]), trim($parameters[2]), trim($parameters[3]), trim($parameters[4]));
    return $db;
}

// ensures that proper database and table has been initialized
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
	echo '<table>';
	echo '<thead>';
	echo '<tr>';
	echo '	<th>ID</th> <th>First name</th> <th>Last name</th> <th>Phone</th> <th>Location</th> <th></th> <th></th>';
	echo '</tr>';
	echo '</thead>';
	echo '</table>';
}

// displays an employee record
function displayRow($id, $fname, $lname, $phone, $location) {
	$cellTemplate = '<td>%s</td> ';
	echo '<table>';
	echo '<tbody>';
	echo '<tr>';
	// print a cell containing the ID number along with a radio button that submits the ID number
	printf($cellTemplate, '<label><input type="radio" name="id" value="'.$id.'" />'.$id.'</label>');
	//printf($cellTemplate, $id);
	// print cells of the other data from the row, as text fields
	printf($cellTemplate, '<input type="text" name="fname" size="30" tabindex="10" value="'.$fname.'" />');
	printf($cellTemplate, '<input type="text" name="lname" size="30" tabindex="20" value="'.$lname.'" />');
	printf($cellTemplate, '<input type="text" name="phone" size="10" tabindex="30" value="'.$phone.'" />');
	// determines what location is in the db row, then makes that the selected value for location drop-down
	if ($location == 'New Jersey') {
		printf($cellTemplate, '<select name="location" tabindex="40"><option value="New Jersey" selected>New Jersey</option><option value="New York">New York</option><option value="California">California</option></select>');
}
	else if ($location == 'New York') {
		printf($cellTemplate, '<select name="location" tabindex="40"><option value="New Jersey">New Jersey</option><option value="New York" selected>New York</option><option value="California">California</option></select>');
}
	else if ($location == 'California') {
		printf($cellTemplate, '<select name="location" tabindex="40"><option value="New Jersey">New Jersey</option><option value="New York">New York</option><option value="California" selected>California</option></select>');
}
	else if (($location != 'New Jersey') && ($location != 'New York') && ($location != 'California')) {
		printf($cellTemplate, 'Error: Location information not found');
}
	echo '</tr>';
	echo '</tbody>';
	echo '</table>';
} 

// display employees table
function displayTables() {
	$db = getDBAccess();
	$selectQueryText = "SELECT * FROM employees;";
	$selectQuery = $db->prepare($selectQueryText);
	$selectQuery->execute();
	$selectQuery->bind_result($id, $fname, $lname, $phone, $location);
	echo "<script type='text/javascript' src='radioFunction.js'></script>";
	echo '<form name="editTable" action="addAndConfirm.php" method="post">';
	echo '<table>';
	echo '<caption>Results</caption>';
	echo '</table>';
	echoTableHeader();
	while($selectQuery->fetch()) {
		displayRow($id, $fname, $lname, $phone, $location);
	}
	echo '<p>';
	echo '<label><input type="radio" name="function"> Update </label>';
	echo '<label><input type="radio" name="function"> Delete </label>';
	echo '</p>';
	echo '<p><input type="reset" value="Reset"><input type="submit" value="Send" onClick="return whichFunction()"></p>';
	echo '</form>';
}
?>
