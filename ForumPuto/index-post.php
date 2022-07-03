<!--Feed 1-->
<div class="feed">
    <div class="head">
        <div class="user">
            <div class="profile-photo">
				<?php
			
				$image = "./pics/dp17.jpg";
				if($ROW_USER['gender'] == "Female")
				{
					$image = "./pics/dp13.jpg";
				}else
					
				?>
                <img src="<?php echo $image ?>">
            </div>
            <div class="ingo">
                <h3><?php echo $ROW_USER['first_name'] . " " . $ROW_USER['last_name'] ?></h3>
                <small><?php echo $ROW['dates'] ?></small>
            </div>
        </div>
            <span class="edit">
                <i class="uil uil-ellipsis-h"></i>
            </span>
        </div>
		<div class="caption">
            <p><?php echo $ROW['post'] ?></p>
			<br/>
		</div>	
		<?php
			$likes = "";
			
			$likes = ($ROW['likes'] > 0) ? "(" .$ROW['likes']. ")" : "" ;
		?>
		<a href="like.php?type=post&id=<?php echo $ROW['post_id'] ?>">Like<?php echo $likes ?></a> . <a href="">Comment</a>
</div>
	