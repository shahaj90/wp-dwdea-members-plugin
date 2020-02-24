<?php
/**
 * Plugin Name:       dwdea-members
 * Plugin URI:        http://dwdea.org
 * Description:       Easy handle to dhaka wasa engineering members(Bangladesh)
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
define('PLUGIN_PATH', plugin_dir_path(__FILE__));

require_once ABSPATH . 'wp-admin/includes/upgrade.php';
// require_once 'includes/class_member.php';

class Dwdea_Members
{
	var $member;
    public function __construct()
    {
        session_start();
        add_action('admin_menu', [$this, 'admin_menu']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);
    }

    public function activate()
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

    public function admin_menu()
    {
        add_menu_page('Add Member', 'DWDEA Member', '', 'dwdea-members', [$this, 'member_add'], '', 25);
        add_submenu_page('dwdea-members', 'Add Member', 'Add Member', 'manage_options', 'new-member', [$this, 'member_add']);
        add_submenu_page('dwdea-members', 'Member List', 'Member List', 'manage_options', 'member-list', [$this, 'member_list']);
    }

    public function enqueue()
    {
        wp_enqueue_script('member-js', plugins_url('/public/js/members.js', __FILE__));
    }

    public function member_add()
    {
        require_once 'views/member_add.php';
    }

    public function member_list()
    {    	
        require_once 'includes/class_member_wp_list_table.php';
    }

} //End class

$dwdea_members = new Dwdea_Members();

//Activation plugin
register_activation_hook(__FILE__, [$dwdea_members, 'activate']);
