<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type">
<link rel="stylesheet" href="table.css" type="text/css">
<title>output</title>
</head>

<body>

<?php
include 'header.php';
require 'dbFunctions.php';

// connect to MySQL database
$our_db = getDBAccess();

// add form input as new row in DB
$queryString = 'INSERT INTO employees VALUES(?, ?, ?, ?, ?);';
$query = $our_db->prepare($queryString);
$query->bind_param('issss', $_POST['id'], $_POST['fname'], $_POST['lname'], $_POST['phone'], $_POST['location']);
if (!$query->execute()) {
    printf("<p>Error: %s. Request could not be completed.</p>", $our_db->error);
}
else {
    echo '<p>Your request was completed successfully.</p>';
	echo '<table>';
	echo '<caption>Added row</caption>';
	echoTableHeader();
	displayRow($_POST['id'], $_POST['fname'], $_POST['lname'], $_POST['phone'], $_POST['location']);
	echo '</table>';
}
$our_db->close();

include 'goBack.php';
include 'footer.php';
?>

</body>

</html>
