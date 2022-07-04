<?php

class User
{

	public function get_data($id)
	{

		$query = "select * from users where user_id = '$id' limit 1";

		$DB = new Database();
		$result = $DB->read($query);

		if ($result) {

			$row = $result[0];
			return $row;
		} else {
			return false;
		}
	}

	public function get_user($id)
	{
		$query = "select * from users where user_id = '$id' limit 1";

		$DB = new Database();
		$result = $DB->read($query);

		if ($result) {
			return $result[0];
		} else {
			return false;
		}
	}

	public function get_friends($id)
	{
		$query = "select * from users where user_id != '$id' ";

		$DB = new Database();
		$result = $DB->read($query);

		if ($result) {
			return $result;
		} else {
			return false;
		}
	}

	public function get_following($id, $type)
	{

		$DB = new Database();
		$type = addslashes($type);

		if (is_numeric($id)) {

			//get following details
			$sql = "select following from likes where type='$type' && content_id = '$id' limit 1";
			$result = $DB->read($sql);
			if (is_array($result)) {

				$following = json_decode($result[0]['following'], true);
				return $following;
			}
		}


		return false;
	}

	public function follow_user($id, $type, $user_id)
	{
		$DB = new Database();

		//save likes deatils
		$sql = "SELECT following FROM likes WHERE type = 'user' && content_id = '$user_id' limit 1";
		$result = $DB->read($sql);

		print_r($result);

		if (isset($result[0]["following"])) {

			$following = json_decode($result[0]['following'], true);

			$following_list = array();
			foreach ($following as $key => $val) {
				$following_list["$key"] = $val["userid"];
			}

			if (!in_array($id, $following_list)) {

				$arr["userid"] = $id;
				$arr["date"] = date("Y-m-d H:i:s");

				$following[] = $arr;

				$following_string = json_encode($following);
				$sql = "update likes set following = '$following_string' where type = 'user' && content_id = '$user_id' limit 1";
				$DB->save($sql);


				$sql = "UPDATE users SET followers = followers + 1 WHERE user_id = '$id'";
				$DB->save($sql);
			} else {

				$key = array_search($id, $following_list);
				unset($following[$key]);

				$following_string = json_encode($following);
				$sql = "UPDATE likes SET following = '$following_string' WHERE type = 'user' AND content_id = '$user_id' limit 1";
				$DB->save($sql);

				$sql = "UPDATE users SET followers = followers - 1 
            WHERE user_id = '$id'";
				$DB->save($sql);
			}
		} else {
			$arr["userid"] = $id;
			$arr["date"] = date("Y-m-d H:i:s");

			// [{"userid": $id, "date" : current_date }]
			$new_user_followers_data[] = $arr;

			$followers_data = json_encode($new_user_followers_data);

			$sql = "INSERT INTO likes (type, content_id, following) 
  			VALUES ('user','$user_id','$followers_data')";
			$DB->save($sql);

			$sql = "UPDATE users SET followers = followers + 1 
        WHERE user_id = '$id'";

			$DB->save($sql);
		}
	}
}