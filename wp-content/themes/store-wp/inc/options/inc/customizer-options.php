<?php
//start class
class IGthemes_Customizer {
// add some settings
public static function igthemes_customize($wp_customize) {

$wp_customize->add_panel( 'igtheme_options', array(
  'title' => __( 'Theme Settings', 'store-wp'),
  'description' => '', 
  'priority' => 10, 
) );
// LAYOUT
$wp_customize->add_section('layout-settings', array(
    'title' => __('Layout', 'store-wp'),
    'panel' => 'igtheme_options',
    'priority' => 10, 
 ));
// Header
$wp_customize->add_section( 'header-settings' , array(
  'title' => __( 'Header', 'store-wp'),
  'panel' => 'igtheme_options',
  'priority' => 20, 
) );
// TYPOGRAPHY
$wp_customize->add_section('typography-settings', array(
    'title' => __('Typography', 'store-wp'),
    'panel' => 'igtheme_options',
    'priority' => 30, 
));
// BUTTONS
$wp_customize->add_section('buttons-settings', array(
    'title' => __('Buttons', 'store-wp'),
    'panel' => 'igtheme_options',
    'priority' => 40, 
 ));
// FOOTER
$wp_customize->add_section('footer-settings', array(
    'title' => __('Footer', 'store-wp'),
    'panel' => 'igtheme_options',
    'priority' => 50, 
));
// SOCIAL
$wp_customize->add_section('social-settings', array(
    'title' => __('Social', 'store-wp'),
    'panel' => 'igtheme_options',
    'priority' => 60, 
));
// END SECTIONS

//ADD CONTROLS
/*****************************************************************
* PREMIUM
******************************************************************/
    if ( apply_filters( 'igthemes_customizer_more', true ) ) {
        
        $wp_customize->add_section( 'upgrade_premium' , array(
            'title'      		=> __( 'More Options', 'store-wp' ),
            'panel'             => 'igtheme_options',
            'priority'   		=> 1,
        ) );

        $wp_customize->add_setting( 'upgrade_premium', array(
            'default'    		=> null,
            'sanitize_callback' => 'igthemes_sanitize_text',
        ) );

        $wp_customize->add_control( new IGthemes_More_Control( $wp_customize, 'upgrade_premium', array(
            'label'    			=> __( 'Looking for more options?', 'store-wp' ),
            'section'  			=> 'upgrade_premium',
            'settings' 			=> 'upgrade_premium',
            'priority' 			=> 1,
        ) ) );
        // SECTIONS
    $wp_customize->add_section('advanced-settings', array(
        'title' => esc_html__('Advanced', 'store-wp'),
        'panel' => 'igtheme_options',
        'priority' => 80,
    ));
    // Shop
    $wp_customize->add_section('shop-settings', array(
        'title' => __('Shop', 'store-wp'),
        'panel' => 'igtheme_options',
        'priority' => 70, 
    ));
    //lightbox
    $wp_customize->add_setting('lightbox', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'lightbox', array(
        'label' => esc_html__('', 'store-wp'),
        'description' => esc_html__('Use the lightbox effect for images and galleries', 'store-wp'),
        'section' => 'layout-settings',
        'settings' => 'lightbox',
        'priority'   => 5
    ) ) );
    //main posts columns
    $wp_customize->add_setting('main_posts_columns', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'main_posts_columns', array(
        'label' => esc_html__('', 'store-wp'),
        'description' => esc_html__('Show posts in two columns on blog?', 'store-wp'),
        'section' => 'layout-settings',
        'settings' => 'main_posts_columns',
        'priority'   => 2
    ) ) );
    
