<?php

/**
 * User: Jake
 * Date: 1/13/2018
 * Time: 3:03 PM
 */

createDatabase();

function createDatabase() {

    $success = 0;

    $ini = parse_ini_file("../configuration.ini");

    $server = $ini["db_address"];
    $database = $ini["db_name"];
    $username = $ini["db_username"];
    $password = $ini["db_password"];

    // First connect to DB and create Database Schema
    $success = initSchema($server, $database, $username, $password);

    // Second create tables
    $success &= initTables($server, $database, $username, $password);

    return $success;

}

function initSchema($server, $database, $username, $password) {

    $connection = new mysqli($server, $username, $password);
    $success = 0;

    if($connection->connect_error) {
        die("Connection Failed: " . $connection->connect_error);
    }

    $query = "CREATE DATABASE " . $database;
    if($connection->query($query) !== TRUE) {
        $success = -1;
    }

    $connection->close();

    return $success;

}

function initTables($server, $database, $username, $password) {

    $success = 0;

    $createTaskQuery = "

      CREATE TABLE TASKS (

        N_TASK_PK         INT           UNSIGNED      AUTO_INCREMENT,
        SZ_DESCRIPTION    VARCHAR(500)  NOT NULL,
        DT_DUE_DATE       DATE          NOT NULL,
        N_TASK_STATUS_FK  INT           UNSIGNED      NOT NULL,
      
        PRIMARY KEY (N_TASK_PK),
        FOREIGN KEY (N_TASK_STATUS_FK) REFERENCES TASK_STATUS(N_TASK_STATUS_PK)
    
      )
    
    ";

    $createTaskStatusQuery = "

      CREATE TABLE TASK_STATUS (

        N_TASK_STATUS_PK  INT           UNSIGNED AUTO_INCREMENT,
        SZ_DESCRIPTION    VARCHAR(100)  NOT NULL,
      
        PRIMARY KEY (N_TASK_STATUS_PK)
    
      )
    
    ";

    $createActionLogQuery = "

      CREATE TABLE ACTION_LOG (

        N_ACTION_PK       INT           UNSIGNED AUTO_INCREMENT,
        SZ_DESCRIPTION    VARCHAR(100)  NOT NULL,
        DT_TIMESTAMP      DATETIME      NOT NULL,
      
        PRIMARY KEY (N_ACTION_PK)
    
      )
    
    ";

    $connection = new mysqli($server, $username, $password, $database);
    if($connection->connect_error) {
        die("Connection Failed: " . $connection->connect_error);
    }

    if($connection->query($createTaskStatusQuery) !== TRUE) {
        $success = -1;
    }

    if($connection->query($createTaskQuery) !== TRUE) {
        $success = -1;
    }

    if($connection->query($createActionLogQuery) !== TRUE) {
        $success = -1;
    }

    $connection->close();

    return $success;

}
