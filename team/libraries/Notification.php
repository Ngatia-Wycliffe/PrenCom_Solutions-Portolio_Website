<?php 
class Notification{
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function taskRejected($tasktitle, $team, $propagator, $propagatorsName){
		$recipient = '';
		$tasktitle = '<label class="ml-1 mr-1">The Task</label>'.$tasktitle.'<label class="ml-1 mr-1"> was </label>Rejected by '.$propagatorsName;
		$this->db->query("SELECT * FROM teams WHERE team_id = :team");
		$this->db->bind(':team', $team);
		if ($this->db->execute()) {
			$row = $this->db->single();
			foreach ($row as $value) {
				$recipient = $value['member_id'];
			}
			$this->db->query("INSERT INTO notifications (notification_text, sender_id, recipient_id) VALUES (:tasktitle, :sender, :recipient)");
			$this->db->bind(':tasktitle',$tasktitle);
			$this->db->bind(':sender', $propagator);
			$this->db->bind(':recipient', $recipient);
			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		}else{return false;}

	}

	public function getMynotifications($recipient){
		$this->db->query("SELECT * FROM notifications WHERE recipient_id = :recipient");
		$this->db->bind(':recipient', $recipient);
		if ($this->db->execute()) {
			return $this->db->resultSet();
		}else{
			return false;
		}
	}

	public function getfewNotifications($recipient){
		$this->db->query("SELECT * FROM notifications WHERE recipient_id = :recipient  ORDER BY notification_id DESC LIMIT 3");
		$this->db->bind(':recipient', $recipient);
		if ($this->db->execute()) {
			if ($this->db->rowCount() > 0) {
				$newNotifications = $this->db->resultSet();
				return $this->db->resultSet();
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function getfewMessages($recipient){
		$this->db->query("SELECT * FROM messages WHERE recipient_id = :recipient ORDER BY message_id DESC LIMIT 1");
		$this->db->bind(':recipient', $recipient);
		if ($this->db->execute()) {
			if ($this->db->rowCount() > 0) {
				$newMessages = $this->db->resultSet();
				return $this->db->resultSet();
			}else{
				return false;
			}
		}else{
			return false;
		}
	}


	public function checkNewnotifications($recipient){
		$notification_status = 0;
		$this->db->query("SELECT m.member_id, m.fname, m.lname, n.notification_id, n.notification_text, n.sent_on FROM members AS m INNER JOIN notifications AS n ON m.member_id = n.recipient_id WHERE n.recipient_id = :recipient AND n.notification_status = :notification_status");
		$this->db->bind(':recipient', $recipient);
		$this->db->bind(':notification_status', $notification_status);
		if ($this->db->execute()) {
			if ($this->db->rowCount() > 0) {
				$newNotifications = $this->db->resultSet();
				return $newNotifications;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function checkNewmessages($recipient){
		$notification_status = 0;
		$this->db->query("SELECT m.member_id, m.fname, m.lname, ms.message_id, ms.message,ms.sender_pic, ms.sent_on FROM members AS m INNER JOIN messages AS ms ON m.member_id = ms.recipient_id WHERE ms.recipient_id = :recipient AND ms.notification_status = :notification_status");
		$this->db->bind(':recipient', $recipient);
		$this->db->bind(':notification_status', $notification_status);
		if ($this->db->execute()) {
			if ($this->db->rowCount() > 0) {
				$newMessages = $this->db->resultSet();
				return $newMessages;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function numberOfnotifications($recipient){
		$notification_status = 0;
		$this->db->query("SELECT * FROM notifications WHERE recipient_id = :recipient AND notification_status = :notification_status");
		$this->db->bind(':recipient', $recipient);
		$this->db->bind(':notification_status', $notification_status);
		if ($this->db->execute()) {
			if ($this->db->rowCount()>0) {
				return $this->db->rowCount();
			}
			
		}
	}
	public function numberOfmessages($recipient){
		$notification_status = 0;
		$this->db->query("SELECT * FROM messages WHERE recipient_id = :recipient AND notification_status = :notification_status");
		$this->db->bind(':recipient', $recipient);
		$this->db->bind(':notification_status', $notification_status);
		if ($this->db->execute()) {
			if ($this->db->rowCount()>0) {
				return $this->db->rowCount();
			}
			
		}
	}
	public function updatestatus($recipient){
		$notification_status = 1;
		$this->db->query("UPDATE notifications SET notification_status = :notification_status WHERE recipient_id = :recipient");
		$this->db->bind(':recipient', $recipient);
		$this->db->bind(':notification_status', $notification_status);
		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function updateMsgstatus($recipient){
		$notification_status = 1;
		$this->db->query("UPDATE messages SET notification_status = :notification_status WHERE recipient_id = :recipient");
		$this->db->bind(':recipient', $recipient);
		$this->db->bind(':notification_status', $notification_status);
		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}
}


 ?>