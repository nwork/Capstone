<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3c.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3c.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Your Feedback</title>
</head>
<body>
<?php
// This page retrieves the parents info from parent_info.html and puts it into the DB accordingly
$ch_fname = $_POST['ch_fname'];
$ch_mname = $_POST['ch_mname'];
$ch_lname = $_POST['ch_lname'];
$ch_age = $_POST['ch_age'];
$gender = $_POST['gender'];
$kalgy = $_POST['kalgy'];
$visit_date = $_POST['visit_date'];

print "<p> Thank you, $ch_fname, $ch_mname, $ch_lname, $ch_age, $kalgy, $visit_date"
// MySQL Commands go here + Response if succeeded.
?>
</body>
</html>
