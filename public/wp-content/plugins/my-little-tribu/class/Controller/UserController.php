<?php

namespace MyLittleTribu\Controller;

/*
// IMPORTANT : A MODIFIER
use MyLittleTribu\Model\ !!!

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

            // IMPORTANT : REDIRIGER VERS SA PAGE PRIVEE
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


    public function signup()
    {
        $this->show('views/user/signup.tpl.php');
    }

    public function create()
    {

        $login = filter_input(INPUT_POST, 'login');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $type = filter_input(INPUT_POST, 'type');

        // DOC wp create user : https://developer.wordpress.org/reference/functions/wp_create_user/
        $result = wp_create_user($login, $password, $email);

        // si la création d'un utilisateur a fonctionné, $result vaut l'id du nouvel utilisateur
        // sinon $result est un objet de type \WP_Error

        if(is_int($result)) {

            // IMPORTANT récupération d'un utilisateur wordpress par id
            $newUser = new WP_User($result);
            // nous retirons le role "subscriber" du nouvel utilisateur
            $newUser->remove_role('subscriber');

            // ajout du role choisi par le visiteur
            // WARNING il faut controler si le type d'utilisateur choisi par le visiteur est valide
            if($type === 'developer') {
                $newUser->add_role('developer');
                $postType = 'developer';
            }
            elseif($type === 'customer') {
                $newUser->add_role('customer');
                $postType = 'customer';
            }

            // IMPORTANT création d'un post de type "developer" (cpt) associé au nouvel utilisateur
            // DOC creation d'un post wp https://developer.wordpress.org/reference/functions/wp_insert_post/

            $options = [
                'post_title' => $login,
                // $result contient l'id de l'utilisateur qui vient de  s'inscrire
                'post_author' => $result,
                'post_status' => 'publish',
                'post_type' => $postType
            ];

            $postCreationResult = wp_insert_post($options);


            $this->authentificateUser($result);
            $this->redirect('/user/home');
        }
        else {
            $messages = [];
            if(array_key_exists('existing_user_login', $result->errors)) {
                $messages[] = "Login déjà existant";
            }
            if(array_key_exists('empty_user_login', $result->errors)) {
                $messages[] = "Le login ne peut pas être vide";
            }

            $this->show('views/user/signup.tpl.php', [
                'error' => 1,
                'messages' => $messages
            ]);
        }
        // TIPS get_defined_vars permet d'avoir la liste des variabls définies ainsi que leur valeurs
        // get_defined_vars()
    }

    public function confirmDelete()
    {
        $this->show('views/user/confirm-delete.tpl.php');
    }

    public function delete()
    {
        // DOC récupérer utilisateur courant https://developer.wordpress.org/reference/functions/wp_get_current_user/
        $user = wp_get_current_user();

        // DOC suppression d'un utilisateur https://developer.wordpress.org/reference/functions/wp_delete_user/
        wp_delete_user($user->ID);
        $this->redirect('/');
    }

    public function edit()
    {

        $currentUser = wp_get_current_user();
        $address = get_user_meta(
            $currentUser->ID,
            'address',
            true
        );


        $email = $currentUser->data->user_email;

        $this->show('views/user/edit.tpl.php', [
            'email' => $email,
            'address' => $address
        ]);
    }


    public function update()
    {

        // récupération des données envoyées depuis le formulaire
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

        $address = filter_input(INPUT_POST, 'address');

        $currentUser = wp_get_current_user();

        if($email) {
            // IMPORTANT construction du tableau que wordpress va utiliser pour mettre à jour un user
            $updateData = [
                'ID' => $currentUser->ID,
                'user_email' => $email
            ];
            // DOC update user https://developer.wordpress.org/reference/functions/wp_update_user/
            wp_update_user($updateData);
        }

        if($address) {
            update_user_meta(
                $currentUser->ID,
                'address',
                $address
            );
        }

        $this->show('views/user/update-success.tpl.php');
    }

    public function projectParticipation()
    {
        // récupération de l'id du projet (envoyé via un formulaire)
        $projectId = filter_input(INPUT_POST, 'projectId');

        // récupération de l'id de la fiche "développeur" pour l'utilisateur connecté
        $currentUser = wp_get_current_user();
        $developerCPT = WPDeveloperModel::findByAuthorId($currentUser->ID);

        // création d'une nouvelle participation
        $participation = new DeveloperProjectModel();

        // nous renseignons les informations de la participation

        // l'id de la fiche "développeur"
        $participation->developer_id = $developerCPT->ID;

        // l'id du projet
        $participation->project_id = $projectId;


        // il faudrait vérifier coté back si l'utilisateur ne participe pas déjà au projet;

        // nous sauvegardons
        $participation->insert();

        // génération du lien pour être redirigé vers la page projet
        $projectPageURL = get_permalink($projectId);
        $this->redirect(
            $projectPageURL,
            302,
            'oprofile',
            ''
        );
    }

    public function technology()
    {
        // Récupération de l'utilisateur courant
        $user = wp_get_current_user();

        // récupération du CPT de type developer associé à l'utilisateur courant
        $developer = WPDeveloperModel::findByAuthorId($user->ID);


        $developerTechnologyModel = new DeveloperTechnologyModel();

        // récupération des technologies maitrisées par le développeur
        $technologies = $developerTechnologyModel->getTechnologiesByDeveloperId($developer->ID);

        // s'il n'y a pas de technologies associées au développeur
        if(empty($technologies)) {
            // création puis récupération des couples technology/developer
            $technologies = $developerTechnologyModel->initializeDeveloper($developer->ID);
        }

        $this->show('views/user/technology.tpl.php', [
            'technologies' => $technologies
        ]);

    }

    public function updateTechnology()
    {

        // récupération des données envoyées par le formulaire
        $technologyLevels = $_POST['technologies'];

        // $technologyLevels est un tableau dans lequel les index sont les id des lignes de la table developer_technology et en valeur le niveau de maitrise choisi par l'utilisateur

        foreach($technologyLevels as $id => $level) {
            $developerTechnologyModel = new DeveloperTechnologyModel();

            // chargement de l'association developer/technology via l'id envoyé dans le formulaire
            $developerTechnologyModel->loadById($id);

            // mise à jour du niveau de maitrise
            $developerTechnologyModel->level = $level;

            // sauvegarde en bdd
            $developerTechnologyModel->update();
        }


        // redirection sur la page d'édition des technologies maitrisées
        $this->redirect(
            '/user/technology',
        );
    }
}
