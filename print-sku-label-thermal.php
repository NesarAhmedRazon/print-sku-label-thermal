<?php

/**
 * Plugin Name: WooCommerce Print SKU Label Thermal
 * Plugin URI: https://github.com/NesarAhmedRazon/smd-picker-extension
 * Description: This plugin is used to print SKU label 58mm thermal printer. It will print SKU, Product Name and QR. It will add a button in the product page to print the SKU label. 
 * Version: 2.0
 * Author: Nesar Ahmed
 * Author URI: https://nesarahmed.dev/
 * License: GPLv2 or later
 * Text Domain: print-sku-label-thermal
 * Domain Path: /languages/
 */


// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Plugin Folder Path.
if (!defined('SKU_LABEL_PRINTER_PLUGIN_DIR')) {
    define('SKU_LABEL_PRINTER_PLUGIN_DIR', plugin_dir_path(__FILE__));
}
// Plugin Folder URL.
if (
    !defined('SKU_LABEL_PRINTER_PLUGIN_URL')
) {
    define('SKU_LABEL_PRINTER_PLUGIN_URL', plugin_dir_url(__FILE__));
}
// Plugin Root File.
if (!defined('SKU_LABEL_PRINTER_PLUGIN_FILE')) {
    define('SKU_LABEL_PRINTER_PLUGIN_FILE', __FILE__);
}

// Plugin Version
if (!defined('SKU_LABEL_PRINTER_VERSION')) {
    define('SKU_LABEL_PRINTER_VERSION', '2.0');
}


// check if WooCommerce is active
add_action('plugins_loaded', 'check_for_woocommerce');
function check_for_woocommerce() {
    if (!defined('WC_VERSION')) {
        // no woocommerce :(
        add_action('admin_notices', 'woocommerce_not_active_notice');
    } else {
        // woocommerce is active :)
        require_once(SKU_LABEL_PRINTER_PLUGIN_DIR . 'includes/sku-printer.php');

    }
}