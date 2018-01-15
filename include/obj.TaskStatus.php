<?php

/**
 * Created by PhpStorm.
 * User: Jake-Desktop
 * Date: 1/14/2018
 * Time: 7:52 PM
 *
 * This object handles I/O for task status items. It contains the capability
 * to select, add, update, and delete a task status.
 *
 */

include "obj.DatabaseConnection.php";

class TaskStatus {

    function select($id) {

        $db = new DB();

        $data = $db->select("
            SELECT *
            FROM TASK_STATUS
            WHERE N_TASK_STATUS_PK = {$id};
        ");

        return $data;

    }

    function selectAll() {

        $db = new DB();

        $data = $db->select("
            SELECT *
            FROM TASK_STATUS;
        ");

        return $data;

    }

    function insert($description) {

        $db = new DB();

        $data = $db->query("
            INSERT INTO TASK_STATUS (
                SZ_DESCRIPTION
            ) VALUES (
                '{$description}'
            );
        ");

        return data;

    }

    function update($id, $description) {

        $db = new DB();

        $data = $db->query("
            UPDATE TASK_STATUS 
            SET
              SZ_DESCRIPTION = '{$description}'
            WHERE
              N_TASK_STATUS_PK = {id};
        ");

        return data;

    }


    function delete($id) {

        $db = new DB();

        $data = $db->query("
            DELETE FROM TASK_STATUS
            WHERE N_TASK_STATUS_PK = {$id};
        ");

        return data;

    }

}