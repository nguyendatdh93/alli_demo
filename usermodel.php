<?php 
require 'Config.php';
/**
 * defind class to execute task.
 */
class UserModel extends Config{
	
	public function __construct(){
		Config::connect();
	}

	/**
	 * [infor API get infor of email address]
	 * @param  [type] $email [ex: abc@gmail.com]
	 * @return [type]        [array]
	 */
	public function infor($email){
		$sql = "SELECT * FROM users WHERE email = '".$email."'";
		$result = mysqli_query($this->__connect, $sql);
		$data=mysqli_fetch_array($result,MYSQLI_NUM);
		return $data;
	}

	/**
	 * [edit API edit infor]
	 * @param  [type] $email [String]
	 * @param  [type] $param [array]
	 * @return [type]        [true/false]
	 */
	public function edit($email,$param){
		// email : can not update this column
		if(isset($param['email'])){
			unset($param['email']);
		}
		$set = '';
		foreach ($param as $key => $value) {
			$set .= ",".$key."='".$value."'";
		}
		$set = trim($set,',');
		$sql = "UPDATE users SET $set WHERE email = '".$email."'";
		$result = mysqli_query($this->__connect, $sql);
		return $result;
	}
}
?>