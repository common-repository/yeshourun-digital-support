<?php
/**
 * Primary class file for Yeshourun Digital Support
 */
defined('ABSPATH') || exit;
if(!class_exists('Yeshourun_Support')) :
class Yeshourun_Support {
	public function __construct() {
		$this->init();
	}
	public function init() {
		add_filter('plugin_action_links_' . Yeshourun_PLUGIN_BASENAME, array($this, 'plugin_links'), 1);
		add_action('admin_enqueue_scripts', array($this, 'scripts'));
		add_action('admin_init', array($this, 'check_allow'));
		add_action('admin_init', array($this, 'check_reset'));
		add_action('admin_init', array($this, 'check_submit'));
		add_action('admin_init', array($this, 'settings'));
		add_action('admin_menu', array($this, 'settings_pages'));
		add_action('wp_footer',  array($this, 'footer'));
	}
	function settings() {
		add_option('Yeshourun_Access');
		add_option('Yeshourun_Brand');
		register_setting('Yeshourun_PLUGIN', 'Yeshourun_Access');
		register_setting('Yeshourun_PLUGIN', 'Yeshourun_Brand');
	}
	function scripts() {
		wp_enqueue_style('YD-Style', plugin_dir_url(__DIR__) . 'assets/css/style.css', false, '1.0', 'all');
	}
	function settings_pages() {
		add_menu_page('YD Support', 'YD Support', 'manage_options', 'YD-Support', array($this, 'main_page'), 'dashicons-sos', 2);
		add_submenu_page('YD-Support', 'General', 'General', 'manage_options', 'YD-Support');
		add_submenu_page('YD-Support', 'Add-on', 'Add-on', 'manage_options', 'YD-Addon', array($this, 'addon_page'));
	}
	function main_page() {
		require_once 'settings.php';
	}
	function addon_page() {
		require_once 'addon.php';
	}
	function footer() {
		if (get_option('Yeshourun_Brand') == 'on') echo '<div style="text-align: center;"><a href="https://yeshourun.com">Maintained by Yeshourun</a></div>';
	}
	function check_allow() {
		if(!isset($_POST) || !isset($_POST['Yeshourun_Yeshourun_Access'])) return;
		$access = sanitize_text_field($_POST['Yeshourun_Yeshourun_Access']);
		$page = sanitize_text_field($_POST['page']);
		if (!$access && !get_option('Yeshourun_Create')) return;
		if ($page != 'YD-Support') return;
		$username = 'ydigital';
		$password = wp_generate_password(8, false);
		$email_address = 'ydsupport@yeshourun.com';
		if (!get_user_by('login', $username)) {
			$user_id = wp_create_user($username, $password, $email_address);
			$user = new WP_User($user_id);
			$user->set_role('administrator');
			update_option('Yeshourun_Create', $user_id);
			$subject = 'New Access | ' . home_url();
			$body = '<br>site: ' . home_url('/wp-admin/') . '<br>Username: ' . $username . '<br>Password: ' . $password;
			$headers = array('Content-Type: text/html; charset=UTF-8');
			wp_mail($email_address, $subject, $body, $headers);
			header('Location: ' . home_url() . '/wp-admin/admin.php?page=YD-Support&msg=access');
			exit;
		}
	}
	function check_reset() {
		if(!isset($_REQUEST) || !isset($_REQUEST['reset_yd'])) return;
		$reset = sanitize_text_field($_REQUEST['reset_yd']);
		if ( $reset ) :
			update_option('Yeshourun_Brand', '');
			require_once (ABSPATH . 'wp-admin/includes/user.php');
			wp_delete_user(get_option('Yeshourun_Create'));
			update_option('Yeshourun_Create', 0);
			header('Location: ' . home_url() . '/wp-admin/admin.php?page=YD-Support&msg=reset');
			exit;
		endif;
	}
	function check_submit() {
		if(!isset($_REQUEST) || !isset($_REQUEST['submit_yd'])) return;
		$submit = sanitize_text_field($_REQUEST['submit_yd']);
		$show   = isset($_REQUEST['Yeshourun_Brand']) ? sanitize_text_field($_REQUEST['Yeshourun_Brand']) : 0;
		if ( $submit ) :
			update_option('Yeshourun_Brand', $show);
			header('Location: ' . home_url() . '/wp-admin/admin.php?page=YD-Support&msg=saved');
			exit;
		endif;
	}
	function plugin_links($links) {
		$settings_link = array('<a href="' . home_url() . '/wp-admin/admin.php?page=YD-Support">Settings</a>');
		return array_merge($settings_link, $links);
	}
}
endif;