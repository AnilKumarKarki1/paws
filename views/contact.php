<?php
include 'config/config.php';  // Database connection

// Fetch company contact info from the database
$query = $pdo->query("SELECT * FROM company LIMIT 1");
$company = $query->fetch();
// Fetch all FAQ entries from the database
$query = $pdo->query("SELECT * FROM faq ORDER BY id ASC");
$faqs = $query->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page - Paws And Claws Rescue</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
    <link rel="icon" href="public/assets/images/favicon.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.0.0/js/all.js"></script>
</head>

<body>
    <?php include 'views/layout/navbar.php'; ?>


    <section class="banner">
        <h1>Contact Us</h1>
        <p>Find Your Next Best Friend At Our Trusted Shelter</p>
    </section>


    <section class="contact-info">
        <h2>Don't Hesitate To Contact Us</h2>
        <p>Please, feel free to reach out for any inquiries.</p>

        <div class="contact-details">
            <div class="contact-method">
                <h3><i class="fas fa-envelope"></i> Email Us</h3>
                <p><?php echo htmlspecialchars($company['email']); ?></p>
            </div>
            <div class="contact-method">
                <h3><i class="fas fa-phone"></i> Call Us</h3>
                <p><?php echo htmlspecialchars($company['phone']); ?></p>
            </div>
            <div class="contact-method">
                <h3><i class="fas fa-map-marker-alt"></i> Location</h3>
                <p><?php echo htmlspecialchars($company['address']); ?></p>
            </div>
        </div>
    </section>


    <section class="contact-form">
    <h2>Get in touch with us.<br>We're here to assist you.</h2>
    <form id="contactForm">
        <div class="form-group">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="text" name="phone" placeholder="Phone Number (optional)">
        </div>
        <textarea name="message" placeholder="Message" required></textarea>
        <button type="submit">Leave us a Message</button>
    </form>
</section>

    <section class="faq">
        <h2>Frequently Asked Questions</h2>
        <div class="accordion">
            <?php foreach ($faqs as $faq): ?>
                <div class="accordion-item">
                    <button class="accordion-button"><?php echo htmlspecialchars($faq['question']); ?></button>
                    <div class="accordion-content">
                        <p><?php echo nl2br(htmlspecialchars($faq['answer'])); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <?php include 'views/layout/footer.php'; ?>

    <button id="scrollToTopBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>

    <script src="public/assets/js/script.js"></script>
    <script src="public/assets/js/contact.js"></script>
</body>

</html>