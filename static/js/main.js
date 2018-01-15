$(document).ready(function(){

    var taskStatusesHTMLString;

    onPageLoad();
    function onPageLoad() {
        taskStatusesHTMLString = fetchTaskStatuses();
        loadTaskTable();
    }

    function getAllTasks() {

        var tasks = [];

        $.ajax({
            url: "include/task.php",
            type: "GET",
            async: false,
            dataType: "json",
            contentType: "application/json",
            complete: function(response){
                tasks = JSON.parse(response.responseText);
            }
        });

        return tasks;

    }

    function loadTaskTable() {

        var tasks = getAllTasks();

        clearTaskTable();
        $.each(tasks, function(i, task) {
            addTaskTableRow(task.N_TASK_PK, task.SZ_DESCRIPTION, task.DT_DUE_DATE, task.SZ_STATUS_TYPE, task.N_TASK_STATUS_FK);
        });

    }

    function addTaskTableRow(id, description, dueDate, statusDescription, statusKey) {

        dueDate = yyyymmdd_to_mmddyyyy(dueDate);

        $("#task-table tbody").append(`
            <tr id="` + statusKey + `">
                <td class="` + statusDescription + `"></td>
                <td>` + description + `</td>
                <td class="text-center">` + dueDate + `</td>
                <td>
                    <select class="form-control status-select">
                        ` + '<option value="' + status.statusKey + '" selected>' + statusDescription + '</option>' + taskStatusesHTMLString + `
                    </select>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-primary edit-task">
                        <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span>
                    </button>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger delete-task">
                        <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                    </button>
                </td>
            </tr>
        `);
    }

    function clearTaskTable() {
        $("#task-table tbody").empty();
    }

    function fetchTaskStatuses() {

        var taskStatuses = {};
        var builder = "";

        $.ajax({
            url: "include/task_status.php",
            type: "GET",
            async: false,
            dataType: "json",
            contentType: "application/json",
            complete: function(response){
                taskStatuses = JSON.parse(response.responseText);
            }
        });

        $.each(taskStatuses, function(i, status) {
            // noinspection JSAnnotator
            builder += '<option value="' + status.N_TASK_STATUS_PK + '">' + status.SZ_DESCRIPTION + '</option>';
        });

        return builder;

    }

    function yyyymmdd_to_mmddyyyy(dueDate) {
        return dueDate.slice(5,7) + '/' + dueDate.slice(8,10) + '/' + dueDate.slice(0,4);
    }

    function mmddyyyy_to_yyyymmdd(dueDate) {
        return dueDate.slice(6,10) + '-' + dueDate.slice(0,2) + '-' + dueDate.slice(3,5);
    }

});