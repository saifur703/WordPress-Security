<?php
/* This code should go to theme's function.php */

-----------------------------------------------

/*Disable plugin udpates notification */
add_filter('auto_plugin_update_send_email', '__return_false');


-----------------------------------------------


/*Disable theme udpates notification */
add_filter('auto_theme_update_send_email', '__return_false'); 


-----------------------------------------------


/*Disable WordPress core updates email */
function wp_updates_email( $send, $type, $core_update, $result ) {
if ( ! empty( $type ) && $type == 'success' ) {
return false;
}
return true;
}

add_filter( 'auto_core_update_send_email', 'wp_updates_email', 10, 4 );

