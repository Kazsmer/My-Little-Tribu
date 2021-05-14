<?php

namespace MyLittleTribu;

class CustomRole
{

    public function register()
    {
        // DOC add_role https://developer.wordpress.org/reference/functions/add_role/
        add_role(
            // identifiant du rôle
            'guest',
            // libellé
            'Guest',
            // liste des autorisations
            [
                'publish_posts' => true,
                //      'edit_posts' => true,
                //        'delete_posts' => true,
                //        'edit_published_posts' => true,
                //        'delete_published_posts' => true,
                'upload_files' => true,
                'read' => true,
            ]
        );

        add_role(
            // identifiant du rôle
            'creator',
            // libellé
            'Creator',
            // liste des autorisations
            [
                'delete_photo' => true,
                //   'edit_private_projects' => true,
                //   'edit_projects' => true,
                //   'edit_published_projects' => true,
                'publish_photo' => true,
                //   'read_private_projects' => true,
            ]
        );

    }

    public function unregister()
    {
        remove_role('creator');
        remove_role('guest');
    }
}
