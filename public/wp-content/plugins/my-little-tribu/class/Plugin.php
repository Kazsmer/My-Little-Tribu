<?php

namespace MyLittleTribu;

use MyLittleTribu\Model\TribeModel;
use MyLittleTribu\Router;


class Plugin
{

   public function __construct()
    {
        $this->initialize();
        
    }

    protected function initialize()
    {
        // au moment de l'initialisation de wordpress, nous enregistrons les custom post types et les custom taxonomies dont nous avons besoin
 
        // $photo = new PhotoModel();
        //$photo->initialize();
 
        // $tribe = new TribeModel();
        // $tribe->initialize();

        $router = new Router();
 
        add_action('init', [$this, 'createCustomPostTypes']);
        add_action('init', [$this, 'createCustomTaxonomies']);
    }

    public static function activate()
    {
       // enregistrement des rôles spécifiques à oProfile
       $customRole = new CustomRole();
       $customRole->register();

        // création des tables en bdd
       $tribeModel = new TribeModel();
       $tribeModel->createTable();
    }

    public static function deactivate()
    {
        $customRole = new CustomRole();
        $customRole->unregister();

        // suppresion des tables en bdd (attention ceci est à titre pédagogique)
       $tribeModel = new TribeModel();
       $tribeModel->dropTable();
        
    }


    public function createCustomPostTypes()
    {
        // DOC create custom post type https://developer.wordpress.org/reference/functions/register_post_type/
        register_post_type(
            'photo',    // identifiant du cpt
            [
                'label' => 'Photo',
                'public' => true,   // le cpt pourra être édité depuis le bo
                'hierarchical' => false,
                'show_in_rest' =>  true,    // notre cpt sera accessible depuis l'api rest de wp
                'singular_name' => 'Photo',
                'add_new_item' => 'Ajouter une photo',

                'supports' => [
                    'title',
                    'editor',
                    'thumbnail',
                    'author',
                    'comments',
                    'custom-fields',
                ]
            ]
        );
            
        register_post_type(
            'tribe',
            [
                'label' => 'Tribu',
                'public' => true,   // le cpt pourra être édité depuis le bo
                'hierarchical' => false,
                'show_in_rest' =>  true,    // notre cpt sera accessible depuis l'api rest de wp
                //'capability_type' => 'tribe',
               
                'supports' => [
                    'title',
                    'editor',
                    'thumbnail',
                    'author',
                    'custom-fields'
                ]
            ]
        );
    }    


   public function createCustomTaxonomies()
    {

        // création de la taxonomie ingredient
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
                'hierarchical' => false,
            ]
        );
    }

  
}
