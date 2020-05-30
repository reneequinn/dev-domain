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

  if (empty($username) or empty($firstName) or empty($lastName) or empty($email) or empty($phone) or empty($password)) {
    $res->message = 'Error: one or more fields are empty';
    $res->success = false;
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $res->message = 'Error: email is not valid';
  } elseif (!preg_match('/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/', $phone)) {
    $res->message = 'Error: phone number is not valid';
    $res->success = false;
  } else {
    $checkQuery = "SELECT * FROM members WHERE member_username = '$username';";
    $checkResult = mysqli_query($link, $checkQuery);

    if (mysqli_num_rows($checkResult) == 1) {
      $row = $checkResult->fetch_assoc();

      if (!password_verify($password, $row['member_password'])) {
        $res->message = 'Error: incorrect password';
        $res->success = false;
      } else {
        $updateQuery = "UPDATE members SET member_first_name = '$firstName', member_last_name = '$lastName', member_email = '$email', member_phone = '$phone' WHERE member_username = '$username';";

        if (mysqli_query($link, $updateQuery)) {
          $res->message = 'Successfully updated your details';
          $res->success = true;
          $res->username = $username;
          $res->firstName = $firstName;
          $res->lastName = $lastName;
          $res->email = $email;
          $res->phone = $phone;

        } else {
          $res->message = 'Error updating your details';
          $res->success = false;
        }
      }
    }
  }
  $jsonRes = json_encode($res);
  echo $jsonRes;
}

mysqli_close($link);

?>