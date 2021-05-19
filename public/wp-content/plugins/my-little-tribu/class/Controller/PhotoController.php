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
        //$this->show('process_upload.php');
    }

}