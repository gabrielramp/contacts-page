<?php
session_start();

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
    <link href="http://138.197.100.219/dist/output.css" rel="stylesheet">
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
                <a class="md:p-4 py-2 block hover:text-[#37ff14e1]" 
                   href="#"
                   onclick="location.href='http://138.197.100.219/LAMPAPI/src/Logout.php'"
                  >Logout</a
                >
              </li>
            </ul>
        </div>
        <!-- End of Regular menu code -->

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
                                " onclick="loginScreen.showModal()">Logout</a>
                      </li>
                    </ul>
          </div>
        </div>
        <!-- End of Hamburger menu code -->
    </nav>

    <div class="grid
                justify-center 
                bg-gradient-to-t 
                from-[#98FF98] 
                to-[#32A89D]">
        <div class="flex flex-col min:w-[600px] break-all">
            <div class="flex flex-col justify-between">
                <h3>
                    Search Contacts
                </h3>
                
                <div class="flex justify-between">
                    <input class="border rounded
                    border-black
                    focus:outline-none
                    bg-transparent
                    w-10/12
                    placeholder-black
                    text-black
                    " name="SearchBar" type="text" placeholder="  Enter first name, last name, email, or phone number" id="searchData">
                    <button type="button" class="continueBtn" onclick="getContacts()">
                        Search
                    </button>
                </div>
            </div>

            <div class="AddContactButton">
              <form action="AddContact.php" method="post">
                  <div class="flex justify-end">
                    <button type="button" class="continueBtn" onclick="location.href='/addContact.php'">Add Contact</button>
                  </div>
              </form>
          </div>
          

        <div class="itemsCardHead ">
            <div>First Name</div>
            <div>Last Name</div>
            <div>Email</div>
            <div>Phone</div>
        </div>

        <div id="resultsContainer">
        </div>
    </div>

    <div id="errors" class="fixed sm:w-[360px] w-[300px] h-full flex-wrap"></div>
    
    </div>

    <footer class="flex 
                   items-center 
                   min-h-[140px] 
                   text-gray-700 
                   bg-[#C0C0C0]
                   border-t-2
                   border-[#484747]
                   ">
      <p class="text-center text-lg w-full">
        2023 COP4331C -- Small Project. Made with love by Group-25
      </p>
    </footer>
    


</body>
</html>
