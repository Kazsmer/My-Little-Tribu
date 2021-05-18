<?php

namespace MyLittleTribu\Controller;

use MyLittleTribu\Model\CoreModel;
use MyLittleTribu\Model\WPUserModel;

class PhotoController extends MainController
{
    public function uploadPhoto()
    {
        $this->show('views/addpicture.tpl.php');
    }

    public function processUpload()

    {
    
        $r = require( get_template_part('process_upload') );
        //var_dump('ça fonctionne');
        //$this->show('process_upload.php');
        $this->redirect('/user/private-page');
    }



}