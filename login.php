<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="login.css" />
    <title>Login/Register</title>
    <style>
       /* Eye Toggle Icon Styles */
       .input-field .fa-eye,
        .input-field .fa-eye-slash {
            position: absolute;
            right: 10px;
            cursor: pointer;
            color: #007bff;
            transition: color 0.3s ease;
        }

        .input-field .fa-eye:hover,
        .input-field .fa-eye-slash:hover {
            color: #0056b3;
        }

        /* Popup Styles */
        #successPopup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
            z-index: 1000;
        }

        #successPopup button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #successPopup button:hover {
            background-color: #0056b3;
        }

        /* Overlay */
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        /* Main container */
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f9f9f9;
        }

        /* Left column for the logo */
        .logo-container {
            flex: 1;
            display: flex;
            justify-content: left;
            align-items: left;
        }

        .logo-container img {
            max-width: 60%; /* Adjust size as needed */
            max-height: 50%;
        }

        /* Right column for the form */
        .form-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
         /* Modal Styles */
         .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            overflow: auto;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            margin: 15% auto;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
        }

        .modal .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 25px;
        }

        .modal .close:hover,
        .modal .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        
    </style>
</head>

<body>
    <?php include_once("navbar.php"); ?>
     <!-- Success Popup -->
     <div id="overlay"></div>
    <div id="successPopup">
        <h2>Sign Up Successfully!</h2>
        <p>Your account has been successfully created. Please log in to continue.</p>
        <button onclick="redirectToLogin()">Okay</button>
    </div>
    <div class="container">
    <div class="logo-container">
            <img src="images/logo.jpg" alt="Logo">
        </div>
        <div class="forms-container">
            <div class="signin-signup">
                <!-- Sign In Form -->
                <form action="dblogin.php" class="sign-in-form" method="POST">
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email" required onkeyup="hideAlertBox()" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="loginPassword" placeholder="Password" name="password" required onkeyup="hideAlertBox()" />
                        <i class="fas fa-eye-slash" id="toggleLoginPassword" style="cursor: pointer;"></i>
                    </div>
                    <p class="terms">
                        By signing in, you agree to our 
                        <a href="javascript:void(0);" onclick="openModal('termsModal')">Terms and Conditions</a>.
                    </p>
                    <p class="privacy-policy">
                        <a href="javascript:void(0);" onclick="openModal('privacyModal')">Privacy Policy</a>
                    </p>
                            <a href="reset_password.php" style="text-decoration: none; color: #007BFF;">Forgot Password?</a>

                    <input type="submit" value="Login" class="submit solid" id="loginButton" />
                    <button class="btn transparent" id="sign-up-btn">
                        Sign up
                    </button>

                    <?php
                    if (isset($_GET['error'])) {
                        echo ('<div class="alert alert-danger" id="alertbox" role="alert">Email or Password is incorrect.</div>');
                    }
                    ?>
                </form>

                <!-- Sign Up Form -->
                <form action="dbregister.php" class="sign-up-form" method="POST" id="registerForm">
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="First Name" name="firstName" onkeyup="hideAlertBox()" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Last Name" name="lastName" onkeyup="hideAlertBox()" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email" onkeyup="hideAlertBox()" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-phone" style="transform: rotate(90deg);"></i>
                        <input type="text" placeholder="Contact No" name="contact" onkeyup="hideAlertBox()" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="registerPassword" placeholder="Password" name="password" required onkeyup="hideAlertBox()" />
                        <i class="fas fa-eye-slash" id="toggleRegisterPassword" style="cursor: pointer;"></i>
                    </div>
                    <input type="submit" class="submit" value="Sign up" id="registerButton" />
                    <button class="btn transparent" id="sign-in-btn">
                        Sign in
                    </button>
                </form>
            </div>
        </div>

       <!-- Terms and Conditions Modal -->
    <div id="termsModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('termsModal')">&times;</span>
            <h2>Terms and Conditions</h2>
            <p>
                Welcome to our platform! These terms and conditions outline the rules and regulations for the use of our website. 
                By accessing this website, we assume you accept these terms. Do not continue to use our website if you do not agree 
                to all of the terms and conditions stated on this page.
            </p>
            <h2>Welcome to April and Marc Frozen Meat Trading</h2>
            <p>By using our services, you agree to the following terms:</p>
            <h3>1. Eligibility</h3>
            <p>You must be at least 18 years old or of legal age in your jurisdiction to use our services.</p>

            <h3>2. User Responsibilities</h3>
            <p>You agree to use the services in accordance with the terms set forth, including respecting intellectual property rights, user privacy, and applicable laws.</p>

            <h3>3. Acceptable Use Policy</h3>
            <p>Prohibited activities include, but are not limited to, distributing harmful materials, harassment, and accessing unauthorized content.</p>

            <h3>4. Account Security</h3>
            <p>It is your responsibility to maintain the confidentiality of your account credentials.</p>

            <h3>5. Limitation of Liability</h3>
            <p>We are not liable for damages or losses resulting from the use of our services.</p>
        </div>
    </div>

    <!-- Privacy Policy Modal -->
    <div id="privacyModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('privacyModal')">&times;</span>
            <h2>Privacy Policy</h2>
            <p>
                Your privacy is critically important to us. This privacy policy document describes the types of information we 
                collect and record and how we use it.
            </p>
            <p>We value your privacy and are committed to protecting your personal data. This Privacy Policy explains how we collect, use, and share information when you visit our site.</p>

