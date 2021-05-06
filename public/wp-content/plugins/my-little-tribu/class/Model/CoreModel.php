<?php

namespace MyLittleTribu\Model;

// cette classe va nous permettre de mutualiser certains traitements sur la base de donnée

abstract class CoreModel
{

    protected $database;

    abstract public static function tableName();

    public function __construct()
    {
        // DOC wpdb https://developer.wordpress.org/reference/classes/wpdb/
        global $wpdb;

        $this->database = $wpdb;
    }

    public function execute($sql, $parameters = [])
    {
        if(empty($parameters)) {
            $results = $this->database->get_results($sql);
            return $results;
        }
        else {
            $preparedStatement = $this->database->prepare($sql, $parameters);
            $results = $this->database->get_results($preparedStatement);
            return $results;
        }
    }

    public function getTableName()
    {
        $prefix = $this->database->prefix;
        return $prefix . $this->tableName();
    }
}

