document.addEventListener('DOMContentLoaded', (event) => {
    const form = document.getElementById('motorbike-form');
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Retrieve form data
        const formData = new FormData(this);

        // Send data to the backend using fetch
        fetch('motorbike.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                // If the response is successful, display a success message
                showMessage('Data inserted successfully');
            } else {
                // If there's an error, display an error message
                showMessage('Error: ' + response.statusText);
            }
        })
        .catch(error => {
            // If there's an error, display an error message
            showMessage('Error: ' + error.message);
        });
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
