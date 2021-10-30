<?php 

/* Replace Login page logo */ 
function login_page_logo() { 
    echo '<style>.login h1 a { 
    background-repeat: no-repeat; 
    background-image: url(https://yourlogolink.com); 
    background-position: center center; 
    background-size: contain !important; 
    width: 100% !important; 
    } 
</style>'; 
} 
add_action( 'login_head', 'login_page_logo' );

/* Replace Login page Logo URL link */ 
function login_page_URL( $url ) { 
    $url = home_url( '/home' ); 
    return $url; 
} 
add_filter( 'login_headerurl', 'login_page_URL' ); 

/* Change Login Error Message */
function login_error_message(){
  return 'Incorrect username or password. Please try again';
}
add_filter( 'login_errors', 'login_error_message' );
