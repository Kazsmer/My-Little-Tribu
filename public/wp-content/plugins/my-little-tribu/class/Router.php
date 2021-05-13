<?php

namespace MyLittleTribu;

use MyLittleTribu\Controller\UserController;
use MyLittleTribu\Controller\TestController;

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

        add_rewrite_rule(
            // premier argument : regexp validant l'url
            /* cette regexpt valide les url du type :
                - n'importe quoi
                - suivi de user/login
                - avec optionnellement un / (caractère ? signifie optionnel)
                - et l'url se termine (caratère $ === fin de chaine)

            */
            'user/login/?$',
            // second paramètre : vers quelle "url virtuelle" wordpress interprète l'url demandée par le visiteur
            'index.php?custom-route=user-login',
            // nous mettons le route en haut de la pile de priorité des routes
            'top'
        );


        add_rewrite_rule(
            'user/checkLogin/?$',
            'index.php?custom-route=user-checkLogin',
            'top'
        );

        add_rewrite_rule(
            'user/home/?$',
            'index.php?custom-route=user-home',
            'top'
        );
     
        add_rewrite_rule(
            'user/register/?$',
            'index.php?custom-route=user-register',
            'top'
        );

        // Création d'un user guest
        add_rewrite_rule(
            'user/create/?$',
            'index.php?custom-route=user-create',
            'top'
        );

        add_rewrite_rule(
            'user/invitation/?$',
            'index.php?custom-route=user-invitation',
            'top'
        );

        add_rewrite_rule(
            'user/addInvitation/?$',
            'index.php?custom-route=user-add-invitation',
            'top'
        );

        add_rewrite_rule(
            'user/create-tribu/?$',
            'index.php?custom-route=user-create-tribu',
            'top'
        );

        add_rewrite_rule(
            'user/create-tribu-name/?$',
            'index.php?custom-route=user-create-tribu-name',
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
        add_action('template_include', function($template) {

            // le paramètre $template indique quel template (page) wordpress charge pour l'url demandée

            // récupération de la variable "virtuelle" custom-route
            $customRouteParameter = get_query_var('custom-route');

            // en fonction de la valeur de $customRouteParameter, nous pouvons décider d'afficher tel ou tel template
            if($customRouteParameter === 'user-login') {
                $controller = new UserController();
                $controller->login();
            }
            elseif($customRouteParameter === 'user-checkLogin') {
                 $controller = new UserController();
                 $controller->checkLogin();
            }

            elseif($customRouteParameter === 'user-home') {
                $controller = new UserController();
                $controller->home();
            }
        
            elseif($customRouteParameter === 'user-register') {
                $controller = new UserController();
                $controller->register();
            }
            elseif($customRouteParameter === 'user-create') {
                $controller = new UserController();
                $controller->create();
            }

            elseif($customRouteParameter === 'user-invitation') {
                $controller = new UserController();
                $controller->invitation();
            }

            elseif($customRouteParameter === 'user-add-invitation') {
                $controller = new UserController();
                $controller->addInvitation();
            }

            elseif($customRouteParameter === 'user-create-tribu') {
                $controller = new UserController();
                $controller->createTribu();
            }
            elseif($customRouteParameter === 'user-create-tribu-name') {
                $controller = new UserController();
                $controller->createTribuName();
            }
            /*elseif($customRouteParameter === 'user-create') {
                $controller = new User();
                $controller->create();
            }
            elseif($customRouteParameter === 'user-confirm-delete') {
                $controller = new User();
                $controller->confirmDelete();
            }
            elseif($customRouteParameter === 'user-delete') {
                $controller = new User();
                $controller->delete();
            }
            elseif($customRouteParameter === 'user-edit') {
                $controller = new User();
                $controller->edit();
            }
            elseif($customRouteParameter === 'user-update') {
                $controller = new User();
                $controller->update();
            }
            elseif($customRouteParameter === 'test-model') {
                $controller = new Test();
                $controller->model();
            }
            elseif($customRouteParameter === 'test-developer-model') {
                $controller = new Test();
                $controller->developerModel();
            }
            elseif($customRouteParameter === 'test-developer-participation-loadbyid') {
                $controller = new Test();
                $controller->developerProjectLoadById();
            }
            elseif($customRouteParameter === 'test-developer-get-developer') {
                $controller = new Test();
                $controller->developerProjectGetDeveloper();
            }
            elseif($customRouteParameter === 'test-developer-get-project') {
                $controller = new Test();
                $controller->developerProjectGetProject();
            }
            elseif($customRouteParameter === 'test-developer-update') {
                $controller = new Test();
                $controller->developerProjectUpdate();
            }
            elseif($customRouteParameter === 'user-project-participation') {
                $controller = new User();
                $controller->projectParticipation();
            }
            elseif($customRouteParameter === 'user-technology') {
                $controller = new User();
                $controller->technology();
            }
            elseif($customRouteParameter === 'user-update-technology') {
                $controller = new User();
                $controller->updateTechnology();
            }
            */

            else {
                // si nous ne souhaitons pas gérer nous même le template, nous retournons le template que wordpress voulait utiliser à la base
                return $template;
            }
        });
    }
}

