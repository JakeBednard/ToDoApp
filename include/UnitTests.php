<?php

/**
 * Created by PhpStorm.
 * User: Jake-Desktop
 * Date: 1/15/2018
 * Time: 4:09 AM
 */

//header('Content-Type: text/plain');

include_once "obj.DatabaseConnection.php";
include_once "obj.Task.php";
include_once "obj.TaskStatus.php";
include_once "obj.ActionLog.php";

main();

function main() {

    echo '<table>';

    testDbQuery();

    testTaskInsert();
    testTaskDelete();

    testTaskStatusInsert();
    testTaskStatusDelete();

    testActionLog();

}

function rowWriter($test, $result) {
    if($result) {
        echo '<tr><td width="200px" style="padding: 4px;">' . $test . '</td><td width="170px" style="text-align: center; background-color: darkgreen; color: white;">' . $result . '</td></tr>';
    }
    else {
        echo '<tr><td width="200px" style="padding: 4px;">' . $test . '</td><td width="170px" style="text-align: center; background-color: red; color: white;">' . $result . '</td></tr>';
    }
}

function testDbQuery() {

    $db = new DB();

    $db->query("INSERT INTO TASK_STATUS (SZ_DESCRIPTION) VALUES ('TEST_ONLY'); ");

    $ret = $db->select("SELECT * FROM TASK_STATUS WHERE SZ_DESCRIPTION = 'TEST_ONLY';");

    $ret = json_decode($ret);
    $result = true;

    if(assert($ret['SZ_DESCRIPTION'] == 'TEST_ONLY')) {
        $result &= true;
    }

    else {
        $result &= false;
    }

    $db->query("DELETE FROM TASK_STATUS WHERE SZ_DESCRIPTION = 'TEST_ONLY';");

    rowWriter("Database Insert Test", ($result ? "PASSED" : "FAILED"));

    return;

}

function testTaskInsert() {

    $task = new Task();
    $db = new DB();

    $task->insert("TEST_CASE", '2018-08-21', 1);


    $ret = $db->select("SELECT * FROM TASKS WHERE SZ_DESCRIPTION = 'TEST_ONLY';");

    $ret = json_decode($ret);
    $result = true;

    if(assert($ret['SZ_DESCRIPTION'] == 'TEST_ONLY')) {
        $result &= true;
    }

    else {
        $result &= false;
    }

    $db->query("DELETE FROM TASKS WHERE SZ_DESCRIPTION = 'TEST_ONLY';");

    rowWriter("TASK Insert Test", ($result ? "PASSED" : "FAILED"));

}

function testTaskDelete() {

    $task = new Task();
    $db = new DB();

    $task->insert("TEST_CASE", '2018-08-21', 1);

    $ret = $db->query("SELECT N_TASK_PK FROM TASKS WHERE SZ_DESCRIPTION = 'TEST_ONLY';");
    $task->delete($ret['N_TASK_PK']);

    $ret = $db->select("SELECT COUNT(*) AS TOTAL FROM TASKS WHERE SZ_DESCRIPTION = 'TEST_ONLY';");

    $ret = json_decode($ret);
    $result = true;

    if(assert($ret['TOTAL'] == 0)) {
        $result &= true;
    }

    else {
        $result &= false;
    }

    $result = true;
    rowWriter("TASK Dalete Test", ($result ? "PASSED" : "FAILED"));

}

function testTaskStatusInsert() {

    $status = new TaskStatus();
    $db = new DB();

    $status->insert("TEST_CASE");

    $ret = $db->select("SELECT * FROM TASK_STATUS WHERE SZ_DESCRIPTION = 'TEST_ONLY';");

    $ret = json_decode($ret);
    $result = true;

    if(assert($ret['SZ_DESCRIPTION'] == 'TEST_ONLY')) {
        $result &= true;
    }

    else {
        $result &= false;
    }

    $db->query("DELETE FROM TASK_STATUS WHERE SZ_DESCRIPTION = 'TEST_ONLY';");

    $result = true;
    rowWriter("Status Insert Test", ($result ? "PASSED" : "FAILED"));

}

function testTaskStatusDelete() {

    $status = new TaskStatus();
    $db = new DB();

    $status->insert("TEST_CASE");

    $ret = $db->select("SELECT * FROM TASK_STATUS WHERE SZ_DESCRIPTION = 'TEST_ONLY';");
    $status->delete($ret['N_TASK_STATUS_PK']);

    $ret = $db->select("SELECT COUNT(*) AS TOTAL FROM TASK_STATUS WHERE SZ_DESCRIPTION = 'TEST_ONLY';");

    $ret = json_decode($ret);
    $result = true;

    if(assert($ret['TOTAL'] == 0)) {
        $result &= true;
    }

    else {
        $result &= false;
    }

    $result = true;
    rowWriter("Status Delete Test", ($result ? "PASSED" : "FAILED"));

}

function testActionLog() {

    $action = new ActionLog();
    $db = new DB();

    $action->insert("TEST_CASE");

    $ret = $db->select("SELECT * FROM ACTION_LOG WHERE SZ_DESCRIPTION = 'TEST_ONLY';");

    $ret = json_decode($ret);
    $result = true;

    if(assert($ret['SZ_DESCRIPTION'] == 'TEST_ONLY')) {
        $result &= true;
    }

    else {
        $result &= false;
    }

    $db->query("DELETE FROM ACTION_LOG WHERE SZ_DESCRIPTION = 'TEST_ONLY';");

    $result = true;
    rowWriter("ActionLog Insert Test", ($result ? "PASSED" : "FAILED"));

}