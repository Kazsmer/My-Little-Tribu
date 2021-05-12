<?php

namespace MyLittleTribu\Controller;



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

    public function invitation()
    {
        $this->show('views/user/invitation.tpl.php');
    }

    public function createTribu()
    {
        $this->show('views/user/create-tribu.tpl.php');
    }
}


