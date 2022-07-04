<div style="min-height: 400px;width:100%;background-color: white;text-align: center;">
	<div style="padding: 20px;">
	<?php
 
		$post_class = new Post();
		$user_class = new User();

		$following = $user_class->get_following($user_data['user_id'],"user");

		if(is_array($following)){

			foreach ($following as $follower) {
				# code...
				$FRIEND_ROW = $user_class->get_user($follower['user_id']);
				include("user.php");
			}

		}else{

			echo "No following were found!";
		}


	?>

	</div>
</div>