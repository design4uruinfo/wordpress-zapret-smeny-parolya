<?php
/*
Plugin Name: PwRemove
Plugin URI: http://design4uru.info
Description: Плагин отключения смены пароля пользователям и группам.
Author: Design4uru.info
Version: 0.1
Author URI: http://design4uru.info/
*/

class Design4uPasswordResetRemoved { 

	function __construct() 
	{ 
	
            add_filter( 'show_password_fields', array( $this, 'disable' ) ); 
            add_filter( 'allow_password_reset', array( $this, 'disable' ) ); 
            add_filter( 'gettext', array( $this, 'remove' ) ); 

	} 
	
    function disable() { 
	
	if ( is_admin() ) {$userdata = wp_get_current_user(); $user = new WP_User($userdata->ID);
    
       var_dump($user->user_login);
        
        if ( !empty( $user->roles ) && is_array( $user->roles ) && $user->roles[0] == 'administrator' ) {
            
            return true;
            
        }
       
        
    }
    
    return false;
	
  }
 
  function remove($text) 
  {
    return str_replace( array('Lost your password?', 'Lost your password'), '', trim($text, '?') ); 
  }
  
}
 
$nopass = new Design4uPasswordResetRemoved();

?>
