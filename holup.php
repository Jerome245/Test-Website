<?php

		error_reporting(E_ALL);
		ini_set("display_errors", 1);
		require 'vendor/autoload.php';

		$from = new SendGrid\Email(null, "test@example.com");
$subject = "Hello World from the SendGrid PHP Library!";
$to = new SendGrid\Email(null, "jaaglugub@clc.pshs.edu.ph");
$content = new SendGrid\Content("text/plain", "Hello, Email!");
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

echo $apiKey;
echo "\n\n\n";
echo $sg;
echo "\n\n\n";

$response = $sg->client->mail()->send()->post($mail);
echo $response->statusCode();
echo "\n\n\n                             ";
echo $response->headers();
echo "\n\n\n                             ";
echo $response->body();

?>
