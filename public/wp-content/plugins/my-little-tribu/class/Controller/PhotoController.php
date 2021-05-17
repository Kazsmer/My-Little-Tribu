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
        $this->show('process_upload.php');
    }



}