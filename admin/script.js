// ---------- NAVBAR MENU & FOOTER YEAR ----------
const menuBtn = document.querySelector('.menu-btn');
const links = document.querySelector('.navlinks');
if (menuBtn && links) {
  menuBtn.addEventListener('click', () => links.classList.toggle('show'));
}

const yearEl = document.getElementById('year');
if (yearEl) yearEl.textContent = new Date().getFullYear();


// ====================================================
// ===============  DYNAMIC GALLERY  ==================
// ====================================================

document.addEventListener('DOMContentLoaded', () => {
  const activityList = document.getElementById('activity-list');
  const photoGallery = document.getElementById('photo-gallery');
  const galleryTitle = document.getElementById('gallery-title');
  const galleryDesc = document.getElementById('gallery-description');

  // Only run if we are on the Gallery page
  if (!activityList) return;

  // Sports and activities data
  const activities = {
    Football: ['football1.jpg', 'football2.jpg', 'football3.jpg', 'football4.jpg'],
    Kabaddi: ['kabaddi1.jpg', 'kabaddi2.jpg', 'kabaddi3.jpg'],
    Cricket: ['cricket1.jpg', 'cricket2.jpg', 'cricket3.jpg', 'cricket4.jpg'],
    Chess: ['chess1.jpg', 'chess2.jpg'],
    Carrom: ['carrom1.jpg', 'carrom2.jpg'],
    'Table Tennis': ['tt1.jpg', 'tt2.jpg', 'tt3.jpg'],
    'Rifle Shooting': ['rifle1.jpg', 'rifle2.jpg'],
    Yoga: ['yoga1.jpg', 'yoga2.jpg', 'yoga3.jpg'],
    Badminton: ['badminton1.jpg', 'badminton2.jpg', 'badminton3.jpg'],
    'Various Activities': ['other1.jpg', 'other2.jpg', 'other3.jpg']
  };

  // Step 1: Generate clickable activity tiles
  Object.keys(activities).forEach(activity => {
    const div = document.createElement('div');
    div.classList.add('activity-card');
    div.innerHTML = `
      <img src="assets/gallery-${activity.toLowerCase().replace(/\s+/g, '-')}.jpg" alt="${activity}">
      <span>${activity}</span>
    `;
    div.addEventListener('click', () => showGallery(activity));
    activityList.appendChild(div);
  });

  // Step 2: Show gallery of selected activity
  function showGallery(activity) {
    activityList.style.display = 'none';
    photoGallery.style.display = 'grid';
    galleryTitle.textContent = `${activity} Gallery`;
    galleryDesc.textContent = `Photos from our ${activity.toLowerCase()} sessions and events.`;

    photoGallery.innerHTML = ''; // Clear previous
    activities[activity].forEach(img => {
      const image = document.createElement('img');
      image.src = `assets/${img}`;
      image.alt = activity;
      photoGallery.appendChild(image);
    });

    // Add Back button
    const backBtn = document.createElement('button');
    backBtn.textContent = '← Back to All Activities';
    backBtn.className = 'btn ghost';
    backBtn.style.marginTop = '20px';
    backBtn.onclick = () => {
      photoGallery.style.display = 'none';
      activityList.style.display = 'grid';
      galleryTitle.textContent = 'Sports & Activities Gallery';
      galleryDesc.textContent = 'Click an activity below to explore photos from our school programs.';
    };
    photoGallery.appendChild(backBtn);
  }
});


// ====================================================
// ===============  DYNAMIC ACADEMICS  ================
// ====================================================

