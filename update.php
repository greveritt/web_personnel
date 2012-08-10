<!DOCTYPE html>
<html>

<head>
<title>Update record</title>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<link rel="stylesheet" href="table.css" type="text/css" />
</head>

<body>
<?php
include 'header.php';
?>
<form action="updateAndConfirm.php" method="post" />

<p>
Enter the ID of the record you want to update: <input type="text" name="id" size="30" /> <br />
Enter the new first name: <input type="text" name="fname" size="10" /> <br />
Enter the new last name: <input type="text" name="lname" size="10" /> <br />
Enter the new phone number (format as XXXXXXXXXX): <input type="text" name="phone" size="10" /> <br />
Enter the new location:
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
