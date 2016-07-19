<?php
// Recipient
$to = 'RECIPIENT EMAIL ADDRESS';

// Subject
$subject = 'This is our test email';

// Message
$message = '<h1>Hi there.</h1><p>Thanks for testing!</p>';

// Headers
$headers = "From: The Sender Name <SENDER EMAIL ADDRESS>\r\n";
$headers .= "Reply-To: REPLY-TO EMAIL ADDRESS\r\n";
$headers .= "Content-type: text/html\r\n";

// Send email
mail($to, $subject, $message, $headers);
?>
