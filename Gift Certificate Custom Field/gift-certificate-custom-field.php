<?php
/**
 * Plugin Name: Gift Certificate Custom Field
 * Plugin URI: https://chefmarcellogourmetimport.com
 * Description: Gift Certificate Custom Field
 * Author: Marco Russodivito
 * Author URI: https://redhitmark.github.io
 * Version: 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

define('GIFT_CERTIFICATE_IDs', array(1972, 2037, 2029, 2020));
define('GIFT_BASKETS_IDs', array(2106, 2167, 2168, 2169, 2170, 2466, 2469));
function show_sender_email_input_field() {
    global $product;
    $product_id = $product->get_id();
    if(in_array($product_id, GIFT_CERTIFICATE_IDs) || in_array($product_id, GIFT_BASKETS_IDs)) {
        $html =
            '<style>
                #gift-certificate-custom-fields, #comments {
                    width: 100%;
                }
            </style>
            <div id="gift-certificate-custom-fields">
                <label for="from">From*:<br><input type="text" id="from" name="from"></label>
                <label for="to">To*:<br><input type="text" id="to" name="to"></label>
                <label for="comments">Comments:<br><textarea id="comments" name="comments" rows="4"></textarea>
            </div>';

        echo $html;
    }
}
add_action( 'woocommerce_before_add_to_cart_button', 'show_sender_email_input_field', 10 );

function sender_email_input_fields_validation( $passed, $product_id, $quantity ) {
    if(in_array($product_id, GIFT_CERTIFICATE_IDs) || in_array($product_id, GIFT_BASKETS_IDs)) {
        if( empty( $_POST['from'] ) ) {
            $passed = false;
            wc_add_notice('You must provide the name of the person who is buying the gift certificate.', 'error' );
        }
        if( empty( $_POST['to'] ) ) {
            $passed = false;
            wc_add_notice('You must provide the name of the person who is receiving the gift certificate.', 'error' );
        }
    }
    return $passed;
}
add_filter( 'woocommerce_add_to_cart_validation', 'sender_email_input_fields_validation', 10, 3 );

function add_sender_email_field_to_cart_item( $cart_item_data, $product_id, $variation_id, $quantity ) {
    if (in_array($product_id, GIFT_CERTIFICATE_IDs) || in_array($product_id, GIFT_BASKETS_IDs)) {
        $cart_item_data['from'] = htmlspecialchars($_POST['from']);
        $cart_item_data['to'] = htmlspecialchars($_POST['to']);
        $cart_item_data['comments'] = htmlspecialchars($_POST['comments']);
    }
    return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'add_sender_email_field_to_cart_item', 10, 4 );

function display_sender_email_input_field_in_cart( $item_data, $cart_item ) {
    $product_id = $cart_item['product_id'];

    if (in_array($product_id, GIFT_CERTIFICATE_IDs) || in_array($product_id, GIFT_BASKETS_IDs)) {
        $item_data[] = array(
            'key'     => 'From',
            'value'   => $cart_item['from'],
            'display' => $cart_item['from']
        );
        $item_data[] = array(
            'key'     => 'To',
            'value'   => $cart_item['to'],
            'display' => $cart_item['to']
        );
        $item_data[] = array(
            'key'     => 'Comments',
            'value'   => $cart_item['comments'],
            'display' => $cart_item['comments']
        );
    }
    return $item_data;
}
add_filter( 'woocommerce_get_item_data', 'display_sender_email_input_field_in_cart', 10, 2 );


/*TODO
function display_sender_email_input_field_in_admin_order($item_id, $item, $_product) {
    if ( null === $_product ) {
        // Shipping.
        return;
    }

    $product_id = $_product->get_id();
    if (in_array($product_id, GIFT_CERTIFICATE_IDs)) {

    }
}
add_filter( 'woocommerce_before_order_itemmeta', 'display_sender_email_input_field_in_admin_order', 10, 3);
*/

function add_sender_email_input_field_to_order_items( $item, $cart_item_key, $values, $order ) {
    $product = $item->get_product();
    $product_id = $product->get_id();

    if (in_array($product_id, GIFT_CERTIFICATE_IDs) || in_array($product_id, GIFT_BASKETS_IDs)) {
        if( !empty( $values['from'] ) ) {
            $item->update_meta_data( 'from', $values['from']);
        }
        if( !empty( $values['to'] ) ) {
            $item->update_meta_data( 'to', $values['to']);
        }
        if( !empty( $values['comments'] ) ) {
            $item->update_meta_data( 'comments', $values['comments']);
        }
    }

}
add_action( 'woocommerce_checkout_create_order_line_item', 'add_sender_email_input_field_to_order_items', 10, 4 );
