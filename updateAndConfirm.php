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

// prepares check to see if item of given ID even exists
$testQuery = 'SELECT * FROM employees WHERE id = ?';
$IDRecord = $our_db->prepare($testQuery);
$IDRecord->bind_param('d', $_POST['id']);
$IDRecord->execute();
$IDRecord->bind_result($idTest, $fnameTest, $lnameTest, $phoneTest, $locationTest);
$IDRecord->fetch();
$IDRecord->close();
unset($IDRecord);

// if record exists, add form input as updated row in DB, then closes DB
$updateQuery = $our_db->prepare('UPDATE employees SET first_name=?, last_name=?, phone_number=?, location=? WHERE id=?;');
if ($idTest==0) {
    echo '<p>Sorry, that record does not exist.</p>';
}
else if ((!$updateQuery->bind_param('ssssi', $_POST['fname'], $_POST['lname'], $_POST['phone'], $_POST['location'], $_POST['id']) || !$updateQuery->execute())) {
    printf("<p>Error: %s. Request could not be completed.</p>", $our_db->error);
}
else {
    echo '<p>Your request was completed successfully.</p>';
	echo '<table>';
	echo '<caption>Updated row</caption>';
	echoTableHeader();
	displayRow($_POST['id'], $_POST['fname'], $_POST['lname'], $_POST['phone'], $_POST['location']);
	echo '</table>';
} 
$updateQuery->close();
unset($updateQuery);

$our_db->close();

include 'goBack.php';
include 'footer.php';
?>

</body>

</html>
