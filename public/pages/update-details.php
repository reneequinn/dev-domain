<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dev Domain - Update Details</title>
  <link rel="stylesheet" href="../css/tailwind.css" />
  <link rel="stylesheet" href="../css/custom.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
</head>

<body ng-app="details" ng-controller="detailsCtrl" class="flex flex-col min-h-screen">
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
      <nav class="w-full block flex-grow hidden lg:flex lg:items-center lg:w-auto" id="nav">
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
      <h1 class="text-3xl mb-2">Update Your Details</h1>
      <div class="bg-gray-900 p-4 rounded-md">
        <?php
          if (isset($_SESSION['username']) && $_SESSION['loggedIn']) {
            $username = $_SESSION['username'];
            include_once '../resources/conndb.php';
            $query = "SELECT * FROM members WHERE member_username = '$username';";
            $result = mysqli_query($link, $query);
            if (mysqli_num_rows($result) == 1) {
              $row = $result->fetch_assoc(); $firstName =
          $row['member_first_name']; $lastName = $row['member_last_name'];
          $email = $row['member_email']; $phone = $row['member_phone'];
          mysqli_close($link); } else { header('Location: login.html'); exit; }
          ?>
        <a href="./member.php" class="btn btn-small btn-gray text-sm mb-2 flex items-center">
          <svg class="icon fill-current h-6 w-6">
            <use xlink:href="../assets/img/icons.svg#icon-chevron-left"></use>
          </svg>
          Return to member dashboard
        </a>
        <p class="text-sm">Note: you cannot change your username</p>
        <form name="updateForm" ng-submit="updateUser()" novalidate class="my-2">
          <div class="form-control">
            <label for="Username">Username</label>
            <input type="text" name="username" ng-model="username" ng-init="username='<?= $username; ?>'" disabled
              class="text-gray-500 cursor-not-allowed" />
          </div>
          <div class="form-control">
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" ng-model="firstName" ng-init="firstName = '<?= $firstName; ?>'"
              ng-maxlength="20" required />
            <span ng-show="updateForm.firstName.$touched && updateForm.firstName.$error.required"
              class="error-msg">First name is required.</span>
            <span ng-show="updateForm.firstName.$dirty && updateForm.firstName.$error.maxlength" class="error-msg">First
              name cannot be more than 20 characters.</span>
          </div>
          <div class="form-control">
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" ng-model="lastName" ng-init="lastName = '<?= $lastName; ?>'"
              ng-maxlength="30" required />
            <span ng-show="updateForm.lastName.$touched && updateForm.lastName.$error.required" class="error-msg">Last
              name is required.</span>
            <span ng-show="updateForm.lastName.$dirty && updateForm.lastName.$error.maxlength" class="error-msg">Last
              name cannot be more than 30 characters.</span>
          </div>
          <div class="form-control">
            <label for="email">Email</label>
            <input type="email" name="email" ng-model="email" ng-init="email='<?= $email; ?>'" required />
            <span ng-show="updateForm.email.$touched && updateForm.email.$error.required" class="error-msg">Email is
              required.</span>
            <span ng-show="updateForm.email.$dirty && updateForm.email.$invalid" class="error-msg">Please enter a valid
              email.</span>
          </div>
          <div class="form-control">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" ng-model="phone" ng-init="phone='<?= $phone; ?>'"
              pattern="^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$" required />
            <span ng-show="updateForm.phone.$touched && updateForm.phone.$error.required" class="error-msg">Phone number
              is required.</span>
            <span ng-show="updateForm.phone.$dirty && updateForm.phone.$invalid" class="error-msg">Please enter a valid
              phone number.</span>
          </div>
          <div class="form-control">
            <label for="password">Password <span>(required)</span></label>
            <input type="password" name="password" ng-model="password" required />
            <span ng-show="updateForm.password.$touched && updateForm.password.$error.required" class="error-msg">Please
              enter your password.</span>
          </div>
          <div class="my-3" ng-show="updateForm.$invalid && updateForm.$dirty">
            <span class="bg-red-600 py-1 px-3 rounded-full text-sm font-semibold">Please fill out the form correctly
              before submitting</span>
          </div>
          <input type="submit" value="Update" name="updateSubmit" class="btn btn-purple mt-2 inline-block"
            ng-disabled="updateForm.$invalid" />
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
  <script src="../js/details-controller.js"></script>
</body>

</html>