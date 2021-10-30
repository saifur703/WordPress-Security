<?php

/* This code will display the following message */

function wp_maintenance_idc () {
 if( !is_user_logged_in() ){
echo '<h1>Briefly unavailable for scheduled maintenance. Check back in a minute.</h1>';
 die ();}
}

add_action ('get_header','wp_maintenance_idc');


------------------------------------------------------------------------
  
/* Use any html template: https://colorlib.com/wp/free-under-construction-templates/ */
/* This code will redirect to the Location URL */

function wp_maintenance_redirect () {
 if( !is_user_logged_in() ){
 header("Location: http://www.your-website.com/site.html", true, 302);
 die ();}
}

add_action ('get_header','wp_maintenance_redirect');


