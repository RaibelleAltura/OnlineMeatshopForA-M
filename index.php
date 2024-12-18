<?php
session_start();



// Include database connection file
include 'db_connection.php';

// Check if database connection was successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Prepare query to fetch popular items
$sql = "SELECT itemName, image, price FROM menuitem WHERE is_popular = 1";

// Check if query was successful
if ($result = $conn->query($sql)) {
  // Initialize array to store popular items
  $popularItems = [];

  // Fetch and store query results
  while ($row = $result->fetch_assoc()) {
    $popularItems[] = $row;
  }

  // Close query result
  $result->close();
} else {
  // Display error message if query fails
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Assuming user's email is stored in session
$email = $_SESSION['email'] ?? '';

$firstName = '';
$lastName = '';
$contact = '';

if ($email) {
    $stmt = $conn->prepare("SELECT firstName, lastName, contact FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $contact = $row['contact'];
    }
    $stmt->close();
}
// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--Bootstrap CSS-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <!--poppins-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!--Icon-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link href="https://fonts.googleapis.com/css2?family=Allura&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Chewy Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Chewy&display=swap" rel="stylesheet">
  <!-- AOS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="index.css">
  <title>Home</title>
</head>

<body>
  <?php
  if (isset($_SESSION['userloggedin']) && $_SESSION['userloggedin']) {
    include 'nav-logged.php';
  } else {
    include 'navbar.php';
  }
  ?>

  <div class="main">
    <section>
      <div class="container mt-3">
        <div class="row d-flex justify-content-start align-items-start main-container">
          <div class="col-md-5 col-sm-12 col-lg-5 reveal main-text mb-4 text-align-justify mt-5" data-aos="fade-up">
            <h2>Welcome to <span style="color: #fb4a36;"> April and Marc Frozen Meat Trading</span></h2>
            <h4 style="color: gray; font-weight: 450;">"Let me Meat your Needs"</h4>
            <p style="font-size: 18px; text-align: justify;">
            At April and Marc Frozen Meat Trading, we are dedicated to providing premium frozen meats that help businesses thrive. Whether you run a restaurant, catering service, or retail store, our top-quality products are sourced to meet your demands with consistency and reliability.
            <br>
            <br>
From small orders to bulk supplies, we ensure that every delivery is handled with professionalism and care, helping you focus on growing your business. Partner with us today, and let’s achieve success together—one trusted supply at a time!
            </p>
            <div class="buttondiv">
              <div>
                <a href="menu.php">
                  <button class="button">
                    Start Order
                    <svg class="cartIcon" viewBox="0 0 576 512">
                      <path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"></path>
                    </svg>
                  </button>
                </a>
              </div>
              <div>
                <a class="button1" href="menu.php">
                  <span class="button__icon-wrapper">
                    <svg width="10" class="button__icon-svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 15">
                      <path fill="currentColor" d="M13.376 11.552l-.264-10.44-10.44-.24.024 2.28 6.96-.048L.2 12.56l1.488 1.488 9.432-9.432-.048 6.912 2.304.024z"></path>
                    </svg>
                    <svg class="button__icon-svg button__icon-svg--copy" xmlns="http://www.w3.org/2000/svg" width="10" fill="none" viewBox="0 0 14 15">
                      <path fill="currentColor" d="M13.376 11.552l-.264-10.44-10.44-.24.024 2.28 6.96-.048L.2 12.56l1.488 1.488 9.432-9.432-.048 6.912 2.304.024z"></path>
                    </svg>
                  </span>
                  Explore our Products!
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-7 col-sm-12 col-lg-7 d-flex justify-content-center align-items-start slide-in-right main-image">
            <img src="images/LOGO.png" class="img" style=" width: 85%; height: 80%;">
          </div>
        </div>
        <div class="row">
          <!-- Menu Section -->
          <!-- Menu Section -->
<section>
  <div class="menu-section">
    <div class="container-fluid">
      <div class="row">
        <!-- Header Text Centered -->
        <div class="row d-flex justify-content-center align-items-center mb-4 font-weight-bold" id="text">
          <h1>OUR <span>PRODUCTS</span></h1>
        </div>
        
        <!-- Center the product cards -->
        <div class="row justify-content-center">
          <!-- Product Card 1 -->
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="category-card" style="background-image: url('images/pork.jfif');" data-aos="fade-up">
              <div class="card-overlay">
                <div class="overlay-content">
                  <h3>PORK</h3>
                  <p>Start your meal with our delicious appetizers that set the tone for a delightful dining experience.</p>
                  <a href="menu.php#pork">
                    <button class="explore-btn">Explore Variety</button></a>
                </div>
              </div>
              <div class="card-bottom">
                <h3>PORK</h3>
                <a href="menu.php#pork">
                  <button class="explore-btn">Explore Variety</button></a>
              </div>
            </div>
          </div>

          <!-- Product Card 2 -->
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="category-card" style="background-image: url('images/beef.jpg');" data-aos="fade-up">
              <div class="card-overlay">
                <div class="overlay-content">
                  <h3>BEEF</h3>
                  <p>Indulge in our wide variety of pizzas, each crafted with the finest ingredients and baked to perfection.</p>
                  <a href="menu.php#beef">
                    <button class="explore-btn">Explore Variety</button></a>
                </div>
              </div>
              <div class="card-bottom">
                <h3>BEEF</h3>
                <a href="menu.php#beef">
                  <button class="explore-btn">Explore Variety</button></a>
              </div>
            </div>
          </div>

          <!-- Product Card 3 -->
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="category-card" style="background-image: url('images/chicken.jfif');" data-aos="fade-up">
              <div class="card-overlay">
                <div class="overlay-content">
                  <h3>CHICKEN</h3>
                  <p>Savor our juicy burgers, loaded with fresh toppings and bursting with flavor in every bite.</p>
                  <a href="menu.php#chicken">
                    <button class="explore-btn">Explore Variety</button></a>
                </div>
              </div>
              <div class="card-bottom">
                <h3>CHICKEN</h3>
                <a href="menu.php#chicken">
                  <button class="explore-btn">Explore Variety</button></a>
              </div>
            </div>
          </div>  
        </div>
      </div>
    </div>
  </div>
</section>

  </div>

  <!-- Why Choose Us Section -->
<section class="why-choose-us" id="why-choose-us" style="display: flex; justify-content: center; align-items: center; height: 100vh; text-align: center; background-color: #ffe4c2;">
  <div class="container" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
    <h1 style="margin-bottom: 20px; font-size: 2.5rem; color: #333;">WHY <span style="color: #fb4a36;">CHOOSE US?</span></h1>
    <p class="content" style="font-size: 1.2rem; color: #555; margin-bottom: 30px;">" Our SHOP offers the best quality meats to MEAT your NEEDS "</p>
    <ul class="why-choose-us-list" style="list-style-type: none; padding: 0;">
      <li style="display: flex; align-items: center; margin-bottom: 1.5rem; max-width: 600px;">
        <div class="image-wrapper mt-1" style="margin-right: 15px;">
          <img src="icons/truck.png" alt="Fast Delivery" style="width: 50px; height: 50px;">
        </div>
        <div class="feature-content">
          <h4 style="margin: 0; font-size: 1.3rem; font-weight: bold;">Fast Delivery</h4>
          <p style="margin: 0; font-size: 1rem; color: #555;">Enjoy prompt and reliable delivery to your doorstep.</p>
        </div>
      </li>
      <li style="display: flex; align-items: center; margin-bottom: 1.5rem; max-width: 600px;">
        <div class="image-wrapper" style="margin-right: 15px;">
          <img src="icons/meat.png" alt="Fresh Ingredients" style="width: 50px; height: 50px;">
        </div>
        <div class="feature-content">
          <h4 style="margin: 0; font-size: 1.3rem; font-weight: bold;">Quality Meats</h4>
          <p style="margin: 0; font-size: 1rem; color: #555;">We use only the freshest and highest quality meats.</p>
        </div>
      </li>
      <li style="display: flex; align-items: center; margin-bottom: 1.5rem; max-width: 600px;">
        <div class="image-wrapper" style="margin-right: 15px;">
          <img src="icons/staff.png" alt="Friendly Service" class="why-us-image" style="width: 50px; height: 50px;">
        </div>
        <div class="feature-content">
          <h4 style="margin: 0; font-size: 1.3rem; font-weight: bold;">Friendly Service</h4>
          <p style="margin: 0; font-size: 1rem; color: #555;">Experience warm and welcoming customer service.</p>
        </div>
      </li>
      <li style="display: flex; align-items: center; margin-bottom: 1.5rem; max-width: 600px;">
        <div class="image-wrapper" style="margin-right: 15px;">
          <img src="icons/price.png" alt="Exceptional Taste" style="width: 50px; height: 50px;">
        </div>
        <div class="feature-content">
          <h4 style="margin: 0; font-size: 1.3rem; font-weight: bold;">Affordable Prices</h4>
          <p style="margin: 0; font-size: 1rem; color: #555;">Enjoy premium meats at competitive prices with no compromise on quality.</p>
        </div>
      </li>
    </ul>
  </div>
</section>


      <!-- Top picks section -->
      <div class="popular reveal" data-aos="fade-up">
        <h1 class="text-center mt-3">OUR <span>BEST SELLERS</span></h1>

        <div id="cardCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="8000" data-aos="fade-up">
          <div class="carousel-inner">

            <div id="toast" class="toast">
              <button class="toast-btn toast-close">&times;</button>
              <span class="pt-3"><strong>You must log in to add items to the cart.</strong></span>
              <button class="toast-btn toast-ok">Okay</button>
            </div>
            <?php
            $chunkedItems = array_chunk($popularItems, 3); // Group items into chunks of 3
            $isActive = true; // To set the first carousel item as active

            foreach ($chunkedItems as $items) {
              echo '<div class="carousel-item' . ($isActive ? ' active' : '') . '" >';
              echo '<div class="d-flex justify-content-center">';

              foreach ($items as $item) {
                echo '<div class="card" >';
                echo '<img src="uploads/' . $item['image'] . '" class="card-img-top" alt="' . $item['itemName'] . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title text-center">' . $item['itemName'] . '</h5>';
                echo '<p class="card-text text-center">₱ ' . $item['price'] . '</p>';
                echo '</div>';
                echo '</div>';
              }

              echo '</div>';
              echo '</div>';
              $isActive = false; // Only the first item should be active
            }
            ?>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#cardCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#cardCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- About Us section -->
  <div class="aboutus" id="About-Us" style="background-color: #feead4; background-size: cover; background-position: center; background-repeat: no-repeat;">
    <section class="our-story-section p-5">
      <div class="container ">
        <div class="row" data-aos="fade-up">
          <h1 style="text-align: center;"><span style="color: #fb4a36;">ABOUT </span>US</h1>
          <h4 style="text-align: center;" class="mb-5">Crafting Memorable Meals!</h4>
        </div>
        <div class="story-content row mb-2">
          <div class="story-text col-lg-6 col-md-6 col-sm-12 reveal mt-2" data-aos="fade-up" data-os-interval="300">
            <p>Hi! <strong>Welcome to April and Marc Frozen Meat Trading</strong>, where we’ve been proudly "Meating" your needs since 2018! Starting from a small shop, we built our business on the belief that quality matters. Our goal is simple: to deliver premium frozen meat products that bring exceptional taste and value to your business.</p>
            <p>With our tagline, "Let me Meat your Needs," we’re committed to being your trusted partner in providing top-quality meats that elevate every dish and delight every customer.</p>
            <p>At April and Marc Frozen Meat Trading, we believe that success starts with strong partnerships and the satisfaction of our customers. Let us be part of your journey to success. Together, we’ll make every meal extraordinary.</p>
            <a href="menu.php" class="about_btn">
              <i class="fa-solid fa-burger"></i>Order Now
            </a>
          </div>
        </div>
      </div>
    </section>
  </div>

   <!-- Table Reservation -->
   <section class="table-reservation" id="Reservation">
    <div class="row text-center ms-4" data-aos="fade-up">
      <h1 class="mb-2">ORDER <span style="color: #fb4a36;">RESERVATION</span></h1>
      <h5 class="mb-5">Book your orders here!</h5>
    </div>
    <div class="table ms-4 me-5" data-aos="fade-up">
      <div class="reservation row reveal">
        <div class="reservation-image col-lg-7 col-md-6 col-sm-12" style="background: none !important; padding: 0 !important;">
          <img src="images/LOGO.png" alt="Reservation" style="background: none ; width: 100%; height: 100%; padding: 0 !important;" class=" w-100 h-100">
        </div>
        <div class="reservation-section col-lg-5 col-md-6 col-sm-12">
          <h2 style="background-color: #feead4;">Reserve Now!</h2>
          <form id="reservation-form" action="reservations.php" method="POST">
            <div class="form-row">
              <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" class="form-control" id="firstName" name="firstName"  value="<?= htmlspecialchars($firstName ?? '') ?>" required>
              </div>
              <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="<?= htmlspecialchars($lastName ?? '') ?>" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($email) ?>" readonly>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="phone">Contact:</label>
                <input type="text" class="form-control" id="contact" name="contact" value="<?= htmlspecialchars($contact) ?>" required>
              </div>
              <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="reservedDate" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="typeOfProduct">Type of Product:</label>
                <select id="typeOfProduct" name="typeOfProduct" class="form-control" required>
                  <option value="">Select Type</option>
                  <option value="pork">Pork</option>
                  <option value="chicken">Chicken</option>
                  <option value="beef">Beef</option>
                </select>
              </div>
              <div class="form-group">
                <label for="specificProduct">Specific Product:</label>
                <select id="specificProduct" name="specificProduct" class="form-control" required>
                  <option value="">Select Specific Product</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="box">Quantity of Box:</label>
                <input type="number" id="box" name="noOfBox" required min="1">
              </div>
            </div>
            <button type="submit" value="submit">Reserve Now</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <script>
  document.addEventListener('DOMContentLoaded', function () {
    // Product types with their specific products
    const products = {
      'beef': [
        'Beef Tripe (Tuwalya)',
        'Beef Shank (Bulalo)',
        'Beef Forequarter'
      ],
      'pork': [
        'Pork Hamleg (Ham)',
        'Pork Back Fat Skin',
        'Pork Back Fat Skinless',
        'Pork Belly Biso',
        'Pork Belly Skin',
        'Pork Belly',
        'Pork Cutting Fats',
        'Pork Ear (Tenga)',
        'Pork Flower (Bulaklak)',
        'Pork Heart',
        'Pork Jowls',
        'Pork Liver',
        'Pork Lungs (Baga)',
        'Pork Mask (Maskara)',
        'Pork Pata',
        'Pork Picnic Shoulder',
        'Pork Riblets',
        'Pork Trimmings',
        'Pork Loin (LOMO)',
        'Pork Loin (Pork Chop)'
      ],
      'chicken': [
        'Chicken Wings',
        'Chicken Drumstick',
        'Chicken Liver',
        'Chicken Drummets',
        'Chicken Breast Fillet',
        'Chicken MDM',
        'Chicken Skin'
      ]
    };

    // Add event listener to the Type of Product dropdown
    document.getElementById('typeOfProduct').addEventListener('change', function () {
      const productType = this.value; // Get the selected product type
      const specificProductDropdown = document.getElementById('specificProduct');

      // Clear the specific product dropdown
      specificProductDropdown.innerHTML = '<option value="">Select Specific Product</option>';

      // Populate specific products based on selected product type
      if (productType && products[productType]) {
        const productList = products[productType];

        // Add options to the specific product dropdown
        productList.forEach(function (product) {
          const option = document.createElement('option');
          option.value = product;
          option.textContent = product;
          specificProductDropdown.appendChild(option);
        });
      }
    });
  });
</script>




 <!-- footer -->
<footer>
  <div class="footer-container">
    <div class="footer-row">
      <!-- Contact Us Section -->
      <div class="footer-col" id="contact">
        <h4>Contact Us</h4>
        <p><i class="fas fa-map-marker-alt"></i> Brgy. Mojon Tampoy San Jose, Batangas Philippines</p>
        <p><i class="fas fa-envelope"></i> Email: <a href="mailto: marcjustineb.ramos082106@gmail.com" style="color: #007bff; text-decoration: none;">AandMFrozenMeatTrading@gmail.com <br>marcjustineb.ramos082106@gmail.com</a></p>
        <p><i class="fas fa-phone"></i> Phone: 0917 302 3141</p>
      </div>

      <!-- Follow Us Section -->
      <div class="footer-col">
        <h4>Follow us on Facebook Page</h4>
        <div class="social-icons">
        <a href="https://www.facebook.com/by.alexramos" style="color: #007bff; text-decoration: none;" target="_blank">
            <i class="fab fa-facebook-f"></i> A And M Frozen Meat Trading
          </a>
        </div>
      </div>

      <!-- Terms and Conditions Section -->
      <div class="footer-col">
      <h4><a href="terms_and_conditions.php" style="color: #007bff; text-decoration: none;">Terms and Conditions</a></h4>
        <div class="footer-col">
        <h4><a href="terms_and_conditions.php" style="color: #007bff; text-decoration: none;">Privacy Policy</a></h4>
      </div>
      </div>

    </div>

    <!-- Footer Bottom Section -->
    <div class="footer-bottom">
      <h4>&copy; 2024 April and Marc Frozen Meat Trading. All rights reserved.</h4>
    </div>
  </div>
</footer>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js">
  </script>
  <!-- AOS -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  <script>
    $(document).ready(function() {
      console.log('Page is ready. Calling load_cart_item_number.');
      load_cart_item_number();

      function load_cart_item_number() {
        $.ajax({
          url: 'action.php',
          method: 'get',
          data: {
            cartItem: "cart_item"
          },
          success: function(response) {
            $("#cart-item").html(response);
          }
        });
      }
    });
  </script>
  <script>
    $('.clients-carousel').owlCarousel({
      loop: true,
      nav: false,
      autoplay: true,
      autoplayTimeout: 5000,
      animateOut: 'fadeOut',
      animateIn: 'fadeIn',
      smartSpeed: 450,
      margin: 30,
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 2
        },
        991: {
          items: 2
        },
        1200: {
          items: 2
        },
        1920: {
          items: 2
        }
      }
    });
  </script>
  <script>
    function addToCart() {
      var userLoggedIn = <?php echo isset($_SESSION['userloggedin']) ? 'true' : 'false'; ?>;

      if (!userLoggedIn) {
        showToast();
      } else {
        // Add to cart logic goes here
      }
    }

    function showToast() {
      var toast = document.getElementById("toast");
      toast.className = "toast show";

      // Handle "Okay" button click
      document.querySelector('.toast-ok').onclick = function() {
        window.location.href = 'login.php'; // Redirect to login page
      };

      // Handle "Close (X)" button click
      document.querySelector('.toast-close').onclick = function() {
        toast.className = toast.className.replace("show", "hide");
      };
    }
  </script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const elements = document.querySelectorAll('.animate-on-scroll');
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('reveal');
          }
        });
      }, {
        threshold: 0.1
      });

      elements.forEach(element => {
        observer.observe(element);
      });
    });
  </script>


</body>
</html>