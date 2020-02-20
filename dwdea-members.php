<?php
/**
 * Plugin Name:       dwdea-members
 * Plugin URI:        http://dwdea.org
 * Description:       Easily handle only dhaka wasa engineering members(Bangladesh)
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Md Golam Shahajuddin
 * Author URI:        http://pph.me/shahaj90
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages

dwdea-members is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

dwdea-members is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with dwdea-members. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */

defined('ABSPATH') or die('Hey, what are you doing here? You silly human');

class Dwdea_Members
{
    public function __construct()
    {
        session_start();
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        add_action('admin_menu', [$this, 'my_menu']);
    }

    public function active()
    {
        $this->create_db();
    }

    public function create_db()
    {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name      = "{$wpdb->prefix}dwdea_members";
        $sql             = "CREATE TABLE IF NOT EXISTS $table_name (
        `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
        `name` varchar(255),
        `father_name` varchar(255),
        `mobile` varchar(255),
        `description` text DEFAULT NULL,
        `status` TINYINT(10)  DEFAULT '3' COMMENT '1=Died, 2=Retired, 3=Alive',
        `created_by` bigint(20),
        `updated_by` bigint(20) DEFAULT NULL,
        `created_at` datetime,
        `updated_at` datetime DEFAULT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

        dbDelta($sql);
    }

    public function my_menu()
    {
        add_menu_page('Dwdea Members', 'Dwdea Members', '', 'dwdea-members', [$this, 'add_new_page'], '', 25);
        add_submenu_page('dwdea-members', 'Add Dwdea Members', 'Add New', 'manage_options', 'new-dwdea-members', [$this, 'add_new_page']);
        add_submenu_page('dwdea-members', 'Dwdea Members List', 'All Members', 'manage_options', 'dwdea-members-list', [$this,'all_member_page'] );
    }

    public function add_new_page()
    {
        require_once 'views/add_new_member.php';
    }

    public function all_member_page()
    {
        exit;
        require_once 'views/all_members.php';
    }

} //End class

$dwdea_member = new Dwdea_Members();

//Active plugin
register_activation_hook(__FILE__, [$dwdea_member, 'active']);
