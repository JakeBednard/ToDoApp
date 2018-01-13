<?php

/**
 * User: Jake-Desktop
 * Date: 1/13/2018
 * Time: 3:06 PM
 */

class DB {

    private $server;
    private $database;
    private $username;
    private $password;

    function __construct() {

        $ini = parse_ini_file("../configuration.ini");

        $this->server = $ini["db_address"];
        $this->database = $ini["db_name"];
        $this->username = $ini["db_username"];
        $this->password = $ini["db_password"];

    }

    function select($query) {

        $connection = new mysqli($this->server, $this->username, $this->password, $this->database);

        if($connection->connect_error) {
            die("Connection Failed: " . $connection->connect_error);
        }

        $result = $connection->query($query);

        $rows = array();
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return json_encode($rows);

    }

    function query($query) {

        $connection = new mysqli($this->server, $this->username, $this->password, $this->database);
        $result = -1;

        if($connection->query($query) === TRUE) {
            $result= 0;
        }

        return $result;

    }

}
