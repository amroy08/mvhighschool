// document.addEventListener("DOMContentLoaded", () => {
//     fetch("header.php")
//       .then(response => response.text())
//       .then(data => {
//           // Load the header HTML
//           document.querySelector("header").innerHTML = data;

//           // ⭐ Highlight Active Link
//           const current = location.pathname.split("/").pop();
//           document.querySelectorAll(".navlinks a").forEach(link => {
//               if (link.getAttribute("href") === current) {
//                   link.classList.add("active-link");
//               }
//           });

//           // ⭐ MOBILE MENU TOGGLE (must run AFTER header loads)
//           const toggleBtn = document.getElementById("menuToggle");
//           const navLinks = document.getElementById("navLinks");

//           if (toggleBtn) {
//               toggleBtn.addEventListener("click", () => {
//                   navLinks.classList.toggle("show");
//               });
//           }
//       });
// });


document.addEventListener("DOMContentLoaded", () => {
  fetch("premium-header.php")
    .then(res => res.text())
    .then(html => {
      document.querySelector("header").innerHTML = html;

      const current = location.pathname.split("/").pop();

      document.querySelectorAll(".nav-link, .nav-btn").forEach(link => {
        if (link.getAttribute("href") === current) {
          link.classList.add("active");
        }
      });

      const burger = document.querySelector(".hamburger");
      const menu = document.getElementById("mobileMenu");

      burger?.addEventListener("click", () => {
        menu.classList.toggle("show-menu");
        burger.classList.toggle("active");
      });
    });
});
