<?php
/* Plugin Name: Kill 'Em All!
Plugin URI: http://dv.id.au/
Description: Wipe all spam in ONE GO!
Version: 1.0
Author: Donny Verdian
Author URI: http://donnyverdian.net/
License: GPLv2 or later
*/
?><?php

add_action( 'admin_menu', 'register_my_custom_menu_page' );

function register_my_custom_menu_page(){
    add_menu_page( 'Kill Em All', 'Kill Em All', 'manage_options', 'killemall', 'my_custom_menu_page','');
}

function my_custom_menu_page(){        
    global $wpdb;
    $user_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_approved = 'spam'" );
    if ($user_count > 0) {
        $wpdb->query( 
        $wpdb->prepare( 
            "
            DELETE FROM $wpdb->comments
            WHERE comment_approved = 'spam'      
            "
        )
    );
        echo "<h1 style='text-align:center; margin-top:20px;'>".$user_count." spam(s) wiped!</h1>";

    } else { echo "<h1 style='text-align:center; margin-top:20px;'>There is no spam!</h1>";}
    echo "<h2 style='text-align:center;'><a href='index.php'>back to index page</a></h2>";
    }
?>