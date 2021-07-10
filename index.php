<?php
require_once('database.php');

require('./db/courses_db.php');

require('./db/students_db.php');

$courses = get_all_courses();

// echo 'SESSION COURSES1';
// echo "<pre style='font-family: monospace; font-size: 12px;'>";
// echo var_dump($courses);
// echo '</pre>';


foreach($courses as $c){
    if($c['courseID'] == $course_id){
        $label_course_id = $c['courseID'];
        $label_course_name = $c['courseName'];
    }
}

// echo 'SESSION COURSES1';
// echo "<pre style='font-family: monospace; font-size: 12px;'>";
// echo var_dump($courses);
// echo '</pre>';
if (isset($_SESSION['course_id'])) {

    $students_course = get_students_by_course($course_id);


}

$_SESSION['courses'] = $courses;

if (!$_SESSION['courses'] == NULL){
    foreach($courses as $c){
        if($c['courseID'] == $_SESSION['course_id']){
            $label_course_id = $c['courseID'];
            $label_course_name = $c['courseName'];
        }
    }
}


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL && !isset($_SESSION['course_id'])) {

        $action = 'view_course';

    }
}

if ($action == 'view_course') {

    if (isset($_SESSION['course_id']) && is_string($_SESSION['course_id'])) {
        $course_id = $_SESSION['course_id'];
    } else {
        $course_id = filter_input(INPUT_GET, 'course_id');

        if($course_id == NULL || $course_id == FALSE) {
            $course_id = 1;
        }
        if (!isset($_SESSION['course_id'])) {
            session_start();
            $_SESSION['course_id'] = $course_id;

        }

    }

    $students_course = get_students_by_course($course_id);

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
    <center><h1>Student List</h1></center>

    <aside>
        <!-- display a list of courses-->
        <h2>Courses</h2>
        <nav>
            <ul>
                <?php foreach ($courses as $course): ?>
                    <li>

                        <a href="/index.php?action=view_course&amp;course_id=<?php
                            echo $course['courseID'];?>">

                            <?php echo $course['courseID'];?>
                        </a>
                    </li>
                <?php endforeach?>
            </ul>
        </nav>
    </aside>

    <section>
        <!-- display a table of Students -->
        <h2> <?php echo $label_course_id."-".$label_course_name?></h2>
        <table>
            <tr>
                <th>First Name</th>

                <th>Last Name</th>

                <th>Email</th>

                <th>&nbsp;</th>
            </tr>
        <?php foreach ($students_course as $student):?>
            <tr>
                <td><?php echo $student['firstName']; ?></td>
                <td><?php echo $student['lastName']; ?></td>
                <td><?php echo $student['email']; ?></td>
                <td><form action="delete_student.php" method="post">
                    <input type="hidden" name="course_id"
                        value="<?php echo $_SESSION['course_id'] ?>">
                    <input type="hidden" name="student_id"
                        value="<?php echo $student['studentID']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
        <?php endforeach?>


        </table>

        <p><a href="add_student_form.php">Add Student</a></p>

        <p><a href="course_list.php">List Courses</a></p>

    </section>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Suresh Kalathur</p>
</footer>
</body>
</html>