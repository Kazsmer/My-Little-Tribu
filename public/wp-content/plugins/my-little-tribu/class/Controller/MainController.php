<?php

namespace MyLittleTribu\Controller;

class MainController
{
    public function __construct()
    {


    }

    public function authentificateUser($userId)
    {
        wp_clear_auth_cookie();
        wp_set_current_user($userId);
        wp_set_auth_cookie($userId);
    }

    // IMPORTANT : REDIRIGER VERS PRIVATE PAGE !!!!
    
    public function redirect($location, $status = 302, $redirectedBy = 'my-little-tribu', $baseURI = null)
    {
        if($baseURI === null) {
            $baseURI = get_home_url();
        }

        // DOC redirection wp  https://developer.wordpress.org/reference/functions/wp_redirect/
        return wp_redirect($baseURI . $location, $status, $redirectedBy);
    }


    // cette méthode se charge d'afficher le template demandé
    // $viewVars est un tableau de variables que l'on envoie au template
    public function show($template, $viewVars = [])
    {


        // nous demandons à wordpress de trouver le vrai fichier correspondant au template que nous souhaitons afficher
        $realTemplate = locate_template($template);


        // DOC charger un template en wordpress : https://developer.wordpress.org/reference/functions/load_template/

        load_template(
            // le fichier template à charger
            $realTemplate,
            // est ce que le template sera chargé qu'une seule fois
            true,
            // les variables à transmettre au template
            $viewVars
        );
    }
}


