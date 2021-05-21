<?php

namespace MyLittleTribu\Controller;

use MyLittleTribu\Model\GuestTribeModel;

class TribeController extends MainController
{
    public function deleteTribe () {

        $tribeId = filter_input(INPUT_GET, 'id');
        $model = new GuestTribeModel();

        $subscriptions = $model->getGuestByTribeId($tribeId);
        foreach($subscriptions as $subscription) {
            $subscription->delete();
        }

        wp_delete_post($tribeId);
        // redirection
        wp_redirect(get_home_url() . '/single-photoDetail' );
    }
}
