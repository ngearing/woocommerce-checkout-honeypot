<?php

/**
 * Plugin Name: WooCommerce checkout honeypot
 * Description: A simple plugin that adds a honey  pot field to the WooCommerce checkout page. This can be used as an additional security measure.
 * Author: Nathan Gearing
 * Author URI: http://nathangearing.com/
 * Version: 1.0.0
 * License: MIT License - http://www.opensource.org/licenses/mit-license.php
 */


function ng_checkout_honeypot() {
    echo '<p style="opacity: 0; position: absolute; top: 0; left: 0; height: 0; width: 0; z-index: -1;"><input type="text" name="ng_checkout_hp" value="" tabindex="-1" autocomplete="off"></p>';
}
add_action('woocommerce_after_checkout_billing_form', 'ng_checkout_honeypot', 9999);

function ng_checkout_honeypot_validate($posted) {
    if (isset($_POST['ng_checkout_hp']) && !empty($_POST['ng_checkout_hp'])) {
        wc_add_notice('Sorry, our system flagged this checkout attempt as spam. Please try again', 'error');
    }
}
add_action('woocommerce_after_checkout_validation', 'ng_checkout_honeypot_validate');
