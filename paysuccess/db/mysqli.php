<?php
namespace DB;
final class MySQLi {
	private $connection;
	private $sql;
	public function __construct($hostname, $username, $password, $database, $port = '3306') {
		$this->connection = new \mysqli($hostname, $username, $password, $database, $port);

		if ($this->connection->connect_error) {
			throw new \Exception('Error: ' . mysql_error($this->connection) . '<br />Error No: ' . mysql_errno($this->connection) . '<br /> Error in: <b>' . $trace[1]['file'] . '</b> line <b>' . $trace[1]['line'] . '</b><br />' . $sql);
		}

		$this->connection->set_charset("utf8");
		$this->connection->query("SET SQL_MODE = ''");
		$this->connection->query("SET time_zone='+06:00';");
	}

	public function query($sql) {
		//echo $sql;
		
		$query = $this->connection->query($sql);
		$this->sql=$sql;
		if (!$this->connection->errno) {
			if ($query instanceof \mysqli_result) {
				$data = array();

				while ($row = $query->fetch_assoc()) {
					$data[] = $row;
				}
				
				$result = new \stdClass();
				$result->num_rows = $query->num_rows;
				$query->close();
				$result->row = isset($data[0]) ? $data[0] : array();
				$result->rows = $data;
				
				
				//$result->total=$this->getTotal();
				return $result;
			} else {
				return true;
			}
		} else {
			throw new \Exception('Error: ' . $this->connection->error  . '<br />Error No: ' . $this->connection->errno . '<br />' . $sql);
		}
	}

	public function escape($value) {
		$value=trim($value);
		return $this->connection->real_escape_string($value);
	}
	
	public function countAffected() {
		return $this->connection->affected_rows;
	}

	public function getLastId() {
		return $this->connection->insert_id;
	}
	public function getTotal($exp=''){
		$sql=$this->sql;
		$limit=0;
		$order=0;
		$group=0;
		if(strripos($sql,'group by')>0){
			$group=strripos($sql,'group');
			$sql=substr($sql, 0, $group);
		}
		
		if(strripos($sql,'limit')>0){
			$limit=strripos($sql,'limit');
			$sql=substr($sql, 0, $limit);
		}
		if(strripos($sql,'order by')>0){
			$order=strripos($sql,'order by');
			$sql=substr($sql, 0, $order);
		}
		//echo $sql;
		if(empty($exp)){
	 	 $sql = preg_replace('/(select).*?(from)/is', '$1 COUNT(*) AS total $2', $sql);
		}else{
			$sql = preg_replace('/(select).*?(from)/is', '$1 COUNT('.$exp.') AS total $2', $sql);
		}
		$total=$this->query($sql);
		if(isset($total->row['total'])){
			return $total->row['total'];
		}
		return 0;
	}
	public function connected() {
		return $this->connection->connected();
	}
	
	public function __destruct() {
		$this->connection->close();
	}
}
