<?php

require '../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

$dbHost = getenv('DB_HOST');
$dbUser = getenv('DB_USER');
$dbPass = getenv('DB_PASS');
$dbName = getenv('DB_NAME');
// Connection variables
// $db = array(
//   'host' => 'localhost',
//   'user' => 'root',
//   'password' => '',
//   'dbname' => 'codeclubdb'
// );

// $link = mysqli_connect($db['host'], $db['user'], $db['password'], $db['dbname'] );

$link = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

// if (!$link) {
//   echo mysqli_error($link);
// } else {
//   echo 'Connected to DB';
// };

?>