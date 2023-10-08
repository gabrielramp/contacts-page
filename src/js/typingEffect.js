const initialGreet = "Hey there, welcome to the Y2K.| Let's get started"
const speed = 50; // The speed of typing in milliseconds
let i = 0;

function typeWriter() {
    if (initialGreet.charAt(i) === "|")
    {
        const greetingDiv = document.getElementById("initialGreetings");
        const br = document.createElement("br");
        greetingDiv.appendChild(br);
        i++;
    }

    if (i < initialGreet.length) {
        document.getElementById("initialGreetings").innerHTML += initialGreet.charAt(i);
        i++;
        setTimeout(typeWriter, speed);
    }

    if (i === initialGreet.length)
    {
        document.getElementById("initialGreetings").classList.remove("blinkingCaret");
        document.getElementById("firstNameField").classList.remove("hidden");
        document.getElementById("signupFields").classList.remove("hidden");
    }
}


