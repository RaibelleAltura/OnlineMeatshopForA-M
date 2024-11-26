<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="terms_and_conditions.css">
  <title>Terms and Conditions</title>
</head>

<body>
  <?php
  if (isset($_SESSION['userloggedin']) && $_SESSION['userloggedin']) {
    include 'nav-logged.php';
  } else {
    include 'navbar.php';
  }
  ?>

  

  <!-- About Us section -->
  <div class="aboutus" id="About-Us" style="background-color: #feead4; background-size: cover; background-position: center; background-repeat: no-repeat;">
      <div class="container ">
        <div class="row" data-aos="fade-up">
        </div>
        <div class="story-content row mb-2">
          <div class="story-text col-lg-6 col-md-6 col-sm-12 reveal mt-2" data-aos="fade-up" data-os-interval="300">
          <h1 style="text-align: center;"><span style="color: #fb4a36;">TERMS & CONDITIONS </span></h1>
          <h2>Welcome to April and Marc Frozen Meat Trading</h2>
          <p>By using our services, you agree to the following terms and policies:</p>
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
            <h1 style="text-align: center;"><span style="color: #fb4a36;">PRIVACY POLICY </span></h1>
        <p>We value your privacy and are committed to protecting your personal data. This Privacy Policy explains how we collect, use, and share information when you visit our site.</p>

        <p>By using our website, you consent to the data practices described in this policy.</p>
        <div class="support">
        <p>If you have any questions, feel free to <a href="mailto:support.aprilmarc@gmail.com">contact us via email</a>.</p>
    </div>

    <div class="login-section">
        <!-- Login button styled as a button instead of link -->
        <a href="login.php" class="btn solid">Back to Login</a>

    </div>
          </div>
          <div class="story-image col-lg-6 col-md-6 col-sm-12 d-flex justify-content-end align-items-start slide-in-right" data-aos="fade-up">
            <img src="images/logo1.png" alt="Crafting Memorable Meals" style="width: 100%; height: auto;">
          </div>
        </div>
      </div>
    </section>
  </div>




  <!-- footer -->
  <footer>
    <div class="footer-container">
      <div class="footer-row">
        <div class="footer-col" id="contact">
          <h4>Contact Us</h4>
          <p>Brgy. Mojon Tampoy San Jose, Batangas Philippines</p>
          <p>Email: AandMFrozenMeatTrading@gmail.com</p>
          <p>Phone: 0917 302 3141</p>
        </div>
        
        <div class="footer-col">
          <h4>Follow Us</h4>
          <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <h4>&copy; April and Marc Frozen Meat Trading</h4>
      </div>
    </div>
  </footer>



</body>
</html>