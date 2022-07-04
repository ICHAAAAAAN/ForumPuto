<div style="display: flex;">
        
		<!--post area-->
       <div style="min-height:400px; flex:2.5; padding:20px; padding-left:0px;">
	
		<div style="border:solid thin #aaa; padding:10px; background-color:white;">
			<form method="post">
				<textarea name="post" placeholder="Anything you want to post?"></textarea>
				<input id="post_button" type="submit" value="Post">
				<br>
			</form>
		</div>

        <!--post-->
	<div id="post_bar">
		
		<?php
					
			$DB = new Database();
			$user_class = new User;
			$sql = "select * from posts where id";
			if($posts)
			{
						
				foreach ($posts as $ROW){
					#code...
							
					$user = new User();
					$ROW_USER = $user->get_user($ROW['user_id']);
							
					include("post.php");
				}
			}
					
		?>
	</div>
	</div>
	<!--friend area-->
       <div style="min-height:400px;flex:1;">	
           <div id="friends_bar">
            Friends<br>
              <?php
				if($friends)
				{
						
					foreach ($friends as $FRIEND_ROW){
						#code...
						include("user.php");
					}
				}
					
			?>
           </div>
       </div>
	</div>
