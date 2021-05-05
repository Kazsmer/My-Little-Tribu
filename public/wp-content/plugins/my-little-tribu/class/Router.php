<?php
/*
namespace OProfile;

use OProfile\Controller\User;
use OProfile\Controller\Test;

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

/*
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
            'user/signup/?$',
            'index.php?custom-route=user-signup',
            'top'
        );

        add_rewrite_rule(
            'user/create/?$',
            'index.php?custom-route=user-create',
            'top'
        );

        add_rewrite_rule(
            'user/confirm-delete/?$',
            'index.php?custom-route=user-confirm-delete',
            'top'
        );

        add_rewrite_rule(
            'user/delete/?$',
            'index.php?custom-route=user-delete',
            'top'
        );
        add_rewrite_rule(
            'user/edit/?$',
            'index.php?custom-route=user-edit',
            'top'
        );

        add_rewrite_rule(
            'user/update/?$',
            'index.php?custom-route=user-update',
            'top'



    