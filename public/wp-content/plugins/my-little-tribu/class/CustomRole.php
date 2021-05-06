<?php

namespace MyLittleTribu;

class CustomRole
{

public function register()
{
    // STEP plugin, ajout d'un rôle
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

    // STEP plugin ajouter des capabilities à un rôle
    // IMPORTANT récupération d'un rôle
    $guestRole = get_role('guest');
    // IMPORTANT ajouter d'une capability à un rôle
    // $guestRole->add_cap('delete_developers');
    // $guestRole->add_cap('edit_developers');
    // $guestRole->add_cap('read_private_developers');
    // $guestRole->add_cap('publish_developers');

    // DOC role, supprimer autorisation : https://developer.wordpress.org/reference/classes/wp_role/remove_cap/



    add_role(
        // identifiant du rôle
        'creator',
        // libellé
        'Creator',
        // liste des autorisations
        [
        //   'delete_others_projects' => false,
        //   'delete_private_projects' => true,
        //   'delete_projects' => true,
        //   'delete_published_projects' => false,
        //   'edit_others_projects' => false,
        //   'edit_private_projects' => true,
        //   'edit_projects' => true,
        //   'edit_published_projects' => true,
        //   'publish_projects' => true,
        //   'read_private_projects' => true,
        ]
    );
}

public function unregister()
{
    // STEP suppression d'un rôle
    remove_role('creator');
}


}