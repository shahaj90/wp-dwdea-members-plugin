<?php
if(!class_exists('Members')) {
    require_once '../classes/member_class.php';
    $members = new Members();
}
?>

<div class="wrap">
    <div id="icon-users" class="icon32"></div>
    <h2>Example List Table Page</h2>
    <?php $members->display();?>
</div>