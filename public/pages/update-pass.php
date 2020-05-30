<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dev Domain - Update Password</title>
  <link rel="stylesheet" href="../css/tailwind.css" />
  <link rel="stylesheet" href="../css/custom.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
</head>

<body ng-app="pass" ng-controller="passCtrl" class="flex flex-col min-h-screen">
  <header>
    <div class="flex items-center justify-between flex-wrap bg-gray-900 p-6">
      <div class="flex items-center mr-6">
        <a href="../index.php">
          <img src="../assets/img/logo.svg" alt="Dev Domain" />
        </a>
      </div>
      <div class="block lg:hidden">
        <button class="flex items-center px-3 py-2 text-white" id="menuBtn">
          <svg class="icon fill-current w-6 h-6">
            <use xlink:href="../assets/img/icons.svg#icon-menu"></use>
          </svg>
        </button>
      </div>
      <nav class="w-full block hidden flex-grow lg:flex lg:items-center lg:w-auto" id="nav">
        <div class="text-center lg:flex-grow lg:text-left">
          <a href="../index.php" class="block mt-4 p-2 lg:inline-block lg:mt-0 lg:mr-4 lg:p-0">Home</a>
          <a href="./about.php" class="block mt-4 p-2 lg:inline-block lg:mt-0 lg:mr-4 lg:p-0">About</a>
          <a href="./news.php" class="block mt-4 p-2 lg:inline-block lg:mt-0 lg:mr-4 lg:p-0">News</a>
          <a href="./events.php" class="block mt-4 p-2 lg:inline-block lg:mt-0 lg:mr-4 lg:p-0">Events</a>
          <a href="./contact.php" class="block mt-4 p-2 lg:inline-block lg:mt-0 lg:mr-4 lg:p-0">Contact</a>
        </div>
        <?php
          if (isset($_SESSION['username']) && $_SESSION['loggedIn']) {
            ?>
        <div class="text-center">
          <a href="./member.php" class="btn btn-outline block lg:inline-block mt-4 mx-2 lg:m-0">Member Dashboard</a>
          <a href="./logout.php" class="btn btn-purple block lg:inline-block mt-4 mx-2 lg:mt-0">Log Out</a>
        </div>
        <?php
          } else {
            ?>
        <div class="text-center">
          <a href="./register.php" class="btn btn-outline block lg:inline-block mt-4 mx-2 lg:m-0">Sign Up</a>
          <a href="./login.php" class="btn btn-purple block lg:inline-block mt-4 mx-2 lg:mt-0">Log In</a>
        </div>
        <?php
          }
          ?>
      </nav>
    </div>
  </header>
  <main class="flex-grow">
    <section class="container my-4 px-4 lg:p-0 mx-auto max-w-lg">
      <h1 class="text-3xl mb-2">Change Your Password</h1>
      <div class="bg-gray-900 p-4 rounded-md">
        <?php
          if (isset($_SESSION['username']) && $_SESSION['loggedIn']) {
              $username = $_SESSION['username'];
            ?>

        <a href="./member.php" class="btn btn-small btn-gray text-sm mb-2 flex items-center">
          <svg class="icon fill-current h-6 w-6">
            <use xlink:href="../assets/img/icons.svg#icon-chevron-left"></use>
          </svg>
          Return to member dashboard
        </a>
        <p class="text-sm">Note: you cannot change your username</p>
        <form name="passForm" ng-submit="updatePass()" novalidate class="my-2">
          <div class="form-control">
            <label for="username">Username</label>
            <input type="text" name="username" ng-model="username" ng-init="username='<?= $username; ?>'" disabled
              class="text-gray-500 cursor-not-allowed" />
          </div>
          <div class="form-control">
            <label for="currentPass">Current Password</label>
            <input type="password" name="currentPass" ng-model="currentPass" required />
            <span ng-show="passForm.currentPass.$touched && passForm.currentPass.$error.required"
              class="error-msg">Please enter your current password.</span>
          </div>
          <div class="form-control">
            <label for="newPass">New Password</label>
            <input type="password" name="newPass" ng-model="newPass"
              pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$" required />
            <span ng-show="passForm.newPass.$touched && passForm.newPass.$error.required" class="error-msg">New password
              is required.</span>
            <span ng-show="passForm.newPass.$touched && passForm.newPass.$invalid" class="error-msg">Password must
              contain a number, uppercase, lowercase, and
              special character and be at least 8 characters.</span>
          </div>
          <div class="form-control">
            <label for="confirmPass">Confirm New Password</label>
            <input type="password" name="confirmPass" ng-model="confirmPass" required data-password-verify="newPass" />
            <span ng-show="passForm.confirmPass.$touched && passForm.confirmPass.$error.required"
              class="error-msg">Confirm new password is required.</span>
            <span ng-show="passForm.confirmPass.$touched && passForm.confirmPass.$error.passwordVerify"
              class="error-msg">New passwords must match.</span>
          </div>
          <div class="my-3" ng-show="passForm.$invalid && passForm.$dirty">
            <span class="bg-red-600 py-1 px-3 rounded-full text-sm font-semibold">
              Please fill out the form correctly before submitting
            </span>
          </div>
          <input type="submit" value="Update Password" name="updatePass" class="btn btn-purple mt-2 inline-block"
            ng-disabled="passForm.$invalid" />
        </form>

        <div class="bg-gray-800 mt-4 p-4 rounded-md" ng-if="success">
          <p ng-bind="message"></p>
        </div>
        <div class="bg-gray-800 mt-4 p-4 rounded-md" ng-if="!success && message">
          <p ng-bind="message"></p>
        </div>

        <?php
          } else {
            ?>
        <span class="font-semibold bg-red-600 px-3 py-1 rounded-full inline-block">Error: You are not logged in</span>
        <div class="mt-4">
          <a href="./login.php" class="btn btn-sm btn-purple inline-block mr-2">Log In</a>
          <a href="./register.php" class="btn btn-sm btn-gray inline-block">Register</a>
        </div>
        <?php
          }
        ?>
      </div>
    </section>
  </main>
  <footer class="bg-gray-900">
    <div class="md:flex justify-between container items-top py-4 text-left px-4 sm:px-0 mt-2 mx-auto">
      <div class="flex-1 md:w:1/3 flex justify-around md:justify-start my-4">
        <ul class="leading-8 mr-8">
          <li>
            <a href="../index.php">Home</a>
          </li>
          <li>
            <a href="./about.php">About</a>
          </li>
          <li>
            <a href="./news.php">News</a>
          </li>
          <li>
            <a href="./events.php">Events</a>
          </li>
        </ul>
        <ul class="leading-8">
          <li>
            <a href="./contact.php">Contact</a>
          </li>
          <li>
            <a href="./privacy.php">Privacy Policy</a>
          </li>
          <li>
            <a href="./register.php">Sign Up</a>
          </li>
          <li>
            <a href="./login.php">Log In</a>
          </li>
        </ul>
      </div>
      <div class="flex-1 md:w-1/3 text-center md:text-left my-4">
        <form action="">
          <label for="newsletter-email" class="block mb-2">Sign up for our newsletter</label>
          <div class="flex items-baseline">
            <input type="email" class="inline mr-3" placeholder="example@email.com" />
            <input type="submit" value="Submit" class="btn btn-purple inline" disabled />
          </div>
        </form>
        <div class="mt-1">
          <h6 class="">Keep in touch</h6>
          <div class="flex items-center justify-center md:justify-start">
            <a href="#"><svg class="icon fill-current text-purple-600 h-8 w-8 m-1 ml-0 hover:text-purple-700">
                <use xlink:href="../assets/img/icons.svg#icon-facebook"></use>
              </svg></a>
            <a href="#"><svg class="icon fill-current text-purple-600 h-8 w-8 m-1 hover:text-purple-700">
                <use xlink:href="../assets/img/icons.svg#icon-twitter-square"></use>
              </svg></a>
            <a href="#"><svg class="icon fill-current text-purple-600 h-8 w-8 m-1 hover:text-purple-700">
                <use xlink:href="../assets/img/icons.svg#icon-instagram"></use>
              </svg></a>
          </div>
        </div>
      </div>
      <div class="flex-1 md:w-1/3 text-center md:text-right my-2">
        <img src="../assets/img/logo.svg" alt="Dev Domain" class="mx-auto md:ml-auto md:mr-0 mb-1" />
        <p class="mb-3 leading-tight">
          120 Currie St<br />
          Adelaide SA 5000<br />
          hello@domain.com<br />
          08 8100 2000
        </p>
        <span class="text-sm">&copy; 2020 Renee Quinn</span>
      </div>
    </div>
  </footer>
  <script src="../js/navbar.js"></script>
  <script src="../js/pass-controller.js"></script>
</body>

</html>