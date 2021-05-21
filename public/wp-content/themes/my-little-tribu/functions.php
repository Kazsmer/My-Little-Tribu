<?php

require_once('walker/CommentWalker.php');
add_filter('use_block_editor_for_post', '__return_false', 10);

add_theme_support( 'post-thumbnails' ); 

add_theme_support( 'title-tag' );


// display admin bar only for admin, but not for the others
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar()
{
    if (!current_user_can('administrator') && !is_admin()) 
    {
        show_admin_bar(false);
    }
}


require __DIR__ . '/includes/theme-initialize.php';
require __DIR__ . '/includes/theme-load-assets.php';
require __DIR__ . '/includes/comments-custom.php';

