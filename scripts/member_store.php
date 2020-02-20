<?php
if (!class_exists('Members')) {
    require_once '../classes/member_class.php';
    $members = new Members();
}

if (isset($_POST['save'])) {
    $store = $members->store();
    return $store;
}
