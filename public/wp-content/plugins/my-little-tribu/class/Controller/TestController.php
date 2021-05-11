<?php

namespace MyLittleTribu\Controller;

use MyLittleTribu\Model\CoreModel;
use MyLittleTribu\Model\PhotoModel;
use MyLittleTribu\Model\TribeModel;
use MyLittleTribu\Model\WPUserModel;


class TestController extends MainController
{

    public function model()
    {
        $tribeModel = new TribeModel();
     //   $tribeModel->createTable();
     //   $tribeModel->user_id = 17;
     //   $tribeModel->tribe_id = 17;
      //  $tribeModel->photo_id = 13;
        $tribeModel->insert();
    }

    public function create()
    {
        $participation = new TribeModel();

       //echo $participation->loadById(1)->get('id');
    }     
}

