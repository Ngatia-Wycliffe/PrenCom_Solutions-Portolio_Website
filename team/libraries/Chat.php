<?php 
class Chat{
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function sendChat($chatroom, $message, $recipient, $member, $fname, $lname, $sender){
		if($chatroom == 0){
			$this->db->query("INSERT INTO chats (member_id, chat, sender) VALUES (:member, :message, :sender)");
			$this->db->bind(':member', $member);
			$this->db->bind(':message', $message);
			$this->db->bind(':sender', $sender);
			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		}else{
			$this->db->query("INSERT INTO messages (sender_id, recipient_id, fname, lname, message, sender_pic) VALUES (:member, :recipient, :fname, :lname, :message, :sender)");
			$this->db->bind(':member', $member);
			$this->db->bind(':recipient', $recipient);
			$this->db->bind(':fname', $fname);
			$this->db->bind(':lname', $lname);
			$this->db->bind(':message', $message);
			$this->db->bind(':sender', $sender);
			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		}
	}

	public function getAllchats(){
		$this->db->query("SELECT * FROM chats");
		if ($this->db->execute()) {
			$rows = $this->db->resultSet();
			return $rows;
		}
	}

	public function loadNewchats($chatroom,$lastId, $chatmate, $me){
		if ($chatroom == 0) {
			$arr = array();
			$jsonData ='{"results":[';
			$this->db->query("SELECT * FROM chats WHERE chat_id > :lastId");
			$this->db->bind(':lastId', $lastId);
			if ($this->db->execute()) {
				$rows = $this->db->resultSet();
				$line = new stdClass;
				foreach ($rows as $value) {
					$line->chat_id = $value['chat_id'];
					$line->member = $value['member_id'];
					$line->chat = $value['chat'];
					$line->senderPic = $value['sender'];
					$arr[] = json_encode($line);
				}
			$jsonData .= implode(",", $arr);
			$jsonData .= ']}';
			return $jsonData;
			}
		}else{
			$arr = array();
			$jsonData ='{"results":[';
			$this->db->query("SELECT * FROM (SELECT * FROM (SELECT * FROM messages WHERE sender_id = :sender OR recipient_id = :sender) AS q1 WHERE q1.sender_id = :recipient OR q1.recipient_id = :recipient) AS q2 WHERE message_id > :lastId");
			$this->db->bind(':lastId', $lastId);
			$this->db->bind(':sender', $me);
			$this->db->bind(':recipient', $chatmate);
			if ($this->db->execute()) {
				$rows = $this->db->resultSet();
				$line = new stdClass;
				foreach ($rows as $value) {
					$line->chat_id = $value['message_id'];
					$line->member = $value['sender_id'];
					$line->chat = $value['message'];
					$line->senderPic = $value['sender_pic'];
					$arr[] = json_encode($line);
				}
			$jsonData .= implode(",", $arr);
			$jsonData .= ']}';
			return $jsonData;
			}
		}
		
	}

	public function getlastchat($chatroom, $chatmate, $me){
		$lastId = '';
		if($chatroom == 0){
			$this->db->query("SELECT * FROM chats ORDER BY chat_id DESC LIMIT 1");
				if ($this->db->execute()) {
				$row = $this->db->single();
				if ($this->db->rowCount() > 0) {
					foreach ($row as $value) {
					$lastId = $value['chat_id'];
					}
					return $lastId;
				}else{
					return 0;
				}
			
			}
		}else{
			$this->db->query("SELECT * FROM (SELECT * FROM messages WHERE sender_id = :sender OR recipient_id = :sender) AS q1 WHERE q1.sender_id = :recipient OR q1.recipient_id = :recipient ORDER BY message_id DESC LIMIT 1");
			$this->db->bind(':sender', $me);
			$this->db->bind(':recipient', $chatmate);
			if ($this->db->execute()) {
				$row = $this->db->single();
				if ($this->db->rowCount() > 0) {
					foreach ($row as $value) {
					$lastId = $value['message_id'];
					}
					return $lastId;
				}else{
					return 0;
				}
			
			}
		}
		
	}
	public function getMymessages($me){
		$messages = array();
		$this->db->query("SELECT m1.* FROM messages m1 JOIN(SELECT MAX(message_id) AS 'latest', sender_id, recipient_id FROM messages WHERE recipient_id = :member_id GROUP BY sender_id) m2 ON m1.message_id = m2.latest AND m1.sender_id = m2.sender_id AND m1.recipient_id = m2.recipient_id");
		$this->db->bind(':member_id', $me);
		if ($this->db->execute()) {
			$rows = $this->db->resultSet();
			foreach ($rows as $value) {
					$messages[] = $this->anyReply($value['message_id'], $me, $value['sender_id']);
			}
			return $messages; 
		}else{
			return false;
		}
	}

	public function getConversation($me, $currentchat){
		$this->db->query("SELECT * FROM (SELECT * FROM messages WHERE sender_id = :sender OR recipient_id = :sender) AS q1 WHERE q1.sender_id = :recipient OR q1.recipient_id = :recipient");
		$this->db->bind(':sender', $me);
		$this->db->bind(':recipient', $currentchat);
		if ($this->db->execute()) {
			$rows = $this->db->resultSet();
			return $rows;
		}else{
			return false;
		}
	}

	public function getCurrentchat($member_id){
		$this->db->query("SELECT * FROM members WHERE member_id = :member_id");
		$this->db->bind(':member_id', $member_id);
		if ($this->db->execute()) {
			$rows = $this->db->resultSet();
			return $rows;
		}else{
			return false;
		}

	}

	public function anyReply($message_id, $recipient, $sender){
		$this->db->query("SELECT * FROM messages WHERE sender_id = :recipient AND recipient_id = :sender AND message_id > :message_id");
		$this->db->bind(':recipient', $recipient);
		$this->db->bind(':sender', $sender);
		$this->db->bind(':message_id', $message_id);
		if ($this->db->execute()) {
			if ($this->db->rowCount() > 0) {
				$results = array();
				$row = $this->db->single();
				$row2 = $this->noReply($message_id);
				$n = 0;
				foreach($row as $detail){
					foreach ($row2 as $value) {
						$results['sender_id']= $value['sender_id'];
						$results['recipient_id'] = $value['recipient_id'];
						$results['sender_pic']= $value['sender_pic'];
						$results['fname'] = $value['fname'];
						$results['lname'] = $value['lname'];
						$results['message'] = $detail['message'];
						$results['reply'] = 1;
					}
				}
				return $results;
			}else{
				$results = array();
				$row =  $this->noReply($message_id);
				foreach ($row as $value)  {
						$results['sender_id']= $value['sender_id'];
						$results['recipient_id'] = $value['recipient_id'];
						$results['sender_pic']= $value['sender_pic'];
						$results['fname'] = $value['fname'];
						$results['lname'] = $value['lname'];
						$results['message'] = $value['message'];
				}
				return $results;
			}
		}else{
			return $this->noReply($message_id);
		}
	}
	public function noReply($message_id){
		$this->db->query("SELECT * FROM messages WHERE message_id = :message_id");
		$this->db->bind(':message_id', $message_id);
		return $this->db->single();
	}
	


}


 ?>