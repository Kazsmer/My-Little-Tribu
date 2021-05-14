<?php

namespace MyLittleTribu\Model;

use WP_Query;

// cette classe va nous permettre de mutualiser certains traitement sur la base de donnée
class GuestTribeModel extends CoreModel
{
    public $id;
    public $guest_id;
    public $tribe_id;
    public $created_at;
    public $updated_at;

    public static function tableName()
    {
        return 'guest_tribe';
    }

   public function loadById($id)
    {
        $sql = "
            SELECT * FROM " . $this->getTableName() . "
            WHERE id=%d
        ";

        $results = $this->execute($sql, [$id]);
        $object = $results[0];


        foreach ($object as $property => $value) {
            $this->$property = $value;
        }
        return $this;
    }



    public function getTribeByGuestId($guestId)
    {
        $sql = "
            SELECT * FROM " . $this->getTableName() . "
            WHERE `guest_id`=%d;
        ";

        $results = $this->execute($sql, [$guestId]);

        $tribeGuestResults = [];


        foreach($results as $values) {
            $result = new GuestTribeModel();

            foreach($values as $property => $value) {
                $result->$property = $value;
            }
            $tribeGuestResults[] = $result;
        }
        return $tribeGuestResults;
    }


    public function getGuestByTribeId($tribeId)
    {
        $sql = "
            SELECT * FROM " . $this->getTableName() . "
            WHERE `tribe_id`=%d;
        ";

        // récupération de toutes les participations pour le projet demandé
        $results = $this->execute($sql, [$tribeId]);


        $guestTribeResults = [];

        // pour chaque ligne récupérée
        foreach($results as $values) {
            // contruction d'un nouvel objet DeveloperProjectModel (cet objet nous permettra de faciliter les traitements par la suite)
            $result = new GuestTribeModel();

            // "mapping" de valeurs de chaque résultat avec les propriétés de l'objet contruit auparavant ($result)
            foreach($values as $property => $value) {
                $result->$property = $value;
            }

            // stockage de l'objet $result dans le tableau de résultats
            $guestTribeResults[] = $result;
        }

        // nous retournons la liste des résultats
        return $guestTribeResults;
    }





    public function get($propertyName)
    {
        return $this->$propertyName;
    }

    public function set($propertyName, $value)
    {
        return $this->$propertyName = $value;
    }



    // cette fonction va créer la table en base de donnée
    public function createTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS `" . $this->getTableName(). "` (
                `id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
                `guest_id` INT(8) UNSIGNED NOT NULL,
                `tribe_id` INT(8) UNSIGNED NOT NULL,
                `created_at` DATETIME,
                `updated_at` DATETIME,
                PRIMARY KEY(`id`)
            );
        ";



        // nous devons un require à la main de cette bibliothèque afin de pouvoir utiliser la fonction dbDelta
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

    }

    public function dropTable()
    {
        $sql = "DROP TABLE `" . $this->getTableName(). "`";

        $this->database->query($sql);
    }

    public function insert()
    {

        // IMPORTANT insertion de donnée en bdd
        $this->database->insert(
            // premier argument : la table dans laquelle nous souhaitons insérer des données
            $this->getTableName(),

            // second argument : les valeur que nous donnons aux différentes colonnes de la table
            [
                'guest_id' => $this->guest_id,
                'tribe_id' => $this->tribe_id,
                'created_at' => date('Y-m-d H:i:s')
            ]
        );
    }

    public function delete()
    {
        $sql = "
            DELETE FROM " . $this->getTableName() . "
            WHERE  `id`=%d
        ";

        $this->execute(
            $sql,
            [$this->id]
        );
    }

    public function update()
    {
        $this->update_at = date('Y-m-d H:i:s');
        $this->database->update(
            $this->getTableName(),
            [
                'guest_id' => $this->user_id,
                'tribe_id' => $this->post_title_id,
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => $this->id,
            ]
        );
        return $this;
    }
    public function addInvitation()
    {
        $guestID = filter_input(INPUT_POST, 'invitation');
        // Recuperer le user courant
        $user = wp_get_current_user();
        $creatorId = $user->ID;
        // Recuperer la tribu du user courant
        $args = array(
            'post_type' => 'tribe',
            'author' => $creatorId
        );
        $query = new WP_Query( $args );

        $tribeID = $query->posts[0]->ID;

        // $guestID = l'invité -> guest_id
        // $tribeID = la tribu -> tribe_id

         // IMPORTANT insertion de donnée en bdd
         $this->database->insert(
            // premier argument : la table dans laquelle nous souhaitons insérer des données
            $this->getTableName(),

            // second argument : les valeur que nous donnons aux différentes colonnes de la table
            [
                'guest_id' => $guestID,
                'tribe_id' => $tribeID,
                'created_at' => date('Y-m-d H:i:s')
            ]
        );

    }
}
