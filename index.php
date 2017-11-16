<?php
require('model/database.php');
require_once('model/students_db.php');
require('model/teacher_db.php');
require('model/validate_teachers.php');
require('model/validate_students.php');

// Start session
session_start();

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
    if (isset($_SESSION['teacher']) || isset($_SESSION['student'])) {    // Skip login if customer is in the session
            $action = 'home';
        } else {
            $action = 'login';
        }
    }
}

switch ($action) {
    case 'login':
        $username = "";
        $password = "";
        $teacher = "Teacher";
        $student = "Student";
        include('view/login.php');
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
    case 'home':
        // If customer is not in the session, set it in the session
        if (isset($_SESSION['teacher'])) {
            include('teachers/index.php');
            break;
        }else{
            include('students/index.php');
            break;
        }

        $customer = $_SESSION['customer'];
        $products = get_products();
        include('product_register.php');
        break;
     case 'login_valadation':
         //get user input
         $user = filter_input(INPUT_POST, 'user');
         $userpass = filter_input(INPUT_POST, 'password');
         $username = filter_input(INPUT_POST, 'username');
         //get valid users from database
         $students =  get_students();
         $teachers = get_teachers();
          
         //redirect valid user to thier home page
         if($user === 'Teacher'){
            //validate user
            $is_teacher_valid = teacher_is_valid($username,$userpass );
            if($is_teacher_valid === true){
                $_SESSION['teacher'] = get_teacher($username);
                $the_teacher =  $_SESSION['teacher'];
               
                include('teachers/home.php');
                break;
            } else {
                include('view/login.php');
            }
             
         } else {
             //validate user
            $is_student_valid = student_is_valid($username,$userpass);
            if($is_student_valid == true){
                $_SESSION['student'] = get_student($username);
                include('students/home.php');
                break;
            }else{
                include('view/login.php');
            }
             
         }
        
        break;
}
?>