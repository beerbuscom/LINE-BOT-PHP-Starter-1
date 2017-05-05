<?php
$access_token = 'iOAyJbgwtAZwMX0uFk3PbSJfXUe4DKfY/9BOnmNZZNV3qDaNzd2kkU6pIN3smlVNS81qEfcpCHHebo0d7JoraRnM6K/aOi+irAbiE+3VNINYVQxlZ2V9VB+7WCry5vsgaL5j3A+tlOL6wIKeQWQauAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
?>
