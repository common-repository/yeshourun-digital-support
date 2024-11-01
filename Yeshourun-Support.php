<?php
/*
 * Plugin Name:       Yeshourun Digital Support
 * Plugin URI:        https://yeshourun.com/plugin
 * Description:       Yeshourun Digital Support provides access to support engineers, allowing them to perform website maintenance & design.
 * Version:           1.0.1
 * Author:            Yeshourun Digital
 * Author URI:        https://yeshourun.com
 * WP tested up to: 5.7
 * Requires PHP: 7.1
 * License: GPLv2 or later
 * Yeshourun Digital. Plugin for Yeshourun Digital Support. Copyright © 2021, All Rights Reserved.
 * Terms of Service:  https://yeshourun.com/terms-of-service/
 * Terms & Conditions: https://yeshourun.com/terms-conditions/
 * Privacy Policy: https://yeshourun.com/privacy-policy/
 */
defined( 'ABSPATH' ) || exit;
define( 'Yeshourun_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
require_once 'include/Yeshourun-class.php';
new Yeshourun_Support();
