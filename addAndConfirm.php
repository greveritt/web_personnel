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

// add form input as new row in DB
$queryString = 'INSERT INTO employees VALUES(?, ?, ?, ?, ?);';
$query = $our_db->prepare($queryString);
$query->bind_param('issss', $_POST['id'], $_POST['fname'], $_POST['lname'], $_POST['phone'], $_POST['location']);
if (!$query->execute()) {
    printf("<br>Error: %s. Request could not be completed.", $our_db->error);
}
else {
    echo 'Your request was completed successfully.';
	echo '<table>';
	echo '<caption>Added row</caption>';
	echoTableHeader();
	displayRow($_POST['id'], $_POST['fname'], $_POST['lname'], $_POST['phone'], $_POST['location']);
	echo '</table>';
}
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