    //shop_menu_link
    $wp_customize->add_setting('shop_menu_link', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'shop_menu_link', array(
        'label' => esc_html__('Display shopping cart link?', 'store-wp'),
        'description' => esc_html__('Add shopping cart link in the header menu', 'store-wp'),
        'section' => 'shop-settings',
        'settings' => 'shop_menu_link',
    ) ) );
    //shop_sidebar
    $wp_customize->add_setting('shop_sidebar', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'shop_sidebar', array(
        'label' => esc_html__('Shop Layout', 'store-wp'),
        'description' => esc_html__('Select the shop layout', 'store-wp'),
        'section' => 'shop-settings',
        'settings' => 'shop_sidebar',
    ) ) );
    //shop_products_number
    $wp_customize->add_setting('shop_products_number', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'shop_products_number', array(
        'label' => esc_html__('', 'store-wp'),
        'description' => esc_html__('How many product display per page?', 'store-wp'),
        'section' => 'shop-settings',
        'settings' => 'shop_products_number',
    ) ) );
    //shop_button_colors
    $wp_customize->add_setting('shop_button_colors', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'shop_button_colors', array(
        'label' => esc_html__('Shop Buttons', 'store-wp'),
        'description' => esc_html__('Change shop buttons colors', 'store-wp'),
        'section' => 'shop-settings',
        'settings' => 'shop_button_colors',
    ) ) );
    //header_layout
    $wp_customize->add_setting('header_layout', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'header_layout', array(
        'label' => esc_html__('Header Layout', 'store-wp'),
        'description' => esc_html__('Inline or expanded layout', 'store-wp'),
        'section' => 'header-settings',
        'settings' => 'header_layout',
    ) ) );
    //header_nav_sticky
    $wp_customize->add_setting('header_nav_sticky', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'header_nav_sticky', array(
        'label' => esc_html__('Sticky Menu', 'store-wp'),
        'description' => esc_html__('Lock the main menu on top of the page when a user scrolls', 'store-wp'),
        'section' => 'header-settings',
        'settings' => 'header_nav_sticky',
    ) ) );
     //header_nav_side
    $wp_customize->add_setting('header_nav_side', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'header_nav_side', array(
        'label' => esc_html__('Side Menu', 'store-wp'),
        'description' => esc_html__('Implement mobile side menu', 'store-wp'),
        'section' => 'header-settings',
        'settings' => 'header_nav_side',
    ) ) );
    //font_google
    $wp_customize->add_setting('font_google', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'font_google', array(
        'label' => esc_html__('Google Font', 'store-wp'),
        'description' => esc_html__('Add your preferred Google Font', 'store-wp'),
        'section' => 'typography-settings',
        'settings' => 'font_google',
    ) ) );
    //font_family_headings
    $wp_customize->add_setting('font_family_headings', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'font_family_headings', array(
        'label' => esc_html__('', 'store-wp'),
        'description' => esc_html__('Headings font family', 'store-wp'),
        'section' => 'typography-settings',
        'settings' => 'font_family_headings',
    ) ) );
    //font_family_body
    $wp_customize->add_setting('font_family_body', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'font_family_body', array(
        'label' => esc_html__('', 'store-wp'),
        'description' => esc_html__('Body font family', 'store-wp'),
        'section' => 'typography-settings',
        'settings' => 'font_family_body',
    ) ) );
    //font_size
    $wp_customize->add_setting('font_size', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'font_size', array(
        'label' => esc_html__('Font Size', 'store-wp'),
        'description' => esc_html__('Change body and headings font size', 'store-wp'),
        'section' => 'typography-settings',
        'settings' => 'font_size',
    ) ) );
    //custom_css
    $wp_customize->add_setting('custom_css', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'custom_css', array(
        'label' => esc_html__('Custom CSS', 'store-wp'),
        'description' => esc_html__('Add your custom css code', 'store-wp'),
        'section' => 'advanced-settings',
        'settings' => 'custom_css',
    ) ) );
    //custom_js
    $wp_customize->add_setting('custom_js', array(
        'default'    		=> null,
        'sanitize_callback' => 'igthemes_sanitize_text',
    ));
    $wp_customize->add_control( new IGthemes_Only_Premium( $wp_customize, 'custom_js', array(
        'label' => esc_html__('Custom JS', 'store-wp'),
        'description' => esc_html__('Add your custom js code', 'store-wp'),
        'section' => 'advanced-settings',
        'settings' => 'custom_js',
    ) ) );
    //end
  }
/*****************************************************************
* LAYOUT SETTINGS
******************************************************************/
//main layout
    $wp_customize->add_setting(
        'main_sidebar',
        array(
            'sanitize_callback' => 'igthemes_sanitize_choices',
            'default' => 'right',
    ));
    $wp_customize->add_control(
            new IGthemes_Radio_Image_Control(
            // $wp_customize object
            $wp_customize,
            // $id
            'main_sidebar',
            // $args
            array(
                'label'			=> __( 'Blog Layout', 'store-wp' ),
                'description'	=> __( 'Select the blog layout', 'store-wp' ),
                'priority' =>   1, 
                'type'          => 'radio-image',
                'section'		=> 'layout-settings',
                'settings'      => 'main_sidebar',
                'choices'		=> array(
                    'left' 	    => get_template_directory_uri() . '/inc/options/images/left.png',
                    'right' 	=> get_template_directory_uri() . '/inc/options/images/right.png'
                )
            )
    ));
