<?php
class dashboard
{
	private $db;
	
	public function __construct() {
		global $db;
		$this->db = $db;
	}
	
	public function totalCount() {
		$result = array();
		$result['country'] = $this->db->fetch_field("countries", "1", "COUNT(id) AS cnt");
		$result['state'] = $this->db->fetch_field("states", "1", "COUNT(id) AS cnt");
		$result['city'] = $this->db->fetch_field("cities", "1", "COUNT(id) AS cnt");
		
		return $result;
	}
	
}
?>