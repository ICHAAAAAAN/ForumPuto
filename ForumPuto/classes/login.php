<?php

class Login
{
	private $error = "";
	
	public function evaluate($data)
	{
		
		$user_name = addslashes($data['user_name']);
		$password = addslashes($data['password']);
		
		$query = "select * from users where user_name = '$user_name' limit 1";
		
		$DB = new Database();
		$result = $DB->read($query);
		
		if($result)
		{
			
			$row = $result[0];
			
			if($password == $row['password'])
			{		
				
				//create session data
				$_SESSION['user_id'] = $row['user_id'];
				
			}else
			{
				$this->error .= "Wrong password<br>";
			}
		}else
		{
			$this->error .= "No such username was found<br>";
		}
			
			return $this->error;
	}
	
	public function check_login($id)
	{
		if(is_numeric ($id))
		{
		
			$query = "select * from users where user_id = '$id' limit 1";
			
			$DB = new Database();
			$result = $DB->read($query);
			
			if($result)
			{
				$user_data = $result[0];
				return $user_data;
			}else
			{
				header("Location: login.php");
				die;
			}		
			
		}else
		{
			header("Location: login.php");
				die;
		}
	}
}