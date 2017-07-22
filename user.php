<?php 
	/**
	 * Main code.
	 */
	require 'usermodel.php';
	require 'access.php';
	$user = new UserModel();
	/**
	 * check if exits token key.
	 * if token is not right. return json_error.
	 */
	if(!isset($_SERVER['HTTP_TOKEN'])){
		echo json_encode('Api needs a token key to use');
		return;
	}else{
		$access = new AccessModel($_SERVER['HTTP_TOKEN']);
		if(!$access->check_token()){
			echo json_encode('Invalid token key for API');
			return;
		}
	}
	$method = $_SERVER['REQUEST_METHOD'];
	$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
	$email = array_shift($request);
	switch ($method) {
	  case 'GET':
	    $data = $user->infor($email);
	    echo json_encode($data);
	    break;
	  case 'POST':
	    $result = $user->edit($email,$_POST);
	    echo json_encode($result);
	    break;
	}
?>