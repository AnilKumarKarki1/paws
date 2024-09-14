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
      <section class="banner">
        <p>Your next best friend at our trusted shelter</p>
        <a href="adopt" id="adoptLink">
          <button>Adopt &#129402;</button>
        </a>
      </section>

      <!-- Hero Section -->
      <section class="hero">
        <div class="hero-content">
          <h1>About Paws And Claws Rescue</h1>
          <p>
            At Paws And Claws Rescue, we believe in saving and improving the
            lives of animals by rescuing, rehabilitating, and rehoming. Be the
            one to make a difference.
          </p>
          <button class="hero-button">
            <a href="contact" id="contactLink">Contact</a>
          </button>
        </div>
        <div class="hero-image">
          <img src="public/assets/images/dog2.jpg" alt="Paws And Claws" />
        </div>
      </section>

      <!-- testimonials section -->
      <section class="testimonials">
        <h2>What Our Clients Say</h2>
        <div class="testimonial-item">
          <iframe
            width="560"
            height="315"
            src="https://www.youtube.com/embed/KbgvRLsCOJI"
            title="Act of Love Adoptions | Adoptive Parents Review"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen
          ></iframe>
          <div class="testimonial-content">
            <p>
              "Paws and Claws provided great service when I adopted my pet.
              Kudos to them!"
            </p>
            <h4>Andy Murray</h4>
          </div>
        </div>
      </section>

      <!-- Story Section -->
      <section class="story">
        <h2>Story Thus Far</h2>
        <div class="story-container">
          <div class="story-item">
            <img
              src="public/assets/images/cat1.jpg"
              alt="Lucy Adoption"
              loading="lazy"
            />
            <h3>Lacy Adoption</h3>
            <p>
              Rescued on March 2, 2020, in sydney. Now living happily with her
              forever family.
            </p>
          </div>
          <div class="story-item">
            <img
              src="public/assets/images/dog1.jpg"
              alt="Pedro Rescue"
              loading="lazy"
            />
            <h3>Paul Rescue</h3>
            <p>
              Taken in on March 2, 2015, in melbourn. Now living happily with
              her forever family.
            </p>
          </div>
          <div class="story-item">
            <img
              src="public/assets/images/cat2.jpg"
              alt="Harvey New Home"
              loading="lazy"
            />
            <h3>Rockey New Home</h3>
            <p>
              Adopted on July 10, 2010, in tasmania. Thriving with his new
              family.
            </p>
          </div>
        </div>
      </section>

      <!-- Team Section -->
      <section class="team">
        <h2>Our Team Members</h2>
        <div class="team-container">
          <div class="team-member">
            <img
              src="public/assets/images/person3.jpg"
              alt="Jane Doe"
              loading="lazy"
            />
            <h3>Jane Doe</h3>
            <p>Founder & Director</p>
          </div>
          <div class="team-member">
            <img
              src="public/assets/images/person4.jpg"
              alt="Dr. John Smith"
              loading="lazy"
            />
            <h3>Dr. John Smith</h3>
            <p>Veterinarian</p>
          </div>
          <div class="team-member">
            <img
              src="public/assets/images/person2.jpg"
              alt="Emily Johnson"
              loading="lazy"
            />
            <h3>Emily Johnson</h3>
            <p>Adoption Coordinator</p>
          </div>
          <div class="team-member">
            <img src="public/assets/images/person5.jpg" alt="Sam Lee" loading="lazy" />
            <h3>Sam Lee</h3>
            <p>Volunteer Coordinator</p>
          </div>
        </div>
      </section>
    </main>
    <?php include 'views/layout/footer.php'; ?>

    <button id="scrollToTopBtn" title="Go to top">
      <i class="fas fa-arrow-up"></i>
    </button>

    <script src="public/assets/js/script.js"></script>
  </body>
</html>
