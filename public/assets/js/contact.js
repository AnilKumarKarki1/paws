document.addEventListener("DOMContentLoaded", function () {
  const contactForm = document.getElementById("contactForm");

  const accordionButtons = document.querySelectorAll(".accordion-button");

  accordionButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const accordionItem = this.parentElement;
      const accordionContent = this.nextElementSibling;

      if (accordionItem.classList.contains("active")) {
        accordionItem.classList.remove("active");
        accordionContent.style.maxHeight = null;
      } else {
        accordionButtons.forEach((btn) => {
          btn.parentElement.classList.remove("active");
          btn.nextElementSibling.style.maxHeight = null;
        });

        accordionItem.classList.add("active");
        accordionContent.style.maxHeight = accordionContent.scrollHeight + "px";
      }
    });
  });

  // Contact form submission
  contactForm.addEventListener("submit", function (event) {
    event.preventDefault();
    // Collect form data
  //   const formData = {
  //     name: document.querySelector("input[name='name']").value,
  //     email: document.querySelector("input[name='email']").value,
  //     phone: document.querySelector("input[name='phone']").value,
  //     message: document.querySelector("textarea[name='message']").value,
  //   };

  //   // Send form data using Fetch API
  //   fetch("/actions/contact_action.php", {
  //     method: "POST",
  //     headers: {
  //       "Content-Type": "application/json",
  //     },
  //     body: JSON.stringify(formData),
  //   })
  //     .then((response) => response.json())
  //     .then((data) => {
  //       if (data.success) {
  //         // Display success message
  //         alert("Message sent successfully!");
  //       } else {
  //         // Display error message
  //         alert("Error: " + data.message);
  //       }
  //     })
  //     .catch((error) => {
  //       console.error("Error:", error);
  //       alert("An error occurred. Please try again later.");
  //     });
  //   alert(
  //     "Thank you for getting in touch with us! We will respond as soon as possible."
  //   );
  //   contactForm.reset(); // Clear the form after submission
  const formData = new FormData(this);

  fetch('/actions/contact_action.php', {
      method: 'POST',
      body: formData
  })
  .then(response => response.json())
  .then(data => {
      if (data.success) {
          alert(data.message);  // Show success message
          document.getElementById('contactForm').reset();  // Reset the form
      } else {
          alert('Error: ' + data.message);  // Show error message
      }
  })
  .catch(error => {
      console.error('Error:', error);
      alert('An error occurred while submitting the form.');
  });
  });
});
