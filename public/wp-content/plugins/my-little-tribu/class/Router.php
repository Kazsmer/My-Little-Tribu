<?php

namespace MyLittleTribu;

use MyLittleTribu\Controller\UserController;
use MyLittleTribu\Controller\TestController;
use MyLittleTribu\Controller\PhotoController;

// Cette classe va nous permettre de dire à wordpress que certaine url seront gérées par le plugin
class Router
{
    public function __construct()
    {
        // à l'inialisation de worpress, le router inquera à wordpress quelles routes le plugin gère
        add_action('init', [$this, 'registerRoutes']);
    }

    public function registerRoutes()
    {
        // DOC route wordpress https://developer.wordpress.org/reference/functions/add_rewrite_rule/

        // DOC regexp  http://www.expreg.com/presentation.php

        /* add_rewrite_rule(
             // premier argument : regexp validant l'url
             /* cette regexpt valide les url du type :
                 - n'importe quoi
                 - suivi de user/login
                 - avec optionnellement un / (caractère ? signifie optionnel)
                 - et l'url se termine (caratère $ === fin de chaine)


             'user/login/?$',
             // second paramètre : vers quelle "url virtuelle" wordpress interprète l'url demandée par le visiteur
             'index.php?custom-route=user-login',
             // nous mettons le route en haut de la pile de priorité des routes
             'top'
         )
         */

        add_rewrite_rule(
            'test/create?$',
            'index.php?custom-route=create',
            'top'
        );

        add_rewrite_rule(
            'test/listGuestByTribeId?$',
            'index.php?custom-route=listGuestByTribeId',
            'top'
        );

        add_rewrite_rule(
            'test/getTribeByGuestId?$',
            'index.php?custom-route=getTribeByGuestId',
            'top'
        );

        add_rewrite_rule(
            'uploadPhoto/?$',
            'index.php?custom-route=upload-photo',
            'top'
        );

        add_rewrite_rule(
            'processUpload/?$',
            'index.php?custom-route=process_upload',
            'top'
        );




        // wordpress enregistre le url en base de donnée. Etant donné que nous déclarons une nouvelle route, de façon "brutale" nous forçons wordpress à rafraichir sont cache d'url
        flush_rewrite_rules();

        add_filter('query_vars', function ($query_vars) {
            // $query_vars est la liste des "variables virtuelles" que wordpress gère depuis des "urls virtuelles"

            // nous indiquons à wordpress qu'il doit gérer une "variable virtuelle" custom-route
            $query_vars[] = 'custom-route';
            // IMPORTANT ne pas oublier de retourner $query_vars
            return $query_vars;
        });

        // ce hook est déclenché lorsque wordpress essaye de charger un template (une page) en fonction de l'url demandée par le visiteur
        add_action('template_include', function ($template) {

    // le paramètre $template indique quel template (page) wordpress charge pour l'url demandée

            // récupération de la variable "virtuelle" custom-route
            $customRouteParameter = get_query_var('custom-route');

            // en fonction de la valeur de $customRouteParameter, nous pouvons décider d'afficher tel ou tel template
            if ($customRouteParameter === 'create') {
                $controller = new TestController();
                $controller->create();
            }
            elseif ($customRouteParameter === 'getTribeByGuestId') {
                $controller = new TestController();
                $controller->getTribeByGuestId();
            }
            elseif ($customRouteParameter === 'listGuestByTribeId') {
                $controller = new TestController();
                $controller->listGuestByTribeId();
            }

            elseif ($customRouteParameter === 'upload-photo') {
                $controller = new PhotoController();
                $controller->uploadPhoto();
            }

            elseif ($customRouteParameter === 'process_upload') {
                $controller = new PhotoController();
                $controller->processUpload();
            }

            else {
                // si nous ne souhaitons pas gérer nous même le template, nous retournons le template que wordpress voulait utiliser à la base
                return $template;
            }
        });
    }
}
