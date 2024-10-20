<?php

if(!defined('ABSPATH')) {
    die('No script kiddies please!');
}

include_once('genarateQr.php');
// add a simple modal button before update button in product edit page which will trigger nothing 

function skuLabelPrinter_add_modal_button()
{
    global $post;
    if ($post->post_type === 'product') {
        // if the product saved as draft or published
        $status = $post->post_status;
        if ($status === 'draft' || $status === 'publish') {
            
            $sku = get_post_meta($post->ID, '_sku', true);
            echo '<button class="button qr-button" id="printQr" data-sku="'.$sku.'" data-css="'.SKU_LABEL_PRINTER_PLUGIN_URL.'assets/style/qrPrint.css?v='.time().'" data-admin="'.admin_url('admin-ajax.php').'">
					<span class="dashicons dashicons-printer"></span><span class="" href="#">Print SKU</span>
				</button>';

                // get the product sku and title
        
        
        
        // enqueue the print label js file
        wp_enqueue_script('skuLabelPrinter-printQr', SKU_LABEL_PRINTER_PLUGIN_URL . 'assets/js/printQr.js', array('jquery'), time(), true);
        wp_enqueue_style( 'skuLabelPrinter-qrPrint', SKU_LABEL_PRINTER_PLUGIN_URL . 'assets/style/qrPrint.css', [], time(), 'all' );
        
        }

        
    }
}
add_action('post_submitbox_start', 'skuLabelPrinter_add_modal_button');



// Handle the ajax request to print the qr code

function getQrData(){
    if(isset($_POST['text']) ){
        $data = trim($_POST['text']);
        $qrData = genarateQrData($data,150,'qr-code-svg');
        echo $qrData;
    }

    wp_die();
}

add_action('wp_ajax_getQrData', 'getQrData');


