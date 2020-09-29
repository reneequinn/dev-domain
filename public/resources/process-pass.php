<?php

include_once './conndb.php';
include_once './functions.php';
$data = json_decode(file_get_contents("php://input"));
$res = new stdClass();

if ($data != null) {
  $username = checkInput($data->username);
  $currentPass = checkInput($data->currentPass);
  $newPass = checkInput($data->newPass);
  $confirmPass = checkInput($data->confirmPass);

  if (empty($username) or empty($currentPass) or empty($newPass) or empty($confirmPass)) {
    $res->message = 'Error: one or more fields are empty';
    $res->success = false;
  } elseif (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/', $newPass)) {
    $res->message = 'Error: new password is not valid';
    $res->success = false;
  } elseif ($newPass != $confirmPass) {
    $res->message = 'Error: new password and confirm new password do not match';
    $res->success = false;
  } else {
    $checkQuery = "SELECT * FROM members WHERE member_username = '$username';";
    $checkResult = mysqli_query($link, $checkQuery);

    if (mysqli_num_rows($checkResult) == 1) {
      $row = $checkResult->fetch_assoc();

      if (!password_verify($currentPass, $row['member_password'])) {
        $res->message = 'Error: incorrect current password';
        $res->success = false;
      } else {
        $newPass = password_hash($newPass, PASSWORD_DEFAULT);

        $updateQuery = "UPDATE members SET member_password = '$newPass' WHERE member_username = '$username';";

        if (mysqli_query($link, $updateQuery)) {
          $res->message = 'Successfully updated your password';
          $res->success = true;
        } else {
          $res->message = 'Error updating your password';
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