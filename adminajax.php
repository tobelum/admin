<?php
	if (!isset($_REQUEST['cmd'])) {
		echo '{"result": 0, "message": "Command not entered"}';
	}
	$command = $_REQUEST['cmd'];
	switch($command) {
		case 1:
		viewUsers();
		break;

		case 2:
		addUser();
		break;

		case 3:
		delUser();
		break;

		case 4:
		viewMsg();
		break;

		case 5:
		delMsg();
		break;

		case 6:
		logAdmin();
		break;

		default:
		echo "wrong cmd";
		break;
	}

function addUser() {
	if (($_REQUEST['username']=="") || ($_REQUEST['firstname']=="") || ($_REQUEST['lastname']=="") || ($_REQUEST['email']=="")
		|| ($_REQUEST['password']=="") || ($_REQUEST['phone']=="") || ($_REQUEST['organization']=="")) {
		echo '{"result":0, "message": "All user information required was not given"}';
		return;
	}
	
	include_once("admin.php");
	$obj = new admin();
	$username = $_REQUEST['username'];
	$firstname = $_REQUEST['firstname'];
	$lastname = $_REQUEST['lastname'];
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	$phone= $_REQUEST['phone'];
	$organization = $_REQUEST['organization'];
	
	$a = $obj->newUser($username,$firstname,$lastname,$email,$password,$phone,$organization);

	if (!$a) {
		echo '{"result":0 ,"message": "Could not add User"}';
	}
	
	else {
		$sms=$obj->sendsms($phone);
	 echo '{"result":1, "message": "User sucessfully added"}';	
	}
	
}

function viewUsers() {
	
	include_once("admin.php");
	$obj = new admin();
	
	$a = $obj->getUsers();

	if (!$a) {
		echo '{"result":0 ,"message": "Could not display Users"}';
	}
	
	else {
		$row=$obj->fetch();
		echo '{"result":1,"pool":[';
		while($row){
			echo json_encode($row);

			$row=$obj->fetch();
			if($row!=false){
				echo ",";
			}
		}
		echo "]}";	
	}
	
}

function delUser() {
	if ($_REQUEST['userid']=="") {
		echo '{"result":0, "message": "User ID was not given"}';
		return;
	}
	
	include_once("admin.php");
	$obj = new admin();
	$userid = $_REQUEST['userid'];

	$a = $obj->delUser($userid);

	if (!$a) {
		echo '{"result":0 ,"message": "Could not delete User"}';
	}
	
	else {
		$sms=$obj->sendsms($phone);
	 echo '{"result":1, "message": "User sucessfully deleted"}';	
	}
	
}

function viewMsg() {
	
	include_once("admin.php");
	$obj = new admin();
	
	$a = $obj->getMessages();

	if (!$a) {
		echo '{"result":0 ,"message": "Could not display Messages"}';
	}
	
	else {
		$row=$obj->fetch();
		echo '{"result":1,"pool":[';
		while($row){
			echo json_encode($row);

			$row=$obj->fetch();
			if($row!=false){
				echo ",";
			}
		}
		echo "]}";	
	}
	
}

function delMsg() {
	if ($_REQUEST['messageid']=="") {
		echo '{"result":0, "message": "Message ID was not given"}';
		return;
	}
	
	include_once("admin.php");
	$obj = new admin();
	$messageid = $_REQUEST['messageid'];

	$a = $obj->delMsg($messageid);

	if (!$a) {
		echo '{"result":0 ,"message": "Could not delete Message"}';
	}
	
	else {
		$sms=$obj->sendsms($phone);
	 echo '{"result":1, "message": "Message sucessfully deleted"}';	
	}
	
}

function logAdmin(){
	if (($_REQUEST['username']=="") || ($_REQUEST['password']=="")) {
		echo '{"result":0, "message": "All user information required was not given"}';
		return;
	}
	
	include_once("admin.php");
	$obj = new admin();
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	
	$result = $obj->getAdmin($username,$password);

	if ($result==false) {
		echo '{"result":0 ,"message": "Could not log User"}';
	}
	
	else {

	 echo '{"result":1, "message": "User sucessfully logged in"}';	
	}
}


?>