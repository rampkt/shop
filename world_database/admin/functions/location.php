<?php
class location
{
	private $db;
	public $page = 1;
	public $start = 0;
	public $rowLimit = 10;
	
	public function __construct() {
		global $db;
		$this->db = $db;
		
		// For pagination
		$this->page = (isset($_REQUEST['page']) ? $_REQUEST['page'] : 1);
		if($this->page > 1) {
			$this->start = ($this->page - 1) * $this->rowLimit;
		}
	}
	
	
	public function getAllcontactus() 
	{
		
		//echo $datestr; exit;
		$result = array();
		
		$query = 'SELECT c.id, c.name, c.email, c.subject, c.message, c.date_added, c.status,c.reply_msg,c.reply_date FROM roo_contactus AS c order by c.date_added asc LIMIT '.$this->start.','.$this->rowLimit;
		
		$queryCount = 'SELECT COUNT(c.id) AS cnt FROM roo_contactus AS c '; 
		
		//echo $query; 
		$qry = $this->db->query($query);
		if($this->db->num_rows($qry) > 0) {
			while($row = $this->db->fetch_array($qry)) {
				$result[] = $row;
			}
		}
		
		// pagination code
		$qryCount = $this->db->query($queryCount);
		$rowCount = $this->db->fetch_array($qryCount);
		
		$totalPage = getTotalPage($rowCount['cnt'],$this->rowLimit);
		$pagination = pagination("contactus.php", "", $this->page, $totalPage, 6);
		return array($result, $pagination);
	}
	
	public function getAllcountry($country) 
	{
		
		$field="";
		if($country!="")
		{
			$field.='and (c.name like '."'%$country%'".')';
		}
		//echo $datestr; exit;
		$result = array();
		
		$query = 'SELECT c.id, c.name, c.status, (SELECT COUNT(id) FROM states AS st WHERE st.cid = c.id) AS state,(SELECT COUNT(id) FROM cities AS ct WHERE ct.cid = c.id) AS city  FROM countries AS c WHERE c.status IN (0,1) '.$field.' order by c.name asc LIMIT '.$this->start.','.$this->rowLimit;
		
		$queryCount = 'SELECT COUNT(c.id) AS cnt FROM countries AS c WHERE c.status IN (0,1)'.$field; 
		
		//echo $query; 
		$qry = $this->db->query($query);
		if($this->db->num_rows($qry) > 0) {
			while($row = $this->db->fetch_array($qry)) {
				$result[] = $row;
			}
		}
		
		// pagination code
		$qryCount = $this->db->query($queryCount);
		$rowCount = $this->db->fetch_array($qryCount);
		
		$totalPage = getTotalPage($rowCount['cnt'],$this->rowLimit);
		$pagination = pagination("country.php", "country=$country", $this->page, $totalPage, 6);
		return array($result, $pagination);
	}
	public function getAllstate($state,$cid) 
	{
		
		$field="and st.cid=$cid";
		if($state!="")
		{
			$field.=' and (st.name like '."'%$state%'".')';
		}
		//echo $datestr; exit;
		$result = array();
		
		$query = 'SELECT st.id, st.name, st.status,st.cid,(SELECT COUNT(id) FROM cities AS ct WHERE st.id = ct.sid) AS city  FROM states AS st WHERE st.status IN (0,1) '.$field.' order by st.name asc LIMIT '.$this->start.','.$this->rowLimit;
		
		$queryCount = 'SELECT COUNT(st.id) AS cnt FROM states AS st WHERE st.status IN (0,1)'.$field; 
		
		//echo $query; 
		$qry = $this->db->query($query);
		if($this->db->num_rows($qry) > 0) {
			while($row = $this->db->fetch_array($qry)) {
				$result[] = $row;
			}
		}
		
		// pagination code
		$qryCount = $this->db->query($queryCount);
		$rowCount = $this->db->fetch_array($qryCount);
		
		$totalPage = getTotalPage($rowCount['cnt'],$this->rowLimit);
		$pagination = pagination("state.php", "state=$state&id=$cid", $this->page, $totalPage, 6);
		return array($result, $pagination);
	}
	
