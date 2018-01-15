<?php
/**
 * Created by PhpStorm.
 * User: Jake-Desktop
 * Date: 1/14/2018
 * Time: 6:30 PM
 */

include_once "obj.Task.php";

$requestType = $_SERVER['REQUEST_METHOD'];

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



}

elseif ($requestType === 'UPDATE') {

}

elseif ($requestType === 'DELETE') {

}

else {
    // Nothing Happens - Unsupported request
    return;
}