<?php
include('whitespacefix.php');
require_once('database.php');
require('./db/courses_db.php');
require('./db/students_db.php');

function coursesGet($courses) {

    if (isset($_GET['action']) && isset($_GET['format'])) {

        $format = $_GET['format'];
        $action = $_GET['action'];
        $courses = get_all_courses();

        if ($format == "xml" && $action == "courses") {
            $xml = new SimpleXMLElement('<courses/>');

            foreach($courses as $c){
                $course = $xml->addChild('course');
                $course->addChild('courseID', $c['courseID']);
                $course->addChild('courseName', $c['courseName']);
            }

            Header('Content-type: text/xml');
            print ($xml->asXML());

        } if ($format == "json" && $action == "courses") {
            $Array = array();

            foreach($courses as $c){
                array_push($Array, array_unique($c));
            }
            $arr =  json_encode($Array, JSON_PRETTY_PRINT);

            print '<pre>';
            print_r($arr);
            print '</pre>';

        }
    }
    // else {
    //     print '<pre>';
    //     echo "Incorrect URL";
    //     print '</pre>';
    // }
}

coursesGet($courses);



function studentsGet($students) {
    if (isset($_GET['action']) && isset($_GET['format']) && isset($_GET['course'])) {
        $action = $_GET['action'];
        $format = $_GET['format'];
        $course_id = $_GET['course'];
        $students = get_students_by_course($course_id);
        $courses = get_all_courses();

        foreach($courses as $course){
            $all_courses_id[] = $course['courseID'];
        }

        if ($format == "xml" && $action == "students" && in_array($course_id, $all_courses_id)) {

            $xml = new SimpleXMLElement('<students/>');

            foreach($students as $s){
                $student = $xml->addChild('student');
                $student->addChild('studentID', $s['studentID']);
                $student->addChild('courseID', $s['courseID']);
                $student->addChild('firstName', $s['firstName']);
                $student->addChild('lastName', $s['lastName']);
                $student->addChild('email', $s['email']);
            }
            Header('Content-type: text/xml');
            print ($xml->asXML());

        } if ($format == "json" && $action == 'students' && in_array($course_id, $all_courses_id)) {

            $Array = array();
            foreach($students as $ar){
                array_push($Array, array_unique($ar));
            }
            $arr = json_encode($Array, JSON_PRETTY_PRINT);

            print "<pre>";
            print_r($arr);
            print '</pre>';

        }

    }
}

studentsGet($students);


?>

