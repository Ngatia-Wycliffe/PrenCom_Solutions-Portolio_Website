<?php require('core/init.php'); ?>
<?php require('fpdf.php'); ?>
<?php 

	$task = new Task;
	class myPDF extends FPDF{
		function header(){
			$this->SetFont('Arial','B', 14);
			$this->Cell(276, 5, 'TASK PROGRESS REPORT', 0, 0, 'C');
			$this->Ln();
			$this->SetFont('Times','',12);
			$this->Cell(276,10,'Progress and Status of Assigned Tasks',0 ,0, 'C');
			$this->Ln(20); 
		}

		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0, 10, 'Page '.$this->PageNo(). '/{nb}' , 0, 0, 'C');
		}

		function headerTable(){
			if (isset($_SESSION['member_id'])) {
			$this->SetFont('Times','B', 12);
			$this->Cell(120,10, 'Task Title',1,0,'C');
			$this->Cell(80,10, 'Progress',1,0,'C');
			$this->Cell(60,10, 'Status',1,0,'C');
			$this->Ln();
		}
		}

		function viewTable($task){
			$this->SetFont('Times','B', 12);
			if (isset($_SESSION['member_id'])) {
				$tasks = $task->getAssignedTasks2($_SESSION['member_id']);
				foreach($tasks as $onetask){
					$this->Cell(120,10, $onetask['title'],1,0,'C');
					$this->Cell(80,10,  $onetask['progress'].'% Complete' , 1,0,'C');
					$startdate = strtotime($onetask['accepted_on']);
					$enddate = strtotime($onetask['due_date']);
					$today  = time();
					$dateDiff = $enddate - $startdate;
					$dateDiffForToday = $today - $startdate;
					$percentage = $dateDiffForToday/$dateDiff * 100;
					$percentage = round($percentage);
					if($percentage <= $onetask['progress']){
						$this->Cell(60,10,  'On Schedule',1,0,'C');
					}else{
						$this->Cell(60,10,  'Behind Schedule',1,0,'C');
					}
					$this->Ln();
				}
			
			}else{
				header('Location:Login.php');
			}
		}
	}

	$pdf = new myPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage('L','A4', 0);
	$pdf->headerTable();
	$pdf->viewTable($task);
	$pdf->Output();



 ?>