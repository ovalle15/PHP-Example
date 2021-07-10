<?php
function get_students_by_course($course_id) {
    global $db;
    $query = 'SELECT * FROM sk_students
            WHERE courseID = :course_id
            ORDER BY courseID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':course_id', $course_id);
        $statement->execute();
        $students = $statement->fetchAll();
        $statement->closeCursor();
        return $students;
    } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
    }
}

?>