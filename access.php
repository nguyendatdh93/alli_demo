<?php 
/**
 * AccessModel for token object
 */
class AccessModel extends Config{
	
	private $token;

	public function __construct($token){
		Config::connect();
		$this->token = $token;
	}

	/**
	 * [check_token is/not right]
	 * @return [type] [true/false]
	 */
	public function check_token(){
		$sql = "SELECT * FROM access WHERE token='".$this->token."'";
		$result = mysqli_query($this->__connect, $sql);
		if (mysqli_num_rows($result) > 0) {
			return true;
		}
		return false;
	}
}
?>