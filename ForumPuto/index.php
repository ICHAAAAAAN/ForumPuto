<?php

	include("classes/autoload.php");
	
	$login = new Login();
	$user_data = $login->check_login($_SESSION['user_id']);
	
	//posting starts here
	
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$post = new Post();
		$id = $_SESSION['user_id'];
		$result = $post->create_post($id, $_POST);
		
		if($result == "")
		{
			header("Location: index.php");
			die;
		}else
		{
			echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
			echo "<br>The following error occured<br><br>";
			echo $result;
			echo "</div>";
		}
	}
	
	//collect post
	$post = new Post();
	$id = $_SESSION['user_id'];
	
	$posts = $post->get_posts($id);
	
	//collect friends
	$user = new User();
	$id = $_SESSION['user_id'];
	
	$friends = $user->get_friends($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum PUTO</title>

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <!--Navigation Bar section-->
    <nav>
        <div class="container">
            <h2 class="log">
               <a href="index.php"><img src="./pics/logos.png"></a>
            </h2>
            <!--Search Bar-->
            <div class="search-bar">
                <i class="uil uil-search"></i>
                <input type="search" placeholder="Anything you want to search?">
            </div>
            <!--Logout Button-->
            <div class="create">
                <input type="button">
                <span class="btn btn-primary" for="create-post"><a href="logout.php"><a href="login.php">Logout</a></a></span>
                <div class="profile-photo">
					<?php
						
						$image = "./pics/dp17.jpg";
						if($user_data['gender'] == "Female")
						{
							$image = "./pics/dp16.jfif";
						}else
								
					?>
                    <img src="<?php echo $image ?>">
                </div>
            </div>
        </div>
    </nav>
    <main>
        <div class="container">
            <div class="left">
                <a class="profile">
                    <div class="profile-photo">
						<?php
						
							$image = "./pics/dp17.jpg";
							if($user_data['gender'] == "Female")
							{
								$image = "./pics/dp13.jpg";
							}else
								
						?>
							<img src="<?php echo $image ?>">
							change dp
                    </div>
                    <div class="handle">
                        <h4><?php echo $user_data['first_name'] ." ". $user_data['last_name']?></h4>
                        <p class="text-muted">
                            @<?php echo $user_data['user_name']?>
                        </p>
                    </div>
                </a>
                <!--Sidebar Navigations-->
                <div class="sidebar">
                    <a class="menu-item active">
                        <span><i class="uil uil-home"></i></span><h3>Home</h3>
                    </a>
                    <!--Class for notifications-->
                    <a class="menu-item" id="notifications">
                        <span><i class="uil uil-bell"><small class="notification-count">9+</small></i></span><h3>Notifications</h3>
                        <div class="notifications-popup">
                            <div>
                                <div class="profile-photo">
                                    <img src="./pics/dp2.jpg">
                                </div>
                                <div class="notifications-body">
                                    <b>Test Name 1</b> accepted your friend request.
                                    <small class="text-muted"> 46 MINUTES AGO </small>
                                </div>
                            </div>
                            <div>
                                <div class="profile-photo">
                                    <img src="./pics/dp3.jpg">
                                </div>
                                <div class="notifications-body">
                                    <b>Test Name 2</b> commented on your post.
                                    <small class="text-muted"> 3 HRS AGO </small>
                                </div>
                            </div>
                            <div>
                                <div class="profile-photo">
                                    <img src="./pics/dp4.jpg">
                                </div>
                                <div class="notifications-body">
                                    <b>Test Name 3</b> commented on a post that you are tagged in.
                                    <small class="text-muted"> 5 HRS AGO </small>
                                </div>
                            </div>
                            <div>
                                <div class="profile-photo">
                                    <img src="./pics/dp5.jpg">
                                </div>
                                <div class="notifications-body">
                                    <b>Test Name 4</b> commented on a post that you are tagged in.
                                    <small class="text-muted"> 7 HRS AGO </small>
                                </div>
                            </div>
                            <div>
                                <div class="profile-photo">
                                    <img src="./pics/dp6.jpg">
                                </div>
                                <div class="notifications-body">
                                    <b>Test Name 5</b> and <b>18 others</b> liked your post.
                                    <small class="text-muted"> 14 HRS AGO </small>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a class="menu-item" id="messages-notifications">
                        <span><i class="uil uil-message"><small class="notification-count">7+</small></i></span><h3>Messages</h3>
                    </a>
                    <a class="menu-item">
                        <span><i class="uil uil-bookmark-full"></i></span><h3>Favorites</h3>
                    </a>
                    <a class="menu-item" id="theme">
                        <span><i class="uil uil-palette"></i></span><h3>Theme</h3>
                    </a>
                    <a class="menu-item">
                        <span><i class="uil uil-setting"></i></span><h3>Settings</h3>
                    </a>
                </div>
                <!--User profile button-->
                <input type="button">
                <label for="create-post" class="btn btn-primary"><a href="profile.php">Go to your profile</a></label>

            </div>
            <!--Middle Navigations-->
            <div class="middle">
                <!--Stories-->
                <div class="stories">
                    <div class="story">
                        <div class="profile-photo">
							<?php
						
								$image = "./pics/dp17.jpg";
								if($user_data['gender'] == "Female")
								{
									$image = "./pics/dp13.jpg";
								}else
									
							?>
                            <img src="<?php echo $image ?>">
                        </div>
                        <p class="name">Your Story</p>
                    </div>
                    <div class="story">
                        <div class="profile-photo">
                            <img src="./pics/dp2.jpg">
                        </div>
                        <p class="name">Test Name 1</p>
                    </div>
                    <div class="story">
                        <div class="profile-photo">
                            <img src="./pics/dp3.jpg">
                        </div>
                        <p class="name">Test Name 2</p>
                    </div>
                    <div class="story">
                        <div class="profile-photo">
                            <img src="./pics/dp4.jpg">
                        </div>
                        <p class="name">Test Name 3</p>
                    </div>
                    <div class="story">
                        <div class="profile-photo">
                            <img src="./pics/dp5.jpg">
                        </div>
                        <p class="name">Test Name 4</p>
                    </div>
                    <div class="story">
                        <div class="profile-photo">
                            <img src="./pics/dp6.jpg">
                        </div>
                        <p class="name">Test Name 5</p>
                    </div>
                </div>
                <!--Status Posting form-->
                <form method="post" class="create-post">
                    <div class="profile-photo">
						<?php
						
							$image = "./pics/dp17.jpg";
							if($user_data['gender'] == "Female")
							{
								$image = "./pics/dp13.jpg";
							}else
								
						?>
                        <img src="<?php echo $image ?>">
                    </div>
                    <input name="post" type="text" placeholder="Anything you want to post?" id="create-post">
                    <input type="submit" value="Post" class="btn btn-primary">
                </form>

                <!--Feeds-->
                <div id="post_bar "class="feeds">
                    
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
							
							include("index-post.php");
						}
					}
					
				?>
			
                    
                    
                </div>
            </div>
            <!--Right Sidebar Navigations-->
            <div class="right">
                <div class="messages">
                    <div class="heading">
                        <h4>Messages</h4><i class="uil uil-edit"></i>
                    </div>
                    <!--Search bar-->
                    <div class="search-bar">
                        <i class="uil uil-search"></i>
                        <input type="search" placeholder="Search messages" id="message-search">
                    </div>
                    <!--Messages category-->
                    <div class="category">
                        <h6 class="active">Primary</h6>
                        <h6>General</h6>
                        <h6 class="messages-requests">Requests(7)</h6>
                    </div>
                    <!--Message-->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="./pics/dp11.jpg">
                        </div>
                        <div class="message-body">
                            <h5>Name 1</h5>
                            <p class="text-bold">tol tatanong lang ako paano to maayos, di ko kasi maidentify yung error eh</p>
                        </div>
                    </div>
                    <!--Message-->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="./pics/dp10.jpg">
                            <div class="active"></div>
                        </div>
                        <div class="message-body">
                            <h5>Name 2</h5>
                            <p class="text-muted">gegege bukas ayusin natin</p>
                        </div>
                    </div>
                    <!--Message-->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="./pics/dp12.jpg">
                        </div>
                        <div class="message-body">
                            <h5>Tender Juicy</h5>
                            <p class="text-bold">ok sige sige</p>
                        </div>
                    </div>
                    <!--Message-->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="./pics/dp13.jpg">
                            <div class="active"></div>
                        </div>
                        <div class="message-body">
                            <h5>Name 4</h5>
                            <p class="text-bold">ipapasa nalang yung linear programming natin no?</p>
                        </div>
                    </div>
                    <!--Message-->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="./pics/dp14.jpg">
                        </div>
                        <div class="message-body">
                            <h5>Name 5</h5>
                            <p class="text-muted">paano magchange ng ports sa phpMyAdmin?</p>
                        </div>
                    </div>
                    <!--Message-->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="./pics/dp15.jpg">
                            <div class="active"></div>
                        </div>
                        <div class="message-body">
                            <h5>Name 6</h5>
                            <p class="text-bold">sige thank you!!!</p>
                        </div>
                    </div>
                </div>

                <!--Friend requests-->
                <div class="friend-requests">
                    <h4>Friend Requests</h4>
                    <!--Request-->
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="./pics/dp19.jpg">
                            </div>
                            <div>
                                <h5>Test name 1</h5>
                                <p class="text-muted">
                                    8 mutual friends
                                </p>
                            </div>
                        </div>
                        <div class="action">
                            <button class="btn btn-primary">
                                Accept
                            </button>
                            <button class="btn btn-primary">
                                Decline
                            </button>
                        </div>
                    </div>
                    <!--Request-->
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="./pics/dp20.jpg">
                            </div>
                            <div>
                                <h5>Test name 2</h5>
                                <p class="text-muted">
                                    8 mutual friends
                                </p>
                            </div>
                        </div>
                        <div class="action">
                            <button class="btn btn-primary">
                                Accept
                            </button>
                            <button class="btn btn-primary">
                                Decline
                            </button>
                        </div>
                    </div>
                    <!--Request-->
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="./pics/dp21.jpg">
                            </div>
                            <div>
                                <h5>Test name 3</h5>
                                <p class="text-muted">
                                    8 mutual friends
                                </p>
                            </div>
                        </div>
                        <div class="action">
                            <button class="btn btn-primary">
                                Accept
                            </button>
                            <button class="btn btn-primary">
                                Decline
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <!--THEME customization-->
    <div class="customize-theme">
        <div class="card">
            <h2>Customize your view</h2>
            <p class="text-muted">Manage your font size, color and background.</p>

        <!--Font sizes-->
        <div class="font-size">
            <h4>Font Size</h4>
            <div>
                <h6>Aa</h6>
                <div class="choose-size">
                    <span class="font-size-1"></span>
                    <span class="font-size-2 active"></span>
                    <span class="font-size-3"></span>
                    <span class="font-size-4"></span>
                    <span class="font-size-5"></span>
                </div>
            <h3>Aa</h3>
            </div>
        </div>

        <!--Primary Colors-->
        <div class="color">
            <h4>Color</h4>
            <div class="choose-color">
                    <span class="color-1 active"></span>
                    <span class="color-2"></span>
                    <span class="color-3"></span>
                    <span class="color-4"></span>
                    <span class="color-5"></span>
            </div>
        </div>

            <!--Background Colors-->
            <div class="background">
                <h4>Background</h4>
                <div class="choose-bg">
                    <div class="bg-1 active">
                        <span></span>
                        <h5 for="bg-1">Light</h5>
                    </div>
                    <div class="bg-2">
                        <span></span>
                        <h5 for="bg-2">Dim</h5>
                    </div>
                    <div class="bg-3">
                        <span></span>
                        <h5 for="bg-3">Lights Out</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--End of MAIN and also THEME CUSTOMIZATION UI-->

<!--JavaScript-->
<script src="./index.js"></script>
</body>
</html>

