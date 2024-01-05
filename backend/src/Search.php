<?php
session_start();

if (!isset($_SESSION['loggedin'])) {

	header('Location: http://138.197.100.219/');
	exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="http://138.197.100.219/src/js/typingEffect.js"></script>
    <script src="http://138.197.100.219/src/js/Hamburger.js"></script>
    <script src="http://138.197.100.219/src/js/showPassword.js"></script>
    <script src="http://138.197.100.219/src/js/showNextField.js"></script>
    <script src="http://138.197.100.219/src/js/APIcalls.js"></script>
    <script src="https://unpkg.com/htmx.org@1.9.6" integrity="sha384-FhXw7b6AlE/jyjlZH5iHa/tTe9EpJ1Y55RjcgPbjeWMskSxZt1v9qkxLJWNJaGni" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.17.1/dist/css/uikit.min.css" />
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.1/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.1/dist/js/uikit-icons.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../dist/output.css" rel="stylesheet">
    <title>COP4331C -- Small Project</title>
</head>
<body class="min-h-[100svh] grid grid-rows-[auto_1fr_auto]">
    
    
  <nav class="mainNavBar">

    <a class="text-[#0000FF]" href="http://138.197.100.219/" type="button">
      <img class="h-6" src="http://138.197.100.219/src/img/drawing.svg" alt="The Y2K website!">     
    </a>

    <!-- Regular menu code -->
    <div class="hidden 
                w-full 
                md:flex 
                md:items-center 
                md:w-auto" id="menu">
            <ul class="
                pt-4
                text-base text-[#0000FF]
                md:flex
                md:justify-between 
                md:pt-0">
              <li>
                <a class="md:p-4 py-2 block hover:text-[#37ff14e1]" href="#" onclick="location.href='http://138.197.100.219/LAMPAPI/src/Logout.php'">Logout</a>
              </li>
            </ul>
        </div>
    
 <!-- Hamburger menu code -->
 <div class="ml-auto md:hidden">
  <button class="flex" onclick="openMenu()">
    <ul class="grid grid-rows-3 gap-2">
      <li class="w-8 h-[3px] bg-black"></li>
      <li class="w-8 h-[3px] bg-black"></li>
      <li class="w-8 h-[3px] bg-black"></li>
    </ul>
  </button>

  <!-- Items in menu code -->
  <div class="hidden absolute bg-[#3894a3] mt-[17.5px] rounded
        right-0 w-auto h-auto pl-[3.5rem] pr-[1.5rem] pb-[1rem]
        flex-col z-10" id="hamburgerMenu">
            <ul class="flex 
                       flex-col 
                       self-end 
                       text-xl 
                       text-[#0000FF] 
                       items-end 
                       space-y-8
                       pt-3">
              <li>
                <a class="md:p-4 py-2 block 
                        hover:text-[#37ff14e1] 
                        hover:duration-300
                        bg-transparent
                        " onclick="location.href='http://138.197.100.219/LAMPAPI/src/Logout.php'">Logout</a>
              </li>
            </ul>
  </div>
</div>
<!-- End of Hamburger menu code -->

</nav>

<div class="flex justify-center bg-gradient-to-t from-green-300 to-[#32A89D] p-4">
    <div class="flex flex-col w-full max-w-xl space-y-4">

        <h3 class="text-2xl">Search Contacts</h3>

        <div class="flex items-center space-x-4">
            <input class="flex-grow border rounded border-black focus:outline-none bg-transparent placeholder-black text-black p-2" name="SearchBar" type="text" placeholder=" Enter first name, last name, email, or phone number" id="searchData">
            <button class="p-2 bg-blue-500 text-white rounded hover:bg-blue-600" onclick="getContacts()">Search</button>
        </div>

        <div class="text-right">
            <button class="p-2 bg-blue-500 text-white rounded hover:bg-blue-600" onclick="location.href='http://138.197.100.219/LAMPAPI/src/AddContactPage.php'">Add Contact</button>
        </div>

        <div class="grid grid-cols-4 gap-4 border-b-2">
            <div>First Name</div>
            <div>Last Name</div>
            <div>Email</div>
            <div>Phone</div>
        </div>

        <div id="resultsContainer"></div>

    </div>
</div>

<div id="errors" class=""></div>

<footer class="flex items-center justify-center h-20 bg-gray-300 text-gray-700 border-t-2 border-gray-500">
    <p class="text-center text-lg">
        2023 COP4331C -- Small Project. Made with love by Group-25
    </p>
</footer>
 

</body>
</html>
