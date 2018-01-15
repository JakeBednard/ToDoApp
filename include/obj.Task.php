<?php

/**
 * Created by PhpStorm.
 * User: Jake-Desktop
 * Date: 1/14/2018
 * Time: 1:11 AM
 */

include "obj.DatabaseConnection.php";

class Task {

    function select($id) {

        $db = new DB();

        $data = $db->select("
            SELECT 
              TASKS.N_TASK_PK,
              TASKS.SZ_DESCRIPTION,
              TASKS.DT_DUE_DATE,
              TASKS.N_TASK_STATUS_FK,
              TASK_STATUS.SZ_DESCRIPTION AS SZ_STATUS_TYPE
            FROM TASKS
            LEFT JOIN TASK_STATUS ON TASKS.N_TASK_STATUS_FK = TASK_STATUS.N_TASK_STATUS_PK 
            WHERE N_TASK_PK = {$id};
        ");

        return $data;

    }

    function selectAll() {

        $db = new DB();

        $data = $db->select("
            SELECT 
              TASKS.N_TASK_PK,
              TASKS.SZ_DESCRIPTION,
              TASKS.DT_DUE_DATE,
              TASKS.N_TASK_STATUS_FK,
              TASK_STATUS.SZ_DESCRIPTION AS SZ_STATUS_TYPE
            FROM TASKS
            LEFT JOIN TASK_STATUS ON TASKS.N_TASK_STATUS_FK = TASK_STATUS.N_TASK_STATUS_PK
            ORDER BY TASKS.DT_DUE_DATE;
        ");

        return $data;

    }

    function insert($description, $dueDate, $taskStatusFk) {

        $db = new DB();

        $data = $db->query("
            INSERT INTO TASKS (
                SZ_DESCRIPTION,
                DT_DUE_DATE,
                N_TASK_STATUS_FK
            ) VALUES (
                '{$description}',
                '{$dueDate}',
                {$taskStatusFk}
            );
        ");

        return $data;

    }

    function update($id, $description, $dueDate, $taskStatusFk) {

        $db = new DB();

        $data = $db->query("
            UPDATE TASKS 
            SET
                SZ_DESCRIPTION = '{$description}',
                DT_DUE_DATE = '{$dueDate}',
                N_TASK_STATUS_FK = {$taskStatusFk}
            WHERE
              N_TASK_PK = {id};
        ");

        return $data;

    }


    function delete($id) {

        $db = new DB();

        $data = $db->query("
            DELETE FROM TASKS
            WHERE N_TASK_PK = {$id};
        ");

        return data;

    }

}