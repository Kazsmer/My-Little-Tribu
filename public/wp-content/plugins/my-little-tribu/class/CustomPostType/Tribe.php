<?php

namespace MyLittleTribu\CustomPostType;

class Tribe
{
    public function initialize()
    {
        add_action('init', [$this, 'createTribePostType']);
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
    
    public function createTribePostType()
    {
        $labels = [
            'name' => 'Tribu',
            'singular_name' => 'Tribu',
            'menu_name' => 'Tribu',
            'all_items' => 'Toutes les tribus',
            'view_item' => 'Voir',
            'add_new_item' => 'Ajouter une tribu',
            'add_new' => 'Ajouter',
            'edit_item' => 'Editer',
            'update_item' => 'Editer',
            'search_items' => 'Chercher une tribu',
            'not_found' => 'Aucun résultat',
            'not_found_in_trash' => 'Aucun résultat dans la corbeille',
        ];

        register_post_type(
            'tribe',
            [
                'label' => 'Tribu',
                'labels' => $labels,
                'public' => true,   // le cpt pourra être édité depuis le bo
                'hierarchical' => false,
                'show_in_rest' =>  true,    // notre cpt sera accessible depuis l'api rest de wp
                'show_in_menu' => true,
                
                'capability_type' => 'tribe',
               
                'map_meta_cap' => true,

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
}