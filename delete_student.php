<?php
require_once('database.php');

// Delete the student from the database
$course_id = filter_input(INPUT_POST, 'course_id');
$student_id = filter_input(INPUT_POST, 'student_id');


if($student_id != false) {
    $query = 'DELETE FROM sk_students WHERE studentID = :student_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':student_id', $student_id);
    $success = $statement->execute();
    $statement->closeCursor();
}

// Display the Home page

$_SESSION['course_id'] = $course_id;


include('index.php');
