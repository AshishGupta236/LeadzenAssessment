<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="<?php echo base_url()?>assets/task.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
</head>
<body>

    <button style="margin-left:70px" onclick = "getTaskList();">All Task</button>
    <button onclick = "completeTaskList();">Complete Task</button>
    <button onclick = "pendingTaskList();">Pending Task</button>

    <a href="<?php echo base_url()?>add-task" class="btn btn-info">
    <button>Add Task</button></a>

    <div class="table-wrapper">
        <table class="fl-table">
          <thead>
            <tr>
              <th>Task</th>
              <th>Task Description</th>
              <th>Status</th>
              <th>Team Member</th>
              <th>End Time </th>
              <th>End Date</th>
              <th>Created At</th>
    
            </tr>
          </thead>
          <tbody id = "tableData"></tbody>
        </table>
    </div>
  
</body>
</html>

<script>
  var BASE_URL = "<?php echo base_url(); ?>";

getTaskList();
function getTaskList(){
    var main_content = '';
    $.ajax({
        url: BASE_URL + "getAllTaskApi",
        type: "GET",
        dataType: "json",
        data:{},
        success: function (response) {
            var value = response.allTask; 
                   
            // console.log(activeStatus);
            if (value.length > 0) {
                $.each(value, function (i, value) {
                    var activeStatus = '';
                    if (value.status == 1){
                        activeStatus = 'checked';
                    } 
                    main_content +=
                    `<tr>
                        <td>`+value.taskName+`</td>
                        <td>`+value.taskDesc+`</td>
                        <td><input type="checkbox" `+activeStatus+` onclick="statusChange(`+value.taskId+`);"/></td>
                        <td>`+value.assignedTo+`</td>
                        <td>`+value.endDate+`</td>
                        <td>`+value.endTime+`</td>
                        <td>`+value.createDate+`</td>
                    </tr>`;
                });
            }else{
                main_content = 'No Data Found!';
            }
            $('#tableData').html(main_content);
        }
    });
}

function completeTaskList(){
    var main_content = '';
    $.ajax({
        url: BASE_URL + "getActiveTaskApi",
        type: "GET",
        dataType: "json",
        data:{},
        success: function (response) {
            var value = response.activeTask;            
            if (value.length > 0) {
                $.each(value, function (i, value) {
                    var activeStatus = '';
                    if (value.status == 1){
                        activeStatus = 'checked';
                    } 
                    main_content +=
                    `<tr>
                        <td>`+value.taskName+`</td>
                        <td>`+value.taskDesc+`</td>
                        <td><input type="checkbox" `+activeStatus+` onclick="statusChange(`+value.taskId+`);"/></td>
                        <td>`+value.assignedTo+`</td>
                        <td>`+value.endDate+`</td>
                        <td>`+value.endTime+`</td>
                        <td>`+value.createDate+`</td>
                    </tr>`;
                });
            }else{
                main_content = 'No Data Found!';
            }
            $('#tableData').html(main_content);
        }
    });
}

function pendingTaskList(){
    var main_content = '';
    $.ajax({
        url: BASE_URL + "getPendingTaskApi",
        type: "GET",
        dataType: "json",
        data:{},
        success: function (response) {
            var value = response.pendingTask;            
            if (value.length > 0) {
                $.each(value, function (i, value) {
                    main_content +=
                    `<tr>
                        <td>`+value.taskName+`</td>
                        <td>`+value.taskDesc+`</td>
                        <td><input type="checkbox" onclick="statusChange(`+value.taskId+`);"/></td>
                        <td>`+value.assignedTo+`</td>
                        <td>`+value.endDate+`</td>
                        <td>`+value.endTime+`</td>
                        <td>`+value.createDate+`</td>
                    </tr>`;
                });
            }else{
                main_content = 'No Data Found!';
            }
            $('#tableData').html(main_content);
        }
    });
}

function statusChange(taskId){
    $.ajax({
        url: BASE_URL + "taskStatusApi",
        type: "POST",
        dataType: "json",
        data: { taskId : taskId },
        success: function (response) {
            console.log("status changed successfully");
        }
    });
}
</script>