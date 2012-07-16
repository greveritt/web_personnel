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

?>
