<?php

namespace MyLittleTribu\CustomPostType;

use WP_Query;

class Photo
{

    public function initialize()
    {
        add_action('init', [$this, 'createPhotoPostType']);
        add_action('init', [$this, 'createCustomTaxonomies']);
    }

    public function createPhotoPostType()
    {
        // DOC create custom post type https://developer.wordpress.org/reference/functions/register_post_type/

        $labels = [
            'name' => 'Photo',
            'singular_name' => 'Photo',
            'menu_name' => 'Photo',
            'all_items' => 'Toutes les photos',
            'view_item' => 'Voir',
            'add_new_item' => 'Ajouter une photo',
            'add_new' => 'Ajouter',
            'edit_item' => 'Editer',
            'update_item' => 'Editer',
            'search_items' => 'Chercher une photo',
            'not_found' => 'Aucun résultat',
            'not_found_in_trash' => 'Aucun résultat dans la corbeille',
        ];

        register_post_type(
            'photo',    // identifiant du cpt
            [
                'label' => 'Photo',
                'labels' => $labels,
                'public' => true,   // le cpt pourra être édité depuis le bo
                'hierarchical' => false,
                'show_in_rest' =>  true,    // notre cpt sera accessible depuis l'api rest de wp
                'singular_name' => 'Photo',
                'add_new_item' => 'Ajouter une photo',

                'capability_type' => 'photo',
               
                'map_meta_cap' => true,

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


        // STEP plugin : déclaration de post custom metadata
        // enregistrement de l'email du customer
        // DOC options de déclaration d'une custom meta https://developer.wordpress.org/reference/functions/register_meta/

        $options = [
            'type' => 'string',
            // la custom meta n'est un type "composé" (par exemple ce n'est pas un tableau)
            'single' => true,
            // la custom méta s'affichera dans l'api
            'show_in_rest' => true
        ];
        // nous associons la custom meta au cpt customer
        register_post_meta('photo', 'tribe_id', $options);

        // Lorsque wordpress affichera le formulaire d'édition d'un customer, nous lui indiquons comment afficher le champ email

        add_action('edit_form_after_editor', [$this, 'displayTribeForm']);

        // nous disons à wordpress d'enregistrer la custom meta email (pour le cpt customer) au moment de la sauvegarde d'un post de type Customer (struture du nom du hook : 'save_post_"+ identifiantCPT)
        add_action('save_post_photo', [$this, 'saveTribeId']);



        $options = [
            'type' => 'string',
            // la custom meta n'est un type "composé" (par exemple ce n'est pas un tableau)
            'single' => true,
            // la custom méta s'affichera dans l'api
            'show_in_rest' => true
        ];
        // nous associons la custom meta au cpt customer
        register_post_meta('photo', 'date_photo', $options);
    }

    public function saveTribeId($postId)
    {
        // STEP plugin, sauvegarde post custom meta
        // récupération de la valeur envoyée dans le formulaire pour le champs email

        // TIPS sécurité : il faut vérifier que la valeur saisie est bien un email avec l'option FILTER_VALIDATE_EMAIL
        // DOC filter inputs https://www.php.net/manual/fr/filter.filters.validate.php
        $tribeId = filter_input(INPUT_POST, 'tribe_id');

        // si $email a une valeur, nous l'enregistrons
        if ($tribeId) {
            // IMPORTANT sauvegarde de l'email pour le post actuellement sauvegardé
            update_post_meta(
                // pour quel post nous souhaitons enregistrer un "champ custom" (custom meta)
                $postId,
                // pour quel champs custom nous enregistrons une valeur
                'tribe_id',
                // ma valeur à enregistrer
                $tribeId
            );
        }
    }

    public function displayTribeForm($post)
    {
        if ($post->post_type !== 'photo') {
            return false;
        }

        // récupération de l'id du post que nous sommes en train d'éditer
        $postId = $post->ID;

        // récuparation de la méta email associée au post
        $tribeId = get_post_meta(
            $postId,    // le post sur leque nous travaillons
            'tribe_id', // quel custom meta nous récupérer
            true // true pour dire à wordpress, je ne veux pas le résultat sous la forme d'un tableau
        );


        // configuration de la requête
        $options = [
            'post_type' => 'tribe',

            // permet de filtrer les résultats en fonction du status des posts
            // DOC WP_query recherche par status https://developer.wordpress.org/reference/classes/wp_query/#status-parameters
            'post_status' => 'publish',

            // DOC wp_query orderby https://developer.wordpress.org/reference/classes/wp_query/#order-orderby-parameters
            'orderby' => 'title',
            // sens dans lequel wp va classer les données, ici du plus petit au plus grand
            'order' => 'ASC',


            // TIPS pagination : https://developer.wordpress.org/reference/classes/wp_query/#pagination-parameters

            // TIPS nous selection tous les posts respectant les critères de selection
            'posts_per_page' => -1
        ];

        // WARNING wp_query : Très important !
        // DOC wp_query https://developer.wordpress.org/reference/classes/wp_query/
        // construction de la requête
        $wpQuery = new WP_Query($options);

        $tribes = $wpQuery->posts;

        echo '
            <div id="tribediv" style="margin-top: 1rem">
                <div id="tribewrap" class="form-field">
                    <label class="" id="tribe-prompt-text" for="tribe">Tribue</label>
            ';

        echo '<select name="tribe_id">';

        foreach ($tribes as $tribe) {
            if ($tribeId == $tribe->ID) {
                echo '<option selected value="' . $tribe->ID. '">' . $tribe->post_title .'</option>';
            } else {
                echo '<option value="' . $tribe->ID. '">' . $tribe->post_title .'</option>';
            }
        }

        echo '</select>';

        echo '
                </div>
            </div>
        ';
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
                'hierarchical' => true,
            ]
        );
    }
}