//main post content
    $wp_customize->add_setting('main_post_content', array(
        'sanitize_callback' => 'igthemes_sanitize_checkbox',
        'default' => 0,
    ));
    $wp_customize->add_control('main_post_content', array(
        'label' => esc_html__('Show full posts on blog?', 'store-wp'),
        'description' => esc_html__('Display full posts content', 'store-wp'),
        'type' => 'checkbox',
        'section' => 'layout-settings',
        'settings' => 'main_post_content',
        'priority'   => 3
    ));
//main featured images
    $wp_customize->add_setting('main_featured_images', array(
        'sanitize_callback' => 'igthemes_sanitize_checkbox',
        'default' => 1,
    ));
    $wp_customize->add_control('main_featured_images', array(
        'label' => esc_html__('Show featured images on blog?', 'store-wp'),
        'description' => esc_html__('Display posts featured images', 'store-wp'),
        'type' => 'checkbox',
        'section' => 'layout-settings',
        'settings' => 'main_featured_images',
        'priority'   => 4
    ));
//breadcrumb
    $wp_customize->add_setting(
        'breadcrumb',
        array(
            'sanitize_callback' => 'igthemes_sanitize_checkbox',
    ));
    $wp_customize->add_control(
        'breadcrumb',
        array(
            'label'         => esc_html__('Display breadcrumb?', 'store-wp'),
            'description'   => __( 'Yoast Breadcrumb supported<br>NavXT Breadcrumb supported', 'store-wp'),
            'priority'      =>  5, 
            'type'          => 'checkbox',
            'section'       => 'layout-settings',
            'settings'      => 'breadcrumb',
    ));
//numeric_pagination
    $wp_customize->add_setting(
        'numeric_pagination',
        array(
            'sanitize_callback' => 'igthemes_sanitize_checkbox',
    ));
    $wp_customize->add_control(
        'numeric_pagination',
        array(
            'label' =>esc_html__('Use numeric pagination ?', 'store-wp'),
            'description' =>   __( 'WP-PageNavi supported', 'store-wp'),
            'priority' =>       6,
            'type' =>           'checkbox',
            'section' =>        'layout-settings',
            'settings' => 'numeric_pagination',
    ));
/*****************************************************************
* HEADER SETTINGS
******************************************************************/
//header color
    $wp_customize->add_setting(
        'header_background_color',
        array(
        
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => '#ffffff',
        'transport' => 'postMessage'

    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'header_background_color',
            array(
                'label' => __('Colors', 'store-wp'),
                'description' => __('Background color', 'store-wp'),
                'type' => 'color',
                'section' => 'header-settings',
                'settings' => 'header_background_color',
            )
    ));
//header text color
    $wp_customize->add_setting(
        'header_text_color',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => '#ffffff',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'header_text_color',
            array(
                'label' => __('', 'store-wp'),
                'description' => __('Text color', 'store-wp'),
                'type' => 'color',
                'section' => 'header-settings',
                'settings' => 'header_text_color',
            )
    ));
//header link normal
    $wp_customize->add_setting(
        'header_link_normal',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => '#444444',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'header_link_normal',
            array(
                'label' => __('', 'store-wp'),
                'description' => __('Link color', 'store-wp'),
                'type' => 'color',
                'section' => 'header-settings',
                'settings' => 'header_link_normal',
            )
    ));
//header link hover
    $wp_customize->add_setting(
        'header_link_hover',
        array(
        
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => '#14bfcc',
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'header_link_hover',
            array(
                'label' => __('', 'store-wp'),
                'description' => __('Link hover color', 'store-wp'),
                'type' => 'color',
                'section' => 'header-settings',
                'settings' => 'header_link_hover',
            )
    ));
