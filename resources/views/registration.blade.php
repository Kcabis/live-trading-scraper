<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<style>
/* Your previous CSS code */
body {
  font-family: Arial, sans-serif;
  background-color: #f3f4f6;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
}

.register-container {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.register-box {
  width: 500px;
}

.register-box h3 {
  text-align: center;
  color: #555;
  margin-bottom: 10px;
}

.register-box p {
  text-align: center;
  color: #555;
  margin-bottom: 20px;
}

.input-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 15px;
}

.input-group {
  flex: 0 0 48%;
}

.input-group label {
  display: block;
  margin-bottom: 5px;
  color: #555;
}

.input-group input,
.input-group select {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
}

.terms {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}

.terms input {
  margin-right: 10px;
}

.terms a {
  color: #673AB7;
  text-decoration: none;
}

.btn-primary {
  width: 100%;
  padding: 10px;
  background-color: #673AB7;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-bottom: 20px;
}

.btn-primary:hover {
  background-color: #5E35B1;
}

.register-box p {
  text-align: center;
  color: #555;
}

.register-box p a {
  color: #673AB7;
  text-decoration: none;
}

.register-box p a:hover {
  text-decoration: underline;
}


</style>
<body>
    <div class="register-container">
        <div class="register-box">
            <h3>Registration Form</h3>
            <p>Enter your information to register Sastoshares</p>
            <form id="registerForm">
                <div class="input-row">
                    <div class="input-group">
                        <label for="first-name">First Name *</label>
                        <input type="text" id="first-name" placeholder="First Name" required>
                    </div>
                    <div class="input-group">
                        <label for="last-name">Last Name *</label>
                        <input type="text" id="last-name" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="input-row">
                    <div class="input-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" placeholder="Email Address" required>
                    </div>
                    <div class="input-group">
                        <label for="mobile">Mobile No. *</label>
                        <input type="text" id="mobile" placeholder="98XXXXXXXX" required>
                    </div>
                </div>
                <div class="input-row">
                    <div class="input-group">
                        <label for="password">Password *</label>
                        <input type="password" id="password" placeholder="Password" required>
                    </div>
                    <div class="input-group">
                        <label for="confirm-password">Confirm Password *</label>
                        <input type="password" id="confirm-password" placeholder="Confirm Password" required>
                    </div>
                </div>
                <div class="terms">
                    <input type="checkbox" id="terms" required>
                    <label for="terms">I agree to the <a href="#">Terms of Service and Privacy Policy</a></label>
                </div>
                <button type="submit" class="btn-primary">Register</button>
            </form>
            <p>Already a Member? <a href="{{url('login')}}">Login</a></p>
        </div>
    </div>

    <script>
        const form = document.getElementById('registerForm');

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Form validation logic
            const firstName = document.getElementById('first-name').value;
            const lastName = document.getElementById('last-name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const termsChecked = document.getElementById('terms').checked;

            if (!termsChecked) {
                alert("You must agree to the terms and conditions.");
                return;
            }

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return;
            }

            // If form is valid, trigger OTP process
            sendOtp(email);
        });

        function sendOtp(email) {
            // Trigger backend OTP generation and email sending
            fetch('send-otp.php', {
                method: 'POST';
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Prompt for OTP
                    const otp = prompt("Enter the OTP sent to your email:");
                    verifyOtp(email, otp);
                } else {
                    alert("Error sending OTP. Please try again.");
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function verifyOtp(email, otp) {
            // Verify OTP with the backend
            fetch('verify-otp.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ email: email, otp: otp })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Registration successful!");
                    form.submit(); // Proceed with form submission after successful OTP verification
                } else {
                    alert("Invalid OTP. Please try again.");
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