document.addEventListener('DOMContentLoaded', () => {
  const levelList = document.getElementById("level-list");
  if (!levelList) return; // only run on Academics page

  const gradeList = document.getElementById("grade-list");
  const bookDetails = document.getElementById("book-details");
  const title = document.getElementById("academics-title");
  const desc = document.getElementById("academics-desc");

  // Academic data
  const academics = {
    "Primary (I–IV)": {
      grades: {
        "Grade I": [
          { subject: "English", book: "My First Words", publisher: "Oxford" },
          { subject: "Mathematics", book: "Fun with Numbers 1", publisher: "NCERT" },
          { subject: "EVS", book: "Our Surroundings", publisher: "Pearson" }
        ],
        "Grade II": [
          { subject: "English", book: "Tiny Tales 2", publisher: "Oxford" },
          { subject: "Mathematics", book: "Play with Numbers 2", publisher: "NCERT" },
          { subject: "EVS", book: "Our World", publisher: "Pearson" }
        ],
        "Grade III": [
          { subject: "English", book: "Reading Ladder 3", publisher: "Oxford" },
          { subject: "Mathematics", book: "Maths in Life 3", publisher: "NCERT" },
          { subject: "EVS", book: "Discover Nature", publisher: "Pearson" }
        ],
        "Grade IV": [
          { subject: "English", book: "New English Quest 4", publisher: "Oxford" },
          { subject: "Mathematics", book: "Numbers & Patterns 4", publisher: "NCERT" },
          { subject: "EVS", book: "Environmental Wonders", publisher: "Pearson" }
        ]
      }
    },
    "Secondary (V–X)": {
      grades: {
        "Grade V": [
          { subject: "English", book: "Advanced English 5", publisher: "Oxford" },
          { subject: "Science", book: "Science Spark 5", publisher: "NCERT" }
        ],
        "Grade VI": [
          { subject: "English", book: "Literary Path 6", publisher: "Oxford" },
          { subject: "Mathematics", book: "NCERT Maths 6", publisher: "NCERT" }
        ],
        "Grade VII": [
          { subject: "English", book: "Wings of Words 7", publisher: "Oxford" },
          { subject: "Science", book: "NCERT Science 7", publisher: "NCERT" }
        ],
        "Grade VIII": [
          { subject: "English", book: "Communicate with English 8", publisher: "Oxford" },
          { subject: "Science", book: "Concepts of Science 8", publisher: "NCERT" }
        ],
        "Grade IX": [
          { subject: "English", book: "Beehive", publisher: "NCERT" },
          { subject: "Science", book: "Science Textbook IX", publisher: "NCERT" }
        ],
        "Grade X": [
          { subject: "English", book: "First Flight", publisher: "NCERT" },
          { subject: "Science", book: "Science Textbook X", publisher: "NCERT" }
        ]
      }
    }
  };

  // Step 1: Generate main level cards
  Object.keys(academics).forEach(level => {
    const div = document.createElement("article");
    div.className = "card clickable";
    div.innerHTML = `<h3>${level}</h3><p>Click to view grades & curriculum</p>`;
    div.onclick = () => showGrades(level);
    levelList.appendChild(div);
  });

  function showGrades(level) {
    levelList.style.display = "none";
    gradeList.style.display = "grid";
    bookDetails.style.display = "none";
    title.textContent = level;
    desc.textContent = "Select a grade to view detailed book information.";

    gradeList.innerHTML = "";
    Object.keys(academics[level].grades).forEach(grade => {
      const div = document.createElement("article");
      div.className = "card clickable";
      div.innerHTML = `<h3>${grade}</h3><p>View subjects & textbooks</p>`;
      div.onclick = () => showBooks(level, grade);
      gradeList.appendChild(div);
    });

    const backBtn = document.createElement("button");
    backBtn.textContent = "← Back to Levels";
    backBtn.className = "btn ghost";
    backBtn.style.marginTop = "20px";
    backBtn.onclick = () => {
      gradeList.style.display = "none";
      levelList.style.display = "grid";
      title.textContent = "Academic Programs";
      desc.textContent = "Curriculum designed for strong foundations and future readiness.";
    };
    gradeList.appendChild(backBtn);
  }

  function showBooks(level, grade) {
    gradeList.style.display = "none";
    bookDetails.style.display = "block";
    title.textContent = grade;
    desc.textContent = "Below are the textbooks followed for this grade.";

    const books = academics[level].grades[grade];
    let table = `
    <table class="table">
      <thead><tr><th>Subject</th><th>Book Name</th><th>Publisher</th></tr></thead>
      <tbody>
        ${books.map(b => `<tr><td>${b.subject}</td><td>${b.book}</td><td>${b.publisher}</td></tr>`).join("")}
      </tbody>
    </table>
    `;

    bookDetails.innerHTML = table;

    const backBtn = document.createElement("button");
    backBtn.textContent = "← Back to Grades";
    backBtn.className = "btn ghost";
    backBtn.style.marginTop = "20px";
    backBtn.onclick = () => {
      bookDetails.style.display = "none";
      gradeList.style.display = "grid";
      title.textContent = level;
      desc.textContent = "Select a grade to view detailed book information.";
    };
    bookDetails.appendChild(backBtn);
  }
});


