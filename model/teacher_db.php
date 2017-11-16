<?php
//select all teachers
function get_teachers() {
    global $db;
    $query = 'SELECT * FROM teachers
              ORDER BY lastName';
    $statement = $db->prepare($query);
    $statement->execute();
    $teacher = $statement->fetchAll();
    $statement->closeCursor();
    return $teacher;
}
//select a spacific teacher
function get_teacher($teacher_id) {
    global $db;
    $query = 'SELECT * FROM teachers
              WHERE teacherid = :teacher_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':teacher_id', $teacher_id);
    $statement->execute();
    $teacher = $statement->fetch();
    $statement->closeCursor();
    return $teacher;
}
//add a teacher
function add_teacher($first_name, $last_name, $password) {
    global $db;
    $query = 'INSERT INTO teachers
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

//validate a teacher
function is_teacher_ok($teacher_id, $password) {
    $is_valid = FALSE;
    global $db;
    $query = 'SELECT * FROM teachers
              WHERE teacherid = :teacher_id AND hashpassword = :password';
    $statement = $db->prepare($query);
    $statement->bindValue(':teacher_id', $teacher_id);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $teacher = $statement->fetch();
    $statement->closeCursor();
    if($teacher != NULL){
        $is_valid = TRUE;
    }
    return $is_valid;
}
?>