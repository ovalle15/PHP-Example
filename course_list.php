<?php
require_once('database.php');
require('./db/courses_db.php');
// '->' is used in object scope to access methods and properties of an object.
// it is meaning is to say that what is on the right of the operator is a
//a member of the object instantiated into the variable on the left side of the
// operator.

// Get all courses
$all_courses = get_all_courses();

// echo 'SESSION COURSES1';
// echo "<pre style='font-family: monospace; font-size: 12px;'>";
// echo var_dump($_SESSION);
// echo '</pre>';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_courses';
    }
}

$_SESSION['all_courses'] = $all_courses;


if (isset($_SESSION['course_id'])){
    $all_courses= get_all_courses();
    $_SESSION['courses'] = $all_courses;
}




?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Course Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>Course Manager</h1></header>
<main>
    <h1>Course List</h1>
    <table>
        <tr>
            <th>ID</th><th>Name</th>
        </tr>

        <!-- add code for the rest of the table here -->
        <?php foreach ($all_courses as $course) : ?>
            <tr>
                <td><?php echo $course['courseID']; ?></td>
                <td><?php echo $course['courseName']; ?></td>
            </tr>
        <?php endforeach ?>
    </table>
    <p>
    <h2>Add Course</h2>

    <form action="add_course.php" method="post"
              id="add_course_form">

        <label>Course Id:</label>
        <input type="text" name="course_id"><br>
        <label>Course Name:</label>
        <input type="text" name="course_name" width="200"><br>

        <label>&nbsp;</label>
        <input type="submit" value="Add Course"><br>

    </form>


    <br>
    <p><a href="index.php">List Students</a></p>

    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Suresh Kalathur</p>
    </footer>
</body>
</html>