document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('personal').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        // Validate the form data before submitting
        if (!validateForm()) {
            return; // Exit if validation fails
        }

        // Serialize the form data
        var formData = new FormData(this);

        // Send an AJAX request to the server
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'personal.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Display a success message to the user
                    showMessage('Profile updated successfully'); // Show pop-up message
                } else {
                    // Display an error message if something went wrong
                    alert('Error: ' + xhr.responseText);
                }
            }
        };
        xhr.send(formData);
    });

    function validateForm() {
        // Example: Ensure the email field is not empty
        var email = document.getElementById('email').value;
        if (!email) {
            alert('Please enter an email address.');
            return false;
        }

        // If all checks pass
        return true;
    }

    function showMessage(message) {
        var messageDiv = document.getElementById('message');
        messageDiv.innerText = message;
        messageDiv.style.display = 'block'; // Show the message

        // Hide the message after 1 second
        setTimeout(function() {
            messageDiv.style.display = 'none';
        }, 1000);
    }
});
