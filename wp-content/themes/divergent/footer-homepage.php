<?php $divergentfooterhide = get_theme_mod('divergent_hidefooter'); ?>
<?php $divergenthidesidebar = get_theme_mod('divergent_hidesidebar'); ?>
    <?php if (!$divergentfooterhide) { ?>
    <!-- FOOTER -->
    <footer id="footer">
        <div class="cv-credits">
            <?php $divergentfootertext = get_theme_mod('divergent_footermessage'); ?>
            <?php echo wp_kses_post($divergentfootertext); ?>
        </div>
        <!-- BACK TO TOP BUTTON -->
        <div id="cv-back-to-top" class="tooltip-gototop" title="<?php echo esc_html( 'Go to top', 'divergent' ); ?>"></div>
    </footer>
<?php } ?>
</div>
<?php if (!$divergenthidesidebar) { ?>
<?php if (( is_active_sidebar( 'divergenthomesidebar' ) ) || (has_nav_menu( 'divergent-menu' ))) { ?>
    <aside id="cv-sidebar">
        <div id="cv-sidebar-inner">
            <?php if ( has_nav_menu( 'divergent-menu' ) ) { ?>
            <div class="cv-panel-widget">
            <div class="cv-sidebar-title">
                <h5><?php echo esc_html( 'MENU', 'divergent' ); ?></h5>
            </div>
            <?php
            $defaults = array(
                'theme_location'  => 'divergent-menu',
                'menu'            => '',
                'container'       => 'nav',
                'container_class' => 'cv-submenu',
                'container_id'    => 'cv-submenu',
                'menu_class'      => '',
                'menu_id'         => '',
                'echo'            => true,
                'fallback_cb'     => '',
                'items_wrap'      => '<ul id="%1$s" class="nav %2$s">%3$s</ul>',
                'depth'           => 2
            );
            wp_nav_menu( $defaults );
            ?>
            </div>
            <?php } ?>
            <?php 
            if ( is_active_sidebar( 'divergenthomesidebar' ) ) {
                dynamic_sidebar( 'divergenthomesidebar');
            }
            ?>
        </div>
    </aside>
<?php } ?>
<?php } ?>
<?php wp_footer(); ?>
</body>
</html>