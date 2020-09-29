<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dev Domain - Member Registration</title>
  <link rel="stylesheet" href="../css/tailwind.css" />
  <link rel="stylesheet" href="../css/custom.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
</head>

<body ng-app="register" ng-controller="registerCtrl" class="flex flex-col min-h-screen">
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
    <section class="container my-4 px-4 lg:p-0 mx-auto">
      <h1 class="text-3xl mb-2">Member Registration</h1>
      <div class="bg-gray-900 p-4 rounded-md grid md:grid-cols-2 gap-4">
        <div class="bg-gray-800 py-4 px-6 rounded-md">
          <h2 class="text-2xl mb-1">Sign Up</h2>
          <p class="mb-4">
            Use this form to sign up for membership with Dev Domain
          </p>
          <div ng-if="message" class="mb-2">
            <span ng-bind="message" class="bg-gray-900 font-semibold py-1 px-3 rounded-full mr-2">
            </span>
            <a ng-if="success" href="./login.html" class="bg-purple-600 font-semibold py-1 px-3 rounded-full">Log In</a>
          </div>
          <form name="regForm" ng-submit="registerUser()" novalidate>
            <div class="form-control">
              <label for="username">Username <span>(required)</span></label>
              <input type="text" name="username" id="username" placeholder="Your username" ng-model="username"
                ng-maxlength="15" required />
              <span ng-show="regForm.username.$touched && regForm.username.$error.required" class="error-msg">Username
                is required.</span>
              <span ng-show="regForm.username.$dirty && regForm.username.$error.maxlength" class="error-msg">Username
                cannot be more than 15 characters.</span>
            </div>
            <div class="form-control">
              <label for="firstName">First Name <span>(required)</span></label>
              <input type="text" name="firstName" id="firstName" placeholder="Your first name" ng-model="firstName"
                ng-maxlength="20" required />
              <span ng-show="regForm.firstName.$touched && regForm.firstName.$error.required" class="error-msg">First
                name is required.</span>
              <span ng-show="regForm.firstName.$dirty && regForm.firstName.$error.maxlength" class="error-msg">First
                name cannot be more than 20 characters.</span>
            </div>
            <div class="form-control">
              <label for="lastName">Last Name <span>(required)</span></label>
              <input type="text" name="lastName" id="lastName" placeholder="Your last name" ng-model="lastName"
                ng-maxlength="30" required />
              <span ng-show="regForm.lastName.$touched && regForm.lastName.$error.required" class="error-msg">Last name
                is required.</span>
              <span ng-show="regForm.lastName.$dirty && regForm.lastName.$error.maxlength" class="error-msg">Last name
                cannot be more than 30 characters.</span>
            </div>
            <div class="form-control">
              <label for="email">Email <span>(required)</span></label>
              <input type="email" name="email" id="email" placeholder="Your email" ng-model="email" required />
              <span ng-show="regForm.email.$touched && regForm.email.$error.required" class="error-msg">Email is
                required.</span>
              <span ng-show="regForm.email.$dirty && regForm.email.$invalid" class="error-msg">Please enter a valid
                email.</span>
            </div>
            <div class="form-control">
              <label for="phone">Phone Number <span>(required)</span></label>
              <input type="text" name="phone" id="phone" placeholder="Your phone number" ng-model="phone"
                pattern="^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$" required />
              <span ng-show="regForm.phone.$touched && regForm.phone.$error.required" class="error-msg">Phone number is
                required.</span>
              <span ng-show="regForm.phone.$dirty && regForm.phone.$invalid" class="error-msg">Please enter a valid
                phone number.</span>
            </div>
            <div class="form-control">
              <label for="password">Password <span>(required)</span></label>
              <input type="password" name="password" id="password" ng-model="password"
                pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$" required />
              <span ng-show="regForm.password.$touched && regForm.password.$error.required" class="error-msg">Password
                is required.</span>
              <span ng-show="regForm.password.$dirty && regForm.password.$invalid" class="error-msg">Password must
                contain a number, uppercase, lowercase, and
                special character and be at least 8 characters.</span>
            </div>
            <div class="form-control">
              <label for="passwordConfirm">Re-enter Password <span>(required)</span></label>
              <input type="password" name="passwordConfirm" id="passwordConfirm" ng-model="passwordConfirm" required
                data-password-verify="password" />
              <span ng-show="regForm.passwordConfirm.$touched && regForm.passwordConfirm.$error.required"
                class="error-msg">Confirm password is required.</span>
              <span ng-show="regForm.passwordConfirm.$dirty && regForm.passwordConfirm.$error.passwordVerify">Passwords
                must match.</span>
            </div>
            <div class="my-3" ng-show="regForm.$invalid && regForm.$dirty">
              <span class="bg-red-600 py-1 px-3 rounded-full text-sm font-semibold">
                Please fill out the form correctly before submitting
              </span>
            </div>
            <input type="submit" value="Sign Up" name="signUp" class="btn btn-purple mt-2 inline-block"
              ng-disabled="regForm.$invalid" />
          </form>
        </div>
        <div class="p-4">
          <h3 class="text-xl mb-4">Member Benefits</h3>
          <div class="bg-gray-800 p-4 my-3 rounded-md flex items-center">
            <svg class="icon fill-current text-purple-600 h-6 w-6 mr-2">
              <use xlink:href="../assets/img/icons.svg#icon-world"></use>
            </svg>
            <p class="text-gray-300">
              Become part of a supportive community of developers across the
              globe
            </p>
          </div>
          <div class="bg-gray-800 p-4 my-3 rounded-md flex items-center">
            <svg class="icon fill-current text-purple-600 h-6 w-6 mr-2">
              <use xlink:href="../assets/img/icons.svg#icon-calendar"></use>
            </svg>
            <p class="text-gray-300">
              Events including meetups, conferences and classes
            </p>
          </div>
          <div class="bg-gray-800 p-4 my-3 rounded-md flex items-center">
            <svg class="icon fill-current text-purple-600 h-6 w-6 mr-2">
              <use xlink:href="../assets/img/icons.svg#icon-group"></use>
            </svg>
            <p class="text-gray-300">
              Online support from your local group and the entire Dev Domain
              community
            </p>
          </div>
          <div class="bg-gray-800 p-4 my-3 rounded-md flex items-center">
            <svg class="icon fill-current text-purple-600 h-6 w-6 mr-2">
              <use xlink:href="../assets/img/icons.svg#icon-help"></use>
            </svg>
            <p class="text-gray-300">
              Career support and advice from peers and top-level industry devs
            </p>
          </div>
        </div>
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
  <script src="../js/register-controller.js"></script>
</body>

</html>