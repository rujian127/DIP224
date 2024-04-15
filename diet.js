document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.diet-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission behavior

        // Retrieve form data
        var formData = new FormData(this);

        // Send AJAX request to diet.php
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'diet.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Display success message or do something else with the response
                    showMessage(xhr.responseText);
                } else {
                    // Display error message
                    showMessage('Error: ' + xhr.statusText);
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
