<?php
include 'config/config.php';  // Database connection

$query = $pdo->query("SELECT * FROM faq");
$preps = $query->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Page - Paws And Claws Rescue</title>
  <link rel="stylesheet" href="public/assets/css/style.css" />
  <link rel="icon" href="public/assets/images/favicon.ico" type="image/x-icon" />
  <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.0.0/js/all.js"></script>
  <style>
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5);
      padding-top: 50px;
    }

    .modal-content {
      background-color: #fefefe;
      margin: auto;
      padding: 20px;
      border-radius: 10px;
      border: 1px solid #888;
      width: 80%;
      max-width: 600px;
      position: relative;
      animation: fadeIn 0.5s;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
    }

    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }

    .styled-form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    label {
      font-weight: bold;
      color: #333;
    }

    input {
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ddd;
      font-size: 1em;
      width: 100% !important;
      box-sizing: border-box;
    }

    input:focus {
      outline: none;
      border-color: #007bff;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .submit-btn {
      background-color: #28a745;
      color: #fff;
      border: none;
      padding: 12px 20px;
      text-align: center;
      font-size: 1em;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .submit-btn:hover {
      background-color: #218838;
    }

    .submit-btn:focus {
      outline: none;
      box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
    }

    #error-message {
      font-weight: bold;
      margin-bottom: 15px;
    }
  </style>
</head>

<body>
  <?php include 'views/layout/navbar.php'; ?>

  <main>
    <!-- Adopt Me Section -->
    <section class="adopt-me" aria-labelledby="adoptMeHeading">
      <h2 id="adoptMeHeading">Adopt Me</h2>
      <p>Waiting for you</p>
      <div class="adopt-container">
        <?php
        include 'config/config.php';

        // Query to get all pets from the database
        $query = $pdo->prepare("SELECT * FROM pets");
        $query->execute();
        $pets = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($pets as $pet):
        ?>
          <div class="adopt-item" role="article" aria-labelledby="pet-<?php echo htmlspecialchars($pet['id']); ?>">
            <img src="public/<?php echo htmlspecialchars($pet['image']); ?>" alt="Adopt Pet <?php echo htmlspecialchars($pet['name']); ?>" />
            <h3 id="pet-<?php echo htmlspecialchars($pet['id']); ?>"><?php echo htmlspecialchars($pet['breed']); ?></h3>
            <p><?php echo htmlspecialchars($pet['description']); ?></p>
            <button class="adopt-button" data-pet-id="<?php echo htmlspecialchars($pet['id']); ?>">Adopt &#129402;</button>
          </div>
        <?php endforeach; ?>
      </div>
      <!-- Adoption Request Form Modal -->
      <div id="adoptModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <h2>Adopt a Pet</h2>

          <!-- Error message container -->
          <div id="error-message" style="color: red; display: none;"></div>

          <form id="adoptionRequestForm" class="styled-form">
            <input type="hidden" id="petId" name="pet_id" value="">

            <div class="form-group">
              <label for="clientName">Your Name:</label>
              <input type="text" id="clientName" name="client_name" required>
            </div>

            <div class="form-group">
              <label for="clientEmail">Your Email:</label>
              <input type="email" id="clientEmail" name="client_email" required>
            </div>

            <div class="form-group">
              <label for="clientPhone">Your Phone (optional):</label>
              <input type="text" id="clientPhone" name="client_phone">
            </div>

            <button type="submit" class="submit-btn">Submit Request</button>
          </form>
        </div>
      </div>


    </section>

    <section class="banner">
      <p>
        Any Enquiries &#128533; &#x1F615; Don't Hesitate to contact us we are
        available 24/7
      </p>
      <button class="banner-button">
        <a href="contact" id="contactLink">Contact Us</a>
      </button>
    </section>

    <!-- Preparation Section -->
    <section class="preparation">
      <h2>Getting Ready For New Family Member</h2>
      <div class="prep-grid">
        <div class="prep-img">
          <img src="public/assets/images/dog2.jpg" alt="Family Preparation" />
        </div>
        <div class="prep-info">
          <div class="prep-info">
            <?php foreach ($preps as $prep): ?>
              <div class="prep-item">
                <h3><?php echo htmlspecialchars($prep['question']); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($prep['answer'])); ?></p>
              </div>
            <?php endforeach; ?>
          </div>
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