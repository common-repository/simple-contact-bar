<?php if (!defined('ABSPATH')) exit;
/**
 * Simple Contact Bar
 *
 * @wordpress-plugin
 * Plugin Name: Simple Contact Bar
 * Version:     1.0.4
 * Stable tag: 1.0.4
 * Plugin URI:  https://wordpress.org/plugins/simple-contact-bar/
 * Description: Simple Contact Bar: A plugin that easily adds Call Now and WhatsApp Message buttons to your site, along with customizable options and a popup feature for visitor communication.
 * Tags:        click to call, call now button, whatsapp button, text from whatsapp, popup contact buttons
 * Author:      Tuncay TEKE
 * Author URI:  https://tuncayteke.com.tr
 * Contributors: tuncayteke
 * Donate link: https://profiles.wordpress.org/tuncayteke/
 * Text Domain: simple-contact-bar
 * Domain Path: /languages/
 * Requires at least:  5.4.0
 * Tested up to: 6.6.1
 * Requires PHP: 7.1
 *
 * WC requires at least: 8.1
 * WC tested up to: 9.1.4
 *
 * License: GPL2+ or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 */


// Simple Contact Bar Define Plugin DIR
define('SIMPLE_CONTACT_BAR_PLUGIN_DIR', plugin_dir_url(__FILE__));
// Load Style CSS
 if (!is_admin()) {
        wp_enqueue_style('scb-style', SIMPLE_CONTACT_BAR_PLUGIN_DIR . 'css/style.css');
	 
 }
 
// Add Admin Menu
function simple_contact_bar_plugin_settings_page()
{
    add_menu_page(
        __('Simple Contact Bar Settings', 'simple-contact-bar'),
        __('Simple Contact Bar Settings', 'simple-contact-bar'),
        'manage_options',
        'simple_contact_bar_settings_page',
        'simple_contact_bar_settings_page_render',
        'dashicons-phone',
        '50'
    );
}
add_action('admin_menu', 'simple_contact_bar_plugin_settings_page');

// Load Lang Files


