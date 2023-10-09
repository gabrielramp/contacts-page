function editContact(contact) {
    sessionStorage.setItem('editContactData', JSON.stringify(contact));
    window.location.href = "./EditingPage.php";
}

function deleteContact(contact) {
    const params = new URLSearchParams({
        cid: contact.id,
    });

    fetch("http://138.197.100.219/LAMPAPI/src/DeleteContact.php", {
        method: "POST",
        body: params
    })

    .then(data => {
        if (data.ok) {
            return data.json();
        } else {
            throw new Error("Failed to fetch");
        }
    })
    .then(data => {
        UIkit.notification({
            message: data.message,
            status: "success",
            pos: 'bottom-right',
            timeout: 5000
        });
        getContacts();
    })

    .catch(error => {
        UIkit.notification({
            message: "An error occurred. Please try again.",
            status: "danger",
            pos: 'bottom-right',
            timeout: 5000
        });
        console.error("There was a problem with the fetch operation:", error.message);
    });
}
function getContacts() {

    const toQuery = document.getElementById("searchData").value;    

    const params = new URLSearchParams({
        keyword: toQuery,
        XDEBUG_SESSION_START: 'PHPSTORM'
    });
    
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
    })
    .catch(error => {
        UIkit.notification({
            message: "An error occurred. Please try again.",
            status: "danger",
            pos: 'bottom-right',
            timeout: 5000
        });
        console.error("There was a problem with the fetch operation:", error.message);
    });
}

function populateResults(data) {
    const container = document.getElementById("resultsContainer");

    container.innerHTML = "";

    data.forEach(item => {
        const card = document.createElement("div");

        card.className = "grid grid-cols-4 gap-4 p-2 border border-black mb-4 break-all";
        card.dataset.key = item.id;

        card.innerHTML = `
            <div>${item.firstname}</div>
            <div>${item.lastname}</div>
            <div>${item.email}</div>
            <div>${item.phone}</div>
        `;

        const editButton = document.createElement("button");
        editButton.type = "button";
        editButton.className = "bg-[#3894a3] text-[#0000FF] p-2 rounded cursor-pointer transition duration-300 hover:bg-[#2b6f7c] col-span-4";
        editButton.textContent = "Edit";

        editButton.onclick = function() {
            editContact(item);
        }
        
        const deleteButton = document.createElement("button");
        deleteButton.type = "button";
        deleteButton.className = "bg-[#3894a3] text-[#0000FF] p-2 rounded cursor-pointer transition duration-300 hover:bg-[#2b6f7c] col-span-4";
        deleteButton.textContent = "Delete";

        deleteButton.onclick = function () { 
            deleteContact(item);
        }

        card.appendChild(editButton);
        card.appendChild(deleteButton);
        
        container.appendChild(card);
    });

}


// Get the data from the previous page

document.addEventListener('DOMContentLoaded', function() {
    if (window.location.href.includes('EditingPage')) {
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
    }
});
