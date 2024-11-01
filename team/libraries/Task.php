<?php 
class Task{
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	
	public function addTask($task_title,$state, $member){
		$this->db->query("INSERT into tasks (title, member_id, state) VALUES (:task, :member, :state)");
		$this->db->bind(':task',$task_title);
		$this->db->bind(':state',$state);
		$this->db->bind(':member',$member);


		if($this->db->execute()){
			// switch ($state) {
			// 	case 0:
			 		// header("Location:unassignedTasks.php");
			// 		exit();
			// 		break;
			// 	case 1:
			// 		header("Location:assigntask.php?id=".urlencode($this->db->lastInsertId()));
			// 		exit();
			// 		break;
				
			// 	default:
			// 		# code...
			// 		break;
			// }
			return true;
		}
		else{
			return false;
		}
	}

	public function assignTask($data, $state, $members, $team){
		$accepted = 1;
	
			$this->db->query("UPDATE tasks SET comment = :comment, state = :state, due_date = :due_date, accepted = :accepted WHERE task_id = :task_id");
			$this->db->bind(':task_id',$data['taskID']);
			$this->db->bind(':comment',$data['comment']);
			$this->db->bind(':state',$state);
			$this->db->bind(':due_date',$data['deadline']);
			$this->db->bind(':accepted',$accepted);

			if ($this->db->execute()) {
				if(!empty($data['file'])){
					$this->db->query("INSERT INTO taskfiles (file_name, task_id) VALUES (:file, :task)");
					$this->db->bind(':file', $data['file']);
					$this->db->bind(':task', $data['taskID']);
					if ($this->db->execute()) {
						return $this->assignTo($data['taskID'], $members, $team);
					}else{
						return false;
					}
				}else{
						return $this->assignTo($data['taskID'], $members, $team);
					}
			
			}else{
				return false;
			}
		

	}

	public function getassignedTasks($team){
		$this->db->query("SELECT * FROM member_task WHERE team_id = :team");
		$this->db->bind(':team',$team);
		if ($this->db->execute()) {
			if ($this->db->rowCount() > 0) {
				return $this->db->resultSet();
			}else{
				return false;
			}
			
		}else{
			return false;
		}
	}

	public function gettotalTasks($member_id, $state){
		if ($state == 20) {
			$this->db->query("SELECT COUNT(task_id) AS total FROM tasks WHERE member_id = :member");
			$this->db->bind(':member',$member_id);
			if ($this->db->execute()) {
				if ($this->db->rowCount() > 0) {
					$total = '';
					$row = $this->db->single();
					foreach ($row as $value) {
						$total = $value['total'];
					}
					return $total;
				}else{
					return false;
				}
				
			}else{
				return false;
			}
		}else{
			$this->db->query("SELECT COUNT(task_id) AS total FROM tasks WHERE member_id = :member AND state = :state");
			$this->db->bind(':member',$member_id);
			$this->db->bind(':state',$state);
			if ($this->db->execute()) {
					$total = '';
					$row = $this->db->single();
					foreach ($row as $value) {
						$total = $value['total'];
					}
					return $total;
			}else{
				return false;
			}
		}
		

	}

	public function getAssignedTasks2($member_id){
		$state = 1;
		$accepted = 2; 
		$this->db->query("SELECT * FROM tasks WHERE member_id = :member AND state = :status AND accepted = :accepted");
		$this->db->bind(':member',$member_id);
		$this->db->bind(':status',$state);
		$this->db->bind(':accepted',$accepted);
		if ($this->db->execute()) {
			if ($this->db->rowCount() > 0) {
				return $this->db->resultSet();
			}else{
				return false;
			}
			
		}else{
			return false;
		}
	}

	public function assignTo($task, $members, $team ){
		foreach ($members as $member) {
			$accepted1 = 0;
			$this->db->query("INSERT into member_task (member_id, task_id, accepted, team_id) VALUES (:member, :task, :accepted, :team)");

			$this->db->bind(':member', $member);
			$this->db->bind(':task', $task);
			$this->db->bind(':accepted', $accepted1);
			$this->db->bind(':team', $team);
			if (!$this->db->execute()) {
				break;
				return false;
			}
		}
		return true;
	}

