
/**
 * Shows the next field based on the provided string.
 * @param {string} fieldToShow - The name of the current field.
 */

function showNext(fieldToShow) {
    let innerText = "";
    let continueOrNot = false;
    
    switch (fieldToShow){
        case "firstNameField":
            innerText = document.getElementById("firstNameInput").value;
            
            // Validate that the name is not an empty string, everything else can be a name
            continueOrNot = verifyField("firstOrLastName", innerText);

            // This is what shows the next field.
            if (continueOrNot) {
                document.getElementById("lastNameField").classList.remove("hidden");    
            }

            // This has to be replaced with a modal or something that prompts the user without being an annoyance.
            else {
                createAlert("That is not a valid name. Try again.", "danger");
            }
            break;
        case "lastNameField":
            innerText = document.getElementById("lastNameInput").value;
            
            // Validate that the name is not an empty string, everything else can be a name
            continueOrNot = verifyField("firstOrLastName", innerText);

            if (continueOrNot) {
                document.getElementById("usernameField").classList.remove("hidden");    
            }

            // This has to be replaced with a modal or something that prompts the user without being an annoyance.
            else {
                createAlert("That is not a valid name. Try again.", "danger");
            }
            break;
        case "usernameField":
            innerText = document.getElementById("usernameInput").value;

            // Validation
            continueOrNot = verifyField("username", innerText);

            if (continueOrNot) {
                document.getElementById("passwordField").classList.remove("hidden");    
            }

            // This has to be replaced with a modal or something that prompts the user without being an annoyance.
            else {
                createAlert("The username has to be between 5 and 20 characters.", "danger");
            }

            break;

        case "passwordField":
            innerText = document.getElementById("passwordInput").value;
            
            // Validation
            continueOrNot = verifyField("password", innerText);
            
            if (continueOrNot) {
                document.getElementById("sendToServerbtn").classList.remove("hidden");    
            }

            // This has to be replaced with a modal or something that prompts the user without being an annoyance.
            else {
                createAlert("That is not a valid password. Try again.", "danger");
            }
            break;
        
    }
}

/**
 * Shows the next field based on the provided string.
 * @param {string} typeofField - The name of the current field.
 */
function verifyField(typeofField, innerText){
    switch (typeofField) {
        case "firstOrLastName":
            if (innerText.length > 0)
                return true;
            else
                return false;
        case "username":
            if (innerText.length > 4)
                return true;
            else
                return false;
        case "password":
            if (innerText.length >= 5 && innerText.length <= 20)
                return true;
            else
                return false;
    }
}

function activateEnter() {
    const inputFields = document.querySelectorAll(".input-field");

    inputFields.forEach(input => {
        input.addEventListener('keydown', function(e) {
            if (e.keyCode === 13) {
                e.preventDefault();
                let continueButton = input.parentElement.nextElementSibling;

                if (continueButton && continueButton.classList.contains("continueBtn")) {
                    continueButton.click();
                }
            }
        })
    });
}

function createAlert(message, statusName) {
    UIkit.notification({
        message: message,
        status: statusName,
        pos: 'bottom-right',
        timeout: 5000
    });
}

function redirectToLogin() {
    setTimeout(function() {
        window.location.href = 'http://138.197.100.219/'; 
    }, 3000); 
}

function redirectToSearch() {
    setTimeout(function () {
        window.location.href = 'http://138.197.100.219/LAMPAPI/src/Search.php'
    }, 3000);
}


function createAlertDialog(message, statusName) {
    let error = UIkit.notification({
        message: message,
        status: 'danger',
        pos: 'bottom-right',
        timeout: 5000
    });

    document.querySelector('#loginScreen #errors').appendChild(error.$el);

}