function processSignup(formData) {
    fetch("http://cop4331cgrp25.club/LAMPAPI/src/Register.php", {
        method: "POST",
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        return response.json();
    })
    .then(data => {
        console.log(data);

        if (data.status === "success") {
            alert("The registering was good");
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error("There was a problem with the fetch operation:", error.message);
        alert("An error occurred. Please try again.");
    });
}

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("signupFields").addEventListener("submit", function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        processSignup(formData);
    });
});


function editContact(contact) {
    sessionStorage.setItem('editContactData', JSON.stringify(contact));
    window.location.href = "./EditingPage.php";
}

function getContacts() {

    const toQuery = document.getElementById("searchData").value;    

    const params = new URLSearchParams({
        keyword: toQuery,
        XDEBUG_SESSION_START: 'PHPSTORM'
    });
    console.log(toQuery);
    
    fetch("http://138.197.100.219/LAMPAPI/src/SearchContact.php?" + params)
    .then(data => {
        if (data.ok) {
            return data.json();
        } else {
            throw new Error("Failed to fetch");
        }
    })
    .then(jsonData => {
        populateResults(jsonData);
        console.log(JSON.stringify(jsonData)); // display parsed data
    })
    .catch(error => {
        console.error("There was a problem with the fetch operation:", error.message);
        alert("An error occurred. Please try again.");
    });
}

function populateResults(data) {
    const container = document.getElementById("resultsContainer");

    container.innerHTML = "";

    data.forEach(item => {
        const card = document.createElement("div");

        card.className = "itemsCard";
        card.dataset.key = item.id;

        card.innerHTML = `
            <div>${item.firstname}</div>
            <div>${item.lastname}</div>
            <div>${item.email}</div>
            <div>${item.phone}</div>
        `;

        const editButton = document.createElement("button");
        editButton.type = "button";
        editButton.className = "continueBtn col-span-4 p-2";
        editButton.textContent = "Edit";

        editButton.onclick = function() {
            editContact(item);
        };
        
        card.appendChild(editButton);
        container.appendChild(card);
    });

}

// Get the data from the previous page

document.addEventListener('DOMContentLoaded', function() {
    const contactData = JSON.parse(sessionStorage.getItem('editContactData'));
    if (contactData) {
        // Populate the edit form fields with the contactData values
        document.getElementById("firstname").value = contactData.firstname;
        document.getElementById("lastname").value = contactData.lastname;
        document.getElementById("email").value = contactData.email;
        document.getElementById("phone").value = contactData.phone;
        document.getElementById("contactId").value = contactData.id;
        
    } else {
        console.error("No contact data found for editing.");
    }
});
