<?php
/*
* Mysql database class - only one connection allowed
*/
require_once 'config.php';

class Db
{
    private static $_instance;
    private $_connection; //The single instance
    private $_host = DATABASE_HOSTNAME;
    private $_username = DATABASE_USERNAME;
    private $_password = DATABASE_PASSWORD;
    private $_database = DATABASE_DATABASE;

    /*
    Get an instance of the Database
    @return Instance
    */

    private function __construct()
    {
        $this->_connection = new mysqli($this->_host, $this->_username,
            $this->_password, $this->_database);
        // Error handling
        if (mysqli_connect_error()) {
            trigger_error("Failed to connect to MySQL: " . mysqli_connect_error(),
                E_USER_ERROR);
        }
    }

    // Constructor

    public static function getInstance()
    {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // Magic method clone is empty to prevent duplication of connection

    public function getConnection()
    {
        return $this->_connection;
    }

    // Get mysqli connection

    private function __clone()
    {
    }
}
/* USE LIKE THAT:
    $db = Database::getInstance();
    $mysqli = $db->getConnection();
    $sql_query = "SELECT foo FROM .....";
    $result = $mysqli->query($sql_query);
*/