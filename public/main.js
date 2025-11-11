document.addEventListener("DOMContentLoaded", function () {
  const toggleButton = document.getElementById("menu-toggle");
  const navList = document.querySelector("nav ul");

  toggleButton.addEventListener("click", function () {
    navList.classList.toggle("show");
  });
});

  // ===== Aktiven Link setzen =====
  const navLinks = document.querySelectorAll("nav a");
  const currentPath = window.location.pathname;

  navLinks.forEach(link => {
    const linkPath = new URL(link.href, window.location.origin).pathname;
    if (linkPath === currentPath) {
      link.classList.add("active");
    } else {
      link.classList.remove("active");
    }
  });