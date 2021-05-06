<?php

namespace MyLittleTribu\Model;

use WP_Query;

// cette classe va nous permettre de mutualiser certains traitement sur la base de donnée
class TribeModel extends CoreModel
{
    public $id;
    public $user_id;
    public $creator_id;
    public $post_title;
    public $post_content;
    public $created_at;
    public $updated_at;

    public static function tableName()
    {
        return 'tribe';
    }

    public function loadById($id)
    {
        $sql = "
            SELECT * FROM " . $this->getTableName() . "
            WHERE id=%d
        ";

        $results = $this->execute($sql, [$id]);
        $object = $results[0];


        foreach($object as $property => $value) {
            $this->$property = $value;
        }
        return $this;
    }

   /*
    public function getCustomersByProjectId($projectId)
    {
        $sql = "
            SELECT * FROM " . $this->getTableName() . "
            WHERE `project_id`=%d;
        ";

        $results = $this->execute($sql, [$projectId]);


        $customerProjectResults = [];

        foreach($results as $values) {
            $result = new CustomerProjectModel();
            foreach($values as $property => $value) {
                $result->$property = $value;
            }

            $customerProjectResults[] = $result;
        }

        // nous retournons la liste des résultats
        return $customerProjectResults;
    }


    public function getProjectByCustomerId($customerId)
    {
        $sql = "
            SELECT * FROM " . $this->getTableName() . "
            WHERE `customer_id`=%d;
        ";

        $results = $this->execute($sql, [$customerId]);

        $customerProjectResults = [];


        foreach($results as $values) {
            $result = new CustomerProjectModel();

            foreach($values as $property => $value) {
                $result->$property = $value;
            }
            $customerProjectResults[] = $result;
        }
        return $customerProjectResults;
    }
    

    public function getCustomer()
    {
        $options = [
            'post_type' => 'any',
            'post__in'=> [$this->customer_id]
        ];

        $wpQuery = new WP_Query($options);
        $posts = $wpQuery->posts;
        return $posts[0];
    }

    public function getProject()
    {
        $options = [
            'post_type' => 'any',
            'post__in'=> [$this->project_id]
        ];
        $wpQuery = new WP_Query($options);
        $posts = $wpQuery->posts;
        return $posts[0];
    }



    public function get($propertyName)
    {
        return $this->$propertyName;
    }

    public function set($propertyName, $value)
    {
        return $this->$propertyName = $value;
    }
    */



    // cette fonction va créer la table en base de donnée
    public function createTable()
    {
        // TIPS $wpdb->prefix permet de récupérer le préfixe des table wordpress
        $sql = "
            CREATE TABLE IF NOT EXISTS `" . $this->getTableName(). "` (
                `id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
                `user_id` INT(8) UNSIGNED NOT NULL,
                `creator_id` INT(8) UNSIGNED NOT NULL,
                `post_title` VARCHAR,
                `post_content` VARCHAR,
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
                `user_id` => $this->user_id,
                `creator_id` => $this->creator_id,
                `post_title` => $this->post_title_id,
                `post_content` => $this->post_content_id,
                `created_at` => date('Y-m-d H:i:s')
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
                `user_id` => $this->user_id,
                `creator_id` => $this->creator_id,
                `post_title` => $this->post_title_id,
                `post_content` => $this->post_content_id,
                `updated_at` => date('Y-m-d H:i:s')
            ],
            [
                'id' => $this->id,
            ]
        );
        return $this;
    }
}
