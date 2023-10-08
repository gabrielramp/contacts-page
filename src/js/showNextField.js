
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
                alert("Not a valid name");
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
                alert("Not a valid name");
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
                alert("Not a valid username");
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
                alert("Not a valid password");
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