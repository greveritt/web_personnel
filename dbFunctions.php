<?php
 
function connect() {
    $db = new mysqli('localhost', 'USER', 'PASSWORD', 'OPUS');
    return $db;
}

# ensures that proper database and table has been initialized
function ensureInit($db) {
	// check that DB and table exist, creates if they don't
	$initFile = 'init.sql';
	$initQuery = file_get_contents($initFile);
	$db->query($initQuery);
}

?>
