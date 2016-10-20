<?php
/*----------------------------------------------------------------------
# BEAVER BUILDER LINK
------------------------------------------------------------------------*/
function igthemes_bb_upgrade_link() { 
    return 'https://www.wpbeaverbuilder.com/?fla=613'; 
}

add_filter( 'fl_builder_upgrade_url', 'igthemes_bb_upgrade_link' );

/*----------------------------------------------------------------------
# BEAVER BUILDER HIDE PAGE TITLE

function igthemes_form_defaults( $defaults, $form_type ) {

    if ( 'global' == $form_type ) {
        $defaults->default_heading_selector = '.entry-header';
    }

    return $defaults; // Must be returned!
}

add_filter( 'fl_builder_settings_form_defaults', 'igthemes_form_defaults', 10, 2 );
------------------------------------------------------------------------*/