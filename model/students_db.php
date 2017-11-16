<?php

function get_students() {
    global $db;
    $query = 'SELECT * FROM students
              ORDER BY lastName';
    $statement = $db->prepare($query);
    $statement->execute();
    $student = $statement->fetchAll();
    $statement->closeCursor();
    return $student;
}
//select a spacific student
function get_student($student_id) {
    global $db;
    $query = 'SELECT * FROM students
              WHERE studentid = :student_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':student_id', $student_id);
    $statement->execute();
    $student = $statement->fetch();
    $statement->closeCursor();
    return $student;
}
//add a student
function add_student($first_name, $last_name, $password) {
    global $db;
    $query = 'INSERT INTO students
                 (firstname, lastname, hashpassword)
              VALUES
                 (:first_name, :last_name, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':first_name', $first_name);
    $statement->bindValue(':last_name', $last_name);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $statement->closeCursor();
}
//validate a student
function is_student_ok($student_id, $password) {
    $is_valid = FALSE;
    global $db;
    $query = 'SELECT * FROM students
              WHERE studentid = :student_id AND hashpassword = :password';
    $statement = $db->prepare($query);
    $statement->bindValue(':student_id', $student_id);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $student = $statement->fetch();
    if(!empty($student)){
        $is_valid = TRUE;
    }
    return $is_valid;
}
?>