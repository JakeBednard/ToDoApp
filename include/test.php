<?php

include "obj.Task.php";

$task = new Task();

echo $task->insert("WORK FOR ME", "2018-08-13", 1);