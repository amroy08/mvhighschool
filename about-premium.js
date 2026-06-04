/* ============================================================
   FOUNDER SLIDER
   ============================================================ */

let slides = document.querySelectorAll(".founder-slider .slide");
let dotsContainer = document.getElementById("sliderDots");
let currentIndex = 0;

// Create dots
slides.forEach((_, i) => {
  let dot = document.createElement("div");
  dot.onclick = () => goToSlide(i);
  dotsContainer.appendChild(dot);
});

let dots = dotsContainer.querySelectorAll("div");

function showSlide(index) {
  slides.forEach(s => s.classList.remove("active"));
  dots.forEach(d => d.classList.remove("active-dot"));

  slides[index].classList.add("active");
  dots[index].classList.add("active-dot");
}

function goToSlide(i) {
  currentIndex = i;
  showSlide(i);
}

function autoSlide() {
  currentIndex = (currentIndex + 1) % slides.length;
  showSlide(currentIndex);
}

setInterval(autoSlide, 5000); // 5 sec slide

showSlide(0);

/* ============================================================
   SCROLL ANIMATIONS
   ============================================================ */

const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) entry.target.classList.add("fade-visible");
  });
}, { threshold: 0.2 });

document.querySelectorAll(".fade-up, .fade-left, .fade-right").forEach(el => {
  observer.observe(el);
});
