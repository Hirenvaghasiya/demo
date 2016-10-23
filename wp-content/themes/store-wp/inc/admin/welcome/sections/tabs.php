<?php
/**
 * Welcome tabs
 */
?>
<?php $theme_data = wp_get_theme('store-wp'); ?>

<h1 class="theme-name">
    <?php echo $theme_data->Name .'<sup class="version">' . esc_attr(  $theme_data->Version ) . '</sup>'; ?>
</h1>
<p><?php esc_html_e( 'Here you can read the documentation and know how to get the most out of your new theme.', 'store-wp' ); ?></p>
<h2 class="igthemes-nav-tab nav-tab-wrapper">
    <a href="#getting_started" class="nav-tab nav-tab-active"><?php esc_html_e( 'Getting Started', 'store-wp' ); ?></a>
    <a href="#wp_resources" class="nav-tab"><?php esc_html_e( 'Resources', 'store-wp' ); ?></a>
</h2>
