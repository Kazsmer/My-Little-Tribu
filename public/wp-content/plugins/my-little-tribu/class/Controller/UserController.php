<?php

namespace MyLittleTribu\Controller;

use MyLittleTribu\Model\WPUserModel;
use MyLittleTribu\Model\GuestTribeModel;
use WP_User;

require_once(ABSPATH.'wp-admin/includes/user.php');

class UserController extends MainController
{
    public function tribe()
    {
        // Récupération de l'utilisateur courant
        $user = wp_get_current_user();

        // récupération du CPT de type developer associé à l'utilisateur courant
        $guest = WPUserModel::findByAuthorId($user->ID);


        $guestTribeModel = new GuestTribeModel();

        // récupération des technologies maitrisées par le développeur
        $tribes = $guestTribeModel->getTribeByGuestId($guest->ID);

        $this->show('addpicture.tpl.php', [
            'tribes' => $tribes
        ]);
    }
}