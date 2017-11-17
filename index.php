<?php
require_once('model/database.php');
require_once('model/students_db.php');
require_once('model/teacher_db.php');
require_once('model/validate_teachers.php');
require_once('model/validate_students.php');

// Start session
session_start();
// 10 mins in seconds
$inactive = 10; 

$session_life = time() - $_session['timeout'];

if($session_life > $inactive)
{  session_destroy(); header("Location: logout.php");     }

$_SESSION['timeout']=time();

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
        $error_message = $_SESSION['errors'];
        if(!empty($error_message)){
            $_SESSION['errors'] = '';
        }
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
    case 'end_session':
        include('logout.php');
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
            $is_teacher_valid = teacher_is_valid($username,$userpass);
            if($is_teacher_valid === TRUE){
                $_SESSION['teacher'] = get_teacher($username);
                $the_teacher =  $_SESSION['teacher'];
               
                include('teachers/home.php');
                break;
            }
            else if($is_teacher_valid === FALSE) {
                $_SESSION['errors'] = "Either username and or password is incorrect.";
                include('view/login.php');
                break;
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