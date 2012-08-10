<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<link rel="stylesheet" href="table.css" type="text/css" />
<title>output</title>
</head>

<body>

<?php
include 'header.php';
require 'dbFunctions.php';

// connect to MySQL database
$our_db = getDBAccess();

// prepares check to see if item of given ID even exists
$testQueryString = 'SELECT * FROM employees WHERE id = ?;';
$testQuery = $our_db->prepare($testQueryString);
$testQuery->bind_param('i', $_POST['id']);
$testQuery->execute();
$testQuery->bind_result($idTest, $fnameTest, $lnameTest, $phoneTest, $locationTest);
$testQuery->fetch();
$testQuery->close();
unset($testQuery);

// prepare delete query
$deleteQueryString = 'DELETE FROM employees WHERE id = ?';
$deleteQuery = $our_db->prepare($deleteQueryString);
$deleteQuery->bind_param('i', $_POST['id']);

// if record exists, deletes row with specified ID, then closes DB connection
if ($idTest==0) {
    echo '<p>Sorry, that record does not exist.</p>';
}
else if (!$deleteQuery->execute()) {
    printf("<p>Error: %s. Request could not be completed.</p>", $our_db->error);
}
else {
    echo "<p>Your request was completed successfully. The following employee was deleted:</p>";
	echo '<table>';
	echo '<caption>Deleted row</caption>';
	echoTableHeader();
	displayRow($idTest, $fnameTest, $lnameTest, $phoneTest, $locationTest);
	echo '</table>';
}
$deleteQuery->close();
unset($deleteQuery);
$our_db->close();

include 'goBack.php';
include 'footer.php';
?>

</body>

</html>
