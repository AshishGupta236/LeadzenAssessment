<?php
defined('BASEPATH') or exit('No direct script access allowed');
$config['my_config_item'] = 'my_config_value';
define('ABCD_MY_CONSTANT', 'my_config_item');

class MESSAGE_conf
{

	const TASK_DELETE_SUCCESS = "task deleted successfully";
	const SOMETHING_WENT_WRONG = "Something went wrong";
	const PASS_CHANGED = "Password has been changed successfully";
	const PASS_NOT_CHANGED = "Password does not match";
	const UPLOAD_IMAGE = "Please upload image";
	const EMAIL_ALREADY_EXIST = "Email already exist Please use another email id";
	const WRONG_IMAGE_FORMAT = "Please upload image in right format (JPG , PNG , JPEG)";
	const SUCCESS = "Success";
	const FAILED = "Failed";
	const INVALID_EMAIL_ID = "Invalid Email Id";
	const ALL_REQUIRED = "All Field Required";
	const NO_DATA_FOUND = "No Data Found";
	const INVALID_PASSWORD_FORMAT = " `8 characters length ,1 uppercase ,1 Special character, 1 lowercase character ,1 number";
	const PASSWORD_NOT_MATCHED = "Password Not matched";
	const WRONG_PASSWORD = "Wrong Password";
	const INVALID_CREDENTIALS = "Invalid Credentials";
	const ERROR = "Error";

}