<?php
class MemberClass
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
            'description' => (!empty($_POST['comment']) ? $_POST['comment'] : null),
            'created_by'  => get_current_user_id(),
            'created_at'  => date('Y-m-d H:i:s'),
        ];

        $wpdb->insert($table, $data, null);
        if (empty($wpdb->insert_id)) {
            //Error
            $_SESSION['message'] = '<div id="message" class="updated notice is-dismissible"><p>Member save failed.</p></div>';
            wp_redirect(admin_url('admin.php?page=new-dwdea-members'), 302);
            exit;
        }

        //Success
        $_SESSION['message'] = '<div id="message" class="updated notice is-dismissible"><p>Member save successfully.</p></div>';
        wp_redirect(admin_url('admin.php?page=new-dwdea-members'), 302);
        exit;

    }
}
