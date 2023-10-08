function showPassword(){
    const textField = document.getElementById("passwordInput");

    if (textField.type === "password") {
        textField.type = "text";
        const hide = document.getElementById("showField");
        hide.classList.add("hidden");
        const show = document.getElementById("hideField");
        show.classList.remove("hidden");
    } else {
        textField.type = "password";
        const hide = document.getElementById("showField");
        hide.classList.remove("hidden");
        const show = document.getElementById("hideField");
        show.classList.add("hidden");
    }
}