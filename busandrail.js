document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.transport-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        // Retrieve form data
        var formData = new FormData(this);

        // Send AJAX request to busandrail.php
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'busandrail.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
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
