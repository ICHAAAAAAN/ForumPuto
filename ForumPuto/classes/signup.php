<?php

class Signup
{
	
	private $error = "";
	
	public function evaluate($data)
	{
		
		foreach ($data as $key => $value){
			#code...
			if(empty($value))
			{
				$this->error = $this->error . $key ."is empty!<br>";
			}
		}
		
		if($this->error == "")
		{
			
			//no error
			$this->create_user($data);
		}else
		{
			return $this->error;
		}
	}
	
	public function create_user($data)
	{
		
		$first_name = $data['first_name'];
		$last_name = $data['last_name'];
		$user_name = $data['user_name'];
		$gender = $data['gender'];
		$password = $data['password'];
		
		//create this
		$user_id = $this->create_userid();
		
		$query = "insert into users (user_id,first_name,last_name,user_name,gender,password) values ('$user_id','$first_name','$last_name','$user_name','$gender','$password')";
		
		$DB = new Database();
		$DB->save($query);
	}
	
	private function create_userid()
	{
		
		$length = rand(4,19);
		$number = "";
		for ($i=0; $i < $length; $i++){
			#code...
			$new_rand = rand(0,9);
			
			$number = $number .  $new_rand;
		}
		
		return $number;
	}
}