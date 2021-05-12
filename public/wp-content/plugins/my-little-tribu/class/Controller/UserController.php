<?php

namespace MyLittleTribu\Controller;

use WP_User;

require_once(ABSPATH.'wp-admin/includes/user.php');

class UserController extends MainController
{

    // la méthode login sera responsable d'afficher la page de login
    public function login()
    {
        $this->show('views/user/login.tpl.php');
    }

    // cette méthode vérifie si le login et le mot de passe saisis par l'utilisateur sont correct
    public function checkLogin()
    {
      // récupération du login saisi
      $login = filter_input(INPUT_POST, 'login');
      $password = filter_input(INPUT_POST, 'password');

      // vérification des données saisies
      // DOC check user login : https://developer.wordpress.org/reference/functions/wp_authenticate/

      $result = wp_authenticate($login, $password);

      if($result instanceof \WP_User) {
          // si $result est un objet (une instance) de type \WP_User, l'utilisateur s'est bien connecté
          $this->authentificateUser($result->ID);

          // nous redirigeons l'utilisateur vers sa home personnelle
          $this->redirect('/user/home');

      }
      else {
          // $result est un object de type \WP_Error
          // nous passons à la vue un index indiquant que le login a échoué
          $this->show('views/user/login.tpl.php', [
              'error' => true,
              'message' => 'Erreur d\'authentification'
          ]);
      }
        
    }

    public function home()
    {
        $this->show('views/user/home.tpl.php');
    }

    public function register()
    {
        $this->show('views/user/register.tpl.php');
    }

    public function create()
    {

        $prenom = filter_input(INPUT_POST, 'prenom');
        $nom = filter_input(INPUT_POST, 'nom');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        // DOC wp create user : https://developer.wordpress.org/reference/functions/wp_create_user/
        $result = wp_create_user($prenom, $nom, $email, $password);

        // si la création d'un utilisateur a fonctionné, $result vaut l'id du nouvel utilisateur
        // sinon $result est un objet de type \WP_Error

        if(is_int($result)) {

            // IMPORTANT récupération d'un utilisateur wordpress par id
            $newUser = new WP_User($result);
            // nous retirons le role "subscriber" du nouvel utilisateur
            $newUser->add_role('guest');
            $postType = 'guest';

            // IMPORTANT création d'un post de type "developer" (cpt) associé au nouvel utilisateur
            // DOC creation d'un post wp https://developer.wordpress.org/reference/functions/wp_insert_post/

            $options = [
                'post_title' => $prenom,
                // $result contient l'id de l'utilisateur qui vient de  s'inscrire
                'post_name' => $nom,
                'post_author' => $result,
                'post_status' => 'publish',
                'post_type' => $postType
            ];

            $postCreationResult = wp_insert_post($options);


            $this->authentificateUser($result);
            $this->redirect('/user/create-tribu');
        }
        else {
            $messages = [];
            if(array_key_exists('existing_user_login', $result->errors)) {
                $messages[] = "Login déjà existant";
            }
            if(array_key_exists('empty_user_login', $result->errors)) {
                $messages[] = "Le login ne peut pas être vide";
            }

            $this->show('views/user/register.tpl.php', [
                'error' => 1,
                'messages' => $messages
            ]);
        }
        // TIPS get_defined_vars permet d'avoir la liste des variabls définies ainsi que leur valeurs
        // get_defined_vars()
    }

    public function invitation()
    {
        $this->show('views/user/invitation.tpl.php');
    }

    public function createTribu()
    {
        $this->show('views/user/create-tribu.tpl.php');
    }
}


