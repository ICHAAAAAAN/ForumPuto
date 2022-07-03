<div id="post">
	<div>
		<?php
			
			$image = "./pics/dp17.jpg";
			if($ROW_USER['gender'] == "Female")
			{
				$image = "./pics/dp13.jpg";
			}else
					
		?>
		<img src="<?php echo $image ?>" style="width:2rem; margin-right:4px;">
	</div>
	<div>
		<div style="font-weight:bold; color:#405d9b;"><?php echo $ROW_USER['first_name'] . " " . $ROW_USER['last_name'] ?></div>
		<?php echo $ROW['post'] ?>
		<br/>
		
		<?php
			$likes = "";
			
			$likes = ($ROW['likes'] > 0) ? "(" .$ROW['likes']. ")" : "" ;
		?>		
		<a href="like.php?type=post&id=<?php echo $ROW['post_id'] ?>">Like<?php echo $likes ?></a> . <a href="">Comment</a> . <?php echo $ROW['dates'] ?>
	</div>
</div>