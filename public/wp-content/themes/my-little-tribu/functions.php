<?php

require_once('walker/CommentWalker.php');
add_filter('use_block_editor_for_post', '__return_false', 10);

add_theme_support( 'post-thumbnails' ); 

add_theme_support( 'title-tag' );

require __DIR__ . '/includes/theme-initialize.php';
require __DIR__ . '/includes/theme-load-assets.php';
require __DIR__ . '/includes/comments-custom.php';

