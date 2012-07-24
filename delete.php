<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
<title>Delete record</title>
<meta content="text/html; charset=utf-8" http-equiv="content-type">
<link rel="stylesheet" href="table.css" type="text/css">
</head>

<body>
<?php
include 'header.php';
?>
<form action="deleteAndConfirm.php" method="post">

<p>
Enter the ID of the record you want to delete: <input type="text" name="id" size="30"> 
</p>

<p><input type="submit" value="Send"></p>

</form>

<?php
include 'goBack.php';
include 'footer.php';
?>

</body>

</html>
