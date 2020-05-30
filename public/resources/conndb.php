<?php

// require '../../vendor/autoload.php';
// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
// $dotenv->load();

// $dbHost = getenv('DB_HOST');
// $dbUser = getenv('DB_USER');
// $dbPass = getenv('DB_PASS');
// $dbName = getenv('DB_NAME');

$url = parse_url(getenv('CLEARDB_DATABASE_URL'));

$dbHost = $url['host'];
$dbUser = $url['user'];
$dbPass = $url['pass'];
$dbName = substr($url['path'], 1);


$link = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

// if (!$link) {
//   echo mysqli_error($link);
// } else {
//   echo 'Connected to DB';
// };

?>