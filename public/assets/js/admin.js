document.addEventListener("DOMContentLoaded", function () {
  const currentPath = window.location.pathname.split("/").pop();
  const navLinks = {
    pet: document.getElementById("petLink"),
    faq: document.getElementById("faqLink"),
    lead: document.getElementById("leadLink"),
    company: document.getElementById("companyLink"),
    adoption: document.getElementById("adoptionLink"),
  };

  if (navLinks[currentPath]) {
    navLinks[currentPath].classList.add("active");
  }
});