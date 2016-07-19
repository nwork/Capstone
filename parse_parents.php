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
//$p_fname = $_POST['p_fname'];
//$p_mname = $_POST['p_mname'];
//$p_lname = $_POST['p_lname'];
//$p_home_number = $_POST['p_home_number'];
//$p_cell_number = $_POST['p_cell_number'];
//$p_home_address = $_POST['p_home_address'];

function trim_value(&$value)
{
    $value = trim($value);    // this removes whitespace and related characters from the beginning and end of the string
}
array_filter($_POST, 'trim_value');

$postfilter = array(
            'p_fname' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => !FILTER_FLAG_STRIP_LOW),    // removes tags. formatting code is encoded -- add nl2br() when displaying
            'p_mname' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => !FILTER_FLAG_STRIP_LOW),    // removes tags. formatting code is encoded -- add nl2br() when displaying
            'p_lname' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => !FILTER_FLAG_STRIP_LOW),    // removes tags. formatting code is encoded -- add nl2br() when displaying
            'p_home_number' => array('filter' => FILTER_SANITIZE_NUMBER_INT),
            'p_cell_number' => array('filter' => FILTER_SANITIZE_NUMBER_INT),
            'p_home_address' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => !FILTER_FLAG_STRIP_LOW),
            );
$revised_post_array = filter_var_array($_POST, $postfilter);
//echo (nl2br($revised_post_array['p_fname']));
//echo (nl2br($revised_post_array['p_mname']));
//echo (nl2br($revised_post_array['p_lname']));
//echo (nl2br($revised_post_array['p_home_number']));
//echo (nl2br($revised_post_array['p_cell_number']));
//echo (nl2br($revised_post_array['p_home_address']));
$p_fname=(nl2br($revised_post_array['p_fname']));
$p_mname=(nl2br($revised_post_array['p_mname']));
$p_lname=(nl2br($revised_post_array['p_lname']));
$p_home_number=(nl2br($revised_post_array['p_home_number']));
$p_cell_number=(nl2br($revised_post_array['p_cell_number']));
$p_home_address=(nl2br($revised_post_array['p_home_address']));
print "<p> Thank you, $p_fname $p_mname $p_lname, $p_home_number, $p_cell_number, $p_home_address"
// MySQL Commands go here + Response if succeeded.

?>
</body>
</html>