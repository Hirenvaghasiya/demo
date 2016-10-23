<?php
     //  =============================
     //  = Default Theme Customizer Settings  =
     //  @ novellaw Theme
     //  =============================
/*theme customizer*/
function novellaw_customize_register( $wp_customize ) {
 
     //  =============================
     //  = Home Page Slider Settings       =
   	 //  =============================	
	$wp_customize->add_section('section_slider_cf', array(
        'title'    => __('Contact Form ShortCode', 'novellaw'),
        'priority' => 20,
         'panel'  => 'home_page_slider',
    ));
	
	 $wp_customize->add_setting('section_contactform_title', array(
        'default'           => 'Conatct us',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('section_contactform_title', array(
        'label'    => __('Contact Form Title', 'novellaw'),
        'section'  => 'section_slider_cf',
        'settings' => 'section_contactform_title',
         'type'       => 'text',
    ));
	
	 $wp_customize->add_setting('section_contactform', array(
        'default'           => '[lead-form form-id=1 title=Contact Us]',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'NovelLite_sanitize_textarea'
    ));
    $wp_customize->add_control('section_contactform', array(
        'label'    => __('Lead Form ShortCode', 'novellaw'),
        'section'  => 'section_slider_cf',
        'settings' => 'section_contactform',
         'type'       => 'textarea',
    ));

//map
$wp_customize->add_setting('map_address', array(
            'default'           => '',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'NovelLite_sanitize_textarea_html'
            ));
        $wp_customize->add_control('map_address', array(
            'label'    => __('Map Address', 'novellaw'),
            'description' => __('insert goole map iframe <a target="_blank" href="https://www.google.co.in/maps">Map</a>','novellaw'),
            'section'  => 'lead_form',
            'settings' => 'map_address',
             'type'       => 'textarea',
            'priority' => 20,
            ));
}

add_action('customize_register','novellaw_customize_register');