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
     $display .= '<div style="background-color: red; padding: 5px 3px;">This is a div element</div>';

     return $display;
 }
 add_shortcode('jeemu-display','jeemu_display_shortcode');