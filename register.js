document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        // Prevent the form from submitting immediately
        event.preventDefault();

        // Perform validation
        let isValid = true;
        const username = document.querySelector('input[name="username"]').value;
        const password = document.querySelector('input[name="password"]').value;

        // Clear previous error messages
        document.querySelectorAll('.error').forEach(e => e.remove());

        // Check if username is empty
        if (!username.trim()) {
            isValid = false;
            addError('input[name="username"]', 'Username cannot be empty');
        }

        // Check if password is empty
        if (!password) {
            isValid = false;
            addError('input[name="password"]', 'Password cannot be empty');
        }

        // If all checks pass, submit the form
        if (isValid) {
            form.submit();
        }
    });

    // Function to add error messages
    function addError(selector, message) {
        const field = document.querySelector(selector);
        const error = document.createElement('span');
        error.classList.add('error');
        error.textContent = message;
        error.style.color = 'red'; // Style the error message
        field.parentNode.insertBefore(error, field.nextSibling);
    }
});
