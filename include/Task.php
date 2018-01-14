<?php

/**
 * Created by PhpStorm.
 * User: Jake-Desktop
 * Date: 1/14/2018
 * Time: 1:11 AM
 */

include "DatabaseConnection.php";

class Task {

    public $N_TASK_PK;
    public $SZ_DESCRIPTION;
    public $DT_DUE_DATE;

    function set($id, $description, $dueDate) {

        $N_TASK_PK = $id;
        $SZ_DESCRIPTION = $description;
        $DT_DUE_DATE = $dueDate;

        return;

    }

    function load($id) {

        $db = new DB();

        $data = $db->select("
            SELECT * 
            FROM TASK
            WHERE N_TASK_PK = {$id};
        ");

        $data = json_decode($data);

        $N_TASK_PK = $data->{'N_TASK_PK'};
        $SZ_DESCRIPTION = $data->{'SZ_DESCRIPTION'};
        $DT_DUE_DATE = $data->{'DT_DUE_DATE'};

        return;

    }

    function toJSON() {


        return;

    }

}