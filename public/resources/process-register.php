<?php

include_once './conndb.php';
include_once './functions.php';
$data = json_decode(file_get_contents("php://input"));
$res = new stdClass();

if ($data != null) {
  $username = checkInput($data->username);
  $firstName = checkInput($data->firstName);
  $lastName = checkInput($data->lastName);
  $email = checkInput($data->email);
  $phone = checkInput($data->phone);
  $password = checkInput($data->password);
  $passwordConfirm = checkInput($data->passwordConfirm);

  if (empty($username) or empty($firstName) or empty($lastName) or empty($email) or empty($phone) or empty($password)) {
    $res->message = 'Error: one or more fields are empty';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $res->message = 'Error: email is not valid';
  } elseif (!preg_match('/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/', $phone)) {
    $res->message = 'Error: phone number is not valid';
  } elseif (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/', $password)) {
    $res->message = 'Error: password does not meet requirements';
  } elseif ($password != $passwordConfirm) {
    $res->message = 'Error: passwords do not match';
  } else {
    // Check if username is already taken
    $checkQuery = "SELECT * FROM members WHERE member_username = '$username';";
    $checkRes = mysqli_query($link, $checkQuery);

    if (mysqli_num_rows($checkRes) > 0) {
      $res->message = 'Error: the username you have chosen is already taken';
    } else {
      $password = password_hash($password, PASSWORD_DEFAULT);

      $query = "INSERT INTO members (member_username, member_first_name, member_last_name, member_email, member_phone, member_password) VALUES('$username', '$firstName', '$lastName', '$email', '$phone', '$password');";

      if (mysqli_query($link, $query)) {
        $res->message = 'Successfully registered';
        $res->success = true;
      } else {
        $res->message = 'Error registering your details';
        $res->success = false;
      }
    }
  }

  $jsonRes = json_encode($res);
  echo $jsonRes;
}

mysqli_close($link);

?>