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

    public function displayPhoto()

    {
      /*   $getPhotos = WPUserModel::findAll();
        echo '<div style="border: solid 2px #F00">';
            echo '<div style=" background-color:#CCC">@'.__FILE__.' : '.__LINE__.'</div>';
            echo '<pre style="background-color: rgba(255,255,255, 0.8)">';
            echo '</pre>';
        echo '</div>'; */


        $this->show('single-photoDetail.php');

    }

    public function displayPhotobyTribuId()

    {
     /*    $getPhotosByTribuId = WPUserModel::findByAuthorId($id);
        echo '<div style="border: solid 2px #F00">';
            echo '<div style="; background-color:#CCC">@'.__FILE__.' : '.__LINE__.'</div>';
            echo '<pre style="background-color: rgba(255,255,255, 0.8);">';
            echo '</pre>';
        echo '</div>';
 */
    }


    function wp_delete_post($postid = 0, $force_delete = false)
    {
        global $wpdb;
     
        $post = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE ID = %d", $postid));
     
        if (! $post) {
            return $post;
        }
     
        $post = get_post($post);
    }



    }

