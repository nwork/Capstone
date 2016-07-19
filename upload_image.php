<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
 
print_r($_FILES);
//What folder to save it in
$targetPath = "uploads/";
$allowed_three = array('pdf', 'doc', 'JPG','log', 'txt', 'wpd', 'wps', 'jpg', 'png', 'PEG', 'PNG');
$allowed_four = array('docx');
 
/*Build the stored file path*/
if ( ! isset( $_FILES['uploadedfile'] ) ) {
  die('No file set.');
}
$targetPath = $targetPath . basename($_FILES['uploadedfile']['name']);

if ($_FILES['uploadedfile']['size'] > 5700000 ) {
  die('The file is too big');
}
    
if ( ! in_array ( substr ( $_FILES['uploadedfile']['name'], -3 ), $allowed_three ) &&
    ! in_array ( substr ( $_FILES['uploadedfile']['name'], -4 ), $allowed_four ) ) {
  die('You must upload a valid file type.');
}
    
/*upload and store*/
if ( move_uploaded_file( $_FILES['uploadedfile']['tmp_name'], $targetPath ) ) {
  echo "The file" . basename($_FILES['uploadedfile']['name']) . "has been uploaded";
} else {
  die('There was a problem uploading the file, please try again!');
} 
?>
