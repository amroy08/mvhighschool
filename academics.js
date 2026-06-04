// // Show list of grades for selected level
// function showGrades(levelId, levelName) {
//     document.getElementById("grade-list").innerHTML = "";
//     document.getElementById("grade-list").style.display = "grid";
//     document.getElementById("book-details").style.display = "none";

//     fetch("load-grades.php?level_id=" + levelId)
//         .then(res => res.json())
//         .then(data => {
//             let html = "";
//             data.forEach(g => {
//                 html += `
//                     <article class="card grade-card" onclick="showBooks(${g.id}, '${g.grade_name}')">
//                         <h3>${g.grade_name}</h3>
//                     </article>
//                 `;
//             });

//             document.getElementById("grade-list").innerHTML = html;
//         });
// }

// // Show books table for grade
// function showBooks(gradeId, gradeName) {
//     fetch("load-books.php?grade_id=" + gradeId)
//         .then(res => res.json())
//         .then(data => {
//             let table = `
//                 <h2>${gradeName}</h2>
//                 <table class="table">
//                   <thead>
//                     <tr>
//                       <th>Subject</th>
//                       <th>Book</th>
//                       <th>Publisher</th>
//                     </tr>
//                   </thead>
//                   <tbody>
//             `;

//             data.forEach(book => {
//                 table += `
//                     <tr>
//                         <td>${book.subject}</td>
//                         <td>${book.book_name}</td>
//                         <td>${book.publisher}</td>
//                     </tr>
//                 `;
//             });

//             table += "</tbody></table>";

//             document.getElementById("book-details").innerHTML = table;
//             document.getElementById("book-details").style.display = "block";
//         });
// }


// ===============================
// ACADEMICS PAGE – CLEAN UX FLOW
// ===============================

function showGrades(levelId, levelName) {
  const gradeList = document.getElementById("grade-list");
  const bookDetails = document.getElementById("book-details");

  gradeList.innerHTML = "";
  gradeList.style.display = "block";
  bookDetails.style.display = "none";

  // Section title
  gradeList.innerHTML = `
    <h2 style="margin-top:30px;">
      ${levelName} – Grades & Curriculum
    </h2>
  `;

  fetch("load-grades.php?level_id=" + levelId)
    .then(res => res.json())
    .then(grades => {
      if (grades.length === 0) {
        gradeList.innerHTML += `<p>No grades available.</p>`;
        return;
      }

      grades.forEach(grade => {
        gradeList.innerHTML += `
          <div class="ac-grade" id="grade-${grade.id}">
            <div class="ac-grade-header" onclick="toggleGrade(${grade.id}, '${grade.grade_name}')">
              ${grade.grade_name}
              <span>View Books</span>
            </div>
            <div class="ac-grade-body" id="grade-body-${grade.id}">
              <p class="empty-books">Loading books...</p>
            </div>
          </div>
        `;
      });
    });
}


// Accordion toggle + load books
function toggleGrade(gradeId, gradeName) {

  // Close other open grades
  document.querySelectorAll(".ac-grade").forEach(g => {
    if (g.id !== `grade-${gradeId}`) {
      g.classList.remove("active");
    }
  });

  const gradeBox = document.getElementById(`grade-${gradeId}`);
  const body = document.getElementById(`grade-body-${gradeId}`);

  // Toggle current
  const isOpen = gradeBox.classList.contains("active");
  gradeBox.classList.toggle("active");

  if (isOpen) return;

  // Load books only when opened
  fetch("load-books.php?grade_id=" + gradeId)
    .then(res => res.json())
    .then(books => {
      if (books.length === 0) {
        body.innerHTML = `<p class="empty-books">Books will be updated soon.</p>`;
        return;
      }

      let table = `
        <table class="table">
          <thead>
            <tr>
              <th>Subject</th>
              <th>Book</th>
              <th>Publisher</th>
            </tr>
          </thead>
          <tbody>
      `;

      books.forEach(book => {
        table += `
          <tr>
            <td>${book.subject}</td>
            <td>${book.book_name}</td>
            <td>${book.publisher}</td>
          </tr>
        `;
      });

      table += `</tbody></table>`;
      body.innerHTML = table;
    });
}
