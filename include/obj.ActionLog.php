<?php
/**
 * Created by PhpStorm.
 * User: Jake-Desktop
 * Date: 1/15/2018
 * Time: 8:40 AM
 */

include_once "obj.DatabaseConnection.php";

class ActionLog {

    function select($id) {

        $db = new DB();

        $data = $db->select("
            SELECT *
            FROM ACTION_LOG
            WHERE N_ACTION_PK = {$id};
        ");

        return $data;

    }

    function selectAll() {

        $db = new DB();

        $data = $db->select("
            SELECT *
            FROM ACTION_LOG;
        ");

        return $data;

    }

    function insert($description) {

        $db = new DB();
        $timestamp = new DateTime();
        $timestamp = date_format($timestamp, 'Y-m-d H:i:s');

        $data = $db->query("
            INSERT INTO ACTION_LOG (
                SZ_DESCRIPTION,
                DT_TIMESTAMP
            ) VALUES (
                '{$description}',
                '{$timestamp}'
            );
            </p>
        ");

        return data;

    }

}