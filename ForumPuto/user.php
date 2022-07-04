<div id="friends">
	
	<?php
			
		$image = "./pics/dp17.jpg";
		if($FRIEND_ROW['gender'] == "Female")
		{
			$image = "./pics/dp13.jpg";
		}
				
		if(file_exists($FRIEND_ROW['profile_image']))
		{
			$image = $image_class->get_thumb_profile($FRIEND_ROW['profile_image']); 
		}
					
	?>
	<a href="profile.php?id=<?php echo $FRIEND_ROW['user_id']; ?> ">
    <img id="friends_img" src="<?php echo $image ?>">
	
	<?php echo $FRIEND_ROW['first_name'] . " " . $FRIEND_ROW['last_name'] ?>
</div>
