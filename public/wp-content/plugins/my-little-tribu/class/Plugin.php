<?php

namespace MyLittleTribu;

//use MyLittleTribu\Model\TribeModel;
//use MyLittleTribu\Router;


class Plugin
{

   /* public function __construct()
    {
        $this->initialize();
        
    }

    */

    /*public static function activate()
    {
        // enregistrement des rôles spécifiques à oProfile
        // $customRole = new CustomRole();
        // $customRole->register();

        // création des tables en bdd
        $tribeModel = new TribeModel();
        $tribeModel->createTable();
    }

    public static function deactivate()
    {
        // $customRole = new CustomRole();
        // $customRole->unregister();

        // suppresion des tables en bdd (attention ceci est à titre pédagogique)
        $tribeModel = new TribeModel();
        $tribeModel->dropTable();
    }

   protected function initialize()
   {
       // au moment de l'initialisation de wordpress, nous enregistrons les custom post types et les custom taxonomies dont nous avons besoin

       // $photo = new PhotoModel();
       //$photo->initialize();

       $tribe = new TribeModel();
       $tribe->initialize();
       

       add_action('init', [$this, 'createCustomPostTypes']);
       add_action('init', [$this, 'createCustomTaxonomies']);
       
   }

   */

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


    add_action('init','createCustomPostTypes')


       /*
        // STEP plugin : déclaration de post custom metadata
        // enregistrement de IdGuest
        // DOC options de déclaration d'une custom meta https://developer.wordpress.org/reference/functions/register_meta/
        $options = [
            'type' => 'string',
            // la custom meta n'est un type "composé" (par exemple ce n'est pas un tableau)
            'single' => true,
            // la custom méta s'affichera dans l'api
            'show_in_rest' => true
        ];
        // nous associons la custom meta au cpt tribe
        register_post_meta('tribe', 'guestId', $options);

        // Lorsque wordpress affichera le formulaire d'édition d'un tribe, nous lui indiquons comment afficher le champ email

        add_action('edit_form_after_editor', [$this, 'displayGuestIdForm']);

        // nous disons à wordpress d'enregistrer la custom meta email (pour le cpt customer) au moment de la sauvegarde d'un post de type Customer (struture du nom du hook : 'save_post_"+ identifiantCPT)
        add_action('save_post_tribe', [$this, 'saveTribeUserIdMeta']);
    }


    // worpress nous envoie un objet WP_Post lorsque le hook edit_form_after_editor est executé
    public function displayUserIdForm ($post)
    {

        if($post->post_type !== 'tribe') {
            return false;
        }

        // récupération de l'id du post que nous sommes en train d'éditer
        $postId = $post->ID;

        // récuparation de la méta email associée au post
        $githubURL = get_post_meta(
            $postId,    // le post sur leque nous travaillons
            'github_url', // quel custom meta nous récupérer
            true // true pour dire à wordpress, je ne veux pas le résultat sous la forme d'un tableau
        );

        // TIPS sécurité : utilisation de htmlentities pour le pas afficher du code html corrompu (exemple javasript malveillant)
        $githubURL = htmlentities($githubURL);

        echo '
            <div id="githubdiv" style="margin-top: 1rem">
                <div id="githubwrap" class="form-field">
                    <label class="" id="github-prompt-text" for="github">Github URL</label>
                    <input type="text" name="developer_github" size="30" value="' . $githubURL . '" id="github" style="width: 100%">
                </div>
            </div>
        ';
    }

    // le paramètre postId est renseigné par worpress au moment du déclenchement du hook save_post_*
    public function saveTribeUSerIdMeta ($postId)
    {

        // STEP plugin, sauvegarde post custom meta
        // récupération de la valeur envoyée dans le formulaire pour le champs email

        // TIPS sécurité : il faut vérifier que la valeur saisie est bien un email avec l'option FILTER_VALIDATE_EMAIL
        // DOC filter inputs https://www.php.net/manual/fr/filter.filters.validate.php
        $github = filter_input(INPUT_POST, 'developer_github', FILTER_VALIDATE_URL);

        // si $email a une valeur, nous l'enregistrons
        if($github) {
            // IMPORTANT sauvegarde de l'email pour le post actuellement sauvegardé
            update_post_meta(
                // pour quel post nous souhaitons enregistrer un "champ custom" (custom meta)
                $postId,
                // pour quel champs custom nous enregistrons une valeur
                'github_url',
                // ma valeur à enregistrer
                $github
            );
        }
    }
    }
    */

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

   
/*    public function createCustomRoles()
    {
        // 1er agument l'idenfiant du rôle, second argument le libellé
        add_role('guest', 'Invite');
        add_role('creator', 'Createur');
    }



    public function activate()
    {
        $this->createCustomRoles();
    }

    public function deactivate()
    {
        remove_role('guest');
    }

    */
}
