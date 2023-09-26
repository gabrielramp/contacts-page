function openMenu(){
    const menu = document.getElementById("hamburgerMenu");

    const isShowing = menu.getAttribute("class", "hidden");

    if (isShowing.includes("hidden")){
        menu.classList.remove("hidden");
        menu.classList.add("flex"); 
    }
    else {
        menu.classList.add("hidden");
        menu.classList.remove("flex");
    }
}