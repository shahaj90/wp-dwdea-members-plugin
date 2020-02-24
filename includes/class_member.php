<?php

if (!defined('ABSPATH')) {
    $path = preg_replace('/wp-content.*$/', '', __DIR__);
    require_once $path . 'wp-load.php';
}

require_once '../vendor/autoload.php';

use Rakit\Validation\Validator;

class Member extends WP_List_Table
{
    public function save()
    {
        $validator  = new Validator;
        $validation = $validator->validate($_POST + $_FILES, [
            'name'   => 'required',
            'f_name' => 'required',
            'mobile' => 'required',
            'status' => 'required',
        ]);

        if ($validation->fails()) {
            $errors              = $validation->errors();
            $_SESSION['message'] = "<div id='message' class='error notice is-dismissible'>
            <p>{$errors->all()[0]}</p></div>";
            wp_redirect(admin_url('admin.php?page=new-member'), 302);
            exit;
        }

        global $wpdb;
        $table = $wpdb->prefix . 'dwdea_members';
        $data  = [
            'name'        => $_POST['name'],
            'father_name' => $_POST['f_name'],
            'mobile'      => $_POST['mobile'],
            'status'      => $_POST['status'],
            'description' => (!empty($_POST['comments']) ? $_POST['comments'] : null),
            'created_by'  => get_current_user_id(),
            'created_at'  => date('Y-m-d H:i:s'),
        ];

        $wpdb->insert($table, $data);
        if (empty($wpdb->insert_id)) {
            $_SESSION['message'] = '<div id="message" class="error notice is-dismissible">
            <p>Member save failed.</p></div>';
            wp_redirect(admin_url('admin.php?page=new-member'), 302);
            exit;
        }

        //Success
        $_SESSION['message'] = '<div id="message" class="updated notice is-dismissible">
        <p>Member save successfully.</p></div>';
        wp_redirect(admin_url('admin.php?page=new-member'), 302);
        exit;
    }

    public function update()
    {
        $validator  = new Validator;
        $validation = $validator->validate($_POST + $_FILES, [
            'name'   => 'required',
            'f_name' => 'required',
            'mobile' => 'required',
            'status' => 'required',
        ]);

        if ($validation->fails()) {
            $errors              = $validation->errors();
            $_SESSION['message'] = "<div id='message' class='error notice is-dismissible'>
            <p>{$errors->all()[0]}</p></div>";
            wp_redirect(admin_url('admin.php?page=member-list'), 302);
            exit;
        }

        global $wpdb;
        $table = $wpdb->prefix . 'dwdea_members';
        $data  = [
            'name'        => $_POST['name'],
            'father_name' => $_POST['f_name'],
            'mobile'      => $_POST['mobile'],
            'status'      => $_POST['status'],
            'description' => (!empty($_POST['comments']) ? $_POST['comments'] : null),
            'updated_by'  => get_current_user_id(),
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        $update = $wpdb->update($table, $data, array('id' => $_POST['id']));
        if ($update < 1) {
            $_SESSION['message'] = '<div id="message" class="error notice is-dismissible">
            <p>Member update failed.</p></div>';
            wp_redirect(admin_url("admin.php?page=member-list&action=edit&id={$_POST['id']}"), 302);
            exit;
        }

        //Success
        $_SESSION['message'] = '<div id="message" class="updated notice is-dismissible">
        <p>Member update successfully.</p></div>';
        wp_redirect(admin_url('admin.php?page=member-list'), 302);
        exit;
    }

}
