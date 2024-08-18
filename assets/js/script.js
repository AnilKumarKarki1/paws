document.querySelectorAll(".faq ul li").forEach(function (item) {
  item.addEventListener("click", function () {
    alert("FAQ item clicked: " + item.textContent);
  });
});
document.addEventListener("DOMContentLoaded", function () {
  const subscribeForm = document.getElementById("subscribeForm");


  subscribeForm.addEventListener("submit", function (event) {
    event.preventDefault();
    alert("Thank you for subscribing! You will receive our latest updates.");
    subscribeForm.reset(); 
  });


  const currentPath = window.location.pathname.split("/").pop();

  const navLinks = {
    "index.html": document.getElementById("homeLink"),
    "about.html": document.getElementById("aboutLink"),
    "adopt.html": document.getElementById("adoptLink"),
    "contact.html": document.getElementById("contactLink"),
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