/*****************************************************************
* TYPOGRAPHY SETTINGS
******************************************************************/
    //body text color
    $wp_customize->add_setting(
        'body_text_color',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => '#666666',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'body_text_color',
            array(
                'label' => __('Font Style', 'store-wp'),
                'description' => __('Body text color', 'store-wp'),
                'priority' => 1,
                'type' => 'color',
                'section' => 'typography-settings',
                'settings' => 'body_text_color',
            )
    ));
    //body headings color
    $wp_customize->add_setting(
        'body_headings_color',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => '#444444',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'body_headings_color',
            array(
                'label' => __('', 'store-wp'),
                'description' => __('Headings color', 'store-wp'),
                'priority' => 2,
                'type' => 'color',
                'section' => 'typography-settings',
                'settings' => 'body_headings_color',
            )
    ));
    //body link normal
    $wp_customize->add_setting(
        'body_link_normal',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => '#444444',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'body_link_normal',
            array(
                'label' => __('', 'store-wp'),
                'description' => __('Link color', 'store-wp'),
                'priority' => 3,
                'type' => 'color',
                'section' => 'typography-settings',
                'settings' => 'body_link_normal',
            )
    ));
    //body link hover
    $wp_customize->add_setting(
        'body_link_hover',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => '#14bfcc'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'body_link_hover',
            array(
                'label' => __('', 'store-wp'),
                'description' => __('Link hover color', 'store-wp'),
                'priority' => 4,
                'type' => 'color',
                'section' => 'typography-settings',
                'settings' => 'body_link_hover',
            )
    ));
/*****************************************************************
* BUTTONS SETTINGS
******************************************************************/
    //button background color
    $wp_customize->add_setting(
        'button_background_normal',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => '#14bfcc',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'button_background_normal',
            array(
                'label' => __('Main Buttons', 'store-wp'),
                'description' => __('Background color', 'store-wp'),
                'priority' => 1,
                'type' => 'color',
                'section' => 'buttons-settings',
                'settings' => 'button_background_normal',
            )
    ));
    //button background hover
    $wp_customize->add_setting(
        'button_background_hover',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => '#0091ac'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'button_background_hover',
            array(
                'label' => __('', 'store-wp'),
                'description' => __('Background hover', 'store-wp'),
                'priority' => 2,
                'type' => 'color',
                'section' => 'buttons-settings',
                'settings' => 'button_background_hover',
            )
    ));
    //button text color
    $wp_customize->add_setting(
        'button_text_normal',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => '#ffffff',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'button_text_normal',
            array(
                'label' => __('', 'store-wp'),
                'description' => __('Text normal', 'store-wp'),
                'priority' => 3,
                'type' => 'color',
                'section' => 'buttons-settings',
                'settings' => 'button_text_normal',
            )
    ));
    //button text hover
    $wp_customize->add_setting(
        'button_text_hover',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => '#ffffff'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'button_text_hover',
            array(
                'label' => __('', 'store-wp'),
                'description' => __('Text hover', 'store-wp'),
                'priority' => 4,
                'type' => 'color',
                'section' => 'buttons-settings',
                'settings' => 'button_text_hover',
            )
    ));
/*****************************************************************
* FOOTER SETTINGS
******************************************************************/
    //footer background color
    $wp_customize->add_setting(
        'footer_background_color',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => '#777777',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'footer_background_color',
            array(
                'label' => __('Colors', 'store-wp'),
                'description' => __('Background color', 'store-wp'),
                'priority' => 1,
                'type' => 'color',
                'section' => 'footer-settings',
                'settings' => 'footer_background_color',
            )
    ));
    //footer text color
    $wp_customize->add_setting(
        'footer_text_color',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => '#aaaaaa',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'footer_text_color',
            array(
                'label' => __('', 'store-wp'),
                'description' => __('Text color', 'store-wp'),
                'priority' => 2,
                'type' => 'color',
                'section' => 'footer-settings',
                'settings' => 'footer_text_color',
            )
    ));
    //footer headings color
    $wp_customize->add_setting(
        'footer_headings_color',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => '#ffffff',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'footer_headings_color',
            array(
                'label' => __('', 'store-wp'),
                'description' => __('Hedings color', 'store-wp'),
                'priority' => 3,
                'type' => 'color',
                'section' => 'footer-settings',
                'settings' => 'footer_headings_color',
            )
    ));
    //footer link normal
    $wp_customize->add_setting(
        'footer_link_normal',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => '#ffffff',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'footer_link_normal',
            array(
                'label' => __('', 'store-wp'),
                'description' => __('Link color', 'store-wp'),
                'priority' => 4,
                'type' => 'color',
                'section' => 'footer-settings',
                'settings' => 'footer_link_normal',
            )
    ));
    //footer link hover
    $wp_customize->add_setting(
        'footer_link_hover',
        array(
        'sanitize_callback' => 'igthemes_sanitize_hex_color',
        'default'  => '#14bfcc'
    ));
    $wp_customize->add_control(
        new WP_Customize_color_Control(
        $wp_customize, 'footer_link_hover',
            array(
                'label' => __('', 'store-wp'),
                'description' => __('Link hover color', 'store-wp'),
                'priority' => 5,
                'type' => 'color',
                'section' => 'footer-settings',
                'settings' => 'footer_link_hover',
            )
    ));
