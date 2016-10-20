<?php
//ad customizer css
add_action( 'customize_controls_print_styles', 	'igthemes_customizer_custom_control_css' );
function igthemes_customizer_custom_control_css() {
    ?>
    <style>
    .customize-control-radio-image .image.ui-buttonset input[type=radio] {
        height: auto;
    }
    .customize-control-radio-image .image.ui-buttonset label {
        display: inline-block;
        width: 30%;
        padding: 1%;
        box-sizing: border-box;
    }
    .customize-control-radio-image .image.ui-buttonset label.ui-state-active {
        background: none;
    }
    .customize-control-radio-image .customize-control-radio-buttonset label {
        background: #f7f7f7;
        line-height: 35px;
    }
    .customize-control-radio-image label img {
        border: 2px solid #eee;
    }
    #customize-controls .customize-control-radio-image label img {
        height: auto;
    }
    .customize-control-radio-image label.ui-state-active img {
        border: 2px solid #fff;
        background: #fff;
    }
    .customize-control-radio-image label.ui-state-hover img {
        border: 2px solid #fff;
    }
    </style>
    <?php
}

//style options
add_action( 'wp_enqueue_scripts', 'igthemes_customizer_css' );
if ( ! function_exists( 'igthemes_customizer_css' ) ) {
    function igthemes_customizer_css() {
        wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/css/custom.css');
        
        $bg_color =  get_theme_mod('background_color', '#fafafa');
        
        $header_background_color =  get_theme_mod('header_background_color', '#fff');
        $header_text_color =  get_theme_mod('header_text_color', '#ffffff');
        $header_link_normal = get_theme_mod('header_link_normal', '#444444');
        $header_link_hover = get_theme_mod('header_link_hover', '#14bfcc');

        $body_text_color =  get_theme_mod('body_text_color', '#666666');
        $body_headings_color =  get_theme_mod('body_headings_color', '#444444');
        $body_link_normal =  get_theme_mod('body_link_normal', '#444444');
        $body_link_hover =  get_theme_mod('body_link_hover', '#14bfcc');

        $footer_background_color =  get_theme_mod('footer_background_color', '#777777');
        $footer_text_color =  get_theme_mod('footer_text_color', '#aaaaaa');
        $footer_headings_color =  get_theme_mod('footer_headings_color', '#ffffff');
        $footer_link_normal =  get_theme_mod('footer_link_normal', '#ffffff');
        $footer_link_hover =  get_theme_mod('footer_link_normal', '#14bfcc');

        $button_background_normal =  get_theme_mod('button_background_normal', '#14bfcc');
        $button_background_hover =  get_theme_mod('button_background_hover', '#0091ac');
        $button_text_normal =  get_theme_mod('button_text_normal', '#ffffff');
        $button_text_hover =  get_theme_mod('button_text_hover', '#ffffff');


        $style = '
        input[type="text"],
        input[type="email"],
        input[type="url"],
        input[type="password"],
        input[type="search"],
        input[type="number"],
        input[type="tel"],
        textarea,
        select  {
            background:  '. igthemes_adjust_color_brightness($bg_color,5) .';
            border: 1px solid '. igthemes_adjust_color_brightness($bg_color,-20) .';
            color:'. $body_text_color .';
        }
        table {
            border:1px solid '. igthemes_adjust_color_brightness($bg_color,-20) .'; 
            background:'. $bg_color .';
        }
        table th {
            background:'. igthemes_adjust_color_brightness($bg_color,-5) .';
            border-bottom: 1px solid '. igthemes_adjust_color_brightness($bg_color,-20) .';
        }
        table td {
            background: '. igthemes_adjust_color_brightness($bg_color,5 ).';
            border: 1px solid '. igthemes_adjust_color_brightness($bg_color,-20) .';
        }
        .site-header {
            background:'. $header_background_color .'
        }
        .site-description {
            color:'. $header_text_color .';
        }
        .site-branding .site-title a {
            color:'.$header_link_normal.';
        }
        .header-nav {
            background:'. $header_link_hover .';
        }
        .header-nav ul li a {
            color:'. $header_text_color .';
        }
        .menu-toggle,
        .main-navigation a {
            color: '. $header_link_normal .';
        }
        .menu-toggle:hover,
        .main-navigation a:hover {
            color: '. $header_link_hover .';
        }
       .main-navigation {
            background: '. igthemes_adjust_color_brightness($header_background_color,5) .';        
        }
        .main-navigation ul ul {
           background: '. $header_background_color .';
           border-bottom: 2px solid '. $header_link_hover .';
        }
        .main-navigation ul ul a {
            border-top: 1px solid '. igthemes_adjust_color_brightness($header_background_color,-10) .';
        }
        .main-navigation ul li:hover > a {
            color: '. $header_link_hover .';
        }
        .scroll-top,
        .site-info {
            background: '. igthemes_adjust_color_brightness($footer_background_color,-5) .';
         }
       .site-footer {
            background:'. $footer_background_color .';
            color:'. $footer_text_color .';
        }
        .site-footer a,
        .site-footer a:hover,
        .site-footer a:focus {
            color:'. $footer_link_normal .';
        }
        .site-footer h1,
        .site-footer h2,
        .site-footer h3,
        .site-footer h4,
        .site-footer h5,
        .site-footer h6 {
            color:'. $footer_headings_color .';
        }
        .site-content {
            color: '. $body_text_color .';
        }
        .site-content a {
            color: '. $body_link_normal .';
        }
        .widget-area h5 {
            border-left-color: '. $body_link_hover .';
        }
        .format-quote .entry-title:before,
        .format-video .entry-title:before,
        .format-image .entry-title:before,
        .format-link .entry-title:before,
        .format-gallery .entry-title:before,
        .format-audio .entry-title:before,
        .format-status .entry-title:before,
        .format-chat .entry-title:before,
        .sticky .entry-title:before {
            color:  '. $body_link_hover .';
        }
        .entry-footer {
            border-bottom-color: '. $body_link_hover .';
        }
        .site-content a:hover,
        .site-content a:focus,
        .archive .entry-title a:hover {
            color: '. $body_link_hover .';
        }
        .site-content h1,
        .site-content h2,
        .site-content h3,
        .site-content h4,
        .site-content h5,
        .site-content h6,
        .archive .entry-title a {
            color: '. $body_headings_color .';
        }
        .site .button,
        .site input[type="button"],
        .site input[type="reset"],
        .site input[type="submit"] {
            border: 1px solid '. $button_background_normal .';
            background: '. $button_background_normal .';
            color: '. $button_text_normal .';
        }
        .site .button:hover,
        .site input[type="button"]:hover,
        .site input[type="reset"]:hover,
        .site input[type="submit"]:hover,
        .site input[type="button"]:focus,
        .site input[type="reset"]:focus,
        .site input[type="submit"]:focus{
            border: 1px solid  '. $button_background_hover .';
            background: '. $button_background_hover .';
            color: '. $button_text_hover .';
        }
        ';
        wp_add_inline_style( 'custom-style', $style );
    }//end custom css
}
