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
{
    if(array_key_exists('submit_scripts', $_POST)){
        update_option('jeemu_header_scripts', $_POST['header_scripts']);
        update_option('jeemu_footer_scripts', $_POST['footer_scripts']);

        ?>
            <div id="setting-error-settings-updated" class="updated_settings-error notice is-dismissible"><strong>Settings Have Been Applied</strong></div>
        <?php
    }

    $header_scripts = get_option('jeemu_header_scripts', 'none');
    $footer_scripts = get_option('jeemu_footer_scripts', 'none');

    ?>
    <div class="wrap">
        <h2>Script Options</h2>

        <form method="post" action="">
            <label for="header_scripts"></label>
            <textarea name="header_scripts" class="large-text"><?php print $header_scripts ?></textarea>
            <label for="footer_scripts"></label>
            <textarea name="footer_scripts" class="large-text"><?php print $footer_scripts ?></textarea>
            <input type="submit" name="submit_scripts" value="Insert Scripts" class="button button-primary" />
        </form>
    </div>
    <?php
}

function jeemu_display_header_scripts()
{
    $header_scripts = get_option('jeemu_header_scripts', 'none');
    print $header_scripts;
}
add_action('wp_head', 'jeemu_display_header_scripts');

function jeemu_display_footer_scripts()
{
    $footer_scripts = get_option('jeemu_footer_scripts', 'none');
    print $footer_scripts;
}
add_action('wp_footer', 'jeemu_display_footer_scripts');