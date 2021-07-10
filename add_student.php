<?php
    session_destroy();
    $first_name = filter_input(INPUT_POST, 'first_name');
    $last_name= filter_input(INPUT_POST, 'last_name');
    $email = filter_input(INPUT_POST, 'email');
    $course_id= filter_input(INPUT_POST, 'course_id');

    if($first_name == NULL ||
    $first_name== FALSE ||
    $last_name == NULL ||
    $last_name == FALSE ||
    $course_id == NULL ||
    $course_id == FALSE) {
        $error = "Invalid input";
        include('error.php');
    } else {
        require_once('database.php');
        $query = 'INSERT INTO sk_students (courseID, firstName, lastName, email)
        VALUES
        (:course_id, :first_name, :last_name, :email)';

        $statement = $db->prepare($query);
        $statement->bindValue(':course_id', $course_id);
        $statement->bindValue(':first_name', $first_name);
        $statement->bindValue(':last_name', $last_name);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $statement->closeCursor();


        $_SESSION['course_id'] = $course_id;

        include('index.php');


    }
?>

