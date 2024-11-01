<?php 
 class User{
 	
 		private $db;

		public function __construct(){
		$this->db = new Database;
		}
	public function addToTeam($data){
		$this->db->query('INSERT INTO members (fname, lname, job, email, password,profile_pic) 
	 		VALUES (:fname, :lname, :job, :email, :password, :pic)');

	 	//Bind values
	 	$this->db->bind(':fname', $data['fname']);
	 	$this->db->bind(':lname', $data['lname']);
	 	$this->db->bind(':job', $data['job']);
	 	$this->db->bind(':email', $data['email']);
	 	$this->db->bind(':password', $data['password']);
	 	$this->db->bind(':pic', $data['pic']);

	 	if ($this->db->execute()) {
			$id = $this->db->lastInsertId();
	 		$email = $data['email'];
	 		$this->db->query('SELECT * FROM invitations WHERE email = :email');
	 		$this->db->bind(':email',$email);
	 		if($this->db->execute()){
	 			$row = $this->db->single();
	 			$team = '';
	 			foreach ($row as $record) {
	 				$team = $record['team_id'];
	 			}
	 			$this->db->query('UPDATE members SET team_id = :team WHERE member_id = :id ');
	 			$this->db->bind(':team', $team);
	 			$this->db->bind(':id', $id);
	 			if($this->db->execute()){
	 			$this->db->query('DELETE FROM invitations WHERE email = :email');
	 			$this->db->bind(':email', $email);
	 			if($this->db->execute()){
	 			return true;
	 			exit();
	 			}else{return false; exit();}
	 		}
	 			else{ 
	 				return false;
	 					exit();
	 			}

	 		}
	 	} else {
	 		return false;
	 		exit();
	 	}
	 	
	}

 	public function register($data){
		//insert query
		$job = "Team Leader";
	 	$this->db->query('INSERT INTO members (fname, lname, job, email, password,profile_pic) 
	 		VALUES (:fname, :lname, :job, :email, :password, :pic)');

	 	//Bind values
	 	$this->db->bind(':fname', $data['fname']);
	 	$this->db->bind(':lname', $data['lname']);
	 	$this->db->bind(':job', $job);
	 	$this->db->bind(':email', $data['email']);
	 	$this->db->bind(':password', $data['password']);
	 	$this->db->bind(':pic', $data['pic']);

	 	if ($this->db->execute() ) {
	 		$id = $this->db->lastInsertId();
	 		$this->db->query('INSERT INTO teams (team_name, member_id)
	 			VALUES (:team, :member)');
	 		//Bind
	 		$this->db->bind(':team', $data['team']);
	 		$this->db->bind(':member', $id);
	 		if ($this->db->execute()) {
	 			$team = $this->db->lastInsertId();
	 			$this->db->query('UPDATE members SET team_id = :team_id WHERE member_id = :id');
	 			//Bind
	 			$this->db->bind('team_id', $team);
	 			$this->db->bind('id', $id);
	 			if ($this->db->execute()) {
	 				return true;
	 				exit();
	 			} else {
	 				return false;
	 				exit();
	 			}
	 			
	 			exit();
	 		} else {
	 			return false;
	 			exit();
	 		}
	 		
	 	} else {
	 		return false;
	 	}
	 	
 	}

 	public function uploadProfilePic(){
 		$allowedExts = array("gif","jpeg","jpg","png");
 		$temp = explode(".", $_FILES["pic"]["name"]);
 		$extension = end($temp);

 		if((($_FILES["pic"]["type"] == "image/gif")||($_FILES["pic"]["type"] == "image/jpeg")
 			||($_FILES["pic"]["type"] == "image/jpg")||($_FILES["pic"]["type"] == "image/png"))
 			&&($_FILES["pic"]["size"] < 10000000)&& in_array($extension, $allowedExts)){
 			if($_FILES["pic"]["error"] > 0){
 				redirect('teamAccount.php',$_FILES["pic"]["error"],'error');
 			}else{
 				if(file_exists("templates/pics/".$_FILES["pic"]["name"])){
 					redirect('teamAccount.php','File already Exists','error');
 				}else{
 					move_uploaded_file($_FILES["pic"]["tmp_name"], "templates/pics/". $_FILES["pic"]["name"]);
 					return true;
 				}
 			}

 		}else{
 			return false;
 		}
 	}
 	public function login($email, $password){
 		$this->db->query('SELECT * FROM members WHERE email = :email AND password = :password');
 		//bind
 		$this->db->bind(':email', $email);
 		$this->db->bind(':password', $password);

 		$row = $this->db->single();
 		//Check rows
 		if ($this->db->rowCount() > 0) {
 			$this->setUserData($row);
 			return true;
 		} else {
 			return false;
 		}
 		
 	}
 	//Set User Data

 	private function setUserData($row){
 		$_SESSION['isLoggedIn'] = true;
 		foreach ($row as $record) {
 		$_SESSION['member_id'] = $record['member_id'];
 		$_SESSION['fname'] = $record['fname'];
 		$_SESSION['name']  = $record['fname'];
 		$_SESSION['name'] .= " ";
 		$_SESSION['name'] .= $record['lname'];
 		$_SESSION['lname'] = $record['lname'];
 		$_SESSION['job'] = $record['job'];
 		$_SESSION['team_id'] = $record['team_id'];
 		$_SESSION['mypic'] = $record['profile_pic'];
 		}
 		//bind
 		$this->db->query('SELECT team_name FROM teams WHERE team_id = :team');
 		$this->db->bind(':team', $_SESSION['team_id']);

 		$result = $this->db->single();
 		foreach ($result as $name) {
 			$_SESSION['team_name'] = $name['team_name'];
 		}
 		
 	
	}
	//Add Members 
	public function addMember($team, $email){
		$this->db->query('INSERT INTO invitations (team_id, email) VALUES (:team, :email)');
		$this->db->bind(':team', $team);
		$this->db->bind(':email', $email);
		if ($this->db->execute()) {
			return true;
			exit();
		} else {
			return false;
			exit();
		}
		
	}

	//Check for members
 	public function checkMembers($member, $team){
 		$this->db->query('SELECT * FROM members WHERE team_id = :team');
 		//bind
 		$this->db->bind(':team', $team);

 		$rows = $this->db->resultSet();
 		//Check rows 
 		if ($this->db->rowCount() > 1) {
 			return true;
 		} else {
 			return false;
 		}
 	}

 	//Get All Members
 	public function getMembers($team){
 		$this->db->query('SELECT * FROM members WHERE team_id = :team');
 		$this->db->bind(':team', $team);

 		if($this->db->execute()){
 			$rows = $this->db->resultSet();
 			return $rows;
 		}
 	}

 	public function emailExists($email){
 		$this->db->query('SELECT *FROM invitations WHERE email = :email');;
 		$this->db->bind(':email', $email);

 		$row = $this->db->single();
 		if ($this->db->rowCount() > 0) {
 			return true;
 		} else {
 			return false;
 		}
 		
 	}

 	public function isInvited($email){
 		$this->db->query('SELECT * FROM invitations WHERE email = :email');
 		$this->db->bind(':email', $email);

 		$row = $this->db->single();
 		if ($this->db->rowCount() > 0) {
 			return true;
 		} else {
 			return false;
 		}
 	}

 	public function getAccount($member){
 		$this->db->query('SELECT * FROM teams WHERE member_id = :member');
 		$this->db->bind(':member', $member);

 		$row = $this->db->single();
 		if ($this->db->rowCount() > 0) {
 			return true;
 		} else {
 			return false;
 		}
 	}

 	public function logOut(){
 		unset($_SESSION['isLoggedIn']);
 		unset($_SESSION['member_id']);
 		unset($_SESSION['name']);
 		unset($_SESSION['fname']);
 		unset($_SESSION['lname']);
 		unset($_SESSION['job']);
 		unset($_SESSION['team_id']);
 		unset($_SESSION['mypic']);

 		return true;
 	}
 	public function Identify($member){
 		$this->db->query('SELECT profile_pic FROM members WHERE member_id = :member');
 		$this->db->bind(':member', $member);
 		$row = $this->db->single();
 		foreach ($row as $name) {
 			$profile = $name['profile_pic'];
 		}
 	     return $profile;

 	}


////DEMO purpose Functions

 	public function loginDemo($email, $password){
 		$this->db->query('SELECT * FROM members WHERE email = :email AND password = :password');
 		//bind
 		$this->db->bind(':email', $email);
 		$this->db->bind(':password', $password);

 		$row = $this->db->single();
 		//Check rows
 		if ($this->db->rowCount() > 0) {
 			$this->setUserDataDemo($row);
 			return true;
 		} else {
 			return false;
 		}
 		
 	}
 	//Set User Data

 	private function setUserDataDemo($row){
 		$_SESSION['isLoggedIn'] = true;
 		foreach ($row as $record) {
 		$_SESSION['member_id2'] = $record['member_id'];
 		$_SESSION['name2']  = $record['fname'];
 		$_SESSION['name2'] .= " ";
 		$_SESSION['name2'] .= $record['lname'];
 		$_SESSION['job2'] = $record['job'];
 		$_SESSION['team_id2'] = $record['team_id'];
 		$_SESSION['mypic2'] = $record['profile_pic'];

 		}
 	
	}



 }

 
