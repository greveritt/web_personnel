<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type">
<title>output</title>
</head>

<body>

<p>
<?php
ini_set('display_errors',1); 
 error_reporting(E_ALL);
require 'dbFunctions.php';

// retrieve form data

$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phone = $_POST['phone'];
$location = $_POST['location'];


// connect to MySQL database
$our_db = getDBAccess();

// prepares check to see if item of given ID even exists
$testQuery = "SELECT * FROM employees WHERE id = ?";
$IDRecord = $our_db->prepare($testQuery);
$IDRecord->bind_param('d', $_POST['id']);
$IDRecord->execute();
$IDRecord->bind_result($idTest, $fnameTest, $lnameTest, $phoneTest, $locationTest);
$IDRecord->fetch();
$IDRecord->close();
unset($IDRecord);

// if record exists, add form input as updated row in DB, then closes DB
$updateQuery = $our_db->prepare("UPDATE employees SET first_name=?, last_name=?, phone_number=?, location=? WHERE id=?;");
if (!isset($idTest)) {
    break;
}
else if ((!$updateQuery->bind_param('ssssi', $_POST['fname'], $_POST['lname'], $_POST['phone'], $_POST['location'], $_POST['id']) || !$updateQuery->execute())) {
    printf("<br>Error: %s. Request could not be completed.", $our_db->error);
}
else {
    echo 'Your request was completed successfully.';
	echo '<br>';
	printf("ID: %s", $our_db->real_escape_string($_POST['id']));
    echo '<br>';
	printf("First name: %s", $our_db->real_escape_string($_POST['fname']));
    echo '<br>';
	printf("Last name: %s", $our_db->real_escape_string($_POST['lname']));
    echo '<br>';
	printf("Phone #: %s", $our_db->real_escape_string($_POST['phone']));
    echo '<br>';
	printf("Location: %s", $our_db->real_escape_string($_POST['location']));
    echo '<br>';
} 
$updateQuery->close();
unset($updateQuery);

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
