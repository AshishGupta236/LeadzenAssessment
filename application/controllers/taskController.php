<?php

require APPPATH . 'libraries/REST_Controller.php';

class taskController extends REST_Controller
{

    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        parent::__construct();
        $this->config->load('myConstant');
        $this->load->library('session');
        $this->load->model('Common_model');
    }

    
    /* 
    Use: Add Task API
    Param :  taskName
             taskDesc
             assignedTo
             endTime
             endDate
    Method : POST
    Response: ok
    */
    public function addTaskApi_post()
    {
        $taskName  = $this->input->post("taskName") != "" ? $this->input->post("taskName") : "";
        $taskDesc        = $this->input->post("taskDesc") != "" ? $this->input->post("taskDesc") : "";
        $assignedTo      = $this->input->post("assignedTo") != "" ? $this->input->post("assignedTo") : "";
        $endTime     = $this->input->post("endTime") != "" ? $this->input->post("endTime") : "";
        $endDate      = $this->input->post("endDate") != "" ? $this->input->post("endDate") : "";
        
        
        if ($taskName != "" && $taskDesc != '' && $assignedTo != '' && $endTime != "" && $endDate != '') {
            $taskData = array(
                'taskName'   => $taskName,
                'taskDesc'   => $taskDesc,
                'assignedTo' => $assignedTo,
                'endTime'    => $endTime,
                'endDate'    => $endDate
            );
            $result = $this->Common_model->insertData('tbl_task', $taskData);
            if ($result) {
                $this->response(array("message" => MESSAGE_conf::SUCCESS, "taskData" => $taskData), REST_Controller::HTTP_OK);
            } else {
                $this->response(array("message" => MESSAGE_conf::FAILED, "taskData" => array()), REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response(array("message" => MESSAGE_conf::ALL_REQUIRED), REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    /* 
    Use: Get All task
    Param : No params 
    Method : GET
    Response: ok
    */

    public function getAllTaskApi_get()
    {
        $allTask = $this->Common_model->getAllDataWhere('tbl_task','*',array('isDelete' => 0),'taskId','desc');
        if ($allTask) {
            $this->response(array("message" => MESSAGE_conf::SUCCESS, 'allTask' => $allTask), REST_Controller::HTTP_OK);
        } else {
            $this->response(array("message" => MESSAGE_conf::NO_DATA_FOUND, 'allTask' => (object)array()), REST_Controller::HTTP_OK);
        }
        
    }


    /* 
    Use: Get All task
    Param : No params 
    Method : GET
    Response: ok
    */

    public function getActiveTaskApi_get()
    {
        $activeTask = $this->Common_model->getAllDataWhere('tbl_task','*',array('isDelete' => 0, 'status'=>'1'),'taskId','desc');
        if ($activeTask) {
            $this->response(array("message" => MESSAGE_conf::SUCCESS, 'activeTask' => $activeTask), REST_Controller::HTTP_OK);
        } else {
            $this->response(array("message" => MESSAGE_conf::NO_DATA_FOUND, 'activeTask' => (object)array()), REST_Controller::HTTP_OK);
        }
        
    }


    /* 
    Use: Get All task
    Param : No params 
    Method : GET
    Response: ok
    */

    public function getPendingTaskApi_get()
    {
        $pendingTask = $this->Common_model->getAllDataWhere('tbl_task','*',array('isDelete' => 0,'status'=>'0'),'taskId','desc');
        if ($pendingTask) {
            $this->response(array("message" => MESSAGE_conf::SUCCESS, 'pendingTask' => $pendingTask), REST_Controller::HTTP_OK);
        } else {
            $this->response(array("message" => MESSAGE_conf::NO_DATA_FOUND, 'pendingTask' => (object)array()), REST_Controller::HTTP_OK);
        }
        
    }
    
    /* 
     Use : Deleting Task
     Method : POST
     Response : OK
        Request param :
            => taskId 
    */
    public function taskDeleteApi_post()
    {
        $taskId = $this->input->post("taskId") != "" ? $this->input->post("taskId") : "";

        $getTask = $this->Common_model->getDataWhere('tbl_task', '*', array('taskId' => $taskId));
        if ($getTask) {
            $deleteBanner = $this->Common_model->updateData('tbl_task', array('taskId' => $taskId), array('isDelete' => '1'));
            if ($deleteBanner) {
                $this->response(array("message" => MESSAGE_conf::TASK_DELETE_SUCCESS), REST_Controller::HTTP_OK);
            } else {
                $this->response(array("message" => MESSAGE_conf::SOMETHING_WENT_WRONG), REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response(array("message" => MESSAGE_conf::SOMETHING_WENT_WRONG, "message" => "No such task exist"), REST_Controller::HTTP_BAD_REQUEST);
        }
        
    }

    /* 
     Use : Updating Task status API (Pending to Completed and vice-versa)
     Method : POST
     Response : OK
        Request param :
            => taskId 
    */
    public function taskStatusApi_post()
    {
        $taskId = $this->input->post("taskId") != "" ? $this->input->post("taskId") : "";

        $getTask = $this->Common_model->getDataWhere('tbl_task', '*', array('taskId' => $taskId));
        $status = $getTask['status'];
        if ($status == '1') {
            $status = '0';
        } else {
            $status = '1';
        }
        if ($getTask) {
            $updateStatus = $this->Common_model->updateData('tbl_task', array('taskId' => $taskId), array('status' => $status));
            if ($updateStatus) {
                $this->response(array("message" => MESSAGE_conf::SUCCESS, "message" => "Task status changed successfully"), REST_Controller::HTTP_OK);
            } else {
                $this->response(array("message" => MESSAGE_conf::SOMETHING_WENT_WRONG, "message" => "Task status Not changed"), REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response(array("message" => MESSAGE_conf::SOMETHING_WENT_WRONG, "message" => "No such Task exist"), REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
?>