		public function getAllcity($city,$cid,$sid) 
	{
		
		$field="and ct.cid=$cid and ct.sid=$sid";
		if($city!="")
		{
			$field.=' and (ct.name like '."'%$city%'".')';
		}
		//echo $datestr; exit;
		$result = array();
		
		$query = 'SELECT ct.id, ct.name, ct.status,ct.cid,ct.sid FROM cities AS ct WHERE ct.status IN (0,1) '.$field.' order by ct.name asc LIMIT '.$this->start.','.$this->rowLimit;
		
		$queryCount = 'SELECT COUNT(ct.id) AS cnt FROM cities AS ct WHERE ct.status IN (0,1)'.$field; 
		
		//echo $query; 
		$qry = $this->db->query($query);
		if($this->db->num_rows($qry) > 0) {
			while($row = $this->db->fetch_array($qry)) {
				$result[] = $row;
			}
		}
		
		// pagination code
		$qryCount = $this->db->query($queryCount);
		$rowCount = $this->db->fetch_array($qryCount);
		
		$totalPage = getTotalPage($rowCount['cnt'],$this->rowLimit);
		$pagination = pagination("city.php", "city=$city&cid=$cid&sid=$sid", $this->page, $totalPage, 6);
		return array($result, $pagination);
	}

	
	public function Activate($id=0) {
		if($id > 0) {
			$this->db->query("UPDATE countries SET status=0 WHERE id='".$id."' LIMIT 1");
			return true;
		}
		return false;
	}
	
	public function getcountryname($id=0) {
		if($id > 0) {
			$qry=$this->db->query("select name from countries WHERE id='".$id."' LIMIT 1");
			$qryfetch=$this->db->fetch_array($qry);
			
			return $qryfetch['name'];
		}
		return false;
	}
	
	public function getstatename($id=0) {
		if($id > 0) {
			$qry=$this->db->query("select name from states WHERE id='".$id."' LIMIT 1");
			$qryfetch=$this->db->fetch_array($qry);
			
			return $qryfetch['name'];
		}
		return false;
	}
	
	public function getcityname($id=0) {
		if($id > 0) {
			$qry=$this->db->query("select name from cities WHERE id='".$id."' LIMIT 1");
			$qryfetch=$this->db->fetch_array($qry);
			
			return $qryfetch['name'];
		}
		return false;
	}
	
	public function countryupdate($id=0,$cname) {
		if($id > 0) {
			$this->db->query("UPDATE countries SET name='".$cname."' WHERE id='".$id."' LIMIT 1");
			return true;
		}
		return false;
	}
	
	public function stateupdate($id=0,$cid,$sname) {
		if($id > 0) {
			$this->db->query("UPDATE states SET name='".$sname."' WHERE id='".$id."' and cid='".$cid."' LIMIT 1");
			return true;
		}
		return false;
	}
	
	public function cityupdate($id=0,$sid,$cid,$ctname) {
		if($id > 0) {
			$this->db->query("UPDATE cities SET name='".$ctname."' WHERE id='".$id."' and sid='".$sid."' LIMIT 1");
			return true;
		}
		return false;
	}
	
	
	public function Deletecountry($id=0) {
		if($id > 0) {
			$this->db->query("Delete from countries WHERE id='".$id."' LIMIT 1");
			return true;
		}
		return false;
	}
	
	
	public function Deleteadvertise($id=0) {
		if($id > 0) {
			$this->db->query("UPDATE roo_advertise_request SET status='2' WHERE id='".$id."' LIMIT 1");
			return true;
		}
		return false;
	}
	
	
	public function Deletecontact($id=0) {
		if($id > 0) {
			$this->db->query("Delete from roo_contactus WHERE id='".$id."' LIMIT 1");
			return true;
		}
		return false;
	}
	
	public function Replycontact($id=0,$msg) {
		if($id > 0) {
			$this->db->query("UPDATE roo_contactus SET reply_msg='".$msg."',reply_date='".DATETIME24H."',status='1' WHERE id='".$id."' LIMIT 1");
			return true;
		}
		return false;
	}
	
	
	
	public function Deletestate($id=0) {
		if($id > 0) {
			$this->db->query("Delete from states WHERE id='".$id."' LIMIT 1");
			return true;
		}
		return false;
	}
	public function Deletecity($id=0) {
		if($id > 0) {
			$this->db->query("Delete from cities WHERE id='".$id."' LIMIT 1");
			return true;
		}
		return false;
	}
		
