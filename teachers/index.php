<?php


$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
    if (isset($_SESSION['teacher'])) {    // Skip login if customer is in the session
            $action = 'dashboard';
        }
    }
}
$message = '';
switch ($action) {
    case 'search_students':
        $studentid = '';
        if(empty($message)){
            $message = '';
        }
        include('add_students.php');
        break;
    case 'add_student':
        require_once('../model/students_db.php');
        $studentID = filter_input(INPUT_POST, 'studentid');
        $is_valid = get_student($studentID);
        if(empty($is_valid)){
            $message = "No student found";
        }else{
            $students = get_student($studentID);
            include('add_students.php');
            break;
        }
        include('add_students.php');
        break;
    case 'logout':
            $_SESSION['teacher'] = array();
            session_destroy();
            $userName = '';
            $password = '';
            $teacher = "Teacher";
            $student = "Student";
            include ('./View/login.php');
            break;
    case 'dashboard':
        include('teachers/home.php');
        break;
     
}
?>