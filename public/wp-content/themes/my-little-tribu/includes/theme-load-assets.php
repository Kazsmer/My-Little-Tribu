<?php

function loadAssets()
{
    /* FICHIERS CSS */

wp_enqueue_style(
    'google-font-0',
    'https://fonts.googleapis.com/css?family=Inconsolata:400,700|Delius|Pacifico&display=swap'
);
/*|Raleway:400,700*/

wp_enqueue_style(
    'bootstrap',
    get_theme_file_uri('assets/bootstrap/css/bootstrap.min.css')
);

wp_enqueue_style(
    'icofont',
    get_theme_file_uri('assets/icofont/icofont.min.css')
);

wp_enqueue_style(
    'line-awesome',
    get_theme_file_uri('assets/line-awesome/css/line-awesome.min.css')
);

wp_enqueue_style(
    'aos',
    get_theme_file_uri('assets/aos/aos.css')
);

wp_enqueue_style(
    'style-css',
    get_theme_file_uri('assets/css/style.css')
);

/* FICHIERS JS 

<!-- Vendor JS Files -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/jquery/jquery-migrate.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="vendor/easing/easing.min.js"></script>
  <script src="vendor/php-email-form/validate.js"></script>
  <script src="vendor/isotope/isotope.pkgd.min.js"></script>
  <script src="vendor/aos/aos.js"></script>
  <script src="vendor/owlcarousel/owl.carousel.min.js"></script>

  <!-- Template Main JS File -->
  <script src="js/main.js"></script>
  */

  wp_enqueue_script(
    'jquery',
    get_theme_file_uri('assets/jquery/jquery.min.js'),
    [], 
    '1.0.0', 
    true 
);

wp_enqueue_script(
    'jquery-migrate',
    get_theme_file_uri('assets/jquery/jquery-migrate.min.js'),
    [], 
    '1.0.0', 
    true 
);

wp_enqueue_script(
    'bootstrap-js',
    get_theme_file_uri('assets/bootstrap/js/bootstrap.min.js'),
    [], 
    '1.0.0', 
    true 
);

wp_enqueue_script(
    'easing',
    get_theme_file_uri('assets/easing/easing.min.js'),
    [], 
    '1.0.0', 
    true 
);

wp_enqueue_script(
    'isotope',
    get_theme_file_uri('assets/isotope/isotope.pkgd.min.js'),
    [], 
    '1.0.0', 
    true 
);

wp_enqueue_script(
    'aos',
    get_theme_file_uri('assets/aos/aos.js'),
    [], 
    '1.0.0', 
    true 
);

wp_enqueue_script(
    'main-js',
    get_theme_file_uri('assets/js/main.js'),
    [], 
    '1.0.0', 
    true 
);


}

add_action('wp_enqueue_scripts', 'loadAssets');