// ====================================================
// ===============  ADMISSION POPUP ====================
// ====================================================

document.addEventListener('DOMContentLoaded', () => {
  const popup = document.getElementById('admission-popup');
  const closeBtn = document.querySelector('.popup-close');
  const form = document.getElementById('admission-form');

  if (!popup) return;

  // Show popup 1.5 seconds after page load (only once per session)
  if (!sessionStorage.getItem('popupShown')) {
    setTimeout(() => {
      popup.style.display = 'flex';
      sessionStorage.setItem('popupShown', 'true');
    }, 1500);
  }

  // Close button
  closeBtn.addEventListener('click', () => {
    popup.style.display = 'none';
  });

  // Close popup when clicking outside the box
  popup.addEventListener('click', (e) => {
    if (e.target === popup) popup.style.display = 'none';
  });

  // Submit form
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    alert('Thank you! Your admission enquiry has been submitted.');
    popup.style.display = 'none';
  });
});


// ---------- Hero Image Slider (Auto + Manual) ----------
const heroImages = [
  'assets/hero1.jpeg',
  'assets/hero2.jpeg',
  'assets/hero3.jpeg',
  'assets/hero4.jpeg'
];

let currentHero = 0;
let slideInterval;
const heroImg = document.getElementById('hero-image');
const prevBtn = document.querySelector('.slider-btn.prev');
const nextBtn = document.querySelector('.slider-btn.next');

function showImage(index) {
  if (!heroImg) return;
  heroImg.style.opacity = 0;
  setTimeout(() => {
    heroImg.src = heroImages[index];
    heroImg.style.opacity = 1;
  }, 400);
}

function nextImage() {
  currentHero = (currentHero + 1) % heroImages.length;
  showImage(currentHero);
}

function prevImage() {
  currentHero = (currentHero - 1 + heroImages.length) % heroImages.length;
  showImage(currentHero);
}

// Auto change every 4 s
function startSlider() {
  slideInterval = setInterval(nextImage, 4000);
}
function stopSlider() {
  clearInterval(slideInterval);
}

// Attach events
if (nextBtn && prevBtn) {
  nextBtn.addEventListener('click', () => {
    stopSlider();
    nextImage();
    startSlider();
  });
  prevBtn.addEventListener('click', () => {
    stopSlider();
    prevImage();
    startSlider();
  });
}

startSlider(); // Start auto rotation


