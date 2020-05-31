<?php
session_start();
$mapKey = getenv('MAP_KEY');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dev Domain - Events</title>
  <link rel="stylesheet" href="../css/tailwind.css" />
  <link rel="stylesheet" href="../css/custom.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
</head>

<body ng-app="events" ng-controller="eventsCtrl" class="flex flex-col min-h-screen">
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
    <section class="container my-4 px-4 lg:p-0 mx-auto max-w-4xl">
      <h1 class="text-3xl mb-2">Events</h1>
      <p ng-bind="$scope.test"></p>
      <div class="bg-gray-900 p-4 rounded-md">
        <div ng-if="!events" class="my-3">
          <span class="bg-red-600 py-1 px-3 rounded-full text-sm font-semibold">Could not fetch event data</span>
        </div>
        <div class="w-full">
          <h2 class="text-2xl mb-2">Search Events</h2>
          <div class="w-full md:grid grid-cols-5 gap-4">
            <div class="relative col-span-2">
              <select ng-model="filterEvent" name="filterEvent" id="filterEvent"
                class="bg-gray-900 block appearance-none mb-2 rounded p-2 border-2 border-gray-700 w-full">
                <option value="" selected>All events</option>
                <option value="{{event.event_name}}" ng-repeat="event in events">{{ event.event_name }}</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
              </div>
            </div>
            <div class="relative col-span-2">
              <select ng-model="filterLocation" name="filterEvent" id="filterEvent"
                class="bg-gray-900 block appearance-none mb-2 rounded p-2 border-2 border-gray-700 w-full">
                <option value="" selected>All locations</option>
                <option value="{{event.event_name}}" ng-repeat="event in events">{{ event.event_venue }}</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
              </div>
            </div>
            <div class="col-span-1 flex items-center"><button ng-click="resetFilters()"
                class="btn btn-purple btn-small w-full block mb-2">Clear
                Search</button></div>
          </div>
        </div>
        <div
          ng-repeat="event in events | filter:(((!!filterEvent || undefined) && filterEvent) || ((!!filterLocation || undefined) && filterLocation))"
          class="bg-gray-800 p-4 rounded-md my-4">
          <div class="flex justify-between items-center mb-1">
            <div class="mr-2">
              <h2 class="text-2xl">{{ event.event_name }}</h2>
              <p class=" italic font-semibold text-gray-100">
                <a href="#myMap" class="text-purple-600 underline hover:text-purple-700">{{ event.event_venue }}</a>
              </p>
            </div>
            <p class="text-right leading-tight text-sm font-semibold">
              {{ event.event_datetime | date: 'EEEE, d MMMM y' }}<br><span
                class="lowercase">{{ event.event_datetime | date: 'shortTime' }}</span></p>
          </div>
          <p class="text-gray-200">{{ event.event_desc }}</p>
        </div>
        <div id="myMap" class="w-full h-64 rounded-md"></div>
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
  <script src="../js/events-controller.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=<?= $mapKey; ?>"></script>
</body>

</html>