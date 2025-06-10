<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
 <?php

$receiving_email_address = 'pathumharshana2018@gmail.com';

// Check if library exists
if (file_exists('../assets/vendor/php-email-form/php-email-form.php')) {
    include('../assets/vendor/php-email-form/php-email-form.php');
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

// Create form instance
$contact = new PHP_Email_Form;
$contact->ajax = true;

$contact->to = $receiving_email_address;

// Sanitize input
$contact->from_name = htmlspecialchars($_POST['name'] ?? '');
$contact->from_email = htmlspecialchars($_POST['email'] ?? '');
$contact->subject = htmlspecialchars($_POST['subject'] ?? 'New Message from Contact Form');

$contact->add_message($contact->from_name, 'From');
$contact->add_message($contact->from_email, 'Email');

if (!empty($_POST['phone'])) {
    $contact->add_message(htmlspecialchars($_POST['phone']), 'Phone');
}

$contact->add_message(htmlspecialchars($_POST['message'] ?? ''), 'Message', 10);

// Optional SMTP config (only if mail() doesn't work)
/*
$contact->smtp = array(
  'host' => 'smtp.yourdomain.com',
  'username' => 'your-smtp-username',
  'password' => 'your-smtp-password',
  'port' => '587' // or 465 for SSL
);
*/

echo $contact->send();

?>

