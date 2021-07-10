<?php
require('database.php');

require('./db/courses_db.php');

// echo 'SESSION COURSES course list';
// echo "<pre style='font-family: monospace; font-size: 12px;'>";
// echo var_dump($_SESSION);
// echo '</pre>';

if (isset($_SESSION['all_courses'])) {
    $_SESSION['all_courses'] = $courses;
} else {
    session_start();
    $courses = get_all_courses();
    $_SESSION['courses'] = $courses;

}

// echo 'SESSION COURSES course list';
// echo "<pre style='font-family: monospace; font-size: 12px;'>";
// echo var_dump($_SESSION);
// echo '</pre>';

?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Course Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>Course Manager</h1></header>

    <main>
        <h1>Add Student</h1>
        <form action="add_student.php" method="post"
              id="add_student_form">

            <label>Course:</label>
                <select name="course_id">
                    <?php foreach($courses as $course): ?>
                        <option value="<?php echo $course['courseID'];?>">
                            <?php echo $course['courseID']."-".$course['courseName']?>
                        </option>
                    <?php endforeach ?>
                </select><br>


            <label>First Name:</label>
            <input type="text" name="first_name"><br>

            <label>Last Name:</label>
            <input type="text" name="last_name"><br>

            <label>Email:</label>
            <input type="email" name="email"><br>


            <label>&nbsp;</label>
            <input type="submit" value="Add Student"><br>
        </form>
        <p><a href="index.php">View Student List</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Suresh Kalathur.</p>
    </footer>
</body>
</html>