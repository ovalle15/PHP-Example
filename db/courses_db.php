<?php

function get_all_courses () {
    global $db;
    // echo "<pre style='font-family: monospace; font-size: 12px;'>";
    // echo var_dump($db);
    // echo '</pre>';
    $query = 'SELECT * FROM sk_courses ORDER BY courseID';
    // echo "<pre style='font-family: monospace; font-size: 12px;'>";
    // echo var_dump($query);
    // echo '</pre>';
    $statement = $db->prepare($query);
    // echo "<pre style='font-family: monospace; font-size: 12px;'>";
    // echo var_dump($statement);
    // echo '</pre>';
    $statement->execute();
    $courses = $statement->fetchAll();
    // echo "<pre style='font-family: monospace; font-size: 12px;'>";
    // echo var_dump($courses);
    // echo '</pre>';
    $statement->closeCursor();
    return $courses;

}

?>