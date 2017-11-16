<?php

function teacher_is_valid($username,$password){
    $is_valid = FALSE;
    $is_ok = is_teacher_ok($username,$password);
    if($is_ok === TRUE){
       $is_valid = TRUE;
    }
    return $is_valid;
}
