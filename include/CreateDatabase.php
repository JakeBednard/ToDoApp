<?php

/**
 * User: Jake
 * Date: 1/13/2018
 * Time: 3:03 PM
 */

createDatabase();

function createDatabase() {

    $success = TRUE;

    $ini = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . "/configuration.ini");

    $server = $ini["db_address"];
    $database = $ini["db_name"];
    $username = $ini["db_username"];
    $password = $ini["db_password"];

    $success &= initSchema($server, $database, $username, $password);
    $success &= initTables($server, $database, $username, $password);
    $success &= insertTaskStatusOptions($server, $database, $username, $password);

    if($success) { echo 1; }
    else { echo 0; }

    return;

}

function initSchema($server, $database, $username, $password) {

    $success = TRUE;

    $connection = new mysqli($server, $username, $password);
    $success &= !($connection->connect_error);

    $query = "CREATE DATABASE " . $database;

    $success &= $connection->query($query);

    $connection->close();

    return $success;

}

function initTables($server, $database, $username, $password) {

    $success = TRUE;

    $createTaskStatusQuery = "

      CREATE TABLE TASK_STATUS (

        N_TASK_STATUS_PK  INT           UNSIGNED AUTO_INCREMENT,
        SZ_DESCRIPTION    VARCHAR(100)  NOT NULL,
      
        PRIMARY KEY (N_TASK_STATUS_PK)
    
      );
    
    ";

    $createTaskQuery = "

      CREATE TABLE TASKS (

        N_TASK_PK         INT           UNSIGNED      AUTO_INCREMENT,
        SZ_DESCRIPTION    VARCHAR(500)  NOT NULL,
        DT_DUE_DATE       DATE          NOT NULL,
        N_TASK_STATUS_FK  INT           UNSIGNED      NOT NULL,
      
        PRIMARY KEY (N_TASK_PK),
        FOREIGN KEY (N_TASK_STATUS_FK) REFERENCES TASK_STATUS(N_TASK_STATUS_PK)
    
      );
    
    ";

    $createActionLogQuery = "

      CREATE TABLE ACTION_LOG (

        N_ACTION_PK       INT           UNSIGNED AUTO_INCREMENT,
        SZ_DESCRIPTION    VARCHAR(100)  NOT NULL,
        DT_TIMESTAMP      DATETIME      NOT NULL,
      
        PRIMARY KEY (N_ACTION_PK)
    
      );
    
    ";

    $connection = new mysqli($server, $username, $password, $database);
    $success &= !($connection->connect_error);

    $success &= $connection->query($createTaskStatusQuery);
    $success &= $connection->query($createTaskQuery);
    $success &= $connection->query($createActionLogQuery);

    $connection->close();

    return $success;

}

function insertTaskStatusOptions($server, $database, $username, $password) {

    $success = TRUE;

    $insertTaskStatusQuery = "

      INSERT INTO TASK_STATUS  
        (SZ_DESCRIPTION) 
      VALUES
         ('Pending'),
         ('Started'),
         ('Completed');
    
    ";

    $connection = new mysqli($server, $username, $password, $database);
    $success &= !($connection->connect_error);

    $success &= $connection->query($insertTaskStatusQuery);

    return $success;

}