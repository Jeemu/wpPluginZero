<?php
/**
 * Plugin Name:       My WP Plugin Zero
 * Plugin URI:        https://github.com/Jeemu/wpPluginZero
 * Description:       A plugin to do random stuffs.
 * Version:           1.0.0
 * Author:            Jeemu
 * Author URI:        https://github.com/Jeemu
 */

 //Add a shortcode to display something to the client
 function jeemu_display_shortcode()
 {
     $display = "";
     $display .= "<p>I can be seen!!!</p>";
     $display .= '<div style="background-color: red; padding: 5px 6px;">This is a div element</div>';

     return $display;
 }
 add_shortcode('jeemu-display','jeemu_display_shortcode');

 //Add an admin menu item and an admin option page, capturing and inserting options to certain web sections
function jeemu_admin_menu_item()
{
    add_menu_page('PluginZero Page','Plugin Zero','manage_options','plugin-zero','jeemu_option_page_display','dashicons-marker',200);
}
add_action('admin_menu','jeemu_admin_menu_item');

function jeemu_option_page_display()
{}