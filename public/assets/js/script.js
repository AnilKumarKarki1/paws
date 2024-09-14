document.querySelectorAll(".faq ul li").forEach(function (item) {
  item.addEventListener("click", function () {
    alert("FAQ item clicked: " + item.textContent);
  });
});
document.addEventListener("DOMContentLoaded", function () {
  const subscribeForm = document.getElementById("subscribeForm");

  // subscribeForm.addEventListener("submit", function (event) {
  //   event.preventDefault();
  //   alert("Thank you for subscribing! You will receive our latest updates.");
  //   subscribeForm.reset();
  // });
  subscribeForm.addEventListener("submit", function (event) {
    event.preventDefault();
    const formData = new FormData(subscribeForm);
    fetch("../../actions/subscribe_action.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert(
            "Thank you for subscribing! You will receive our latest updates."
          );
          subscribeForm.reset();
        } else {
          alert("Error: " + data.message);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("There was an error. Please try again.");
      });
  });

  const currentPath = window.location.pathname.split("/").pop();
  const navLinks = {
    "": document.getElementById("homeLink"),
    about: document.getElementById("aboutLink"),
    adopt: document.getElementById("adoptLink"),
    contact: document.getElementById("contactLink"),
  };

  if (navLinks[currentPath]) {
    navLinks[currentPath].classList.add("active");
  }
  window.onscroll = function () {
    scrollFunction();
  };

  function scrollFunction() {
    var scrollToTopBtn = document.getElementById("scrollToTopBtn");
    if (
      document.body.scrollTop > 300 ||
      document.documentElement.scrollTop > 300
    ) {
      scrollToTopBtn.style.display = "block";
    } else {
      scrollToTopBtn.style.display = "none";
    }
  }

  document.getElementById("scrollToTopBtn").onclick = function () {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  };
});

document.addEventListener("DOMContentLoaded", function () {
  if (document.getElementById("adoptionRequestForm")) {
    // Open the modal when the Adopt button is clicked
    document.querySelectorAll(".adopt-button").forEach((button) => {
      button.addEventListener("click", function () {
        const petId = this.dataset.petId;
        document.getElementById("petId").value = petId;
        document.getElementById("adoptModal").style.display = "block";
        // Clear error messages when the modal opens
        document.getElementById("error-message").style.display = "none";
        document.getElementById("error-message").textContent = "";
      });
    });

    // Close the modal
    document.querySelector(".close").onclick = function () {
      document.getElementById("adoptModal").style.display = "none";
    };

    // Submit form via AJAX
    document
      .getElementById("adoptionRequestForm")
      .addEventListener("submit", function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch("/actions/create_adoption_request.php", {
          method: "POST",
          body: formData,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              alert("Your adoption request has been submitted successfully!");
              document.getElementById("adoptModal").style.display = "none";
              this.reset();
            } else {
              // Display error message without closing the modal
              const errorMessageDiv = document.getElementById("error-message");
              errorMessageDiv.style.display = "block";
              errorMessageDiv.textContent = data.message;
            }
          })
          .catch((error) => {
            // Handle any unexpected errors
            const errorMessageDiv = document.getElementById("error-message");
            errorMessageDiv.style.display = "block";
            errorMessageDiv.textContent = "An unexpected error occurred.";
          });
      });
  }
});
