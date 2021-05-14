<?php

function initializeTheme()
{
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
}

add_action('after_setup_theme','initializeTheme');