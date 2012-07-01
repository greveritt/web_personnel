<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
<title>output</title>
</head>

<body>

<p>
<?php
include 'dbFunctions.php';

// retrieve form data

$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phone = $_POST['phone'];
$location = $_POST['location'];

// connect to MySQL server database 'daedalus'
$our_db = connect();

/*check connection for errors */
if ($our_db->connect_errno) {
    printf("Connection failed: %s\n", $our_db->connect_errno);
    exit();
}

// add form input as new row in DB
if (!$our_db->query("INSERT INTO employees 
    VALUES($id, '$fname', '$lname', $phone, '$location');")) {
    printf("<br>Error: %s. Request could not be completed.", $our_db->error);
}
else {
    echo 'Your request was completed successfully.';
}
$our_db->close();
?>
</p>

<p>
    <a href="http://validator.w3.org/check?uri=referer"><img
      src="http://www.w3.org/Icons/valid-html401" alt="Valid HTML 4.01 Strict" height="31" width="88"></a>
</p>

</body>

</html>
