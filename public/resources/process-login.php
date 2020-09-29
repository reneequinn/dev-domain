<?php
session_start();

include_once './conndb.php';
include_once './functions.php';
$data = json_decode(file_get_contents("php://input"));
$res = new stdClass();

if ($data != null) {
  $username = checkInput($data->username);
  $password = checkInput($data->password);

  if (empty($username) or empty($password)) {
    $res->message = 'Error: one or more fields are empty';
  } else {
    $query = "SELECT * FROM members WHERE member_username = '$username';";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) == 1) {
      $row = $result->fetch_assoc();

      if (!password_verify($password, $row['member_password'])) {
        $res->message = 'Error: incorrect password';
      } else {
        $firstName = $row['member_first_name'];
        $loggedIn = true;
        mysqli_close($link);

        $_SESSION['username'] = $username;
        $_SESSION['loggedIn'] = true;

        $res->message = 'Successfully logged in';
        $res->loggedIn = $loggedIn;
      }
    } else {
      $res->message = 'Error: username not found';
    }
  }
  $jsonRes = json_encode($res);
  echo $jsonRes;
}

?>