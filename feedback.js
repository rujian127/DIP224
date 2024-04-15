document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('feedback-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission behavior

        // Retrieve form data
        var formData = new FormData(this);

        // Send AJAX request to feedback-submit.php
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'feedback-submit.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Display success message or handle response
                    console.log(xhr.responseText);
                    showMessage("Feedback submitted successfully");
                } else {
                    // Display error message
                    console.error('Error:', xhr.statusText);
                }
            }
        };
        xhr.send(formData);
    });
});
