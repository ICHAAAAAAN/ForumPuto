<?php

class Post
{
	private $error = "";
	
	public function create_post($user_id, $data)
	{
		
		if(!empty($data['post']))
		{
			
			$post = addslashes($data['post']);
			$post_id = $this->create_postid();
			$parent = 0;
			$DB = new Database();

			
			if(isset($data['parent']) && is_numeric($data['parent'])){
				
				$parent = $data['parent'];
				
				$sql = "update posts set comments = comments + 1 where post_id = '$parent' limit 1";
				$DB->save($sql);
			}
			$query = "insert into  posts (post_id,user_id,post,parent) values ('$post_id','$user_id','$post','$parent')";
			$DB->save($query);
			
		}else
		{
			$this->error .= "Please put what's on your mind<br>";
		}
		
		return $this->error;
	}
	
	public function get_posts($id)
	{
		
		$query = "select * from  posts where user_id = '$id' order by id desc limit 10";
			
		$DB = new Database();
		$result = $DB->read($query);
		
		if($result)
		{
			return $result;
		}else
		{
			return false;
		}
	}
	
	public function get_comments($id)
	{
		
		$query = "select * from  posts where parent = '$id' order by id asc limit 10";
			
		$DB = new Database();
		$result = $DB->read($query);
		
		if($result)
		{
			return $result;
		}else
		{
			return false;
		}
	}
	
	public function get_one_post($post_id)
	{
		
		if(!is_numeric($post_id)){
			
			return false;
		}
		
		$query = "select * from posts where post_id = '$post_id' limit 1";
		
		$DB = new Database();
		$result = $DB->read($query);
		
		if($result)
		{
			return $result[0];
		}else{
			return false;
		}
	}
	
	public function like_post($id,$type,$user_id){
		
		
			
			$DB = new Database();
			
			
			//save likes deatils
			$sql = "select likes from likes where type = '$type' && content_id = '$id' limit 1";
			$result = $DB->read($sql);
			if(is_array($result)){
				
				$likes = json_decode($result[0]['likes'],true);
				
				$user_ids = array_column($likes, "userid");
				
				if(!in_array($user_id, $user_ids)){
					
					$arr[] = $user_id;
					$arr[] = date("Y-m-d H:i:s");
					
					$likes[] = $arr;
					
					$likes_string = json_encode($likes);
					$sql = "update likes set likes = '$likes_string' where type ='$type' && content_id = '$id' limit 1";
					$DB->save($sql);
					
					//increment posts table
					$sql = "update {$type}s set likes = likes + 1 where {$type}_id = '$id' limit 1";
					$DB->save($sql);
				}else{
					
					$key = array_search($user_id, $user_ids);
					unset($likes[$key]);
					
					$likes_string = json_encode($likes);
					$sql = "update likes set likes = '$likes_string' where type ='$type' && content_id = '$id' limit 1";
					$DB->save($sql);
					
					//increment right table
					$sql = "update {$type}s set likes = likes - 1 where {$type}_id = '$id' limit 1";
					$DB->save($sql);
				}
				
			}else{
				
				$arr["userid"] = $user_id;
				$arr["date"] = date("Y-m-d H:i:s");
				
				$arr2[] = $arr;
				
				$likes = json_encode($arr2);
				$sql = "insert into likes (type,content_id,likes) values ('$type','$id','$likes')";
				$DB->save($sql);
				
				//increment right table
				$sql = "update {$type}s set likes = likes + 1 where {$type}_id = '$id' limit 1";
				$DB->save($sql);
			}
		
	}
	
	public function get_likes($id,$type){

		$DB = new Database();
		$type = addslashes($type);

		if(is_numeric($id)){
 
			//get like details
			$sql = "select likes from likes where type='$type' && content_id = '$id' limit 1";
			$result = $DB->read($sql);
			if(is_array($result)){

				$likes = json_decode($result[0]['likes'],true);
				return $likes;
			}
		}


		return false;
	}
	
	private function create_postid()
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
