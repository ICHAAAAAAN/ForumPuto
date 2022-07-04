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
				<a href = "index.php?id=$COMMENT[user_id]">
                <h3><?php echo $ROW_USER['first_name'] . " " . $ROW_USER['last_name'] ?></h3>
				</a>
                <small><?php echo $COMMENT['dates'] ?></small>
            </div>
        </div>
            <span class="edit">
                <i class="uil uil-ellipsis-h"></i>
            </span>
        </div>
		<div class="caption">
            <p><?php echo $COMMENT['post'] ?></p>
			<br/>
		</div>	
		<?php
			$likes = "";
			
			$likes = ($COMMENT['likes'] > 0) ? "(" .$COMMENT['likes']. ")" : "" ;
		?>
		<a href="like.php?type=post&id=<?php echo $COMMENT['post_id'] ?>">Like<?php echo $likes ?></a> . 
</div>
	