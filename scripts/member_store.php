<?php
include_once '../classes/member_class.php';
$member_class = new memberClass();
if (isset($_POST['save'])) {
    $store = $member_class->store();
    return $store;
}
