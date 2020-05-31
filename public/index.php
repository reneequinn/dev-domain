<?php
session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dev Domain</title>
  <link rel="stylesheet" href="css/tailwind.css" />
  <link rel="stylesheet" href="css/custom.css" />
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
</head>

<body class="flex flex-col min-h-screen">
  <header>
    <div class="flex items-center justify-between flex-wrap bg-gray-900 p-6">
      <div class="flex items-center mr-6">
        <a href="#">
          <img src="assets/img/logo.svg" alt="Dev Domain" />
        </a>
      </div>
      <div class="block lg:hidden">
        <button class="px-3 py-2 text-white" id="menuBtn">
          <svg class="icon fill-current w-6 h-6">
            <use xlink:href="./assets/img/icons.svg#icon-menu"></use>
          </svg>
        </button>
      </div>
      <nav id="nav" class="w-full block flex-grow hidden lg:flex lg:items-center lg:w-auto">
        <div class="text-center lg:flex-grow lg:text-left">
          <a href="#" class="block mt-4 p-2 lg:inline-block lg:mt-0 lg:mr-4 lg:p-0">Home</a>
          <a href="pages/about.php" class="block mt-4 p-2 lg:inline-block lg:mt-0 lg:mr-4 lg:p-0">About</a>
          <a href="pages/news.php" class="block mt-4 p-2 lg:inline-block lg:mt-0 lg:mr-4 lg:p-0">News</a>
          <a href="pages/events.php" class="block mt-4 p-2 lg:inline-block lg:mt-0 lg:mr-4 lg:p-0">Events</a>
          <a href="pages/contact.php" class="block mt-4 p-2 lg:inline-block lg:mt-0 lg:mr-4 lg:p-0">Contact</a>
        </div>
        <?php if (isset($_SESSION['username']) && $_SESSION['loggedIn']) { ?>
        <div class="text-center">
          <a href="pages/member.php" class="btn btn-outline block lg:inline-block mt-4 mx-2 lg:m-0">Member Dashboard</a>
          <a href="pages/logout.php" class="btn btn-purple block lg:inline-block mt-4 mx-2 lg:mt-0">Log Out</a>
        </div>
        <?php } else { ?>
        <div class="text-center">
          <a href="pages/register.php" class="btn btn-outline block lg:inline-block mt-4 mx-2 lg:m-0">Sign Up</a>
          <a href="pages/login.php" class="btn btn-purple block lg:inline-block mt-4 mx-2 lg:mt-0">Log In</a>
        </div>
        <?php } ?>
      </nav>
    </div>
  </header>
  <main class="flex-grow">
    <section class="hero-section flex items-center">
      <div class="container text-center mx-auto">
        <h1 class="text-4xl mb-2">
          Connecting developers across the globe
        </h1>
        <p class="text-lg mb-6">
          A developer community focused on connection, education and people
        </p>
        <a href="#" class="btn-large btn-purple mt-4 mr-2">Sign Up</a>
        <a href="#" class="btn-large btn-gray mt-4">Find Out More</a>
      </div>
    </section>
    <section class="container sm:grid sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4 mb-8 mx-auto text-center px-4 lg:p-0">
      <div class="bg-gray-900 my-4 p-6 rounded-md">
        <svg class="icon fill-current text-purple-600 mx-auto mb-2 h-16 w-16">
          <use xlink:href="./assets/img/icons.svg#icon-world"></use>
        </svg>
        <h3 class="text-xl mb-2">160 countries</h3>
        <p class="text-gray-300">
          Our user base spans over 160 countries worldwide
        </p>
      </div>
      <div class="bg-gray-900 my-4 p-6 rounded-md">
        <svg class="icon fill-current text-purple-600 mx-auto mb-2 h-16 w-16">
          <use xlink:href="./assets/img/icons.svg#icon-group"></use>
        </svg>
        <h3 class="text-xl mb-2">13,000 groups</h3>
        <p class="text-gray-300">
          We have over 13,000 active meetup groups and counting
        </p>
      </div>
      <div class="bg-gray-900 my-4 p-6 rounded-md">
        <svg class="icon fill-current text-purple-600 mx-auto mb-2 h-16 w-16">
          <use xlink:href="./assets/img/icons.svg#icon-person"></use>
        </svg>
        <h3 class="text-xl mb-2">100,000 developers</h3>
        <p class="text-gray-300">
          Over 100,000 developers of different skill levels and interest
          groups
        </p>
      </div>
    </section>
  </main>
  <footer class="bg-gray-900">
    <div class="md:flex justify-between container items-top py-4 text-left px-4 mt-2 mx-auto">
      <div class="flex-1 md:w:1/3 flex justify-around md:justify-start my-4">
        <ul class="leading-8 mr-8">
          <li>
            <a href="#">Home</a>
          </li>
          <li>
            <a href="pages/about.php">About</a>
          </li>
          <li>
            <a href="pages/news.php">News</a>
          </li>
          <li>
            <a href="pages/events.php">Events</a>
          </li>
        </ul>
        <ul class="leading-8">
          <li>
            <a href="pages/contact.php">Contact</a>
          </li>
          <li>
            <a href="./privacy.php">Privacy Policy</a>
          </li>
          <li>
            <a href="pages/register.php">Sign Up</a>
          </li>
          <li>
            <a href="pages/login.php">Log In</a>
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
            <a href="#">
              <svg class="icon fill-current text-purple-600 h-8 w-8 m-1 ml-0 hover:text-purple-700">
                <use xlink:href="./assets/img/icons.svg#icon-facebook"></use>
              </svg>
            </a>
            <a href="#">
              <svg class="icon fill-current text-purple-600 h-8 w-8 m-1 hover:text-purple-700">
                <use xlink:href="./assets/img/icons.svg#icon-twitter-square"></use>
              </svg>
            </a>
            <a href="#">
              <svg class="icon fill-current text-purple-600 h-8 w-8 m-1 hover:text-purple-700">
                <use xlink:href="./assets/img/icons.svg#icon-instagram"></use>
              </svg>
            </a>
          </div>
        </div>
      </div>
      <div class="flex-1 md:w-1/3 text-center md:text-right my-4">
        <img src="./assets/img/logo.svg" alt="Dev Domain" class="mx-auto md:ml-auto md:mr-0 mb-1" />
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
  <script src="js/navbar.js"></script>
</body>

</html>