		public function getsetting($id,$field) {
		if($id > 0) {
			$qry = $this->db->query("SELECT * FROM roo_settings WHERE id='".$id."'");
			$row = $this->db->fetch_array($qry);
			
			return $row[$field];
			
		}
		return false;
	}
	
	public function Approveadvertise($id=0,$pass) {
		
		$encpassword = enc_password($pass);
		
		if($id > 0) {
			$this->db->query("UPDATE roo_advertise_request SET status='1' WHERE id='".$id."' LIMIT 1");
			
			$qry=$this->db->query("select * from roo_advertise_request where id='".$id."' LIMIT 1");
			$fetch=$this->db->fetch_array($qry);
			
			$username=$fetch['email'];
			
			$qrryy=$this->db->query("select * from roo_admin_users where email='".$fetch['email']."' and (type='3' and status='0') LIMIT 1");
			$fetchqrryy=$this->db->fetch_array($qrryy);
			$count=$this->db->num_rows($qrryy);
			
			if($count==0)
			{
			$qry2=$this->db->query("INSERT INTO roo_admin_users(email,username,password,salt,firstname,lastname,phone,signupdate,type,status)values('".$fetch['email']."','".$username."','".$encpassword."','".SALT."','".$fetch['company_name']."','','".$fetch['mobile']."','".DATETIME24H."','3','0')");	
			}
			else
			{
			$qry2=$this->db->query("UPDATE roo_admin_users SET password='".$encpassword."' where email='".$fetch['email']."'");	
			}
			
			//echo "INSERT INTO roo_admin_users(email,username,password,salt,firstname,lastname,phone,signupdate,type,status)values('".$fetch['email']."','".$username."','".$encpassword."','".SALT."','".$fetch['company_name']."','','".$fetch['mobile']."','".DATETIME24H."','3','0')"; exit;
			
			
			
			return true;
		}
		return false;
	}
	

	public function Updatecountry($id,$country) {
		if($id > 0) {
			$this->db->query("UPDATE countries SET name='".$country."' WHERE id='".$id."' LIMIT 1");
			return true;
		}
		return false;
	}
	
	public function Deactivate($id=0) {
		if($id > 0) {
			$this->db->query("UPDATE countries SET status=1 WHERE id='".$id."' LIMIT 1");
			return true;
		}
		return false;
	}

public function Activatestate($id=0) {
		if($id > 0) {
			$this->db->query("UPDATE states SET status=0 WHERE id='".$id."' LIMIT 1");
			return true;
		}
		return false;
	}
	
	public function Deactivatestate($id=0) {
		if($id > 0) {
			$this->db->query("UPDATE states SET status=1 WHERE id='".$id."' LIMIT 1");
			return true;
		}
		return false;
	}

public function Activatecity($id=0) {
		if($id > 0) {
			$this->db->query("UPDATE cities SET status=0 WHERE id='".$id."' LIMIT 1");
			return true;
		}
		return false;
	}
	
	public function Deactivatecity($id=0) {
		if($id > 0) {
			$this->db->query("UPDATE cities SET status=1 WHERE id='".$id."' LIMIT 1");
			return true;
		}
		return false;
	}

	public function countrysave($country) {
		if($country !="") {
			//echo $country; exit;
			$sql="INSERT INTO countries(name,status) values('$country','0')";
			//echo $sql; exit;
			$this->db->query($sql);
			return true;
		}
		return false;
	}
	
	public function statesave($cid,$state) {
		if($state !="") {
			//echo $state; exit;
			$sql="INSERT INTO states(cid,name,status) values('$cid','$state','0')";
			//echo $sql; exit;
			$this->db->query($sql);
			return true;
		}
		return false;
	}
	
	public function citysave($cid,$sid,$city) {
		if($city !="") {
			//echo $city; exit;
			$sql="INSERT INTO cities(cid,sid,name,status) values('$cid','$sid','$city','0')";
			//echo $sql; exit;
			$this->db->query($sql);
			return true;
		}
		return false;
	}
	
	
}
?>