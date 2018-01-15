<?php
/**
 * Created by PhpStorm.
 * User: Jake-Desktop
 * Date: 1/14/2018
 * Time: 6:30 PM
 */

include_once "obj.Task.php";

$requestType = $_SERVER['REQUEST_METHOD'];
header("Content-Type: application/json; charset=UTF-8");

$task = new Task();

if ($requestType === 'GET') {

    if (isset($_GET['id'])) {
        echo $task->select($_GET['id']);
    }

    else {
        echo $task->selectAll();
    }

}

elseif ($requestType === 'POST') {

    //$json_as_str = file_get_contents('php://input');
    $json_data = json_decode(file_get_contents('php://input'), true);

    return $task->insert(
        $json_data["SZ_DESCRIPTION"],
        $json_data["DT_DUE_DATE"],
        $json_data["N_TASK_STATUS_FK"]
    );

}

elseif ($requestType === 'UPDATE') {

    $json_as_str = file_get_contents('php://input');
    $json_data = json_decode(file_get_contents('php://input'), true);

    $task->update(
        $_GET['id'],
        $json_data->SZ_DESCRIPTION,
        $json_data->DT_DUE_DATE,
        $json_data->N_TASK_STATUS_FK
    );

    return $json_data->SZ_DESCRIPTION;

}

elseif ($requestType === 'DELETE') {
    echo $task->delete($_GET['id']);
}

return;
