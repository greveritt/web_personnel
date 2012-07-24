<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type">
<title>output</title>
</head>

<body>

<p>
<?php
require 'dbFunctions.php';

// connect to MySQL database
$our_db = getDBAccess();

// prepares check to see if item of given ID even exists
$testQuery = 'SELECT * FROM employees WHERE id = ?;';
$IDRecord = $our_db->prepare($testQuery);
$IDRecord->bind_param('i', $_POST['id']);
$IDRecord->execute();
$IDRecord->bind_result($idTest, $fnameTest, $lnameTest, $phoneTest, $locationTest);
$IDRecord->fetch();
$IDRecord->close();
unset($recordDeleter);

// prepare delete query
$deleteQuery = 'DELETE FROM employees WHERE id = ?';
$recordDeleter = $our_db->prepare($deleteQuery);
$recordDeleter->bind_param('i', $_POST['id']);

// if record exists, deletes row with specified ID, then closes DB connection
if ($idTest==0) {
    echo 'Sorry, that record does not exist.';
}
else if (!$recordDeleter->execute()) {
    printf("<br>Error: %s. Request could not be completed.", $our_db->error);
}
else {
    echo "Your request was completed successfully. The following employee was deleted:";
	echo '<table>';
	echo '<caption>Deleted row</caption>';
	echoTableHeader();
	displayRow($idTest, $fnameTest, $lnameTest, $phoneTest, $locationTest);
	echo '</table>';
}
$recordDeleter->close();
unset($recordDeleter);
$our_db->close();
?>
</p>

<p>
	<a href="index.html">Back</a> <br>
    <a href="http://validator.w3.org/check?uri=referer"><img
      src="http://www.w3.org/Icons/valid-html401" alt="Valid HTML 4.01 Strict" height="31" width="88"></a>
</p>

</body>

</html>
