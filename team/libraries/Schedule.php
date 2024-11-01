<?php 
class Schedule{
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function getTodaystasks($today, $memberID){
		$accepted = 1;
		$accepted1 = 1;
		$this->db->query("SELECT t.task_id, t.title, t.due_date, mt.scheduled_date FROM tasks AS t INNER JOIN member_task AS mt ON t.task_id = mt.task_id WHERE mt.member_id = :memberID AND mt.accepted = :accepted AND mt.scheduled_date = :today AND t.state = :accepted1   ORDER BY mt.scheduled_date ASC");
		$this->db->bind(':memberID', $memberID);
		$this->db->bind(':accepted', $accepted);
		$this->db->bind(':accepted1', $accepted1);
		$this->db->bind(':today', $today);
		if($this->db->execute()){
			if($this->db->rowCount() > 0){
				$todaysTasks = $this->db->resultSet();
				return $todaysTasks;
			}else{
				return false;
			}
			
		}
	}

	public function getTommorowstasks($tommorow, $memberID){
		$accepted = 1;
		$accepted1 = 1;
		$this->db->query("SELECT t.task_id, t.title, t.due_date, mt.scheduled_date FROM tasks AS t INNER JOIN member_task AS mt ON t.task_id = mt.task_id WHERE mt.member_id = :memberID AND mt.accepted = :accepted AND mt.scheduled_date = :tommorow AND t.state = :accepted1   ORDER BY mt.scheduled_date ASC");
		$this->db->bind(':memberID', $memberID);
		$this->db->bind(':accepted', $accepted);
		$this->db->bind(':accepted1', $accepted1);
		$this->db->bind(':tommorow', $tommorow);
		if($this->db->execute()){
			if($this->db->rowCount() > 0){
				$tommorowsTasks = $this->db->resultSet();
				return $tommorowsTasks;
			}else{
				return false;
			}
			
		}

	}

	public function getRestoftheweek($afterTommorow, $weekEnd, $memberID){
		$accepted = 1;
		$accepted1 = 1;
		$this->db->query("SELECT t.task_id, t.title, t.due_date, mt.scheduled_date FROM tasks AS t INNER JOIN member_task AS mt ON t.task_id = mt.task_id WHERE mt.member_id = :memberID AND mt.accepted = :accepted AND mt.scheduled_date >= :afterTommorow AND mt.scheduled_date < :weekEnd AND t.state = :accepted1   ORDER BY mt.scheduled_date ASC");
		$this->db->bind(':memberID', $memberID);
		$this->db->bind(':accepted', $accepted);
		$this->db->bind(':accepted1', $accepted1);
		$this->db->bind(':afterTommorow', $afterTommorow);
		$this->db->bind(':weekEnd', $weekEnd);
		if($this->db->execute()){
			if($this->db->rowCount() > 0){
				$restOftheweek = $this->db->resultSet();
				return $restOftheweek;
			}else{
				return false;
			}
			
		}
	}

	public function getNextweek($weekEnd,$nextweekEnd, $memberID){
		$accepted = 1;
		$accepted1 = 1;
		$this->db->query("SELECT t.task_id, t.title, t.due_date, mt.scheduled_date FROM tasks AS t INNER JOIN member_task AS mt ON t.task_id = mt.task_id WHERE mt.member_id = :memberID AND mt.accepted = :accepted AND mt.scheduled_date >= :weekEnd AND mt.scheduled_date < :nextweekEnd  AND t.state = :accepted1   ORDER BY mt.scheduled_date ASC");
		$this->db->bind(':memberID', $memberID);
		$this->db->bind(':accepted', $accepted);
		$this->db->bind(':accepted1', $accepted1);
		$this->db->bind(':weekEnd', $weekEnd);
		$this->db->bind(':nextweekEnd', $nextweekEnd);
		if($this->db->execute()){
			if($this->db->rowCount() > 0){
				$nextweek = $this->db->resultSet();
				return $nextweek;
			}else{
				return false;
			}
			
		}
	}

	public function getafterNextweek($nextweekEnd, $memberID){
		$accepted = 1;
		$accepted1 = 1;
		$this->db->query("SELECT t.task_id, t.title, t.due_date, mt.scheduled_date FROM tasks AS t INNER JOIN member_task AS mt ON t.task_id = mt.task_id WHERE mt.member_id = :memberID AND mt.accepted = :accepted AND mt.scheduled_date >= :nextweekEnd AND t.state = :accepted1   ORDER BY mt.scheduled_date ASC");
		$this->db->bind(':memberID', $memberID);
		$this->db->bind(':accepted', $accepted);
		$this->db->bind(':accepted1', $accepted1);
		$this->db->bind(':nextweekEnd', $nextweekEnd);
		if($this->db->execute()){
			if($this->db->rowCount() > 0){
				$nextweek = $this->db->resultSet();
				return $nextweek;
			}else{
				return false;
			}
			
		}
	}

	public function getUnscheduledtasks($memberID){
		$accepted = 1;
		$scheduled = '0000-00-00';
		$this->db->query("SELECT t.task_id, t.title, t.due_date, mt.scheduled_date FROM tasks AS t INNER JOIN member_task AS mt ON t.task_id = mt.task_id WHERE mt.member_id = :memberID AND mt.accepted = :accepted AND mt.scheduled_date = :scheduled");
		$this->db->bind(':memberID', $memberID);
		$this->db->bind(':accepted', $accepted);
		$this->db->bind(':scheduled', $scheduled);
		if($this->db->execute()){
			$myUnsheduledtasks = $this->db->resultSet();
			return $myUnsheduledtasks;
	}
}


 }