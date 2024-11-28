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
    <a href="terms_and_conditions.php" target="_blank">Terms and Conditions</a>.
</p>
<p class="privacy-policy">
    <a href="terms_and_conditions.php" target="_blank">Privacy Policy</a>
</p>
<a href="reset_password.php" style="text-decoration: none; color: #007BFF;">Forgot Password?</a>




                    <input type="submit" value="Login" class="submit solid" id="loginButton" />

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
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New to Our Restaurant?</h3>
                    <p>
                        Join us today and enjoy the convenience of online ordering. Get exclusive offers and track your orders easily.
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Sign up
                    </button>
                </div>
                <img src="images/form-pic.png" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Our Customer?</h3>
                    <p>
                        Sign in to continue enjoying our delicious meals and manage your orders seamlessly.
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Sign in
                    </button>
                </div>
                <img src="images/form-pic2.png" class="image" alt="" />
            </div>
        </div>
    </div>

    <script>
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