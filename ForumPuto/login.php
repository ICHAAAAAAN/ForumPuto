<?php
session_start();

	include("classes/connect.php");
	include("classes/login.php");
	
	$user_name = "";
	$password = "";
	
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$login = new Login();
		$result = $login->evaluate($_POST);
		
		if($result != ""){
			
			echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
			echo "<br>The following error occured<br><br>";
			echo $result;
			echo "</div>";
		}else
		{
			
			header("Location: index.php");
			die;
		}
		
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
			
	}

	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum PUTO - Login</title>
    <link rel="stylesheet" href="login-signup.css">
</head>
<body>
    <section>
        <div class="imgBx">
            <img src="./loginpic/forum-puto.png">
        </div>
        <div class="contentBx">
            <div class="formBx">
                <h2>Login</h2>
                <form method="post">
                    <div class="inputBx">
                        <p>Username</p>
                        <input value = "<?php echo $user_name ?>" id="text" type="text" name="user_name" placeholder="Enter Username">
                    </div>
                    <div class="inputBx">
                        <p>Password</p>
                        <input id="text" type="password" name="password" placeholder="Enter Password">
                    </div>
                    <div class="inputBx">
                        <input style="background-color: #943131;" id="button" type="submit" value="Login">
						<a href="signup.php">Click to Signup</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>