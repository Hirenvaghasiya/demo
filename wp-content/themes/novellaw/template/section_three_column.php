<!-- Services Section -->
<section id="section1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <?php if (get_theme_mod('col_heading','') != '') { ?>
                <h2 class="section-heading"><?php echo esc_html(get_theme_mod('col_heading')); ?></h2>
                <?php } else { ?>
                <h2 class="section-heading os-animation"  data-os-animation="FadeInLeft" data-os-animation-delay="0s"><?php _e('Services','novellaw'); ?></h2>
                <?php } ?>
                <?php if (get_theme_mod('col_sub','') != '') { ?>
                <h3 class="section-subheading text-muted"><?php echo esc_html(get_theme_mod('col_sub','')); ?></h3>
                <?php } else { ?>
                <h3 class="section-subheading text-muted"><?php _e('Phasellus elementum odio faucibus diam sollicitudin','novellaw'); ?></h3>
                <?php } ?>
            </div>
        </div>
        <div class="row text-center servies">
            
            <div class="col-md-4">
                <div class="service-deg">
                    <span class="fa-stack fa-4x">
                        <a href="<?php
                            if (get_theme_mod('first_feature_link','#') != '') {
                            echo esc_url(get_theme_mod('first_feature_link','#'));
                            }
                            ?>">
                            <!-- <i class="fa fa-circle fa-stack-2x text-primary"></i> -->
                            <i class="fa <?php
                            if (get_theme_mod('first_feature_font_icon','') != '') {
                            echo esc_html(get_theme_mod('first_feature_font_icon',''));
                            } else {
                        ?> fa-microphone <?php } ?> fa-stack-1x fa-inverse"></i></a>
                    </span>
                    <?php if (get_theme_mod('first_feature_heading','') != '') { ?>
                    <a href="<?php
                        if (get_theme_mod('first_feature_link','') != '') {
                        echo esc_url(get_theme_mod('first_feature_link',''));
                        } else {
                        echo "#";
                        }
                    ?>"><h4 class="service-heading"><?php echo esc_html(get_theme_mod('first_feature_heading','')); ?></h4></a>
                    <?php } else { ?>
                    <a href="#"><h4 class="service-heading"><?php _e('Criminal law','novellaw'); ?></h4></a><div class="servive-underline" ></div>
                    <?php } if (get_theme_mod('first_feature_desc','') != '') { ?>
                    <p class="text-muted"><?php echo esc_html(get_theme_mod('first_feature_desc','')); ?></p>
                    <?php } else { ?>
                    <p class="text-muted"><?php _e('Write Law Discription.','novellaw'); ?></p>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-deg-2">
                    <span class="fa-stack fa-4x">
                        <a href="<?php
                            if (get_theme_mod('second_feature_link','#') != '') {
                            echo esc_url(get_theme_mod('second_feature_link','#'));
                            }
                            ?>">
                            <!-- <i class="fa fa-circle fa-stack-2x text-primary"></i> -->
                            <i class="fa <?php
                            if (get_theme_mod('second_feature_font_icon','') != '') {
                            echo esc_html(get_theme_mod('second_feature_font_icon',''));
                            } else {
                            ?> fa-rocket <?php } ?> fa-stack-1x fa-inverse"></i>
                        </a>
                    </span>
                    <?php if (get_theme_mod('second_feature_heading','') != '') { ?>
                    <a href="<?php
                        if (get_theme_mod('second_feature_link','') != '') {
                        echo esc_url(get_theme_mod('second_feature_link',''));
                        } else {
                        echo "#";
                        }
                    ?>"><h4 class="service-heading"><?php echo esc_html(get_theme_mod('second_feature_heading','')); ?></h4></a>
                    <?php } else { ?>
                    <a href="#"><h4 class="service-heading"><?php _e('Insurance law','novellaw'); ?></h4></a><div class="servive-underline" ></div>
                    <?php } if (get_theme_mod('second_feature_desc','') != '') { ?>
                    <p class="text-muted"><?php echo esc_html(get_theme_mod('second_feature_desc','')); ?></p>
                    <?php } else { ?>
                    <p class="text-muted"><?php _e('Write Law Discription.','novellaw'); ?></p>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-deg-3">
                    <span class="fa-stack fa-4x">
                        <a href="<?php
                            if (get_theme_mod('third_feature_link','#') != '') {
                            echo esc_url(get_theme_mod('third_feature_link','#'));
                            }
                            ?>"> <!-- <i class="fa fa-circle fa-stack-2x text-primary"></i> -->
                            <i class="fa <?php
                            if (get_theme_mod('third_feature_font_icon','') != '') {
                            echo esc_html(get_theme_mod('third_feature_font_icon',''));
                            } else {
                            ?>fa-signal <?php } ?> fa-stack-1x fa-inverse"></i>
                        </a>
                    </span>
                    <?php if (get_theme_mod('third_feature_heading','') != '') { ?>
                    <a href="<?php
                        if (get_theme_mod('third_feature_link','') != '') {
                        echo esc_url(get_theme_mod('third_feature_link',''));
                        } else {
                        echo "#";
                        }
                    ?>"><h4 class="service-heading"><?php echo esc_html(get_theme_mod('third_feature_heading','')); ?></h4></a>
                    <?php } else { ?>
                    <a href="#"><h4 class="service-heading"><?php _e('Business law','novellaw'); ?></h4></a><div class="servive-underline" ></div>
                    <?php } if (get_theme_mod('third_feature_desc','') != '') { ?>
                    <p class="text-muted"><?php echo esc_html(get_theme_mod('third_feature_desc','')); ?></p>
                    <?php } else { ?>
                    <p class="text-muted"><?php _e('Write Law Discription.','novellaw'); ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>