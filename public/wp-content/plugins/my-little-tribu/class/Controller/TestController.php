<?php

namespace MyLittleTribu\Controller;

use MyLittleTribu\Model\CoreModel;
use MyLittleTribu\Model\GuestTribeModel;
use MyLittleTribu\Model\PhotoModel;
use MyLittleTribu\Model\TribeModel;
use MyLittleTribu\Model\WPUserModel;


class TestController extends MainController
{

    public function model()
    {
    }

    public function create()
    {
        $guestTribeModel = new GuestTribeModel();
        $guestTribeModel->tribe_id = 19;
        $guestTribeModel->guest_id = 2;
        $guestTribeModel->insert();
        echo __FILE__.':'.__LINE__; exit();
    }

    public function listGuestByTribeId()
    {
        $guestTribeModel = new GuestTribeModel();
        $results = $guestTribeModel->getGuestByTribeId(19);

        echo '<div style="border: solid 2px #F00">';
            echo '<div style="; background-color:#CCC">@'.__FILE__.' : '.__LINE__.'</div>';
            echo '<pre style="background-color: rgba(255,255,255, 0.8);">';
            print_r($results);
            echo '</pre>';
        echo '</div>';
    }


    public function getTribeByGuestId()
    {
        $guestTribeModel = new GuestTribeModel();
        $results = $guestTribeModel->getTribeByGuestId(2);

        echo '<div style="border: solid 2px #F00">';
            echo '<div style="; background-color:#CCC">@'.__FILE__.' : '.__LINE__.'</div>';
            echo '<pre style="background-color: rgba(255,255,255, 0.8);">';
            print_r($results);
            echo '</pre>';
        echo '</div>';
    }
}

