<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="js/typingEffect.js"></script>
    <script src="js/Hamburger.js"></script>
    <script src="js/showPassword.js"></script>
    <script src="js/showNextField.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.17.1/dist/css/uikit.min.css" />
    
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.1/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.1/dist/js/uikit-icons.min.js"></script>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/dist/output.css" rel="stylesheet">
    <title>COP4331C -- Small Project</title>
</head>
<body class="min-h-[100svh] grid grid-rows-[auto_1fr_auto]">
    
    <nav class="mainNavBar">

        <a class="text-[#0000FF]" href="/src/index.html" type="button">
          <img class="h-6"src="img/drawing.svg" alt="The Y2K website!">     
        </a>

        <div class="hidden 
                    w-full 
                    md:flex 
                    md:items-center 
                    md:w-auto" id="menu"
                    >
            <ul
              class="
                pt-4
                text-base text-[#0000FF]
                md:flex
                md:justify-between 
                md:pt-0"
            >
              <li>
                <a class="md:p-4 py-2 block hover:text-[#37ff14e1]" 
                   href="#"
                   onclick="loginScreen.showModal()"
                  >Login</a
                >
              </li>
              <li>
                <a
                  class="md:p-4 py-2 block hover:text-[#39FF14] text-[#22bb07e1]"
                  href="signup.html"
                  >Sign Up</a
                >
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
                    <ul class='flex 
                               flex-col 
                               self-end 
                               text-xl 
                               text-[#0000FF] 
                               items-end 
                               space-y-8
                               pt-3'>
                      <li>
                        <a class="md:p-4 py-2 block 
                                hover:text-[#37ff14e1] 
                                hover:duration-300
                                bg-transparent
                                "
                                onclick="loginScreen.showModal()"
                          >Login</a
                        >
                      </li>
                      <li>
                        <a
                          class="md:p-4 
                                 py-2 
                                 block 
                                 hover:text-[#39FF14] 
                                 text-[#22bb07e1] 
                                 bg-transparent
                                 hover:duration-300
                                 "
                          href="./signup.html"
                          >Sign Up</a
                        >
                      </li>
                    </ul>
          </div>
        </div>
        <!-- End of Hamburger menu code -->
    </nav>
    

    <div class="grid 
                flex-col 
                justify-center 
                bg-gradient-to-t 
                from-[#98FF98] 
                to-[#32A89D]"
                >
      <div class="flex w-full h-fit pt-4 items-center justify-center">
        <video class="md:h-1/2 h-1/6 border rounded shadow-lg border-[#000000]" loop autoplay>
          <source src="img/serial-experiments-lain-lain.webm">
        </video> 
      </div>

      <div class="grid grid-rows-2 h-fit justify-self-center text-center">
          <h1 class="md:text-[60px] sm:text-[45px] text-[25px]
          font-mono
          "
          id="exampleh1">Experience the Y2K again</h1>
          <h3 class="md:text-[30px]
                     text-[15px]">as a Contact Manager</h3>
      </div>
    </div>
    
    <div>
    </div>
    
    
    <dialog id="loginScreen">
      <div class="grid
                  sm:h-[360px]
                  sm:w-[360px] 
                  h-[300px]
                  w-[300px] 
                  items-center
                  rounded-xl
                  shadow-lg
                  justify-items-center
                  ">
        <h1 class="row-span-3 
                   w-full
                   font-bold 
                   md:text-[30px]
                   border-b-2
                   h-full
                   flex
                   justify-center
                   items-center
                  border-zinc-500
                   ">Login</h1>

        <form class="flex flex-col gap-2"
              id="loginForm"
              hx-post=""
              action="http://138.197.100.219/LAMPAPI/src/Login.php"
              method="post">
          <label>Username:</label>
          <input class="border-b
                      border-gray-400 
                        focus:outline-none" 
                        name="Login"
                        type="text"
                        placeholder="Enter username"
                        >
          <label for="password">Password: </label>

          <div class="flex border-b border-gray-400 pr-[2px]">
            <input class="focus:outline-none"
                    name="Password"
                    type="password"
                    id="passwordField"
                    placeholder="Enter password"
                    >
            
            <button type="button" onclick="showPassword()" id="togglePassword">
              <img src="./img/eye-password-hide-svgrepo-com.svg" alt="Hide"
                  class="h-5 hidden"
                  id="hideField">
              <img src="./img/eye-password-show-svgrepo-com.svg" alt="Show"
                  class="h-5"
                  id="showField">
            </button>

          </div>
          <button type="submit" class="mt-4 bg-[#2d961ace] hover:bg-[#22BB07E1] text-white font-bold py-2 px-4 rounded-full">Login</button>
        </form>

        <p>Or Sign up: </p>
        <button class="bg-[#2d961ace] hover:bg-[#22BB07E1] text-white font-bold py-2 px-4 rounded-full" onclick="location.href='/src/signup.html'">Sign Up</button>
      </div>

      <div id="errors" class="fixed sm:w-[360px] w-[300px] h-full flex-wrap"></div>
    </dialog>
    
    <footer class="flex 
                   items-center 
                   min-h-[140px] 
                   text-gray-700 
                   bg-[#C0C0C0]
                   border-t-2
                   border-[#484747]
                   "
                   >
      <p class="text-center text-lg w-full">
        2023 COP4331C -- Small Project. Made with love by Group-25
      </p>
    </footer>
    
</body>
</html>
