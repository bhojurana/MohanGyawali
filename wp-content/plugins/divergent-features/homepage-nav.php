<?php
$homeslug = sanitize_title(get_theme_mod('divergent_homeslug'));
$hometitle = get_theme_mod('divergent_hometitle');
$menuicon = get_theme_mod('divergent_menuicon');
$homeicon = get_theme_mod('divergent_homeicon');

$menuargs = array(
    'post_type' => 'dvsections',
    'posts_per_page' => 99
);
$menu_query = new WP_Query( $menuargs );
$count = 2;
?>
<div id="cv-menu">
    <nav id="cv-main-menu">
        <ul>
            <?php $hidesidebar = get_theme_mod('divergent_hidesidebar'); ?>
            <?php if (!$hidesidebar) { ?>
            <?php if (( is_active_sidebar( 'divergenthomesidebar' ) ) || (has_nav_menu( 'divergent-menu' ))) { ?>
                <li class="cv-menu-icon"><a href="#" class="cv-menu-button <?php if (!empty($menuicon)) { echo esc_attr($menuicon); } else { echo esc_attr('fas fa-bars'); } ?>"><?php esc_attr_e('Menu', 'divergent'); ?></a>
                </li>
            <?php } ?>
            <?php } ?>
                <li class="links-to-floor-li cv-active" data-id="1" data-slug="<?php if (!empty($homeslug)) { echo esc_attr($homeslug); } else { echo esc_attr('home'); } ?>"><a href="#<?php if (!empty($homeslug)) { echo esc_attr($homeslug); } else { echo esc_attr('home'); } ?>" class="<?php if (!empty($homeicon)) { echo esc_attr($homeicon); } else { echo esc_attr('fas fa-home'); } ?> tooltip-menu" title="<?php if (!empty($hometitle)) { echo esc_attr($hometitle); } else { echo esc_attr('HOME'); } ?>"><?php if (!empty($hometitle)) { echo esc_attr($hometitle); } else { echo esc_attr('HOME'); } ?></a>
                </li>
            <?php while($menu_query->have_posts()) : $menu_query->the_post(); ?>
            <?php $icon = get_post_meta( get_the_id(), 'divergentcmb2_menu_icon', true ); ?>
                <li class="links-to-floor-li" data-id="<?php echo $count++; ?>" data-slug="<?php echo divergent_slug(); ?>"><a href="#<?php echo divergent_slug(); ?>" class="<?php if (!empty($icon)) { echo esc_attr($icon); } else { echo esc_attr('fas fa-file'); } ?> tooltip-menu" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                </li>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </ul>
    </nav>
</div>