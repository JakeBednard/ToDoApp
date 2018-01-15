<?php
/**
 * Created by PhpStorm.
 * User: Jake-Desktop
 * Date: 1/14/2018
 * Time: 8:04 PM
 */

include_once "obj.TaskStatus.php";

$requestType = $_SERVER['REQUEST_METHOD'];
header("Content-Type: application/json; charset=UTF-8");

$taskStatus = new TaskStatus();

if ($requestType === 'GET') {

    if (isset($_GET['id'])) {
        echo $taskStatus->select($_GET['id']);
    }

    else {
        echo $taskStatus->selectAll();
    }

}

elseif ($requestType === 'POST') {

    $json_as_str = file_get_contents('php://input');
    $json_data = json_decode($json_as_str);

    echo $taskStatus->insert(
        $json_data->SZ_DESCRIPTION
    );

}

elseif ($requestType === 'UPDATE') {

    $json_as_str = file_get_contents('php://input');
    $json_data = json_decode($json_as_str);

    echo $taskStatus->update(
        $_GET['id'],
        $json_data->SZ_DESCRIPTION
    );

}

elseif ($requestType === 'DELETE') {
    echo $taskStatus->delete($_GET['id']);
}

return;