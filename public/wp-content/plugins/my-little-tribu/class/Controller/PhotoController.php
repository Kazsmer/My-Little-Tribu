<?php

namespace MyLittleTribu\Controller;

use MyLittleTribu\Model\CoreModel;
use MyLittleTribu\Model\GuestTribeProject;
use MyLittleTribu\Model\WPUserModel;

class PhotoController extends MainController
{
    public function uploadPhoto()
    {
        $this->show('addpicture.tpl.php');
    }

    public function processUpload()

    {
        $this->show('process_upload.tpl.php');
    }

}