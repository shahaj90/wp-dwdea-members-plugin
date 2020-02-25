<?php
if (!defined('ABSPATH')) {
    $path = preg_replace('/wp-content.*$/', '', __DIR__);
    require_once $path . 'wp-load.php';
}

if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Member_Wp_List extends WP_List_Table
{

    public function get_members()
    {
        global $wpdb;
        $per_page    = 10;
        $paged       = $paged       = isset($_GET['paged']) ? max(0, intval($_GET['paged'] - 1) * $per_page) : 0;
        $orderby     = (isset($_GET['orderby']) && in_array($_GET['orderby'], array_keys($this->get_sortable_columns()))) ? $_GET['orderby'] : 'id';
        $order       = (isset($_GET['order']) && in_array($_GET['order'], array('ASC', 'DESC'))) ? $_GET['order'] : 'DESC';
        $search_item = (!empty($_POST['s']) ? $_POST['s'] : null);

        //Dynamic serial number
        $sl = 0;
        if (!empty($_GET['paged']) && $_GET['paged'] != 1) {
            $sl = $_GET['paged'] * $per_page;
        }

        //Get members
        $result = $wpdb->get_results("SELECT *, @rownum := @rownum + 1 as sl,
            CASE
            WHEN status =1 THEN 'Died'
            WHEN status = 2 THEN 'Retried'
            ELSE 'Active'
            END AS status
            FROM {$wpdb->prefix}dwdea_members cross join (select @rownum := {$sl}) r
            ORDER BY $orderby $order LIMIT {$paged}, {$per_page}", ARRAY_A);

        $total_items = $wpdb->get_var("SELECT count(id) FROM {$wpdb->prefix}dwdea_members");
        $this->set_pagination_args(array(
            'total_items' => $total_items,
            'per_page'    => $per_page,
        ));

        return $result;
    }

    public function get_columns()
    {
        $columns = array(
            'sl'          => 'Sl',
            'name'        => 'Name',
            'father_name' => 'Father',
            'mobile'      => 'Mobile',
            'status'      => 'Status',
            'description' => 'Comments',
        );

        return $columns;
    }

    public function prepare_items()
    {
        $columns               = $this->get_columns();
        $hidden                = array();
        $sortable              = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items           = $this->get_members();
    }

    public function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'sl':
            case 'name':
            case 'father_name':
            case 'mobile':
            case 'status':
            case 'description':
                return $item[$column_name];
            default:
                return print_r($item, true); //Show the whole array for troubleshooting purposes
        }
    }

    public function get_sortable_columns()
    {
        $sortable_columns = array(
            'name'        => array('name', false),
            'father_name' => array('father_name', false),
            'mobile'      => array('mobile', false),
            'status'      => array('status', false),
        );

        return $sortable_columns;
    }

    public function column_name($item)
    {
        $actions = array(
            'edit'   => sprintf('<a href="?page=%s&action=%s&id=%s">Edit</a>', $_REQUEST['page'], 'edit', $item['id']),
            'delete' => sprintf('<a href="?page=%s&action=%s&id=%s">Delete</a>', $_REQUEST['page'], 'delete', $item['id']),
        );

        return sprintf('%1$s %2$s', $item['name'], $this->row_actions($actions));
    }

    public function edit()
    {
        global $wpdb;
        $data = $wpdb->get_row("SELECT * from {$wpdb->prefix}dwdea_members WHERE id={$_GET['id']}", OBJECT);

        require_once PLUGIN_PATH . 'views/member_edit.php';
    }

    public function delete()
    {
        global $wpdb;
        $delete = $wpdb->delete("{$wpdb->prefix}dwdea_members", ['id' => $_GET['id']]);
        if ($delete > 0) {
            $_SESSION['message'] = '<div id="message" class="updated notice is-dismissible"><p>Member delete successfully.</p></div>';
        } else {
            $_SESSION['message'] = '<div id="message" class="error notice is-dismissible"><p>Member delete falied.</p></div>';
        }        

        $this->redirect(admin_url('admin.php?page=member-list'));
    }

    public function redirect($filename)
    {
        if (!headers_sent()) {
            header('Location: ' . $filename);
        } else {
            echo '<script type="text/javascript">';
            echo 'window.location.href="' . $filename . '";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url=' . $filename . '" />';
            echo '</noscript>';
        }
    }
}

function member_wp_list_table()
{
    $member_table = new Member_Wp_List();

    //Edit operation
    if (!empty($_GET['action']) && $_GET['action'] == 'edit' && !empty($_GET['id'])) {
        $member_table->edit();
        exit;
    }

    //Delete operation
    if (!empty($_GET['action']) && $_GET['action'] == 'delete' && !empty($_GET['id'])) {
        $member_table->delete();
        exit;

    }

    //Show WP list table
    echo '<div class="wrap">';
    echo '<h2>Member List</h2>';

    // message
    if (!empty($_SESSION['message'])) {
        echo "<div>{$_SESSION['message']}</div>";
        unset($_SESSION['message']);
    }

    // echo '<form method="post">';
    // echo '<input type="hidden" name="page" value="member_list">';

    $member_table->prepare_items();
    // $member_table->search_box('search', 'search_id');
    $member_table->display();
    echo '</div>';
}

member_wp_list_table();
