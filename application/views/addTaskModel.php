<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/addTaskModel.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">Add Task</div>
    <div class="content">
      <form class="taskForm" mathod="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Task Name</span>
            <input type="text" placeholder="Enter your name" name="taskName" id="taskName" required>
          </div>
          
          <div class="input-box">
            <span class="details">Team Member</span>
            <input type="text" placeholder="Enter Assigned person" name="assignedTo" id="assignedTo"  required>
          </div>
          <div class="input-box">
            <span class="details">Task Description</span>
            <input type="text" placeholder="Brief Task" name="taskDesc" id="taskDesc"  required>
          </div>
          <div class="input-box">
            <span class="details">End Time</span>
            <input type="time" placeholder="Enter your City" name="endTime" id="endTime"  required>
          </div>
          <div class="input-box">
            <span class="details">End Date</span>
            <input type="date" placeholder="Enter your State" name="endDate" id="endDate"  required>
          </div>
        <div class="button">
          <input type="submit" value="Save">
        </div>
      </form>
    </div>
  </div>

</body>
</html>

<script>

    var BASE_URL = "<?php echo base_url(); ?>"

    $(".taskForm").validate({
    errorPlacement: function (error, element) {
        if (element.hasClass('error-replace')) {
            error.insertAfter(element.parent('div'));
        } else {
            error.insertAfter(element);               // default
        }
    },
    rules: {
        taskName: {
            required: true,
        },
        assignedTo: {
            required: true,
        },
        taskDesc: {
            required: true,
        },
        endTime: {
            required: true,
        },
        endDate: {
            required: true,
        }
    },
    messages: {
        taskName: {
            required: "Please enter full name",
        },
        assignedTo: {
            required: "Please select gender",
        },
        taskDesc: {
            required: "Please enter username",
        },
        endTime: {
            required: "Please enter email",
        },
        endDate: {
            required: "Please enter city",
        }
    },
    submitHandler: function (form) {
        $.ajax({
            url: BASE_URL + "addTaskApi",
            type: "post",
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            
            data: new FormData($('.taskForm')[0]),
            success: function (response) {
              window.location.href = BASE_URL+"task";
            },
            
        });

    }
});
</script>