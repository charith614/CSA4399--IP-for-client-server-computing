// Class schedule functionality
const classes = [
    { name: "Yoga", time: "Monday 10am", trainer: "Sarah" },
    { name: "HIIT", time: "Wednesday 6pm", trainer: "John" },
    { name: "Zumba", time: "Friday 5pm", trainer: "Anna" }
];

document.addEventListener('DOMContentLoaded', () => {
    // Display class schedule
    const classList = document.getElementById("class-list");
    if (classList) {
        classes.forEach((gymClass) => {
            const classItem = document.createElement("div");
            classItem.classList.add("class-item");
            classItem.innerHTML = `
                <h2>${gymClass.name}</h2>
                <p>Time: ${gymClass.time}</p>
                <p>Trainer: ${gymClass.trainer}</p>
                <button class="book-btn">Book Now</button>
            `;
            classList.appendChild(classItem);
        });

        document.querySelectorAll('.book-btn').forEach(button => {
            button.addEventListener('click', () => {
                alert("Class booked!");
            });
        });
    }

    // Registration functionality
    document.addEventListener('DOMContentLoaded', function () {
        const registerForm = document.getElementById('register-form');
        const errorMessage = document.getElementById('error-message');
        const popup = document.getElementById('popup');
        const overlay = document.getElementById('overlay');
        
        registerForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent form submission
            
            // Get form values
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
    
            // Regular expression for password validation
            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    
            // Validate password
            if (!passwordPattern.test(password)) {
                errorMessage.textContent = 'Password must be at least 8 characters long and include an uppercase letter, a lowercase letter, a number, and a special character.';
                return;
            }
    
            // Check if passwords match
            if (password !== confirmPassword) {
                errorMessage.textContent = 'Passwords do not match.';
                return;
            }
    
            // Clear any previous error messages
            errorMessage.textContent = '';
    
            // Show success popup
            popup.style.display = 'block';
            overlay.style.display = 'block';
    
            // Optionally, you can submit the form data via AJAX here
            // or store it in local storage, etc.
        });
    });
    

    // Login functionality
    document.addEventListener('DOMContentLoaded', () => {
        // Login functionality
        const loginForm = document.getElementById('login-form');
        if (loginForm) {
            loginForm.addEventListener('submit', (e) => {
                e.preventDefault();  // Prevent form submission
    
                // Assuming login is successful; add your login validation logic here
                showPopup("Login successful!", "home.html");
            });
        }
    
        // Function to show popup message
        function showPopup(message, redirectUrl) {
            const popup = document.getElementById('popup');
            const overlay = document.getElementById('overlay');
            if (popup && overlay) {
                popup.querySelector('h2').textContent = message;
                overlay.classList.add('show');
                popup.classList.add('show');
                popup.querySelector('button').addEventListener('click', () => {
                    window.location.href = redirectUrl;
                });
            } else {
                // If popup is not found, simply redirect
                window.location.href = redirectUrl;
            }
        }
    });

    // Payment functionality
    const paymentBtn = document.getElementById('payment-btn');
    if (paymentBtn) {
        paymentBtn.addEventListener('click', (e) => {
            e.preventDefault();  // Prevent form submission
            showPopup("Payment successful!", "home.html");
        });
    }

    // Contact form functionality
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();  // Prevent form submission
            alert("Message sent!");
            window.location.href = "about-us.html";
        });
    }

    // Function to show popup message
    function showPopup(message, redirectUrl) {
        const popup = document.getElementById('popup');
        const overlay = document.getElementById('overlay');
        if (popup && overlay) {
            popup.querySelector('h2').textContent = message;
            overlay.classList.add('show');
            popup.classList.add('show');
            popup.querySelector('button').addEventListener('click', () => {
                window.location.href = redirectUrl;
            });
        } else {
            // If popup is not found, simply redirect
            window.location.href = redirectUrl;
        }
    }
});
