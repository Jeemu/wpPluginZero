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

//Add a contact form, capture its content, and send it to email
function jeemu_contact_form()
{
    $form = '';
    $form .= '<h3>Contact Form</h3>';
    $form .= '<form method="post" action="https://www.pst.or.tz/devEnv/thank-you/">';
    $form .= '<input type="text" name="full_name" placeholder="Your Full Name" />';
    $form .= '<br/>';
    $form .= '<input type="text" name="email" placeholder="Email Address" />';
    $form .= '<br/>';
    $form .= '<input type="text" name="phone_number" placeholder="Phone" />';
    $form .= '<br/>';
    $form .= '<textarea name="message" class="large-text" placeholder="Your message"></textarea>';
    $form .= '<br/>';
    $form .= '<input type="submit" name="jeemu_submit_form" value="CONTACT US" class="button button-primary" />';
    $form .= '</form>';

    return $form;
}
add_shortcode('jeemu-form', 'jeemu_contact_form');

function jeemu_set_html_content_type()
{
    return 'text/html';
}

function jeemu_form_capture()
{
    global $post, $wpdb;

    if(array_key_exists('jeemu_submit_form', $_POST)){
        $to = 'abc@gmail.com';
        $subject = 'New Test Contact From Jeemu Form';
        $content = '';
        $content .= 'Name: '.$_POST['full_name'].' <br /> ';
        $content .= 'Email: '.$_POST['email'].' <br /> ';
        $content .= 'Phone: '.$_POST['phone_number'].' <br /> ';
        $content .= 'Message: '.$_POST['message'].' <br /> ';

        //Send the form contact by email
        add_filter('wp_mail_content_type', 'jeemu_set_html_content_type');
        wp_mail($to, $subject, $content);
        remove_filter('wp_mail_content_type', 'jeemu_set_html_content_type');

        /*
        //Insert the information into a wordpress comment section
        $time = current_time('mysql');

        $contentdata = array(
            'comment_post_ID' => $post->ID,
            'comment_author' => $_POST['full_name'],
            'comment_author_email' => $_POST['email'],
            'comment_content' => $_POST['message'],
            'comment_author_ip' => $_SERVER['REMOTE_ADDR'],
            'comment_date' => $time,
            'comment_approved' => 1,
        );

        wp_insert_comment($contentdata);
        */

        //Insert submission into a custom database table
        $time = current_time('mysql');

        $contentdata = array(
            'name' => $_POST['full_name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone_number'],
            'message' => $_POST['message'],
            'lead_ip' => $_SERVER['REMOTE_ADDR'],
            'time_submitted' => $time,
        );

        $insertData = $wpdb->insert($wpdb->prefix.'form_submissions',$contentdata);

    }
}
add_action('wp_head', 'jeemu_form_capture');

//Get information from the database
function jeemu_get_message()
{
    global $wpdb;
    $displayData = '';
    
    /*Use geolocation api to convert submitter IP address into location
    use ipinfo/ipinfo/IPinfo;

    $access_token = 'd93f47315a4950';
    $client = new IPinfo($access_token);
    */

    //Get data from custom database table
    $getData = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}form_submissions", OBJECT_K);

    if($getData)
    {
        foreach ($getData as $getDatum){
            /*
            $ip_address = $getDatum->lead_ip;
            $details = $client->getDetails($ip_address);
            */

            $displayData .= $getDatum->message.'<br/>Written By: '.$getDatum->name.' <br/>Contacts: '.$getDatum->email.' | '.$getDatum->phone.'<br/><span class="dashicons-before dashicons-clock"> On: '.$getDatum->time_submitted.'</span><hr/>';
        }
    }
    else{
        $displayData .= "Ooops! It seem there is an error...";
    }
    

    $jeemuData = "<p><pre>".$displayData."</pre></p>";

    return $jeemuData;

}
add_shortcode('jeemu-data','jeemu_get_message');

//Insert custom post type logic from another file
require_once plugin_dir_path( __FILE__ ) . 'jeemu_custom_posttype.php';
