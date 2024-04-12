// Function to send AJAX request for validating username
function validateUsername(username) {
    sendRequest('../src/functions/signup-onkeyup/validate_username.php', 'username=' + encodeURIComponent(username));
}

// Function to send AJAX request for validating first name
function validateFirstName(firstName) {
    sendRequest('../src/functions/signup-onkeyup/validate_firstname.php', 'firstName=' + encodeURIComponent(firstName));
}

// Function to send AJAX request for validating last name
function validateLastName(lastName) {
    sendRequest('../src/functions/signup-onkeyup/validate_lastname.php', 'lastName=' + encodeURIComponent(lastName));
}

// Generic function to send AJAX request
function sendRequest(url, data) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                // Handle the response
                handleResponse(response);
            } else {
                console.error('Error:', xhr.status);
            }
        }
    };
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(data);
}

// Function to handle the response
function handleResponse(response) {
    // Display the validation result
    var message = response.valid ? "" : response.message;
    var fieldName = response.fieldName;
    var errorElement = document.getElementById(fieldName + "Error");
    if (errorElement) {
        errorElement.textContent = message;
    }
}
