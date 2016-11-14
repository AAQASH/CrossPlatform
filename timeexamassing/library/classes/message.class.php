<?php

class Message {
	
	function setMessage($message, $message_type){
		if(strlen(trim($message)) > 0 && strlen(trim($message_type)) > 0){
			switch($message_type){
				case 'success':
				case 'SUCCESS':
					$class = "alert alert-success";
					break;
				
				case 'error':
				case 'ERROR':
					$class = "alert alert-danger";
					break;
					
				case 'warning':	
				case 'WARNING':
					$class = "alert alert-warning";
					break;
					
				case 'question':
				case 'QUESTION':
					$class = "customquestion";
				break;
			}
			$_SESSION['message'] = "<div class='".$class." uberbar' id='uberbar'>".$message."</div>";
		}else{
			trigger_error("Argument Missing",E_USER_ERROR);
		}
		
	}
	
	function getMessage(){
		$x = $_SESSION['message'];
		unset($_SESSION['message']);
		return $x;
	}
	
	function customMessage($message, $message_type){
		if(strlen(trim($message)) > 0 && strlen(trim($message_type)) > 0){
			switch($message_type){
				case 'success':
				case 'SUCCESS':
					$class = "alert alert-success";
					break;
				
				case 'error':
				case 'ERROR':
					$class = "alert alert-danger";
					break;
					
				case 'warning':	
				case 'WARNING':
					$class = "alert alert-warning";
					break;
					
				case 'question':
				case 'QUESTION':
					$class = "customquestion";
				break;
			}
			return "<div class='".$class."'>".$message."</div>";
		}else{
			trigger_error("Argument Missing",E_USER_ERROR);
		}
	}
}

?>