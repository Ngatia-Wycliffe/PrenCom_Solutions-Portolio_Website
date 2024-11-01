<?php 
class Project{
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function addProject($title, $member){
		$this->db->query("INSERT into projects (title, member_id) VALUES (:title, :member)");
		$this->db->bind(':title',$title);
		$this->db->bind(':member', $member);
		if ($this->db->execute()) {
			header("Location:tasks.php");
		}else{
			return false;
		}
	}

	public function checkProjects($member){
		$this->db->query("SELECT * FROM projects WHERE member_id = :member");
		$this->db->bind(':member', $member);
		$rows = $this->db->resultSet();
		if ($this->db->rowCount() > 1) {
			return true;
		}else{
			return false;
		}
	}
}


 ?>