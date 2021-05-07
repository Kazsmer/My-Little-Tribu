<?php

/*

namespace MyLittleTribu\Model;

use WP_Query;

class WPUserModel
{
    public static function findByAuthorId($id)
    {

        // DOC wp query via id d'auteur https://developer.wordpress.org/reference/classes/wp_query/#author-parameters

        $options = [
            'post_type' => 'photo',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'author' => $id
        ];

        $wpQuery = new WP_Query($options);
        $posts = $wpQuery->posts;

        // nous retournons $posts[0] car seul le premier résultat nous intersse
        // il faudrait faire du contrôle de donnée (potentiellement donnée manquante)
        return $posts[0];
    }


    public static function findAll()
    {
        // configuration de la requête
        $options = [
            'post_type' => 'photo',
            'post_status' => 'publish',
            'posts_per_page' => 10,
            // DOC wp_query orderby https://developer.wordpress.org/reference/classes/wp_query/#order-orderby-parameters
            'orderby' => 'date',
            // sens dans lequel wp va classer les données, ici du plus petit au plus grand
            'order' => 'DESC',
            // TIPS pagination : https://developer.wordpress.org/reference/classes/wp_query/#pagination-parameters

            // TIPS nous selection tous les posts respectant les critères de selection
            //'posts_per_page' => -1
        ];

        $wpQuery = new WP_Query($options);

        $photos = $wpQuery->posts;
        return $photos;
    }
}

*/
