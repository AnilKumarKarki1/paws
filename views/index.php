<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Page - Paws And Claws Rescue</title>
  <link rel="stylesheet" href="public/assets/css/style.css" />
  <link rel="icon" href="public/assets/images/favicon.ico" type="image/x-icon" />
  <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.0.0/js/all.js"></script>
</head>

<body>
  <?php include 'views/layout/navbar.php'; ?>
  <main>
    <section class="banner" aria-labelledby="bannerHeading">
      <p id="bannerHeading">Find Your Next Best Friend At Our Trusted Shelter</p>
      <a href="adopt" id="adoptLink" aria-label="Go to Adoption page">
        <button>Adopt &#129402;</button>
      </a>
    </section>
    <!-- Services Section -->
    <section class="services" aria-labelledby="servicesHeading">
      <h2 id="servicesHeading">Services</h2>
      <div class="services-container">
        <div class="service-item" role="article" aria-labelledby="petAdoption">
          <i class="fas fa-paw" aria-hidden="true"></i>
          <h3 id="petAdoption">Pet Adoption</h3>
          <p>Find your perfect pet companion.</p>
        </div>
        <div class="service-item" role="article" aria-labelledby="veterinaryCare">
          <i class="fas fa-stethoscope" aria-hidden="true"></i>
          <h3 id="veterinaryCare">Veterinary Care</h3>
          <p>Comprehensive care for your pets.</p>
        </div>
        <div class="service-item" role="article" aria-labelledby="petGrooming">
          <i class="fas fa-cut" aria-hidden="true"></i>
          <h3 id="petGrooming">Pet Grooming</h3>
          <p>Keep your pet looking sharp and healthy.</p>
        </div>
        <div class="service-item" role="article" aria-labelledby="petRescue">
          <i class="fas fa-search" aria-hidden="true"></i>
          <h3 id="petRescue">Pet Rescue</h3>
          <p>Rescuing pets and finding new homes.</p>
        </div>
        <div class="service-item" role="article" aria-labelledby="petExercise">
          <i class="fas fa-running" aria-hidden="true"></i>
          <h3 id="petExercise">Pet Exercise</h3>
          <p>Ensuring your pet stays active and healthy.</p>
        </div>
        <div class="service-item" role="article" aria-labelledby="animalTraining">
          <i class="fas fa-dog" aria-hidden="true"></i>
          <h3 id="animalTraining">Animal Training</h3>
          <p>Expert training for your pets.</p>
        </div>
      </div>
    </section>

    <!-- Adopt Me Section -->
    <section class="adopt-me" aria-labelledby="adoptMeHeading">
      <h2 id="adoptMeHeading">Adopt Me</h2>
      <p>Waiting for you</p>
      <div class="adopt-container">
        <?php
        include 'config/config.php';

        // Query to get 4 pets from the database
        $query = $pdo->prepare("SELECT * FROM pets LIMIT 4");
        $query->execute();
        $pets = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($pets as $pet):
        ?>
          <div class="adopt-item" role="article" aria-labelledby="pet-<?php echo htmlspecialchars($pet['id']); ?>">
            <img src="public/<?php echo htmlspecialchars($pet['image']); ?>" alt="Adopt Pet <?php echo htmlspecialchars($pet['name']); ?>" />
            <h3 id="pet-<?php echo htmlspecialchars($pet['id']); ?>"><?php echo htmlspecialchars($pet['breed']); ?></h3>
            <p><?php echo htmlspecialchars($pet['description']); ?></p>
            <a href="adopt" id="adoptLink" aria-label="Adopt <?php echo htmlspecialchars($pet['name']); ?>">
              <button>Adopt &#129402;</button>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </section>


    <!-- Testimonials Section -->
    <section class="testimonials" aria-labelledby="testimonialsHeading">
      <h2 id="testimonialsHeading">What Our Clients Say</h2>
      <div class="testimonial-item" role="article">
        <iframe
          width="560"
          height="315"
          src="https://www.youtube.com/embed/KbgvRLsCOJI"
          title="Act of Love Adoptions | Adoptive Parents Review"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
          referrerpolicy="strict-origin-when-cross-origin"
          allowfullscreen
          aria-label="Video testimonial from Jane Doe"></iframe>
        <div class="testimonial-content">
          <p>
            "Paws and Claws provided excellent service when I adopted my pet.
            Highly recommended!"
          </p>
          <h4>Jane Doe</h4>
        </div>
      </div>
      <div class="testimonial-item" role="article">
        <div class="testimonial-content">
          <p>
            "The staff at Paws and Claws are so caring and helpful. They made
            the adoption process easy."
          </p>
          <h4>John Smith</h4>
        </div>
        <iframe
          width="560"
          height="315"
          src="https://www.youtube.com/embed/ZO5dXkxvq_A"
          title="Heartbreaking dog rescue animation | Billie by Maki Yoshikura | Short Film | Random Acts"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
          referrerpolicy="strict-origin-when-cross-origin"
          allowfullscreen
          aria-label="Video testimonial from John Smith"></iframe>
      </div>
    </section>

    <!-- Subscription Section -->
    <section class="subscription" aria-labelledby="subscriptionHeading">
      <h2 id="subscriptionHeading">Subscription</h2>
      <p>Stay updated with our latest news and offers.</p>
      <form id="subscribeForm" method="post" aria-labelledby="subscriptionHeading">
        <input type="email" name="email" id="email" placeholder="Email address" required aria-required="true" />
        <button type="submit">Subscribe</button>
      </form>
    </section>
  </main>

  <?php include 'views/layout/footer.php'; ?>

  <button id="scrollToTopBtn" title="Go to top" aria-label="Scroll to top">
    <i class="fas fa-arrow-up"></i>
  </button>

  <script src="public/assets/js/script.js"></script>
</body>

</html>