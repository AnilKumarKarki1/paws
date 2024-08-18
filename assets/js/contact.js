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
    alert(
      "Thank you for getting in touch with us! We will respond as soon as possible."
    );
    contactForm.reset(); // Clear the form after submission
  });
});