function simple_contact_bar_load_lang()
{
    load_plugin_textdomain('simple-contact-bar', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}

add_action('plugins_loaded', 'simple_contact_bar_load_lang');





// Simple Contact Bar Admin Settings Page
function simple_contact_bar_settings_page_render()
{

    if (is_admin()) {

        wp_enqueue_style('scb-admin-style', SIMPLE_CONTACT_BAR_PLUGIN_DIR . 'css/admin-style.css');
        wp_enqueue_style('scb-style', SIMPLE_CONTACT_BAR_PLUGIN_DIR . 'css/style.css');
		
		//wp_register_style( 'wpdocsPluginStylesheet', plugins_url( 'stylesheet.css', __FILE__ ) );

?>
        <div class="wrap scb-admin">
            <h1><?php echo __('Simple Contact Bar', 'simple-contact-bar'); ?></h1>

            <form method="post" action="options.php">
                <?php settings_fields('simple_contact_bar_settings_page');
                do_settings_sections('simple_contact_bar_settings_page');
                submit_button();
                ?>
            </form>

            <!---SHORTCODES -->
            <div class="shortcodes-details">
                <h2><?php echo __('SUPPORTED SHORTCODES', 'simple-contact-bar'); ?></h2>
                <h4> <?php echo __('You can use this shortcodes where you want to display your contact information.', 'simple-contact-bar'); ?></h4>
                <h5> <?php echo __('These are inline elements that can be used in Post, Page or Widget contents.', 'simple-contact-bar'); ?></h5>
                <div class="shortcodes-details-row">

                    <div class="shortcodes-details-col">
                        <div class="shortcodes-details-title">
                            <?php echo __('Shortcode that can be used to for displaying phone number as text.', 'simple-contact-bar'); ?>:
                        </div>
                        <div class="shortcodes-details-description">
                            <h4><?php echo __('Short Code:', 'simple-contact-bar'); ?></h4>
                            <input class="scb-padding-20 scb-width-100" type="text" value="[simple_contact_bar_phone_number]">
                        </div>
                        <div class="shortcodes-details-preview">
                            <h4><?php echo __('Code Preview:', 'simple-contact-bar'); ?></h4>
                            <div class="shorcode-preview">
                                <?php
                                $phone = simple_contact_bar_phone_number_render();
                                echo $phone;
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="shortcodes-details-col">
                        <div class="shortcodes-details-title">
                            <?php echo __('Shortcode that can be used to display phone number as text in national format.', 'simple-contact-bar'); ?>:
                        </div>
                        <div class="shortcodes-details-description">
                            <h4><?php echo __('Short Code:', 'simple-contact-bar'); ?></h4>
                            <input class="scb-padding-20 scb-width-100" type="text" value="[simple_contact_bar_phone_number_format]">
                        </div>
                        <div class="shortcodes-details-preview">
                            <h4><?php echo __('Code Preview:', 'simple-contact-bar'); ?></h4>
                            <div class="shorcode-preview">
                                <?php
                                $phone = simple_contact_bar_phone_number_format_render();
                                echo $phone;
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="shortcodes-details-col">
                        <div class="shortcodes-details-title">
                            <?php echo __('Shortcode that can be used to for displaying clickable phone link with title.', 'simple-contact-bar'); ?>:
                        </div>
                        <div class="shortcodes-details-description">
                            <h4><?php echo __('Short Code:', 'simple-contact-bar'); ?></h4>
                            <input class="scb-padding-20 scb-width-100" type="text" value="[simple_contact_bar_phone_link]">
                        </div>
                        <div class="shortcodes-details-preview">
                            <h4><?php echo __('Code Preview:', 'simple-contact-bar'); ?></h4>
                            <div class="shorcode-preview">
                                <?php
                                $p_link = simple_contact_bar_phone_link_render();
                                echo $p_link;
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="shortcodes-details-col">
                        <div class="shortcodes-details-title">
                            <?php echo __('Shortcode that can be used to for displaying clickable phone buton with title and icon.', 'simple-contact-bar'); ?>:
                        </div>
                        <div class="shortcodes-details-description">
                            <h4><?php echo __('Short Code:', 'simple-contact-bar'); ?></h4>
                            <input class="scb-padding-20 scb-width-100" type="text" value="[simple_contact_bar_phone_button]">
                        </div>
                        <div class="shortcodes-details-preview">
                            <h4><?php echo __('Code Preview:', 'simple-contact-bar'); ?></h4>
                            <div class="shorcode-preview">
                                <?php
                                $w_link = simple_contact_bar_phone_button_render();
                                echo $w_link;
                                ?>
                            </div>
                        </div>
                        <h5><?php echo __('Preview settings are same with your phone button settings.', 'simple-contact-bar'); ?></h5>
                    </div>

                    <div class="shortcodes-details-col">
                        <div class="shortcodes-details-title">
                            <?php echo __('Shortcode that can be used to for displaying WhatsApp number as text.', 'simple-contact-bar'); ?>:
                        </div>
                        <div class="shortcodes-details-description">
                            <h4><?php echo __('Short Code:', 'simple-contact-bar'); ?></h4>
                            <input class="scb-padding-20 scb-width-100" type="text" value="[simple_contact_bar_whatsapp_number]">
                        </div>
                        <div class="shortcodes-details-preview">
                            <h4><?php echo __('Code Preview:', 'simple-contact-bar'); ?></h4>
                            <div class="shorcode-preview">
                                <?php
                                $whatsapp = simple_contact_bar_whatsapp_number_render();
                                echo $whatsapp;
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="shortcodes-details-col">
                        <div class="shortcodes-details-title">
                            <?php echo __('Shortcode that can be used to display WhatsApp number as text in national format.', 'simple-contact-bar'); ?>:
                        </div>
                        <div class="shortcodes-details-description">
                            <h4><?php echo __('Short Code:', 'simple-contact-bar'); ?></h4>
                            <input class="scb-padding-20 scb-width-100" type="text" value="[simple_contact_bar_whatsapp_number_format]">
                        </div>
                        <div class="shortcodes-details-preview">
                            <h4><?php echo __('Code Preview:', 'simple-contact-bar'); ?></h4>
                            <div class="shorcode-preview">
                                <?php
                                $whatsapp = simple_contact_bar_whatsapp_number_format_render();
                                echo $whatsapp;
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="shortcodes-details-col">
                        <div class="shortcodes-details-title">
                            <?php echo __('Shortcode that can be used to for displaying clickable whatsapp link with title.', 'simple-contact-bar'); ?>:
                        </div>
                        <div class="shortcodes-details-description">
                            <h4><?php echo __('Short Code:', 'simple-contact-bar'); ?></h4>
                            <input class="scb-padding-20 scb-width-100" type="text" value="[simple_contact_bar_whatsapp_link]">
                        </div>
                        <div class="shortcodes-details-preview">
                            <h4><?php echo __('Code Preview:', 'simple-contact-bar'); ?></h4>
                            <div class="shorcode-preview">
                                <?php
                                $w_link = simple_contact_bar_whatsapp_link_render();
                                echo $w_link;
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="shortcodes-details-col">
                        <div class="shortcodes-details-title">
                            <?php echo __('Shortcode that can be used to for displaying clickable WhatsApp buton with title and icon.', 'simple-contact-bar'); ?>:
                        </div>
                        <div class="shortcodes-details-description">
                            <h4><?php echo __('Short Code:', 'simple-contact-bar'); ?></h4>
                            <input class="scb-padding-20 scb-width-100" type="text" value="[simple_contact_bar_whatsapp_button]">
                        </div>
                        <div class="shortcodes-details-preview">
                            <h4><?php echo __('Code Preview:', 'simple-contact-bar'); ?></h4>
                            <div class="shorcode-preview">
                                <?php
                                $w_link = simple_contact_bar_whatsapp_button_render();
                                echo $w_link;
                                ?>
                            </div>
                        </div>
                        <h5><?php echo __('Preview settings are same with your WhatsApp button settings.', 'simple-contact-bar'); ?></h5>
                    </div>

                </div>
                <p><?php echo __('Thanks for using Simple Contact Bar. Coded with love.', 'simple-contact-bar'); ?> ❤ <?php echo __('by:', 'simple-contact-bar'); ?> <a href="https://tuncayteke.com.tr">Tuncay TEKE</a></p>
            </div>
        </div>
<?php
    }
}



// Register Settings
function simple_contact_bar_settings()
{

    // Setting Option Name
    $option_name   = 'simple_contact_bar_settings';

    // Fetch existing options.
    register_setting('simple_contact_bar_settings_page', $option_name);

    $default_values = array(
        'simple_contact_bar_enable' => 1,
        'simple_contact_bar_phone_button_enable'  => 0,
        'simple_contact_bar_phone_number'  => '05001110000',
        'simple_contact_bar_phone_title'  => __('Call Now', 'simple-contact-bar'),
        'simple_contact_bar_phone_text_color'  => '#ffffff',
        'simple_contact_bar_phone_bg_color'  => '#177cc7',
        'simple_contact_bar_phone_button_position'  => 'bottom-right',
        'simple_contact_bar_phone_button_size'  => 'md',
        'simple_contact_bar_phone_button_type'  => 'onlyicon',
        'simple_contact_bar_phone_button_animation'  =>  0,
        'simple_contact_bar_phone_icon_animation'  =>  0,
        'simple_contact_bar_whatsapp_button_enable'  => 0,
        'simple_contact_bar_whatsapp_number'  => '+905001110000',
        'simple_contact_bar_whatsapp_title'  => __('WhatsApp Text', 'simple-contact-bar'),
        'simple_contact_bar_whatsapp_message'  => __('WhatsApp Message', 'simple-contact-bar'),
        'simple_contact_bar_whatsapp_message_type'  => 'none',
        'simple_contact_bar_whatsapp_text_color'  => '#ffffff',
        'simple_contact_bar_whatsapp_bg_color'  => '#229000',
        'simple_contact_bar_whatsapp_button_position'  => 'bottom-right',
        'simple_contact_bar_whatsapp_button_size'  => 'md',
        'simple_contact_bar_whatsapp_button_type'  => 'onlyicon',
        'simple_contact_bar_whatsapp_button_animation'  => 0,
        'simple_contact_bar_whatsapp_icon_animation'  => 0,
        'simple_contact_bar_buttons_enable'  => 0,
        'simple_contact_bar_button_style'  => 'circle',
        'simple_contact_bar_button_display_style'  => 'grid',
        'simple_contact_bar_button_border_enable'  => 1,
        'simple_contact_bar_button_border_width'  => '2',
        'simple_contact_bar_button_border_style'  => 'solid',
        'simple_contact_bar_button_border_color'  => '#ffffff',
        'simple_contact_bar_button_display_devices'  => 'all',
        'simple_contact_bar_button_icon_animation'  => 0,
        'simple_contact_bar_popup_enable'  => 0,
        'simple_contact_bar_popup_title'  => __('Get in Touch', 'simple-contact-bar'),
        'simple_contact_bar_popup_title_text_color'  => '#000000',
        'simple_contact_bar_popup_text'  => '',
        'simple_contact_bar_popup_text_color'  => '#000000',
        'simple_contact_bar_popup_overlay_color'  => '#ffffff',
        'simple_contact_bar_popup_background_color'  => '#ffffff',
        'simple_contact_bar_popup_border_width'  => '2',
        'simple_contact_bar_popup_border_style'  => 'solid',
        'simple_contact_bar_popup_border_color'  => '#e2e2e2',
        'simple_contact_bar_popup_box_shadow_color'  => '#e2e2e2',
        'simple_contact_bar_popup_view_style'  => 'afterdelayed',
        'simple_contact_bar_popup_delay_time'  => '30000',
        'simple_contact_bar_popup_display_devices'  => 'all'

    );

    $option_values = get_option($option_name);
    $data = shortcode_atts($default_values, $option_values);


    /* Plugin Activation Section */
    add_settings_section(
        'plugin_enable_section',
        __('Simple Contact Bar Settings', 'simple-contact-bar'),
        'simple_contact_bar_settings_section_enable_callback',
        'simple_contact_bar_settings_page'
    );

    // Plugin Activation
    add_settings_field(
        'simple_contact_bar_enable',
        __('Enable Simple Contact Bar', 'simple-contact-bar'),
        'simple_contact_bar_settings_checkbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'plugin_enable_section',
        array(
            'name'        => 'simple_contact_bar_enable', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_enable']),
            'option_name' => $option_name
        )
    );

    /* Phone Settings Section */
    add_settings_section(
        'phone_settings_section',
        __('Phone Button Settings', 'simple-contact-bar'),
        'simple_contact_bar_settings_section_phone_callback',
        'simple_contact_bar_settings_page'
    );



    // Plugin Activation
    add_settings_field(
        'simple_contact_bar_phone_button_enable',
        __('Enable Phone Button', 'simple-contact-bar'),
        'simple_contact_bar_settings_checkbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'phone_settings_section',
        array(

            'name'        => 'simple_contact_bar_phone_button_enable', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_phone_button_enable']),
            'option_name' => $option_name
        )
    );

    // Phone Number
    add_settings_field(
        'simple_contact_bar_phone_button_number',
        __('Your Phone Number', 'simple-contact-bar'),
        'simple_contact_bar_settings_text_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'phone_settings_section',
        array(

            'name'        => 'simple_contact_bar_phone_number', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_phone_number']),
            'option_name' => $option_name
        )
    );

    // Phone Title
    add_settings_field(
        'simple_contact_bar_phone_title',
        __('Click to Call Button Title', 'simple-contact-bar'),
        'simple_contact_bar_settings_text_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'phone_settings_section',
        array(

            'name'        => 'simple_contact_bar_phone_title', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_phone_title']),
            'option_name' => $option_name
        )
    );

    //Phone Title Color
    add_settings_field(
        'simple_contact_bar_phone_text_color',
        __('Click to Call Button Title Text Color', 'simple-contact-bar'),
        'simple_contact_bar_settings_color_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'phone_settings_section',
        array(

            'name'        => 'simple_contact_bar_phone_text_color', // value for 'name' attribute
            'value'       => sanitize_hex_color($data['simple_contact_bar_phone_text_color']),
            'option_name' => $option_name
        )
    );
    //Phone Bg Color
    add_settings_field(
        'simple_contact_bar_phone_bg_color',
        __('Click to Call Button Background Color', 'simple-contact-bar'),
        'simple_contact_bar_settings_color_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'phone_settings_section',
        array(

            'name'        => 'simple_contact_bar_phone_bg_color', // value for 'name' attribute
            'value'       => sanitize_hex_color($data['simple_contact_bar_phone_bg_color']),
            'option_name' => $option_name
        )
    );

    //Phone Button Position
    add_settings_field(
        'simple_contact_bar_phone_button_position',
        __('Click to Call Button Position', 'simple-contact-bar'),
        'simple_contact_bar_settings_selectbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'phone_settings_section',
        array(

            'name'        => 'simple_contact_bar_phone_button_position', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_phone_button_position']),
            'options'     => array(
                'bottom-left'  => __('Bottom Left', 'simple-contact-bar'),
                'bottom-right'   => __('Bottom Right', 'simple-contact-bar'),
                'bottom-center'   => __('Bottom Center', 'simple-contact-bar'),
                'center-left' => __('Middle Left', 'simple-contact-bar'),
                'center-right' => __('Middle Right', 'simple-contact-bar'),
                'top-left' => __('Top Left', 'simple-contact-bar'),
                'top-right' => __('Top Right', 'simple-contact-bar')
            ),
            'option_name' => $option_name
        )
    );

    //Phone Button Size
    add_settings_field(
        'simple_contact_bar_phone_button_size',
        __('Click to Call Button Size', 'simple-contact-bar'),
        'simple_contact_bar_settings_selectbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'phone_settings_section',
        array(

            'name'        => 'simple_contact_bar_phone_button_size', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_phone_button_size']),
            'options'     => array(
                'sm'  => __('Small', 'simple-contact-bar'),
                'md'   => __('Medium', 'simple-contact-bar'),
                'lg'   => __('Large', 'simple-contact-bar'),
                'xl' => __('X Large', 'simple-contact-bar'),
                'xxl' => __('XX Large', 'simple-contact-bar')
            ),
            'option_name' => $option_name
        )
    );

    // Phone Button Type
    add_settings_field(
        'simple_contact_bar_phone_button_type',
        __('Click to Call Phone Button Type', 'simple-contact-bar'),
        'simple_contact_bar_settings_selectbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'phone_settings_section',
        array(

            'name'        => 'simple_contact_bar_phone_button_type', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_phone_button_type']),
            'options'     => array(
                'onlyicon'  => __('Only Icon', 'simple-contact-bar'),
                'onlytitle'   => __('Only Title', 'simple-contact-bar'),
                'iconwithtitle'   => __('Icon With Title', 'simple-contact-bar')
            ),
            'option_name' => $option_name
        )
    );

    // Phone Button Animation
    add_settings_field(
        'simple_contact_bar_phone_button_animation',
        __('Enable Phone Button Animation', 'simple-contact-bar'),
        'simple_contact_bar_settings_checkbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'phone_settings_section',
        array(

            'name'        => 'simple_contact_bar_phone_button_animation', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_phone_button_animation']),
            'option_name' => $option_name
        )
    );

    // Phone Icon Animation
    add_settings_field(
        'simple_contact_bar_phone_icon_animation',
        __('Enable Phone Icon Animation', 'simple-contact-bar'),
        'simple_contact_bar_settings_checkbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'phone_settings_section',
        array(

            'name'        => 'simple_contact_bar_phone_icon_animation', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_phone_icon_animation']),
            'option_name' => $option_name
        )
    );
    /* Whatsapp Settings Section */
    add_settings_section(
        'whatsapp_settings_section',
        __('WhatsApp Button Settings.', 'simple-contact-bar'),
        'simple_contact_bar_settings_section_whatsapp_callback',
        'simple_contact_bar_settings_page'
    );


    // Whatsapp Activation
    add_settings_field(
        'simple_contact_bar_whatsapp_button_enable',
        __('Enable WhatsApp Text Button', 'simple-contact-bar'),
        'simple_contact_bar_settings_checkbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'whatsapp_settings_section',
        array(

            'name'        => 'simple_contact_bar_whatsapp_button_enable', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_whatsapp_button_enable']),
            'option_name' => $option_name
        )
    );

    // Whatsapp Number
    add_settings_field(
        'simple_contact_bar_whatsapp_number',
        __('Your Whatsapp Text Number', 'simple-contact-bar'),
        'simple_contact_bar_settings_text_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'whatsapp_settings_section',
        array(

            'name'        => 'simple_contact_bar_whatsapp_number', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_whatsapp_number']),
            'option_name' => $option_name
        )
    );
    // Whatsapp Title
    add_settings_field(
        'simple_contact_bar_whatsapp_title',
        __('Your Whatsapp Text Button Title', 'simple-contact-bar'),
        'simple_contact_bar_settings_text_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'whatsapp_settings_section',
        array(

            'name'        => 'simple_contact_bar_whatsapp_title', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_whatsapp_title']),
            'option_name' => $option_name
        )
    );

    // Whatsapp Title Text Color
    add_settings_field(
        'simple_contact_bar_whatsapp_text_color',
        __('Your Whatsapp Text Button Title Color', 'simple-contact-bar'),
        'simple_contact_bar_settings_color_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'whatsapp_settings_section',
        array(

            'name'        => 'simple_contact_bar_whatsapp_text_color', // value for 'name' attribute
            'value'       => sanitize_hex_color($data['simple_contact_bar_whatsapp_text_color']),
            'option_name' => $option_name
        )
    );

    // Whatsaap Message Type
    add_settings_field(
        'simple_contact_bar_whatsapp_message_type',
        __('WhatsApp Message Type', 'simple-contact-bar'),
        'simple_contact_bar_settings_selectbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'whatsapp_settings_section',
        array(

            'name'        => 'simple_contact_bar_whatsapp_message_type', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_whatsapp_message_type']),
            'options'     => array(
                'none'  => __('None', 'simple-contact-bar'),
                'text'   => __('Text Below', 'simple-contact-bar'),
                'url'   => __('Page Title & Url', 'simple-contact-bar')
            ),
            'option_name' => $option_name
        )
    );

    // Whatsapp Message
    add_settings_field(
        'simple_contact_bar_whatsapp_message',
        __('Your Whatsapp Message', 'simple-contact-bar'),
        'simple_contact_bar_settings_text_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'whatsapp_settings_section',
        array(

            'name'        => 'simple_contact_bar_whatsapp_message', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_whatsapp_message']),
            'option_name' => $option_name
        )
    );

    // Whatsapp Button Bg Color
    add_settings_field(
        'simple_contact_bar_whatsapp_bg_color',
        __('Your Whatsapp Text Button Background Color', 'simple-contact-bar'),
        'simple_contact_bar_settings_color_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'whatsapp_settings_section',
        array(

            'name'        => 'simple_contact_bar_whatsapp_bg_color', // value for 'name' attribute
            'value'       => sanitize_hex_color($data['simple_contact_bar_whatsapp_bg_color']),
            'option_name' => $option_name
        )
    );

    // Whatsaap Button Position
    add_settings_field(
        'simple_contact_bar_whatsapp_button_position',
        __('WhatsApp Text Button Position', 'simple-contact-bar'),
        'simple_contact_bar_settings_selectbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'whatsapp_settings_section',
        array(

            'name'        => 'simple_contact_bar_whatsapp_button_position', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_whatsapp_button_position']),
            'options'     => array(
                'bottom-left'  => __('Bottom Left', 'simple-contact-bar'),
                'bottom-right'   => __('Bottom Right', 'simple-contact-bar'),
                'bottom-center'   => __('Bottom Center', 'simple-contact-bar'),
                'center-left' => __('Middle Left', 'simple-contact-bar'),
                'center-right' => __('Middle Right', 'simple-contact-bar'),
                'top-left' => __('Top Left', 'simple-contact-bar'),
                'top-right' => __('Top Right', 'simple-contact-bar')
            ),
            'option_name' => $option_name
        )
    );

    // Whatsapp Button Size
    add_settings_field(
        'simple_contact_bar_whatsapp_button_size',
        __('WhatsApp Text Button Size', 'simple-contact-bar'),
        'simple_contact_bar_settings_selectbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'whatsapp_settings_section',
        array(

            'name'        => 'simple_contact_bar_whatsapp_button_size', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_whatsapp_button_size']),
            'options'     => array(
                'sm'  => __('Small', 'simple-contact-bar'),
                'md'   => __('Medium', 'simple-contact-bar'),
                'lg'   => __('Large', 'simple-contact-bar'),
                'xl' => __('X Large', 'simple-contact-bar'),
                'xxl' => __('XX Large', 'simple-contact-bar')
            ),
            'option_name' => $option_name
        )
    );

    // Whatsapp Button View
    add_settings_field(
        'simple_contact_bar_whatsapp_button_type',
        __('WhatsApp Text Button Type', 'simple-contact-bar'),
        'simple_contact_bar_settings_selectbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'whatsapp_settings_section',
        array(

            'name'        => 'simple_contact_bar_whatsapp_button_type', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_whatsapp_button_type']),
            'options'     => array(
                'onlyicon'  => __('Only Icon', 'simple-contact-bar'),
                'onlytitle'   => __('Only Title', 'simple-contact-bar'),
                'iconwithtitle'   => __('Icon With Title', 'simple-contact-bar')
            ),
            'option_name' => $option_name
        )
    );


    // Whatsapp Button Animation
    add_settings_field(
        'simple_contact_bar_whatsapp_button_animation',
        __('Enable WhatsApp Button Animation', 'simple-contact-bar'),
        'simple_contact_bar_settings_checkbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'whatsapp_settings_section',
        array(

            'name'        => 'simple_contact_bar_whatsapp_button_animation', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_whatsapp_button_animation']),
            'option_name' => $option_name
        )
    );

    // Whatsapp Icon Animation
    add_settings_field(
        'simple_contact_bar_whatsapp_icon_animation',
        __('Enable WhatsApp Icon Animation', 'simple-contact-bar'),
        'simple_contact_bar_settings_checkbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'whatsapp_settings_section',
        array(

            'name'        => 'simple_contact_bar_whatsapp_icon_animation', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_whatsapp_icon_animation']),
            'option_name' => $option_name
        )
    );



    /* Button Settings Section */
    add_settings_section(
        'buttons_settings_section',
        __('Button Display Settings', 'simple-contact-bar'),
        'simple_contact_bar_settings_buttons_section_callback',
        'simple_contact_bar_settings_page'
    );


    // Enable Buttons
    add_settings_field(
        'simple_contact_bar_buttons_enable',
        __('Enable Buttons', 'simple-contact-bar'),
        'simple_contact_bar_settings_checkbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'buttons_settings_section',
        array(
            'name'        => 'simple_contact_bar_buttons_enable', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_buttons_enable']),
            'option_name' => $option_name
        )
    );


    // Button Style
    add_settings_field(
        'simple_contact_bar_button_style',
        __('Button View', 'simple-contact-bar'),
        'simple_contact_bar_settings_selectbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'buttons_settings_section',
        array(
            'name'        => 'simple_contact_bar_button_style', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_button_style']),
            'options'     => array(
                'circle'  => __('Rounded Circle', 'simple-contact-bar'),
                'radius-square'   => __('Oval Corner Square', 'simple-contact-bar'),
                'flat-square'   => __('Flat Square', 'simple-contact-bar')
            ),
            'option_name' => $option_name
        )
    );

    // Button Display
    add_settings_field(
        'simple_contact_bar_button_display_style',
        __('Button Display Block', 'simple-contact-bar'),
        'simple_contact_bar_settings_selectbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'buttons_settings_section',
        array(
            'name'        => 'simple_contact_bar_button_display_style', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_button_display_style']),
            'options'     => array(
                'grid'  => __('Grid', 'simple-contact-bar'),
                'inline'   => __('Inline', 'simple-contact-bar')
            ),
            'option_name' => $option_name
        )
    );

    // Enable Button Border
    add_settings_field(
        'simple_contact_bar_button_border_enable',
        __('Enable Button Border', 'simple-contact-bar'),
        'simple_contact_bar_settings_checkbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'buttons_settings_section',
        array(
            'name'        => 'simple_contact_bar_button_border_enable', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_button_border_enable']),
            'option_name' => $option_name
        )
    );

    // Button Border Width
    add_settings_field(
        'simple_contact_bar_button_border_width',
        __('Button Border Width', 'simple-contact-bar'),
        'simple_contact_bar_settings_number_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'buttons_settings_section',
        array(
            'name'        => 'simple_contact_bar_button_border_width', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_button_border_width']),
            'option_name' => $option_name
        )
    );

    // Button Border Type
    add_settings_field(
        'simple_contact_bar_button_border_style',
        __('Button Border Style', 'simple-contact-bar'),
        'simple_contact_bar_settings_selectbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'buttons_settings_section',
        array(
            'name'        => 'simple_contact_bar_button_border_style', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_button_border_style']),
            'options'     => array(
                'solid'  => __('Solid', 'simple-contact-bar'),
                'dotted'   => __('Dotted', 'simple-contact-bar'),
                'dashed'   => __('Dashed', 'simple-contact-bar'),
                'double'   => __('Double', 'simple-contact-bar'),
                'groove'   => __('Groove', 'simple-contact-bar'),
                'ridge'   => __('Ridge', 'simple-contact-bar'),
                'inset'   => __('Inset', 'simple-contact-bar'),
                'outset'   => __('Outset', 'simple-contact-bar'),
            ),
            'option_name' => $option_name
        )
    );

    // Button Border Color
    add_settings_field(
        'simple_contact_bar_button_border_color',
        __('Button Border Color', 'simple-contact-bar'),
        'simple_contact_bar_settings_color_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'buttons_settings_section',
        array(
            'name'        => 'simple_contact_bar_button_border_color', // value for 'name' attribute
            'value'       => sanitize_hex_color($data['simple_contact_bar_button_border_color']),
            'option_name' => $option_name
        )
    );


    // Button Devices
    add_settings_field(
        'simple_contact_bar_button_display_devices',
        __('Activate Butons On', 'simple-contact-bar'),
        'simple_contact_bar_settings_selectbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'buttons_settings_section',
        array(
            'name'        => 'simple_contact_bar_button_display_devices', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_button_display_devices']),
            'options'     => array(
                'all'  => __('All Devices', 'simple-contact-bar'),
                'mobile'   => __('Mobile Devices', 'simple-contact-bar')
            ),
            'option_name' => $option_name
        )
    );

    /* Popup Settings Section */
    add_settings_section(
        'popup_settings_section',
        __('Popup Display Settings', 'simple-contact-bar'),
        'simple_contact_bar_settings_popup_section_callback',
        'simple_contact_bar_settings_page'
    );


    // Enable Popup
    add_settings_field(
        'simple_contact_bar_popup_enable',
        __('Enable Popup', 'simple-contact-bar'),
        'simple_contact_bar_settings_checkbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'popup_settings_section',
        array(
            'name'        => 'simple_contact_bar_popup_enable', // value for 'name' attribute
            'value'       => sanitize_text_field($data['simple_contact_bar_popup_enable']),
            'option_name' => $option_name
        )
    );


    //  Popup Title
    add_settings_field(
        'simple_contact_bar_popup_title',
        __('Popup Title', 'simple-contact-bar'),
        'simple_contact_bar_settings_text_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'popup_settings_section',
        array(
            'name'        => 'simple_contact_bar_popup_title', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_popup_title']),
            'option_name' => $option_name
        )
    );

    // Popup Title Color
    add_settings_field(
        'simple_contact_bar_popup_title_text_color',
        __('Popup Title Color', 'simple-contact-bar'),
        'simple_contact_bar_settings_color_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'popup_settings_section',
        array(
            'name'        => 'simple_contact_bar_popup_title_text_color', // value for 'name' attribute
            'value'       => sanitize_hex_color($data['simple_contact_bar_popup_title_text_color']),
            'option_name' => $option_name
        )
    );

    // Popup Text
    add_settings_field(
        'simple_contact_bar_popup_text',
        __('Popup Text', 'simple-contact-bar'),
        'simple_contact_bar_settings_text_area_render',
        'simple_contact_bar_settings_page',  // menu slug
        'popup_settings_section',
        array(
            'name'        => 'simple_contact_bar_popup_text', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_popup_text']),
            'option_name' => $option_name
        )
    );
    // Popup Text Color
    add_settings_field(
        'simple_contact_bar_popup_text_color',
        __('Popup Text Color', 'simple-contact-bar'),
        'simple_contact_bar_settings_color_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'popup_settings_section',
        array(
            'name'        => 'simple_contact_bar_popup_text_color', // value for 'name' attribute
            'value'       => sanitize_hex_color($data['simple_contact_bar_popup_text_color']),
            'option_name' => $option_name
        )
    );


    // Popup Bg Color
    add_settings_field(
        'simple_contact_bar_popup_background_color',
        __('Popup Background Color', 'simple-contact-bar'),
        'simple_contact_bar_settings_color_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'popup_settings_section',
        array(
            'name'        => 'simple_contact_bar_popup_background_color', // value for 'name' attribute
            'value'       => sanitize_hex_color($data['simple_contact_bar_popup_background_color']),
            'option_name' => $option_name
        )
    );

    // Popup Overlay Color
    add_settings_field(
        'simple_contact_bar_popup_overlay_color',
        __('Popup Overlay Background Color', 'simple-contact-bar'),
        'simple_contact_bar_settings_color_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'popup_settings_section',
        array(
            'name'        => 'simple_contact_bar_popup_overlay_color', // value for 'name' attribute
            'value'       => sanitize_hex_color($data['simple_contact_bar_popup_overlay_color']),
            'option_name' => $option_name
        )
    );

    // Popup Border Width
    add_settings_field(
        'simple_contact_bar_popup_border_width',
        __('Popup Border Width', 'simple-contact-bar'),
        'simple_contact_bar_settings_number_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'popup_settings_section',
        array(
            'name'        => 'simple_contact_bar_popup_border_width', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_popup_border_width']),
            'option_name' => $option_name
        )
    );

    // Popup Border Style
    add_settings_field(
        'simple_contact_bar_popup_border_style',
        __('Popup Border Style', 'simple-contact-bar'),
        'simple_contact_bar_settings_selectbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'popup_settings_section',
        array(
            'name'        => 'simple_contact_bar_popup_border_style', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_popup_border_style']),
            'options'     => array(
                'solid'  => __('Solid', 'simple-contact-bar'),
                'dotted'   => __('Dotted', 'simple-contact-bar'),
                'dashed'   => __('Dashed', 'simple-contact-bar'),
                'double'   => __('Double', 'simple-contact-bar'),
                'groove'   => __('Groove', 'simple-contact-bar'),
                'ridge'   => __('Ridge', 'simple-contact-bar'),
                'inset'   => __('Inset', 'simple-contact-bar'),
                'outset'   => __('Outset', 'simple-contact-bar'),
            ),
            'option_name' => $option_name
        )
    );

    // Popup Border Color
    add_settings_field(
        'simple_contact_bar_popup_border_color',
        __('Popup Border Color', 'simple-contact-bar'),
        'simple_contact_bar_settings_color_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'popup_settings_section',
        array(
            'name'        => 'simple_contact_bar_popup_border_color', // value for 'name' attribute
            'value'       => sanitize_hex_color($data['simple_contact_bar_popup_border_color']),
            'option_name' => $option_name
        )
    );

    // Popup Box Shadow Color
    add_settings_field(
        'simple_contact_bar_popup_box_shadow_color',
        __('Popup Box Shadow Color', 'simple-contact-bar'),
        'simple_contact_bar_settings_color_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'popup_settings_section',
        array(
            'name'        => 'simple_contact_bar_popup_box_shadow_color', // value for 'name' attribute
            'value'       => sanitize_hex_color($data['simple_contact_bar_popup_box_shadow_color']),
            'option_name' => $option_name
        )
    );

    // Popup Style
    add_settings_field(
        'simple_contact_bar_popup_view_style',
        __('Popup View Style', 'simple-contact-bar'),
        'simple_contact_bar_settings_selectbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'popup_settings_section',
        array(
            'name'        => 'simple_contact_bar_popup_view_style', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_popup_view_style']),
            'options'     => array(
                'onpageload'  => __('On Page Load', 'simple-contact-bar'),
                'afterdelayed'   => __('After Delayed X Seconds', 'simple-contact-bar'),
                'onlinkclick'   => __('On Any Click', 'simple-contact-bar')
            ),
            'option_name' => $option_name
        )
    );

    // Popup Delay Time
    add_settings_field(
        'simple_contact_bar_popup_delay_time',
        __('Popup Delay Time in Milisecond', 'simple-contact-bar'),
        'simple_contact_bar_settings_number_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'popup_settings_section',
        array(
            'name'        => 'simple_contact_bar_popup_delay_time', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_popup_delay_time']),
            'option_name' => $option_name
        )
    );

    // Popup Devices
    add_settings_field(
        'simple_contact_bar_popup_display_devices',
        __('Enable Popup On', 'simple-contact-bar'),
        'simple_contact_bar_settings_selectbox_input_render',
        'simple_contact_bar_settings_page',  // menu slug
        'popup_settings_section',
        array(
            'name'        => 'simple_contact_bar_popup_display_devices', // value for 'name' attribute
            'value'       => esc_attr($data['simple_contact_bar_popup_display_devices']),
            'options'     => array(
                'all'  => __('All Devices', 'simple-contact-bar'),
                'afterdelayed'   => __('Mobile Devices', 'simple-contact-bar')
            ),
            'option_name' => $option_name
        )
    );
}

add_action('admin_init', 'simple_contact_bar_settings');


// PLUGIN ACTIVATION SECTION BEFORE
function simple_contact_bar_settings_section_enable_callback()
{
    print __('A simple plugin that adds a click to call now button and whatsapp contact link button to the bottom of your site and Also supports shortcodes.', 'simple-contact-bar');
}

// PHONE SETTINGS SECTION BEFORE
function simple_contact_bar_settings_section_phone_callback()
{
    print '<p>' . __('Make your Click To Call Button settings here.', 'simple-contact-bar') . '</p>';
}

// WHATSAPP SETTINGS SECTION BEFORE
function simple_contact_bar_settings_section_whatsapp_callback($args)
{
    print '<p>' . __('Make your WhatsApp Text Button settings here.', 'simple-contact-bar') . '</p>';
}

// BUTTONS SETTINGS SECTION BEFORE
function simple_contact_bar_settings_buttons_section_callback()
{
    print '<p>' . __('Make your Buttons general settings here.', 'simple-contact-bar') . '</p>';
}

// POPUP SETTINGS SECTION BEFORE
function simple_contact_bar_settings_popup_section_callback()
{
    print '<p>' . __('Make your PopUP settings here.', 'simple-contact-bar') . '</p>';
}


// Checkbox Input Render
function simple_contact_bar_settings_checkbox_input_render($args)
{
    printf(
        '<input name="%1$s[%2$s]" type="hidden" value="0" /> <input name="%1$s[%2$s]" type="checkbox" value="1" %4$s />',
        $args['option_name'],
        $args['name'],
        $args['value'],
        checked("1", $args['value'], FALSE)
    );
}

// Text Input Render
function simple_contact_bar_settings_text_input_render($args)
{
    printf(
        '<input type="text" name="%1$s[%2$s]" value="%3$s">',
        $args['option_name'],
        $args['name'],
        $args['value']
    );
}
// Text Area Render
function simple_contact_bar_settings_text_area_render($args)
{
    printf(
        '<textarea type="number" name="%1$s[%2$s]" rows="5" cols="50">%3$s</textarea>',
        $args['option_name'],
        $args['name'],
        $args['value']
    );
}
// Number Input Render
function simple_contact_bar_settings_number_input_render($args)
{
    printf(
        '<input type="number" name="%1$s[%2$s]" value="%3$s">',
        $args['option_name'],
        $args['name'],
        $args['value']
    );
}
// Color Picker Input Render
function simple_contact_bar_settings_color_input_render($args)
{
    printf(
        '<input type="color" name="%1$s[%2$s]" value="%3$s">',
        $args['option_name'],
        $args['name'],
        $args['value']
    );
}

// Selectbox Render
function simple_contact_bar_settings_selectbox_input_render($args)
{
    printf(
        '<select name="%1$s[%2$s]">',
        $args['option_name'],
        $args['name']
    );

    foreach ($args['options'] as $val => $title)
        printf(
            '<option value="%1$s" %2$s>%3$s</option>',
            $val,
            selected($val, $args['value'], FALSE),
            $title
        );

    print '</select>';
}

// Get Current Page Title And Url
function scb_get_current_page_info()
{
    // Check Current Page title And Url
    global $wp;
    $page['link'] = add_query_arg($wp->query_string, '', home_url($wp->request));
    $page['title'] = wp_get_document_title();
    return $page;
}

// Simple Contact Bar Button Renderer
function scb_render_contact_bar()
{
    if (!is_admin()) {

        // Get Options
        $scb_get_options = get_option('simple_contact_bar_settings');

        // Check Simple Contact Bar
        if (is_array($scb_get_options) && esc_attr($scb_get_options['simple_contact_bar_enable']) != null) {

            // Start Generating HTML Output
            $html = '';
            $scb_javascripts = '';
			$is_button_border_active ='';
            $phone_call_button = '';
            $whatsapp_text_button = '';
            $popup_whatsapp_text_button = '';
			$button_view_class = '';
            $border_width = '';
            $border_color = '';
            $border_style = '';
            $button_border_style = '';
			$button_animation = '';
			$icon_animation = '';
			$current_page_title = '';
			$current_page_link = '';
            $phone_button_icon = '';
            $phone_button_title_text = '';
            $popup_phone_call_button = '';
            $whatsapp_button_icon = '';
            $whatsapp_button_title_text = '';
            $popup_whatsapp_text_button = '';
            $phone_number = '';
            $phone_button_title = '';
            $phone_text_color = '';
            $phone_background_color = '';
            $phone_button_position_class = '';
            $phone_button_size = '';
            $phone_button_type = '';			
			$whatsapp_number = '';
			$whatsapp_button_title = '';
			$whatsapp_text_color = '';
			$whatsapp_background_color = '';
			$whatsapp_button_position_class = '';
			$whatsapp_button_size = '';
			$whatsapp_button_type = '';
			$whatsapp_message_type = '';
			$whatsapp_button_animation = '';
			$whatsapp_icon_animation = '';
			$whatsapp_message = '';
			$simple_contact_bar_buttons_display='';
			$message = '';

            // Get Button Classes
            $button_view_class = sanitize_text_field($scb_get_options['simple_contact_bar_button_style'], 'radius-square');

            // Check Button Border
            $is_button_border_active = esc_attr($scb_get_options['simple_contact_bar_button_border_enable']);

            if ($is_button_border_active) {
                $border_width = esc_attr($scb_get_options['simple_contact_bar_button_border_width']);
                $border_style = sanitize_text_field($scb_get_options['simple_contact_bar_button_border_style']);
                $border_color = sanitize_hex_color($scb_get_options['simple_contact_bar_button_border_color']);

                if ($border_width && $border_style && $border_color) {
                    $button_border_style = ' border:' . $border_width . 'px; border-style:' . $border_style . '; border-color:' . $border_color . ';';
                }
            }

            // Check Phone Call Button
            $is_phone_active = esc_attr($scb_get_options['simple_contact_bar_phone_button_enable']);

            if ($is_phone_active) {
                $phone_number = sanitize_text_field($scb_get_options['simple_contact_bar_phone_number']);
                $phone_button_title = sanitize_text_field($scb_get_options['simple_contact_bar_phone_title']);
                $phone_text_color = sanitize_hex_color($scb_get_options['simple_contact_bar_phone_text_color']);
                $phone_background_color = sanitize_hex_color($scb_get_options['simple_contact_bar_phone_bg_color']);
                $phone_button_position_class = sanitize_text_field($scb_get_options['simple_contact_bar_phone_button_position']);
                $phone_button_size = sanitize_text_field($scb_get_options['simple_contact_bar_phone_button_size']);
                $phone_button_type = sanitize_text_field($scb_get_options['simple_contact_bar_phone_button_type']);

                // Check Phone Button Type
                if ($phone_button_type === 'onlyicon' || $phone_button_type === 'iconwithtitle') {
                    $phone_button_icon = '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
			                       <path d="M280 0C408.1 0 512 103.9 512 232c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-101.6-82.4-184-184-184c-13.3 0-24-10.7-24-24s10.7-24 24-24zm8 192a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm-32-72c0-13.3 10.7-24 24-24c75.1 0 136 60.9 136 136c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-48.6-39.4-88-88-88c-13.3 0-24-10.7-24-24zM117.5 1.4c19.4-5.3 39.7 4.6 47.4 23.2l40 96c6.8 16.3 2.1 35.2-11.6 46.3L144 207.3c33.3 70.4 90.3 127.4 160.7 160.7L345 318.7c11.2-13.7 30-18.4 46.3-11.6l96 40c18.6 7.7 28.5 28 23.2 47.4l-24 88C481.8 499.9 466 512 448 512C200.6 512 0 311.4 0 64C0 46 12.1 30.2 29.5 25.4l88-24z"/>
			                       </svg>';
                }

                $scb_only_icon_class = '';
                if ($phone_button_type === 'onlyicon') {
                    $scb_only_icon_class = ' scb-only-icon';
                }

                if ($phone_button_type === 'onlytitle' || $phone_button_type === 'iconwithtitle') {
                    $phone_button_title_text = '<span class="scb-button-text">' . $phone_button_title . '</span>';
                }

                // Button Animation
                $phone_button_animation = esc_attr($scb_get_options['simple_contact_bar_phone_button_animation']);
                $phone_icon_animation = esc_attr($scb_get_options['simple_contact_bar_phone_icon_animation']);

                if ($phone_button_animation) {
                    $button_animation = ' scb-button-animation';
                }

                if ($phone_icon_animation) {
                    $icon_animation = ' scb-button-icon-animation';
                }

                // Generate Phone Button
                $phone_call_button = '<a id="scb-phone-button" class="scb-button scb-button-' . $button_view_class . ' scb-' . $phone_button_position_class . ' scb-button-' . $phone_button_size . '' . $button_animation . '' . $icon_animation . '' . $scb_only_icon_class . '" href="tel:' . $phone_number . '" style="color: ' . $phone_text_color . '; background-color: ' . $phone_background_color . ';' . $button_border_style . '" title="' . $phone_button_title . '">
			                       ' . $phone_button_icon . '' . $phone_button_title_text . '
			                       </a>';

                // Popup Generate Phone Button
                $popup_phone_call_button = '<a id="scb-popup-phone-button" class="scb-button scb-button-' . $button_view_class . ' scb-' . $phone_button_position_class . ' scb-button-' . $phone_button_size . '' . $button_animation . '' . $icon_animation . '' . $scb_only_icon_class . '" href="tel:' . $phone_number . '" style="color: ' . $phone_text_color . '; background-color: ' . $phone_background_color . ';' . $button_border_style . '" title="' . $phone_button_title . '">
			                       ' . $phone_button_icon . '' . $phone_button_title_text . '
			                       </a>';
            }

            // Check WhatsApp Button
            $is_whatsapp_active = esc_attr($scb_get_options['simple_contact_bar_whatsapp_button_enable']);

            if ($is_whatsapp_active) {

                $whatsapp_number = sanitize_text_field($scb_get_options['simple_contact_bar_whatsapp_number']);
                $whatsapp_button_title = sanitize_text_field($scb_get_options['simple_contact_bar_whatsapp_title']);
                $whatsapp_text_color = sanitize_hex_color($scb_get_options['simple_contact_bar_whatsapp_text_color']);
                $whatsapp_background_color = sanitize_hex_color($scb_get_options['simple_contact_bar_whatsapp_bg_color']);
                $whatsapp_button_position_class = sanitize_text_field($scb_get_options['simple_contact_bar_whatsapp_button_position']);
                $whatsapp_button_size = sanitize_text_field($scb_get_options['simple_contact_bar_whatsapp_button_size']);
                $whatsapp_button_type = sanitize_text_field($scb_get_options['simple_contact_bar_whatsapp_button_type']);

                // Check Phone Button Type
                if ($whatsapp_button_type === 'onlyicon' || $whatsapp_button_type === 'iconwithtitle') {
                    $whatsapp_button_icon = '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
<path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
</svg>';
                }

                $scb_only_icon_class = '';
				
                if ($whatsapp_button_type === 'onlyicon') {
                    $scb_only_icon_class = ' scb-only-icon';
                }

                if ($whatsapp_button_type === 'onlytitle' || $whatsapp_button_type === 'iconwithtitle') {
                    $whatsapp_button_title_text = '<span class="scb-button-text">' . $whatsapp_button_title . '</span>';
                }


                $whatsapp_message_type = sanitize_text_field($scb_get_options['simple_contact_bar_whatsapp_message_type']);

                if ($whatsapp_message_type == 'url') {
                    $scb_get_page = scb_get_current_page_info();
                    $current_page_title = $scb_get_page['title'];
                    $current_page_link = $scb_get_page['link'];

                    $whatsapp_message = '?text=' . urlencode($current_page_title . ' - ' . $current_page_link);
                }

                if ($whatsapp_message_type == 'text') {

                    $message = sanitize_text_field($scb_get_options['simple_contact_bar_whatsapp_message']);

                    $whatsapp_message = '?text=' . urlencode($message);
                }
				
				$button_animation = '';
				$icon_animation = '';

                $whatsapp_button_animation = esc_attr($scb_get_options['simple_contact_bar_whatsapp_button_animation']);
                $whatsapp_icon_animation = esc_attr($scb_get_options['simple_contact_bar_whatsapp_icon_animation']);

                if ($whatsapp_button_animation) {
                    $button_animation = ' scb-button-animation';
                }

                if ($whatsapp_icon_animation) {
                    $icon_animation = ' scb-button-icon-animation';
                }


                // Generate Whatsapp Button
                $whatsapp_text_button = '<a id="scb-whatsapp-button" href="https://wa.me/' . $whatsapp_number . '' . $whatsapp_message . '" class="scb-button scb-button-' . $button_view_class . ' scb-' . $whatsapp_button_position_class . ' scb-button-' . $whatsapp_button_size . '' . $button_animation . '' . $icon_animation . '' . $scb_only_icon_class . '" style="color: ' . $whatsapp_text_color . '; background-color: ' . $whatsapp_background_color . ';' . $button_border_style . '" title="' . $whatsapp_button_title . '" rel="external nofollor" target="_blank">
			                          ' . $whatsapp_button_icon . '' . $whatsapp_button_title_text . '
									 </a>';
                // Popup Whatsapp Button
                $popup_whatsapp_text_button = '<a id="scb-popup-whatsapp-button" href="https://wa.me/' . $whatsapp_number . '' . $whatsapp_message . '" class="scb-button scb-button-' . $button_view_class . ' scb-' . $whatsapp_button_position_class . ' scb-button-' . $whatsapp_button_size . '' . $button_animation . '' . $icon_animation . '' . $scb_only_icon_class . '" style="color: ' . $whatsapp_text_color . '; background-color: ' . $whatsapp_background_color . ';' . $button_border_style . '" title="' . $whatsapp_button_title . '" rel="external nofollow" target="_blank">
			                          ' . $whatsapp_button_icon . '' . $whatsapp_button_title_text . '
									 </a>';
            }

            // Prepare HTML Content
            // Check Show Buttons Active
            $is_simple_contact_bar_buttons_enable = esc_attr($scb_get_options['simple_contact_bar_buttons_enable']);

            if ($is_simple_contact_bar_buttons_enable) {

                //Check Phone Or Whatsapp Avtive
                if ($is_phone_active || $is_whatsapp_active) {

                    // Check Devices
                    $get_button_device = esc_attr($scb_get_options['simple_contact_bar_button_display_devices']);
                    $show_buttons = false;
                    if ($get_button_device === 'all') {
                        $show_buttons = true;
                    } elseif ($get_button_device === 'mobile' && wp_is_mobile()) {
                        $show_buttons = true;
                    }

                    if ($show_buttons) {
                        //SCB Contact Bar
                        if ($phone_button_position_class === $whatsapp_button_position_class) {

                            $simple_contact_bar_buttons_display = esc_attr($scb_get_options['simple_contact_bar_button_display_style']);

                            $html .= '<div class="scb-contact-bar scb-gab scb-' . $phone_button_position_class . ' scb-' . $simple_contact_bar_buttons_display . '">';
                            $html .= $phone_call_button;
                            $html .= $whatsapp_text_button;
                            $html .= '</div>';
                        } else {
                            $html .= '<div class="scb-contact-bar scb-phone">';
                            $html .= $phone_call_button;
                            $html .= '</div>';
                            $html .= '<div class="scb-contact-bar scb-whatsapp">';
                            $html .= $whatsapp_text_button;
                            $html .= '</div>';
                        }
                    }
                }
            }

            // Check Popup Active
            $is_scb_popup_active = esc_attr($scb_get_options['simple_contact_bar_popup_enable']);

            if ($is_scb_popup_active) {

                // Check Phone Or WhatsApp Active
                if ($is_phone_active || $is_whatsapp_active) {

                    // Check Popup Devices
                    $get_popup_device = esc_attr($scb_get_options['simple_contact_bar_popup_display_devices']);
                    $show_popup = false;

                    if ($get_popup_device === 'all') {
                        $show_popup = true;
                    } elseif ($get_popup_device === 'mobile' && wp_is_mobile()) {
                        $show_popup = true;
                    }

                    if ($show_popup) {

                        // Popup Design
                        $popup_overlay_color = sanitize_hex_color($scb_get_options['simple_contact_bar_popup_overlay_color']);
                        $popup_background_color = sanitize_hex_color($scb_get_options['simple_contact_bar_popup_background_color']);
                        $popup_border_color = sanitize_hex_color($scb_get_options['simple_contact_bar_popup_border_color']);
                        $popup_border_width = sanitize_text_field($scb_get_options['simple_contact_bar_popup_border_width']);
                        $popup_border_style = sanitize_text_field($scb_get_options['simple_contact_bar_popup_border_style']);
                        $popup_box_shadow_color = sanitize_hex_color($scb_get_options['simple_contact_bar_popup_box_shadow_color']);
                        $popup_view_style = sanitize_text_field($scb_get_options['simple_contact_bar_popup_view_style']);
                        $popup_afterdelayed_time = sanitize_text_field($scb_get_options['simple_contact_bar_popup_delay_time']);

                        // Popup cuntent
                        $popup_title = sanitize_text_field($scb_get_options['simple_contact_bar_popup_title']);
                        $popup_title_color = sanitize_hex_color($scb_get_options['simple_contact_bar_popup_title_text_color']);
                        $popup_text_before_buttons = wp_kses_post($scb_get_options['simple_contact_bar_popup_text']);
                        $popup_text_color = wp_kses_post($scb_get_options['simple_contact_bar_popup_text_color']);


                        $html .= '<div class="scb-popup-overlay" style="background-color:' . $popup_overlay_color . ';">
			           <div class="scb-popup-content" style="background-color:' . $popup_background_color . '; border:' . $popup_border_width . 'px;border-color:' . $popup_border_color . '; border-style:' . $popup_border_style . '; box-shadow: 0 0 10px ' . $popup_box_shadow_color . ';">
					    <button class="scb-popup-close-button" style="color:' . $popup_title_color . '; opacity:0.8;">×</button>
						 <div class="scb-popup-header">
						  <h2 style="color:' . $popup_title_color . ';">' . $popup_title . '</h2>
						 </div>';
                        if (!empty($popup_text_before_buttons)) {
                            $html .= '			 <div class="scb-popup-scrollable-content" style="color:' . $popup_text_color . '">
						  ' . $popup_text_before_buttons . '
						 </div>';
                        }

                        $html .= '	<div class="scb-popup-footer-buttons">
						 ' . $popup_phone_call_button . '
						 ' . $popup_whatsapp_text_button . '
						 </div>
						 <div class="scb-popup-footer">
						  <label for="scb-show-popup-again">
						   <input type="checkbox" id="scb-show-popup-again"> <span style="color:' . $popup_title_color . '; opacity:0.7; font-size:0.8rem;">' . __('Dismiss this notice.', 'simple-contact-bar') . '</span>
						  </label>
						 </div>
					</div>
				  </div>';

                        // Generate Popup Javascript
                        $scb_javascripts .= '
                localStorage.removeItem("scb-popup-expiration");
                
		  var popupOverlay = document.querySelector(".scb-popup-overlay");
		            var closeButton = document.querySelector(".scb-popup-close-button");
					var showPopupAgainCheckbox = document.getElementById("scb-show-popup-again");
					
					
					function showPopup() {
						
						 var expirationTime = localStorage.getItem("scb-popup-expiration");
						 var currentTime = new Date().getTime();
						 
						 if (!expirationTime || currentTime > parseInt(expirationTime)) {
							 popupOverlay.style.display = "flex";
							 }
							 }
							 
					function hidePopup() {
						 popupOverlay.style.display = "none";
						 }
						 
				    closeButton.addEventListener("click", hidePopup);
					
					showPopupAgainCheckbox.addEventListener("change", function() {
						if (this.checked) {
							var expirationTimeSet = new Date().getTime() + (60 * 60 * 1000);
							localStorage.setItem("scb-popup-expiration", expirationTimeSet);
							document.body.classList.removeItem("scb-popup-body");
							} else {
								localStorage.removeItem("scb-popup-expiration");
								}
								});
								
					';

                        // Get Popup View Style
                        if ($popup_view_style === 'onpageload') {

                            $scb_javascripts .= '
			window.addEventListener("load", function() {
				       showPopup();
					   });';
                        } elseif ($popup_view_style === 'afterdelayed') {

                            $scb_javascripts .= '
			window.addEventListener("load", function() {
				        
						setTimeout(function() {
							 showPopup();
							 }, ' . $popup_afterdelayed_time . ');
								
				      });
					  
					  ';
                        } elseif ($popup_view_style === 'onlinkclick') {


                            $scb_javascripts .= '
			var myTarget = ["a", "button","input", "textarea"];
			
			document.addEventListener("click", function(event) {
				if (!popupOverlay.contains(event.target)) {			
										
					var isMatch = myTarget.some(function(target) {
						return event.target.closest(target) !== null;
						});
						if (isMatch) {
							var expirationTime = localStorage.getItem("scb-popup-expiration");
							var currentTime = new Date().getTime();
						 
						 if (!expirationTime || currentTime > parseInt(expirationTime)) {
							event.preventDefault();
							 }
							 }
									
					showPopup();
					}
					});
					
					';
                        } else {
                            $scb_javascripts .= '
			window.addEventListener("load", function() {
				        
						setTimeout(function() {
							 showPopup();
							 }, 10000);
				
				
				      });
					  
					  ';
                        }
                    }
                }

                // Check $scb_javascripts
                if (!empty($scb_javascripts)) {

                    $html .= '<script type="text/javascript">';
                    $html .= $scb_javascripts;
                    $html .= '</script>';
                }
            }

            // Echoing HTML Output
            echo $html;
        }
    }
}

add_action('wp_footer', 'scb_render_contact_bar');



// SCB Phone Number Formatter
function formatPhoneNumber($phoneNumber)
{
    // Remove unnecessary characters from the number first
    $cleanNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

    // Format the number in national format
    $nationalFormat = '';

    // Handle different cases based on the length
    $length = strlen($cleanNumber);
    if ($length == 10) {
        // 10-digit number: (123) 456 7890
        $nationalFormat = '(' . substr($cleanNumber, 0, 3) . ') ' . substr($cleanNumber, 3, 3) . ' ' . substr($cleanNumber, 6);
    } elseif ($length == 11) {
        // 11-digit number: 1 (123) 456 7890
        $nationalFormat = substr($cleanNumber, 0, 1) . ' (' . substr($cleanNumber, 1, 3) . ') ' . substr($cleanNumber, 4, 3) . ' ' . substr($cleanNumber, 7);
    } elseif ($length == 12) {
        // 12-digit number: 10 (123) 456 7890
        $nationalFormat = substr($cleanNumber, 0, 2) . ' (' . substr($cleanNumber, 2, 3) . ') ' . substr($cleanNumber, 4, 3) . ' ' . substr($cleanNumber, 7);
    } elseif ($length == 13) {
        // 13-digit number: +10 (123) 456-78901
        $nationalFormat =  substr($cleanNumber, 0, 2) . ' (' . substr($cleanNumber, 1, 3) . ') ' . substr($cleanNumber, 4, 3) . ' ' . substr($cleanNumber, 8);
    }
    //Return National Format
    return $nationalFormat;
}


// SHORTCODES
// Display Phone Number ShortCode
function simple_contact_bar_phone_number_render()
{

    // Get Options
    $scb_get_options = get_option('simple_contact_bar_settings');

    // Check If Plugin Enabled
    if (is_array($scb_get_options) && esc_attr($scb_get_options['simple_contact_bar_enable']) != null) {
        $simple_contact_bar_phone_number =  sanitize_text_field($scb_get_options['simple_contact_bar_phone_number']);
    } else {
        $simple_contact_bar_phone_number = "";
    }



    // Return Phone Number
    return $simple_contact_bar_phone_number;
}
add_shortcode('simple_contact_bar_phone_number', 'simple_contact_bar_phone_number_render');

// Display Phone Number ShortCode International Formatted
function simple_contact_bar_phone_number_format_render()
{
    // Get Options
    $scb_get_options = get_option('simple_contact_bar_settings');
    // Check If Plugin Enabled
    if (is_array($scb_get_options) && esc_attr($scb_get_options['simple_contact_bar_enable']) != null) {
        $simple_contact_bar_phone_number =  formatPhoneNumber(sanitize_text_field($scb_get_options['simple_contact_bar_phone_number']));
    } else {
        $simple_contact_bar_phone_number = "";
    }
    // Return Phone Number
    return $simple_contact_bar_phone_number;
}
add_shortcode('simple_contact_bar_phone_number_format', 'simple_contact_bar_phone_number_format_render');



// Display Phone Link ShortCode
function simple_contact_bar_phone_link_render()
{
    // Get Options
    $scb_get_options = get_option('simple_contact_bar_settings');

    // Check If Plugin Enabled
    if (is_array($scb_get_options) && esc_attr($scb_get_options['simple_contact_bar_enable']) != null) {

        // Sanitize Options
        $simple_contact_bar_phone_number_link = '<a href="tel:' . sanitize_text_field($scb_get_options['simple_contact_bar_phone_number']) . '">' . sanitize_text_field($scb_get_options['simple_contact_bar_phone_title']) . '</a>';
    } else {
        $simple_contact_bar_phone_number_link = "";
    }
    // Return Phone Numbber Link
    return $simple_contact_bar_phone_number_link;
}
add_shortcode('simple_contact_bar_phone_link', 'simple_contact_bar_phone_link_render');


// Display Phone Button ShortCode
function simple_contact_bar_phone_button_render()
{
	$button_view_class ='';
	$is_button_border_active ='';
	$border_width ='';
	$border_style ='';
	$border_color ='';
	$button_border_style ='';
	$phone_number ='';
	$phone_button_title ='';
	$phone_text_color ='';
	$phone_background_color ='';
	$phone_button_size ='';
	$phone_button_type ='';
	$phone_button_icon ='';
	$scb_only_icon_class = '';
	$phone_button_title_text = '';
	$button_animation = '';
	$icon_animation = '';
	$simple_contact_bar_phone_number_button = "";
	
    // Get Options
    $scb_get_options = get_option('simple_contact_bar_settings');
    // Check If Plugin Enabled
    if (is_array($scb_get_options) && esc_attr($scb_get_options['simple_contact_bar_enable']) != null) {

        // Get Button Classes
        $button_view_class = sanitize_text_field($scb_get_options['simple_contact_bar_button_style']);

        // Check Button Border
        $is_button_border_active = esc_attr($scb_get_options['simple_contact_bar_button_border_enable']);

        // Get Button Border Styles
        if ($is_button_border_active) {
            $border_width = esc_attr($scb_get_options['simple_contact_bar_button_border_width']);
            $border_style = sanitize_text_field($scb_get_options['simple_contact_bar_button_border_style']);
            $border_color = sanitize_hex_color($scb_get_options['simple_contact_bar_button_border_color']);

            $button_border_style = ' border:' . $border_width . 'px; border-style:' . $border_style . '; border-color:' . $border_color . ';';
        }

        // Get Button Settings
        $phone_number = sanitize_text_field($scb_get_options['simple_contact_bar_phone_number']);
        $phone_button_title = sanitize_text_field($scb_get_options['simple_contact_bar_phone_title']);
        $phone_text_color = sanitize_hex_color($scb_get_options['simple_contact_bar_phone_text_color']);
        $phone_background_color = sanitize_hex_color($scb_get_options['simple_contact_bar_phone_bg_color']);
        $phone_button_size = sanitize_text_field($scb_get_options['simple_contact_bar_phone_button_size']);
        $phone_button_type = sanitize_text_field($scb_get_options['simple_contact_bar_phone_button_type']);

        // Check Phone Button Type
        if ($phone_button_type === 'onlyicon' || $phone_button_type === 'iconwithtitle') {
            $phone_button_icon = '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
			                       <path d="M280 0C408.1 0 512 103.9 512 232c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-101.6-82.4-184-184-184c-13.3 0-24-10.7-24-24s10.7-24 24-24zm8 192a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm-32-72c0-13.3 10.7-24 24-24c75.1 0 136 60.9 136 136c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-48.6-39.4-88-88-88c-13.3 0-24-10.7-24-24zM117.5 1.4c19.4-5.3 39.7 4.6 47.4 23.2l40 96c6.8 16.3 2.1 35.2-11.6 46.3L144 207.3c33.3 70.4 90.3 127.4 160.7 160.7L345 318.7c11.2-13.7 30-18.4 46.3-11.6l96 40c18.6 7.7 28.5 28 23.2 47.4l-24 88C481.8 499.9 466 512 448 512C200.6 512 0 311.4 0 64C0 46 12.1 30.2 29.5 25.4l88-24z"/>
			                       </svg>';
        }
		
        if ($phone_button_type === 'onlyicon') {
            $scb_only_icon_class = ' scb-only-icon';
        }


        if ($phone_button_type === 'onlytitle' || $phone_button_type === 'iconwithtitle') {
            $phone_button_title_text = '<span class="scb-button-text">' . $phone_button_title . '</span>';
        }

        // Button Animation
        $phone_button_animation = esc_attr($scb_get_options['simple_contact_bar_phone_button_animation']);
        $phone_icon_animation = esc_attr($scb_get_options['simple_contact_bar_phone_icon_animation']);

        if ($phone_button_animation) {
            $button_animation = ' scb-button-animation';
        }

        if ($phone_icon_animation) {
            $icon_animation = ' scb-button-icon-animation';
        }


        // Sanitize Options
        $simple_contact_bar_phone_number_button = '<a id="scb-phone-button" class="scb-button scb-button-' . $button_view_class . ' scb-button-' . $phone_button_size . '' . $button_animation . '' . $icon_animation . '' . $scb_only_icon_class . '" href="tel:' . $phone_number . '" style="color: ' . $phone_text_color . '; background-color: ' . $phone_background_color . ';' . $button_border_style . '" title="' . $phone_button_title . '">
			                       ' . $phone_button_icon . '' . $phone_button_title_text . '
			                       </a>';
    }
	
    // Return Phone Number
    return $simple_contact_bar_phone_number_button;
}
add_shortcode('simple_contact_bar_phone_button', 'simple_contact_bar_phone_button_render');


// Display Whatsapp Number ShortCode
function simple_contact_bar_whatsapp_number_render()
{
    $simple_contact_bar_whatsapp_number = "";
    // Get Options
    $scb_get_options = get_option('simple_contact_bar_settings');
    // Check If Plugin Enabled
    if (is_array($scb_get_options) && esc_attr($scb_get_options['simple_contact_bar_enable']) != null) {

        // Sanitize Options
        $simple_contact_bar_whatsapp_number = sanitize_text_field($scb_get_options['simple_contact_bar_whatsapp_number']);
    }

    // Return WhatsApp Number
    return $simple_contact_bar_whatsapp_number;
}
add_shortcode('simple_contact_bar_whatsapp_number', 'simple_contact_bar_whatsapp_number_render');

// Display Whatsapp Number ShortCode International Formated
function simple_contact_bar_whatsapp_number_format_render()
{
    $simple_contact_bar_whatsapp_number = "";
    // Get Options
    $scb_get_options = get_option('simple_contact_bar_settings');
    // Check If Plugin Enabled
    if (is_array($scb_get_options) && esc_attr($scb_get_options['simple_contact_bar_enable']) != null) {

        $simple_contact_bar_whatsapp_number = '+' . formatPhoneNumber(sanitize_text_field($scb_get_options['simple_contact_bar_whatsapp_number']));
    }

    // Return WhatsApp Number
    return $simple_contact_bar_whatsapp_number;
}
add_shortcode('simple_contact_bar_whatsapp_number_format', 'simple_contact_bar_whatsapp_number_format_render');


// Display Whatsapp Link ShortCode
function simple_contact_bar_whatsapp_link_render()
{
	$simple_contact_bar_whatsapp_number_link = "";
    // Get Options
    $scb_get_options = get_option('simple_contact_bar_settings');
    // Check If Plugin Enabled
    if (is_array($scb_get_options) && esc_attr($scb_get_options['simple_contact_bar_enable']) != null) {
        // Sanitize Options
        $simple_contact_bar_whatsapp_number_link = '<a rel="external nofollow" target="_blank" href="https://wa.me/' . sanitize_text_field($scb_get_options['simple_contact_bar_whatsapp_number']) . '">' . sanitize_text_field($scb_get_options['simple_contact_bar_whatsapp_title']) . '</a>';
    }
	
    // Return WhatsApp Link
    return $simple_contact_bar_whatsapp_number_link;
}
add_shortcode('simple_contact_bar_whatsapp_link', 'simple_contact_bar_whatsapp_link_render');


// Display WhatsApp Button ShortCode
function simple_contact_bar_whatsapp_button_render()
{
	$button_view_class = '';
	$is_button_border_active = '';
	$scb_only_icon_class = '';
	$border_width = '';
	$border_style = '';
	$border_color = '';
	$button_border_style = '';
	$button_animation = '';
	$icon_animation = '';
	$whatsapp_number = '';
	$whatsapp_button_title = '';
	$whatsapp_text_color = '';
	$whatsapp_background_color = '';
	$whatsapp_button_size = '';
	$whatsapp_button_type = '';
	$whatsapp_button_icon = '';
	$whatsapp_button_title_text = '';
	$whatsapp_button_animation = '';
	$whatsapp_icon_animation = '';
	$whatsapp_message = '';
	$whatsapp_message_type = '';
	$current_page_title = '';
	$current_page_link = '';
	$message = '';
	$simple_contact_bar_whatsapp_number_button = "";
	
    // Get Options
    $scb_get_options = get_option('simple_contact_bar_settings');
    // Check If Plugin Enabled
    if (is_array($scb_get_options) && esc_attr($scb_get_options['simple_contact_bar_enable']) != null) {

        // Get Button Classes
        $button_view_class = sanitize_text_field($scb_get_options['simple_contact_bar_button_style']);

        // Check Button Border
        $is_button_border_active = esc_attr($scb_get_options['simple_contact_bar_button_border_enable']);

        // Get Button Styles
        if ($is_button_border_active) {
            $border_width = esc_attr($scb_get_options['simple_contact_bar_button_border_width']);
            $border_style = sanitize_text_field($scb_get_options['simple_contact_bar_button_border_style']);
            $border_color = sanitize_hex_color($scb_get_options['simple_contact_bar_button_border_color']);

            $button_border_style = ' border:' . $border_width . 'px; border-style:' . $border_style . '; border-color:' . $border_color . ';';
        } 

        // Get WhatsApp Styles
        $whatsapp_number = sanitize_text_field($scb_get_options['simple_contact_bar_whatsapp_number']);
        $whatsapp_button_title = sanitize_text_field($scb_get_options['simple_contact_bar_whatsapp_title']);
        $whatsapp_text_color = sanitize_hex_color($scb_get_options['simple_contact_bar_whatsapp_text_color']);
        $whatsapp_background_color = sanitize_hex_color($scb_get_options['simple_contact_bar_whatsapp_bg_color']);
        $whatsapp_button_size = sanitize_text_field($scb_get_options['simple_contact_bar_whatsapp_button_size']);
        $whatsapp_button_type = sanitize_text_field($scb_get_options['simple_contact_bar_whatsapp_button_type']);

        // Check WhatsApp Icon Type
        if ($whatsapp_button_type === 'onlyicon' || $whatsapp_button_type === 'iconwithtitle') {
            $whatsapp_button_icon = '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
<path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
</svg>';
        }

        if ($whatsapp_button_type === 'onlyicon') {
            $scb_only_icon_class = ' scb-only-icon';
        }

        if ($whatsapp_button_type === 'onlytitle' || $whatsapp_button_type === 'iconwithtitle') {
            $whatsapp_button_title_text = '<span class="scb-button-text">' . $whatsapp_button_title . '</span>';
        } else {
            $whatsapp_button_title_text = '';
        }

        // Button Animation

        $whatsapp_button_animation = esc_attr($scb_get_options['simple_contact_bar_whatsapp_button_animation']);
        $whatsapp_icon_animation = esc_attr($scb_get_options['simple_contact_bar_whatsapp_icon_animation']);

        if ($whatsapp_button_animation) {
            $button_animation = ' scb-button-animation';
        }

        if ($whatsapp_icon_animation) {
            $icon_animation = ' scb-button-icon-animation';
        }

        $whatsapp_message_type = sanitize_text_field($scb_get_options['simple_contact_bar_whatsapp_message_type']);

        if ($whatsapp_message_type == 'url') {
            $scb_get_page = scb_get_current_page_info();
            $current_page_title = $scb_get_page['title'];
            $current_page_link = $scb_get_page['link'];

            $whatsapp_message = '?text=' . urlencode($current_page_title . ' - ' . $current_page_link);
        }



        if ($whatsapp_message_type == 'text') {

            $message = sanitize_text_field($scb_get_options['simple_contact_bar_whatsapp_message']);

            $whatsapp_message = '?text=' . urlencode($message);
        }

        // Generate Whatsapp Button
        $simple_contact_bar_whatsapp_number_button = '<a id="scb-whatsapp-button" href="https://wa.me/' . $whatsapp_number . '' . $whatsapp_message . '" class="scb-button scb-button-' . $button_view_class . ' scb-button-' . $whatsapp_button_size . '' . $button_animation . '' . $icon_animation . '' . $scb_only_icon_class . '" style="color: ' . $whatsapp_text_color . '; background-color: ' . $whatsapp_background_color . ';' . $button_border_style . '" title="' . $whatsapp_button_title . '" rel="external nofollow" target="_blank">
			                          ' . $whatsapp_button_icon . '' . $whatsapp_button_title_text . '
									 </a>';
    } 
	
    // Return WhatsApp Button
    return $simple_contact_bar_whatsapp_number_button;
}
add_shortcode('simple_contact_bar_whatsapp_button', 'simple_contact_bar_whatsapp_button_render');