// ---------- Dynamic Circular Loader ----------
const circulars = {
  "childrens-day": {
    title: "Children’s Day Celebration",
    date: "November 14, 2025",
    venue: "Auditorium",
    content: `
      <p>Dear Students and Parents,</p>
      <p>We are delighted to announce our annual <strong>Children’s Day Celebration</strong> filled with performances, games, and fun activities to celebrate the joy of childhood.</p>
      <ul>
        <li>Fancy Dress Competition (Grades I–IV)</li>
        <li>Talent Show (Grades V–X)</li>
        <li>Special Address by our Principal</li>
      </ul>
      <p>We look forward to your enthusiastic participation!</p>
      <p style="margin-top:20px;">Warm regards,<br><strong>Principal, M.V. High School</strong></p>
    `
  },
  "sports-day": {
    title: "Annual Sports Day",
    date: "December 10, 2025",
    venue: "Main Ground",
    content: `
      <p>Our much-awaited <strong>Annual Sports Day</strong> will feature exciting inter-house competitions and cultural displays. Parents are invited to witness the grand opening ceremony.</p>
      <ul>
        <li>Chief Guest: [Guest Name]</li>
        <li>Events: Races, Tug of War, Gymnastics, Yoga Display</li>
      </ul>
      <p>Let’s celebrate teamwork, energy, and sportsmanship!</p>
    `
  },
  "science-exhibition": {
    title: "Science Exhibition",
    date: "January 18, 2026",
    venue: "Lab Complex",
    content: `
      <p>Join us for our annual <strong>Science Exhibition</strong> where students will present innovative models and experiments on sustainability and technology.</p>
      <p>Parents and guests are encouraged to visit and interact with young scientists.</p>
    `
  },
  "marathon": {
    title: "Marathon Certificates Ready",
    date: "November 16, 2025",
    venue: "School Office",
    content: `
      <p>Participants of the recent <strong>MVHS Marathon</strong> can now collect their certificates from the school office during school hours.</p>
    `
  },
  "winter-break": {
    title: "Winter Break Schedule",
    date: "Dec 20 – Jan 2",
    venue: "All Grades",
    content: `
      <p>The school will remain closed for <strong>Winter Break</strong> from December 20 to January 2. Classes will resume on <strong>January 3, 2026</strong>.</p>
      <p>We wish everyone a joyful and safe vacation!</p>
    `
  },
  "science-fair": {
    title: "State-Level Science Fair Winners",
    date: "November 2025",
    venue: "Nagpur",
    content: `
      <p>Congratulations to our brilliant students for their remarkable performance in the <strong>State-Level Science Fair</strong>:</p>
      <ul>
        <li>3 Gold Medals</li>
        <li>2 Silver Medals</li>
      </ul>
      <p>We are proud of your innovation and hard work!</p>
    `
  }
};

// Display circular data if on circular.html
const circularContainer = document.getElementById('circular-content');
if (circularContainer) {
  const params = new URLSearchParams(window.location.search);
  const id = params.get('id');
  const data = circulars[id];

  if (data) {
    circularContainer.innerHTML = `
      <h2>${data.title}</h2>
      <p><strong>Date:</strong> ${data.date}</p>
      <p><strong>Venue:</strong> ${data.venue}</p>
      <div class="circular-box">${data.content}</div>
    `;
  } else {
    circularContainer.innerHTML = `
      <h2>Notice Not Found</h2>
      <p>Sorry, this circular could not be found. Please check back later.</p>
    `;
  }
}



function openAccomplishment(id) {
  window.location.href = `accomplishment-details.html?id=${id}`;
}


// ---------------------- Search Function ----------------------
document.getElementById("searchBox").addEventListener("keyup", function () {
  let filter = this.value.toLowerCase();
  let rows = document.querySelectorAll(".table tbody tr");

  rows.forEach(row => {
    let text = row.innerText.toLowerCase();
    row.style.display = text.includes(filter) ? "" : "none";
  });
});

// ---------------------- Month Filter ----------------------
document.getElementById("monthFilter").addEventListener("change", function () {
  let month = this.value;
  let rows = document.querySelectorAll(".table tbody tr");

  rows.forEach(row => {
    let rowMonth = row.children[0].innerText.split(" ")[0];
    row.style.display = (month === "" || month === rowMonth) ? "" : "none";
  });
});

// ---------------------- Auto Year Update ----------------------
const year = new Date().getFullYear();
document.querySelector("h2").innerHTML = `Monthly Activities Calendar <span style="color:#2563eb;">(${year})</span>`;

// ---------------------- Export to PDF ----------------------
function exportPDF() {
  const element = document.querySelector(".table");

  const opt = {
    margin:       0.5,
    filename:     `School_Yearly_Planner_${year}.pdf`,
    image:        { type: 'jpeg', quality: 1 },
    html2canvas:  { scale: 2 },
    jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
  };

  html2pdf().from(element).set(opt).save();
}
