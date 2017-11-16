<?php

function student_is_valid($username,$password){
    $is_valid = FALSE;
    $is_ok = is_student_ok($username,$password);
    if($is_ok === TRUE){
       $is_valid = TRUE;
    }
    return $is_valid;
}