	public function updateAssignTo($task, $members, $team){
		$this->db->query("SELECT * FROM member_task WHERE task_id = :task_id");
		$this->db->bind(':task_id', $task);
		$existing = $this->db->resultSet();
		$n = 0;
		$rowCount = $this->db->rowCount();
		foreach ($members as $member) {
			foreach ($existing as $exist) {
					if ($member == $exist['member_id']) {
						$n = 0;
						break;
					}
					if($member != $exist['member_id']){
						$n++;
						if ($n == $rowCount) {
							$accepted1 = 0;
							$this->db->query("INSERT into member_task (member_id, task_id,accepted, team_id) VALUES (:member, :task,:accepted, :team)");

							$this->db->bind(':member', $member);
							$this->db->bind(':task', $task);
							$this->db->bind(':accepted', $accepted1);
							$this->db->bind(':team', $team);
							if (!$this->db->execute()) {
								break;
								return false;
							}
							$n = 0;
							break;
						}else{
							continue;
						}
						
					}
				}	
		}
		return true;
	}

	public function alterTask($taskID, $column, $value){
		$this->db->query("UPDATE tasks SET $column = :value WHERE task_id = :taskID");
		$this->db->bind(':value', $value);
		$this->db->bind(':taskID', $taskID);
		if ($this->db->execute()) {
			return true;
		}else{
			return false;
		}
	}

	public function deleteAssignees($members, $task){
		$this->db->query("SELECT * FROM member_task WHERE task_id = :task_id");
		$this->db->bind(':task_id', $task);
		$existing = $this->db->resultSet();
		$n = 0;
		$rowCount = $this->db->rowCount();
		foreach ($members as $member) {
			foreach ($existing as $exist) {

				if ($member == $exist['member_id']) {
					$this->db->query("DELETE FROM member_task WHERE member_id = :member AND task_id = :task");
					$this->db->bind(':task',$task);
					$this->db->bind(':member',$member);
					if (!$this->db->execute()) {
						break;
						return false;
					}
					$n = 0;
					break;
				}
				if($member != $exist['member_id']){
					$n++;
					if ($n == $rowCount) {
						break;
						$n = 0;
					}else{
						continue;
					}
				}
				
			}
			
		}
		return true;
	}

	public function getteamMates($task){
		$this->db->query("SELECT mt.task_id, m.member_id, m.fname, m.lname, m.profile_pic, m.job FROM members As m INNER JOIN member_task AS mt ON m.member_id = mt.member_id WHERE mt.task_id = :task");
		$this->db->bind(':task', $task);
		if ($this->db->execute()) {
			if ($this->db->rowCount() > 1) {
				return $this->db->resultSet();
			}
		}
	}

	public function getTask($task, $member){
		$this->db->query("SELECT * FROM tasks WHERE task_id = :task AND member_id = :member");
		$this->db->bind(':task',$task);
		$this->db->bind(':member',$member);
		$row = $this->db->single();
		return $row;
		
	}
	public function gettaskInfo($task){
		$this->db->query("SELECT * FROM tasks WHERE task_id = :task");
		$this->db->bind(':task',$task);
		$row = $this->db->single();
		return $row;
		
	}
	public function getAllTasks2($state, $member){
		$this->db->query("SELECT * FROM tasks WHERE state = :state AND member_id = :member ORDER BY task_id ASC");
		$this->db->bind(':state',$state);
		$this->db->bind(':member',$member);
		$row = $this->db->single();
		return $row;
	}
	public function getAllTasks($state, $member){
		$this->db->query("SELECT COUNT(mt.member_id) AS assigned, t.title, t.due_date, t.accepted, mt.task_id, (SELECT COUNT(*) FROM member_task WHERE task_id = mt.task_id AND accepted > 0) AS accepted_status FROM tasks AS t INNER JOIN member_task AS mt ON t.task_id = mt.task_id WHERE t.member_id = :member AND t.state = :state GROUP BY mt.task_id ORDER BY mt.task_id DESC");

		$this->db->bind(':state', $state);
		$this->db->bind(':member', $member);

		if($this->db->execute()){
			$rows = $this->db->resultSet();
			return $rows;
		}
	}

