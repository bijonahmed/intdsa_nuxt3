<?php
class DB {
	private $adaptor;
	public $driver, $hostname, $username, $password, $database, $port;
	
	public function __construct($driver, $hostname, $username, $password, $database, $port = NULL) {
		$this->driver=$driver;
		$this->hostname=$hostname;
		$this->username=$username;
		$this->password=$password;
		$this->database=$database;
		$this->port=$port;
		$class = 'DB\\' . $driver;
		if (class_exists($class)) {
			$this->adaptor = new $class($hostname, $username, $password, $database, $port);
		} else {
			throw new \Exception('Error: Could not load database adaptor ' . $driver . '!');
		}
	}

	public function query($sql, $params = array()) {
		return $this->adaptor->query($sql, $params);
	}

	public function escape($value) {
		return $this->adaptor->escape($value);
	}

	public function countAffected() {
		return $this->adaptor->countAffected();
	}
	public function getTotal($exp=''){
			return $this->adaptor->getTotal($exp);
		}
	public function getLastId() {
		return $this->adaptor->getLastId();
	}
	public function insert_id() {
		return $this->getLastId();
	}
	
	public function connected() {
		return $this->adaptor->connected();
	}

	public function insert($tbl,$data){
		$sql="INSERT INTO $tbl SET ";
		$fld=array();
		foreach($data as $k=>$v){
			$fld[]=sprintf("`%s`='%s'",$k,$this->escape($v));
		}
		$sql.=implode(',',$fld);
		$this->query($sql);
	}
	public function update($tbl,$data,$id=""){
		$fld=array();
		$where=" WHERE 1";
		$id=explode(",",$id);
		$cond=array();
		
		foreach($id as $fl){
			$cond[]=sprintf("`%s`='%s'",$fl,$this->escape($data[$fl]));
			unset($data[$fl]);
		}
		$where.=' AND '.implode(' AND ',$cond);
		
		
		foreach($data as $k=>$v){
			$fld[]=sprintf("`%s`='%s'",$k,$this->escape($v));
		}
		$sq=implode(',',$fld);
		$sql="UPDATE $tbl SET $sq $where";
	    
		$this->query($sql);
		
	}
	public function delete($tbl,$data){
		$fld=array();
		$where=" WHERE 1";
		foreach($data as $k=>$v){
			$fld[]=sprintf("`%s`='%s'",$k,$this->escape($v));
		}
		$where=implode(' AND ',$fld);
		$sql="DELETE FROM $tbl SET $where";
		$this->query($sql);
	}
	public function select($tbl,$cols="*",$data=[]){
		$fld=array();
		$where=" WHERE 1";
		foreach($data as $k=>$v){
			$fld[]=sprintf("`%s`='%s'",$k,$this->escape($v));
		}
		$where=implode(' AND ',$fld);
		$sql="SELECT $cols FROM $tbl WHERE $where";
		return $this->query($sql)->rows;
	}
}
