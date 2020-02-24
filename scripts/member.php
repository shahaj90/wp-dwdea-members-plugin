<?php

if (!class_exists('Member')) {
    require_once '../includes/class_member.php';
    $member = new Member();
}

if (isset($_POST['save'])) {
    $save = $member->save();
    return $save;
}

if (isset($_POST['update'])) {
    $update = $member->update();
    return $update;
}

if (isset($_POST['delete'])) {
    $delete = $member->delete();
    return $delete;
}