/*****************************************************************
* SOCIAL SETTINGS
******************************************************************/
//facebook
    $wp_customize->add_setting('facebook_url', array(
        'sanitize_callback' => 'igthemes_sanitize_url',
        'default' => 'https://www.facebook.com/iograficathemes'
    ));
    $wp_customize->add_control('facebook_url', array(
        'label' => esc_html__('Facebook url', 'store-wp'),
        'type' => 'url',
        'section' => 'social-settings',
        'settings' => 'facebook_url',
    ));
//twitter
    $wp_customize->add_setting('twitter_url', array(
        
        'sanitize_callback' => 'igthemes_sanitize_url',
        'default' => 'https://twitter.com/iograficathemes'
    ));
    $wp_customize->add_control('twitter_url', array(
        'label' => esc_html__('Twitter url', 'store-wp'),
        'type' => 'url',
        'section' => 'social-settings',
        'settings' => 'twitter_url',
    ));
//google
    $wp_customize->add_setting('google_url', array(
        
        'sanitize_callback' => 'igthemes_sanitize_url',
        'default' => 'https://plus.google.com/+Iograficathemes'
    ));
    $wp_customize->add_control('google_url', array(
        'label' => esc_html__('Google plus url', 'store-wp'),
        'type' => 'url',
        'section' => 'social-settings',
        'settings' => 'google_url',
    ));
//pinterest
    $wp_customize->add_setting('pinterest_url', array(
        
        'sanitize_callback' => 'igthemes_sanitize_url',
    ));
    $wp_customize->add_control('pinterest_url', array(
        'label' => esc_html__('Pinterest url', 'store-wp'),
        'type' => 'url',
        'section' => 'social-settings',
        'settings' => 'pinterest_url',
    ));
//tumblr
    $wp_customize->add_setting('tumblr_url', array(
        
        'sanitize_callback' => 'igthemes_sanitize_url',
    ));
    $wp_customize->add_control('tumblr_url', array(
        'label' => esc_html__('Tumblr url', 'store-wp'),
        'type' => 'url',
        'section' => 'social-settings',
        'settings' => 'tumblr_url',
    ));
//instagram
    $wp_customize->add_setting('instagram_url', array(
        
        'sanitize_callback' => 'igthemes_sanitize_url',
    ));
    $wp_customize->add_control('instagram_url', array(
        'label' => esc_html__('Instagram url', 'store-wp'),
        'type' => 'url',
        'section' => 'social-settings',
        'settings' => 'instagram_url',
    ));
//linkedin
    $wp_customize->add_setting('linkedin_url', array(
        
        'sanitize_callback' => 'igthemes_sanitize_url',
    ));
    $wp_customize->add_control('linkedin_url', array(
        'label' => esc_html__('Linkedin url', 'store-wp'),
        'type' => 'url',
        'section' => 'social-settings',
        'settings' => 'linkedin_url',
    ));
//dribbble
    $wp_customize->add_setting('dribbble_url', array(
        
        'sanitize_callback' => 'igthemes_sanitize_url',
    ));
    $wp_customize->add_control('dribbble_url', array(
        'label' => esc_html__('Dribble url', 'store-wp'),
        'type' => 'url',
        'section' => 'social-settings',
        'settings' => 'dribbble_url',
    ));
//youtube
    $wp_customize->add_setting('youtube_url', array(
        
        'sanitize_callback' => 'igthemes_sanitize_url',
    ));
    $wp_customize->add_control('youtube_url', array(
        'label' => esc_html__('Youtube url', 'store-wp'),
        'type' => 'url',
        'section' => 'social-settings',
        'settings' => 'youtube_url',
    ));
//END
    }
}
// Setup the Theme Customizer settings and controls...
add_action('customize_register' , array('IGthemes_Customizer' , 'igthemes_customize') );
//END OF CLASS
