document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM Loaded");
    document.querySelector('.flight-form').addEventListener('submit', function(e) {
        console.log("Form Submitted");
        e.preventDefault(); // Prevent the default form submission behavior

        // Retrieve form data
        var formData = new FormData(this);
        console.log("Form Data:", formData);

        // Send AJAX request to airplane.php
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'airplane.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                console.log("XHR Status:", xhr.status);
                if (xhr.status === 200) {
                    // Display success message
                    showMessage('Data inserted successfully');
                } else {
                    // Display error message
                    showMessage('Error: ' + xhr.responseText);
                }
            }
        };
        xhr.send(formData);
    });
});

function showMessage(message) {
    var messageDiv = document.getElementById('message');
    messageDiv.innerText = message;
    messageDiv.style.display = 'block'; // Show the message

    // Hide the message after 1 second
    setTimeout(function() {
        messageDiv.style.display = 'none';
    }, 1000);
}
