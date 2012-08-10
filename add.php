<!DOCTYPE html>
<html>

<head>
<title>Add record</title>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<link rel="stylesheet" href="table.css" type="text/css" />
</head>

<body>
<?php
include 'header.php';
?>
<form action="addAndConfirm.php" method="post">

<p>
Enter the employee ID: <input type="text" name="id" size="30" /> <br />
Enter the first name: <input type="text" name="fname" size="10" /> <br />
Enter the last name: <input type="text" name="lname" size="10" /> <br />
Enter the phone number (format as XXXXXXXXXX): <input type="text" name="phone" size="10" /> <br />
Enter the location:
<select name="location">
    <option value="">Select location, please.</option>
    <option value="New Jersey">New Jersey</option>
    <option value="New York">New York</option>
    <option value="California">California</option>
</select> <br />
</p>

<p><input type="submit" value="Send" /></p>

</form>

<?php
include 'goBack.php';
include 'footer.php';
?>
</body>

</html>