<h3>1. Data Collection</h3>
<p>We collect information you provide when registering or placing orders, such as your name, email address, and contact number.</p>

<h3>2. Data Usage</h3>
<p>We use your data to process orders, provide customer support, and send promotional messages (if opted in).</p>

<h3>3. Data Sharing</h3>
<p>We do not share your information with third parties except for order fulfillment or legal obligations.</p>

<div class="support">
  <p>If you have any questions, feel free to <a href="mailto:support.aprilmarc@gmail.com">contact us via email</a>.</p>
        </div>
    </div>


    </div>

    <script>
             // Open Modal
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        // Close Modal
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const termsModal = document.getElementById('termsModal');
            const privacyModal = document.getElementById('privacyModal');
            if (event.target === termsModal) termsModal.style.display = 'none';
            if (event.target === privacyModal) privacyModal.style.display = 'none';
        };
        
        // Redirect to login after showing success popup
        function redirectToLogin() {
            window.location.href = "login.php";
        }

        // Display popup if redirected from registration
        window.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('signup') && urlParams.get('signup') === 'success') {
                document.getElementById('overlay').style.display = 'block';
                document.getElementById('successPopup').style.display = 'block';
            }
        });

        // Toggle password visibility for login form
        const toggleLoginPassword = document.querySelector('#toggleLoginPassword');
        const loginPassword = document.querySelector('#loginPassword');

        toggleLoginPassword.addEventListener('click', function() {
            const type = loginPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            loginPassword.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });

        // Toggle password visibility for register form
        const toggleRegisterPassword = document.querySelector('#toggleRegisterPassword');
        const registerPassword = document.querySelector('#registerPassword');

        toggleRegisterPassword.addEventListener('click', function() {
            const type = registerPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            registerPassword.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });

        // Handle sign up and sign in button clicks
        const sign_in_btn = document.querySelector("#sign-in-btn");
        const sign_up_btn = document.querySelector("#sign-up-btn");
        const container = document.querySelector(".container");

        sign_up_btn.addEventListener("click", () => {
            container.classList.add("sign-up-mode");
        });

        sign_in_btn.addEventListener("click", () => {
            container.classList.remove("sign-up-mode");
        });

        // Hide alert box
        function hideAlertBox() {
            const alertBox = document.getElementById('alertbox');
            alertBox.style.display = 'none';
        }
    </script>
</body>

</html>