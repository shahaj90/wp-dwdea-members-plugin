<?php

class Members
{
    public function __construct()
    {
        require_once '../../../../wp-load.php';
    }

    public function store()
    {
        // Validation
        if (empty($_POST['name'])) {
            $_SESSION['message'] = '<div id="message" class="error notice is-dismissible"><p>Name is required.</p></div>';
            wp_redirect(admin_url('admin.php?page=new-dwdea-members'), 302);
            exit;
        }

        if (empty($_POST['f_name'])) {
            $_SESSION['message'] = '<div id="message" class="error notice is-dismissible"><p>Father name is required.</p></div>';
            wp_redirect(admin_url('admin.php?page=new-dwdea-members'), 302);
            exit;
        }

        if (empty($_POST['mobile'])) {
            $_SESSION['message'] = '<div id="message" class="error notice is-dismissible"><p>Mobile is required.</p></div>';
            wp_redirect(admin_url('admin.php?page=new-dwdea-members'), 302);
            exit;
        }

        if (empty($_POST['status'])) {
            $_SESSION['message'] = '<div id="message" class="error notice is-dismissible"><p>status is required.</p></div>';
            wp_redirect(admin_url('admin.php?page=new-dwdea-members'), 302);
            exit;
        }

        //Save
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

        $wpdb->insert($table, $data, null);
        if (empty($wpdb->insert_id)) {
            $_SESSION['message'] = '<div id="message" class="error notice is-dismissible"><p>Member save failed.</p></div>';
            wp_redirect(admin_url('admin.php?page=new-dwdea-members'), 302);
            exit;
        }

        //Success
        $_SESSION['message'] = '<div id="message" class="updated notice is-dismissible"><p>Member save successfully.</p></div>';
        wp_redirect(admin_url('admin.php?page=new-dwdea-members'), 302);
        exit;
    }

    public function update()
    {
        // Validation
        if (empty($_POST['name'])) {
            $_SESSION['message'] = '<div id="message" class="error notice is-dismissible"><p>Name is required.</p></div>';
            wp_redirect(admin_url("admin.php?page=dwdea-members-list&action=edit&id={$_POST['id']}"), 302);
            exit;
        }

        if (empty($_POST['f_name'])) {
            $_SESSION['message'] = '<div id="message" class="error notice is-dismissible"><p>Father name is required.</p></div>';
            wp_redirect(admin_url("admin.php?page=dwdea-members-list&action=edit&id={$_POST['id']}"), 302);
            exit;
        }

        if (empty($_POST['mobile'])) {
            $_SESSION['message'] = '<div id="message" class="error notice is-dismissible"><p>Mobile is required.</p></div>';
            wp_redirect(admin_url("admin.php?page=dwdea-members-list&action=edit&id={$_POST['id']}"), 302);
            exit;
        }

        if (empty($_POST['status'])) {
            $_SESSION['message'] = '<div id="message" class="error notice is-dismissible"><p>status is required.</p></div>';
            wp_redirect(admin_url("admin.php?page=dwdea-members-list&action=edit&id={$_POST['id']}"), 302);
            exit;
        }

        //Save
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
            $_SESSION['message'] = '<div id="message" class="error notice is-dismissible"><p>Member save failed.</p></div>';
            wp_redirect(admin_url("admin.php?page=dwdea-members-list&action=edit&id={$_POST['id']}"), 302);
            exit;
        }

        //Success
        $_SESSION['message'] = '<div id="message" class="updated notice is-dismissible"><p>Member update successfully.</p></div>';
        wp_redirect(admin_url('admin.php?page=dwdea-members-list'), 302);
    }

}
