<?php 
class Subtask{
	private $db;

	public function __construct(){
		$this->db = new Database;
	}
  	
  	public function addsubTask($taskid, $subtask){
  		$this->db->query("INSERT INTO subtasks (task_id, subtask_name) VALUES (:taskid, :subtask)");
  		$this->db->bind(':taskid', $taskid);
  		$this->db->bind(':subtask', $subtask);
  		if ($this->db->execute()) {
        $contribution = '';
        $total = '';
        $id = $this->db->lastInsertId();
        $this->db->query("SELECT COUNT(subtask_id) AS total, subtask_id FROM subtasks WHERE task_id = :taskid");
        $this->db->bind(':taskid', $taskid);
        $row = $this->db->single();
        foreach ($row as $value) {
         $total = $value['total'];
        }
        $contribution = 1/$total * 100;
        $contribution = round($contribution);
          $this->db->query("UPDATE subtasks SET contribution = :contribution WHERE task_id = :id");
          $this->db->bind(':contribution', $contribution);
          $this->db->bind(':id', $taskid);
          if ($this->db->execute()) {
            return true;
          }else{
            return false;
          }
  		}else{
  			return false;
  		}
  	}

  	public function getSubtasks($task){
  		$this->db->query("SELECT * FROM subtasks WHERE task_id = :task");
  		$this->db->bind(':task', $task);
  		if ($this->db->execute()) {
  			return $this->db->resultSet();
  		}
  	}

    public function addActivity($parent,$activityname, $taskid){
      $this->db->query("INSERT INTO activities (parent_task,activity_name, subtask_id) VALUES (:parent, :activityname, :taskid)");
      $this->db->bind(':taskid', $taskid);
      $this->db->bind(':activityname', $activityname);
      $this->db->bind(':parent', $parent);
      if ($this->db->execute()) {
        return true;
      }else{
        return false;
      }
    }

    public function getTodolist($task){
      $this->db->query("SELECT * FROM activities WHERE parent_task = :task");
      $this->db->bind(':task', $task);
      if ($this->db->execute()) {
        return $this->db->resultSet();
      }
    }

    public function subtaskCompleted($task, $subtask, $completed){
        $percentage = 95;
        $contribution = '';
        $checked = 'checked';
        $completion = '';
        $this->db->query("UPDATE subtasks SET completed = :completed WHERE subtask_id = :subtask");
        $this->db->bind(':completed', $completed);
        $this->db->bind(':subtask', $subtask);

        if ($this->db->execute()) {
              $this->db->query("SELECT COUNT(subtask_id) AS total FROM subtasks WHERE task_id = :task");
              $this->db->bind(':task', $task);
              $rows =  $this->db->resultSet();
              foreach($rows as $value){
                $contribution = 1/$value['total'] * $percentage;
              }
              $contribution1 = round($contribution);
              $this->db->query("UPDATE subtasks SET contribution = :contribution WHERE subtask_id = :subtask");
              $this->db->bind(':contribution', $contribution1);
              $this->db->bind(':subtask', $subtask);

              if ($this->db->execute()) {
                 $this->db->query("SELECT COUNT(subtask_id) AS completed FROM subtasks WHERE task_id = :task AND completed = :checked");
                  $this->db->bind(':checked', $checked);
                  $this->db->bind(':task', $task);
                  $rows =  $this->db->resultSet();
                  foreach($rows as $value){
                    $completion = $value['completed'] * $contribution;
                    $completion = round($completion);
                  }
                  $this->db->query("UPDATE tasks SET progress = :completion WHERE task_id = :task");
                  $this->db->bind(':completion', $completion);
                  $this->db->bind(':task', $task);
                  if ($this->db->execute()) {
                    $contribution = '';
                    $checked = 'checked';
                    $completion = '';
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

    public function activityCompleted($activity, $completed, $subtask, $task){
      $percentage = '';
      $contribution = '';
      $checked = 'checked';
      $completion = '';
      $this->db->query("UPDATE activities SET completed = :completed WHERE activity_id = :activity");
      $this->db->bind(':completed', $completed);
      $this->db->bind(':activity', $activity);
      if ($this->db->execute()) {
          $this->db->query("SELECT * FROM subtasks WHERE subtask_id = :subtask");
          $this->db->bind(':subtask', $subtask);
          $row = $this->db->resultSet();
          foreach ($row as $value) {
            $percentage = $value['contribution'];
          }
           $this->db->query("SELECT COUNT(activity_id) AS total FROM activities WHERE subtask_id = :subtask");
              $this->db->bind(':subtask', $subtask);
              $rows =  $this->db->resultSet();
              foreach($rows as $value){
                $contribution = 1/$value['total'] * $percentage;
              }
              if ($this->db->execute()) {
                 $this->db->query("SELECT COUNT(activity_id) AS completed FROM activities WHERE subtask_id = :subtask AND completed = :checked");
                  $this->db->bind(':checked', $checked);
                  $this->db->bind(':subtask', $subtask);
                  $rows =  $this->db->resultSet();
                  foreach($rows as $value){
                    $completion = $value['completed'] * $contribution;
                    $completion = round($completion);
                  }
                  $this->db->query("UPDATE tasks SET progress = :completion WHERE task_id = :task");
                  $this->db->bind(':completion', $completion);
                  $this->db->bind(':task', $task);
                  if ($this->db->execute()) {
                    $percentage = '';
                    $contribution = '';
                    $checked = 'checked';
                    $completion = '';
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

    public function checkActivities($subtask, $completed){
        $this->db->query("UPDATE activities SET completed = :completed WHERE subtask_id = :subtask");
        $this->db->bind(':completed', $completed);
        $this->db->bind(':subtask', $subtask);
        if ($this->db->execute()) {
          return true;
        }else{
          return false;
        }
    }

    public function uncheckActivities($subtask, $completed){
        $this->db->query("UPDATE activities SET completed = :completed WHERE subtask_id = :subtask");
        $this->db->bind(':completed', $completed);
        $this->db->bind(':subtask', $subtask);
        if ($this->db->execute()) {
          return true;
        }else{
          return false;
        }
    }

    public function deleteActivity($task){
      $this->db->query("DELETE FROM activities WHERE activity_id = :taskid");
      $this->db->bind(':taskid', $task);

      if ($this->db->execute()) {
        return true;
      }else{
        return false;
      }
      }
    

  	public function deletesubTask($task){
  		$this->db->query("DELETE FROM subtasks WHERE subtask_id = :taskid");
		$this->db->bind(':taskid', $task);

		if ($this->db->execute()) {
			return true;
		}else{
			return false;
		}
  	}



    public function lastInserted(){
      return $this->db->lastInsertId();
    }

 }