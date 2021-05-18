<?php

namespace MyLittleTribu;

use MyLittleTribu\Model\GuestTribeModel;
use MyLittleTribu\Model\TribeModel;
use MyLittleTribu\Router;
use MyLittleTribu\CustomPostType\Generic;
use MyLittleTribu\CustomPostType\Photo;
use MyLittleTribu\CustomPostType\Tribe;
use WP_Query;

class Plugin
{
    public function __construct()
    {
        $this->initialize();
    }
    
    public static function activate()
    {
        // enregistrement des rôles spécifiques à oProfile
        $customRole = new CustomRole();
        $customRole->register();

        // création des tables en bdd
        // $tribeModel = new TribeModel();
        // $tribeModel->createTable();

        $guestTribeModel = new GuestTribeModel();
        $guestTribeModel->createTable();
    }

    public static function deactivate()
    {
        $customRole = new CustomRole();
        $customRole->unregister();

        // suppresion des tables en bdd (attention ceci est à titre pédagogique)
        $guestTribeModel = new GuestTribeModel();
        $guestTribeModel->dropTable();
    }

    protected function initialize()
    {
        // au moment de l'initialisation de wordpress, nous enregistrons les custom post types et les custom taxonomies dont nous avons besoin

        $photo = new Photo();
        $photo->initialize();

        $tribe = new Tribe();
        $tribe->initialize();

        register_taxonomy(
            'event',  //identifiant
            ['photo'], // a quel cpt la taxonomie est associée
            [
                'label' => 'Evenement',
                'public' => true,   // gérable depuis le bo
                'show_in_rest' => true,
                'hierarchical' => true,
            ]
        );

        register_taxonomy(
            'person',
            ['photo'],
            [
                'label' => 'Personnage',
                'public' => true,
                'show_in_rest' => true,
                'hierarchical' => true,
            ]
        );
        $router = new Router();
    }
}