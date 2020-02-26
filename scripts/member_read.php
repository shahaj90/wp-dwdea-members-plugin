<?php

if (!class_exists('Member')) {
    require_once '../includes/class_member.php';
    $member = new Member();
}


$read = $member->read();
die(json_encode($read));
