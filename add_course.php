<?php


// Get the course form data
$course_name = filter_input(INPUT_POST, 'course_name');
$course_id = filter_input(INPUT_POST, 'course_id');

if($course_id == NULL || $course_id == FALSE || $course_name == NULL || $course_name == FALSE) {
    $error = "Invalid input";
    include('error.php');
} else {
    require('database.php');
    $query = 'INSERT INTO sk_courses (courseID, courseName)
    VALUES
    (:course_id, :course_name)';

    $statement = $db->prepare($query);
    $statement->bindValue(':course_id', $course_id);
    $statement->bindValue(':course_name', $course_name);
    $statement->execute();
    $statement->closeCursor();


    $_SESSION['course_id'] = $course_id;
    include('course_list.php');

}

?>