document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.utilities-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission behavior

        // Retrieve form data
        var formData = new FormData(this);

        // Send AJAX request to house.php
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'house.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Display success message or handle response
                    console.log(xhr.responseText);
                } else {
                    // Display error message
                    console.error('Error:', xhr.statusText);
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
