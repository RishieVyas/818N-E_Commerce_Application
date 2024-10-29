<?php
require 'vendor/autoload.php';

use Aws\SecretsManager\SecretsManagerClient;
use Aws\Exception\AwsException;

$secretName = 'db-credentials';
$region = 'us-east-1'; 

$client = new SecretsManagerClient([
    'version' => 'latest',
    'region'  => $region,
]);

try {
    $result = $client->getSecretValue([
        'SecretId' => $secretName,
    ]);

    $secret = $result['SecretString'];
    $credentials = json_decode($secret, true);

} catch (AwsException $e) {
    echo "Error retrieving secret: " . $e->getMessage();
    exit;
}

$host = $credentials['host'];
$username = $credentials['username'];
$password = $credentials['password'];
$dbname = $credentials['dbname'];

$con = new mysqli($host, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

echo "Connected successfully using AWS Secrets Manager!";
?>
