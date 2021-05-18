<?php 
/**
 * Plugin Name: my-little-tribu
 */

use MyLittleTribu\Plugin;

require __DIR__ . '/vendor/autoload.php';


 // STEP plugin : instanciation de l'objet
 $mylittletribu = new Plugin();

// DOC Hook activation plugin https://developer.wordpress.org/reference/functions/register_activation_hook/
// save HOOK, which starts when the plugin is activated

register_activation_hook(
    __FILE__, // root file
    // we call the activate method on the plugin object
    [$mylittletribu , 'activate']
);

register_deactivation_hook(
    __FILE__,
    // we call the deactivate method on the plugin object
    [$mylittletribu , 'deactivate']
);
