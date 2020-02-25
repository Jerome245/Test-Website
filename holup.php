<?php
require 'vendor/autoload.php';

$email = new \SendGrid\Mail\Mail();
$email->setFrom("emailbotsender@gmail.com", "Example User");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("jaaglugub@clc.pshs.edu.ph", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
echo getenv('SENDGRID_API_KEY');

$sendgrid = new \SendGrid('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');
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