	public function getApproved($member){
		$approved = 1;
		$this->db->query("SELECT * FROM tasks WHERE approved = :approved AND member_id = :member");
		$this->db->bind(':approved',$approved);
		$this->db->bind(':member',$member);
		$row = $this->db->single();
		return $row;
	}

	public function deleteTask($task){
		$this->db->query("DELETE FROM tasks WHERE task_id = :taskid");
		$this->db->bind(':taskid', $task);

		if ($this->db->execute()) {
			return true;
		}else{
			return false;
		}
	}
	public function deleteAssigned($task){
		$this->db->query("DELETE FROM tasks WHERE task_id = :taskid");
		$this->db->bind(':taskid', $task);

		if ($this->db->execute()) {
			$this->db->query("DELETE FROM  member_task WHERE task_id = :taskid");
			$this->db->bind(':taskid', $task);
			if ($this->db->execute()) {
				$this->db->query("DELETE FROM  subtasks WHERE task_id = :taskid");
				$this->db->bind(':taskid', $task);
				if ($this->db->execute()) {
					$this->db->query("DELETE FROM  activities WHERE parent_task = :taskid");
					$this->db->bind(':taskid', $task);
					return true;
				}else{
					return false;
					}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function getSubmitted($member){
		$submitted = 1;
		$approved = 0;
		$this->db->query("SELECT * FROM tasks WHERE submitted = :submitted AND member_id = :member AND approved = :approved");
		$this->db->bind(':submitted',$submitted);
		$this->db->bind(':approved',$approved);
		$this->db->bind(':member',$member);
		$row = $this->db->single();
		return $row;
	}

	public function getMembersassigned($task){
		$assignees = array();
		$this->db->query("SELECT * FROM member_task WHERE task_id = :task_id");
		$this->db->bind(':task_id', $task);
		if ($this->db->execute()) {
			$rows = $this->db->resultSet();
			foreach ($rows as $key) {
				$this->db->query("SELECT * FROM members WHERE member_id = :member");
				$this->db->bind(':member', $key['member_id']);
				if ($this->db->execute()) {
					$assignees[] = $this->db->single();
				}else{
					break;
					return false;
				}
			}
			return $assignees;
		}
	}

	public function getUnscheduled($memberID){
		$accepted = 2;
		$submitted = 0;
		$unscheduled = '0000-00-00';
		$this->db->query("SELECT t.task_id, t.title, t.submitted, t.due_date, mt.scheduled_date FROM tasks AS t INNER JOIN member_task AS mt ON t.task_id = mt.task_id WHERE mt.member_id = :memberID AND t.accepted = :accepted AND t.submitted = :submitted AND mt.scheduled_date =:unscheduled  ORDER BY t.due_date ASC");
		$this->db->bind(':unscheduled', $unscheduled);
		$this->db->bind(':memberID', $memberID);
		$this->db->bind(':accepted', $accepted);
		$this->db->bind(':submitted', $submitted);
		if($this->db->execute()){
			$myTasks = $this->db->resultSet();
			return $myTasks;
		}
		// foreach ($taskIDs as $taskID) {
		// 	$this->db->query("SELECT * FROM tasks WHERE task_id = :taskID");
		// 	$this->db->bind(':taskID', $taskID['task_id']);
		// 	if ($this->db->execute()) {
		// 		$myTasks[] = $this->db->single();
		// 	}else{
		// 		break;
		// 		return false;
		// 	}
		// }
		 
	}
	public function getMyTasks($memberID){
		$accepted = 2;
		$submitted = 0;
		$this->db->query("SELECT t.task_id, t.title, t.submitted, t.due_date, mt.scheduled_date FROM tasks AS t INNER JOIN member_task AS mt ON t.task_id = mt.task_id WHERE mt.member_id = :memberID AND t.accepted = :accepted AND t.submitted = :submitted ORDER BY mt.scheduled_date ASC");
		$this->db->bind(':memberID', $memberID);
		$this->db->bind(':accepted', $accepted);
		$this->db->bind(':submitted', $submitted);
		if($this->db->execute()){
			$myTasks = $this->db->resultSet();
			return $myTasks;
		}
		// foreach ($taskIDs as $taskID) {
		// 	$this->db->query("SELECT * FROM tasks WHERE task_id = :taskID");
		// 	$this->db->bind(':taskID', $taskID['task_id']);
		// 	if ($this->db->execute()) {
		// 		$myTasks[] = $this->db->single();
		// 	}else{
		// 		break;
		// 		return false;
		// 	}
		// }
		 
	}

	public function getScheduled($task){
		$scheduled_date = '';
		$schedule = '';
		$today = new Datetime();
		$nextdate = '';
		$this->db->query("SELECT * FROM member_task WHERE task_id = :task");
		$this->db->bind(':task', $task);
		$row = $this->db->resultSet();
		foreach($row as $value){
			$scheduled_date = $value['scheduled_date'];
			$schedule = $value['schedule'];
		}
		if ($today->format('Y-m-d') > $scheduled_date) {
			while($today->format('Y-m-d') > $scheduled_date){
			$scheduled_date = date("Y-m-d", strtotime('$scheduled_date +'.$schedule.' days'));
		}
		$this->db->query("UPDATE member_task SET scheduled_date = :scheduled_date WHERE task_id = :task
			");
		$this->db->bind(':task', $task);
		$this->db->bind(':scheduled_date', $scheduled_date);
		if ($this->db->execute()) {
			return $scheduled_date;
		}
		}else{
			return $scheduled_date;
		}
	}

	public function getnextScheduled($task){
		$scheduled_date = '';
		$schedule = '';
		$today = new Datetime();
		$nextdate = '';
		$this->db->query("SELECT * FROM member_task WHERE task_id = :task");
		$this->db->bind(':task', $task);
		$row = $this->db->resultSet();
		foreach($row as $value){
			$scheduled_date = $value['scheduled_date'];
			$schedule = $value['schedule'];
		}
		return $schedule;

	}

	public function regulateSchedule($schedule, $task){
		$this->db->query("UPDATE member_task SET schedule = :schedule WHERE task_id = :task ");
		$this->db->bind(':task', $task);
		$this->db->bind(':schedule', $schedule);
		if ($this->db->execute()) {
			return true;
		}else{
			return false;
		}
	}

	public function checkNewtasks($member){
		$accepted = 0;
		$this->db->query("SELECT t.task_id, t.title, t.due_date FROM tasks AS t INNER JOIN member_task AS mt ON t.task_id = mt.task_id WHERE mt.member_id = :member AND mt.accepted = :accepted");
		$this->db->bind(':member', $member);
		$this->db->bind(':accepted', $accepted);
		if ($this->db->execute()) {
			if ($this->db->rowCount() > 0) {
				$newTasks = $this->db->resultSet();
				return $newTasks;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function scheduleTask($task, $member, $scheduled){
		$this->db->query("UPDATE member_task SET scheduled_date = :scheduled WHERE member_id = :member AND task_id = :task ");
		$this->db->bind(':scheduled', $scheduled);
		$this->db->bind(':member', $member);
		$this->db->bind(':task', $task);
		if ($this->db->execute()) {
			return true;
		}else{
			return false;
		}
	}

	public function acceptTask($taskID, $member){
		$accepted = 1;
		$accepted_on = date('Y-m-d');
		$this->db->query("UPDATE member_task SET accepted = :accepted WHERE task_id = :taskID AND member_id = :member");
		$this->db->bind(':accepted', $accepted);
		$this->db->bind(':taskID', $taskID);
		$this->db->bind(':member', $member);
		if ($this->db->execute()) {
			$accepted = 2;
			$this->db->query("UPDATE tasks SET accepted = :accepted , accepted_on = :accepted_on  WHERE task_id = :taskID");
			$this->db->bind(':accepted', $accepted);
			$this->db->bind(':taskID', $taskID);
			$this->db->bind(':accepted_on', $accepted_on);
			if ($this->db->execute()) {
				
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function rejectTask($taskID, $member){
		$accepted = 2;
		$this->db->query("UPDATE member_task SET accepted = :accepted WHERE task_id = :taskID AND member_id = :member");
		$this->db->bind(':accepted', $accepted);
		$this->db->bind(':taskID', $taskID);
		$this->db->bind(':member', $member);
		if ($this->db->execute()) {
			$accepted = 3;
			$this->db->query("UPDATE tasks SET accepted = :accepted WHERE task_id = :taskID");
			$this->db->bind(':accepted', $accepted);
			$this->db->bind(':taskID', $taskID);
			if ($this->db->execute()) {
				$this->db->query("SELECT * FROM tasks WHERE task_id = :taskID");
				$this->db->bind(':taskID', $taskID);
				return $this->db->resultSet();
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function numberOftasks($member){
		$accepted = 0;
		$this->db->query("SELECT * FROM member_task WHERE member_id = :member AND accepted = :accepted");
		$this->db->bind(':member', $member);
		$this->db->bind(':accepted', $accepted);
		if ($this->db->execute()) {
			return $this->db->rowCount();
		}
	}

	public function uploadfileDetails($file, $task, $member){
		$this->db->query("INSERT INTO taskfiles (file_name, task_id, member_id) VALUES (:file, :task, :member)");
		$this->db->bind(':file', $file);
		$this->db->bind(':task', $task);
		$this->db->bind(':member', $member);
		if ($this->db->execute()) {
			return true;
		}else{
			return false;
		}
	}

	public function getFiles($task){
		$this->db->query("SELECT m.member_id, m.fname, m.lname, tf.file_id, tf.task_id, tf.file_name, tf.uploaded FROM taskfiles AS tf INNER JOIN members AS m ON m.member_id = tf.member_id WHERE tf.task_id = :task");
		$this->db->bind(':task', $task);
		if ($this->db->execute()) {
			return $this->db->resultSet();
		}
	}

	public function deleteFile($file){
		$this->db->query("DELETE FROM taskfiles WHERE file_id = :file");
		$this->db->bind(':file', $file);
		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}
	public function showacceptStatus($task){
		$this->db->query("SELECT m.member_id, m.profile_pic, mt.accepted FROM members AS m INNER JOIN member_task AS mt ON m.member_id = mt.member_id WHERE mt.task_id = :task");
		$this->db->bind(':task', $task);
		if ($this->db->execute()) {
			if ($this->db->rowCount() > 0) {
				return $this->db->resultSet();
			}
			else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function submitTask($task, $date){
		$submit = 1;
		$state = 2;
		$this->db->query("UPDATE tasks SET state = :state, submitted = :submit, submitted_on = :submitted_on WHERE task_id = :task");
		$this->db->bind(':state', $state);
		$this->db->bind(':submit', $submit);
		$this->db->bind(':submitted_on', $date);
		$this->db->bind(':task', $task);
		if ($this->db->execute()) {
			return true;
		}else{
			return false;
		}
	}

	public function approveTask($task, $date){
		$approve = 1;
		$progress = 100;
		$this->db->query("UPDATE tasks SET approved = :approve, approved_on = :approved_on, progress = :progress WHERE task_id = :task");
		$this->db->bind(':approve', $approve);
		$this->db->bind(':progress', $progress);
		$this->db->bind(':approved_on', $date);
		$this->db->bind(':task', $task);
		if ($this->db->execute()) {
			return true;
		}else{
			return false;
		}
	}
	public function uploadFile(){
 		$temp = explode(".", $_FILES["attachment"]["name"]);
 				if(file_exists("templates/files/".$_FILES["attachment"]["name"])){
 					echo('File already Exists');
 				}else{
 					move_uploaded_file($_FILES["attachment"]["tmp_name"], "templates/files/". $_FILES["attachment"]["name"]);
 					return true;
 				}
 		
 	}
 	public function uploadFile1(){
 		$temp = explode(".", $_FILES["myfile"]["name"]);
 				if(file_exists("templates/files/".$_FILES["myfile"]["name"])){
 					echo('File already Exists');
 				}else{
 					move_uploaded_file($_FILES["myfile"]["tmp_name"], "templates/files/". $_FILES["myfile"]["name"]);
 					return true;
 				}
 		
 	}
 	public function lastInserted(){
		return $this->db->lastInsertId();
 	}


 }
 ?>