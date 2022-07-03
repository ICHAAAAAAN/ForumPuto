<div style="min-height: 400px;width:100%;background-color: white;text-align: center;">
	<div style="padding: 20px;">
	<?php
 
		$post_class = new Post();
		$user_class = new User();

		$followers = $post_class->get_likes($user_data['user_id'],"user");

		if(is_array($followers)){

			foreach ($followers as $follower) {
				# code...
				$FRIEND_ROW = $user_class->get_user($follower['user_id']);
				include("user.php");
			}

		}else{

			echo "No followers were found!";
		}


	?>

	</div>
</div>