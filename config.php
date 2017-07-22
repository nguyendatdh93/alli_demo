<?php 

class Config{
	const HOSTNAME = 'localhost';
	const USERNAME = 'root';
	const PASSWORD = '';
	const DATABASE = 'alli_demo';
	protected $__connect;
	/**
	 * [connect to database]
	 * @return [type] [__connect is a pram to save connect database]
	 */
	protected function connect(){
		$this->__connect = mysqli_connect(self::HOSTNAME,self::USERNAME,self::PASSWORD,self::DATABASE) or die(mysql_error());
	} 

	/**
	 * [close connect to database]
	 * @return [type] [status true/false]
	 */
	protected function close(){
		mysql_close($this->__connect);
	}
}

?>