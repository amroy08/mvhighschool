<?php
include "db.php";

// Read form data
$student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
$parent_name  = mysqli_real_escape_string($conn, $_POST['parent_name']);
$class        = mysqli_real_escape_string($conn, $_POST['class']);
$phone        = mysqli_real_escape_string($conn, $_POST['phone']);
$message      = mysqli_real_escape_string($conn, $_POST['message']);

// Insert into database
$query = "INSERT INTO admission_enquiries (student_name, parent_name, class, phone, message)
          VALUES ('$student_name', '$parent_name', '$class', '$phone', '$message')";

if(mysqli_query($conn, $query)){
    echo "<script>
            alert('Admission enquiry submitted successfully.');
            window.location.href='index.php';
          </script>";
} else {
    echo "<script>
            alert('Something went wrong. Try again.');
            window.location.href='index.php';
          </script>";
}
?>
