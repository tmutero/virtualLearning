<?php
// Get the PHP helper library from twilio.com/docs/php/install
require_once 'autoload.php'; // Loads the library
use \Twilio\Rest\Client;

// Your Account Sid and Auth Token from twilio.com/user/account
$sid = "ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
$token = "your_auth_token";
$client = new Client($sid, $token);

$messages = $client->account->messages->read(
    array("to" => $_SERVER['QUERY_STRING']),
    50
);
// Loop over the list of calls and echo a property for each one
foreach($messages as $message) {
    echo "<tr><td class=\"text-center\">" . $message->from . "</td><td class=\"text-center\">" . $message->dateSent->format('Y-m-d H:i:s') . "</td><td class=\"text-center\">" . $message->body . "</td></tr>";
}