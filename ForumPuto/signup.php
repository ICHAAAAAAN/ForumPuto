<?php

	include("classes/connect.php");
	include("classes/signup.php");
	
	$first_name = "";
	$last_name = "";
	$user_name = "";
	$gender = "";
	
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$signup = new Signup();
		$result = $signup->evaluate($_POST);
		
		if($result != ""){
			
			echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
			echo "<br>The following error occured<br><br>";
			echo $result;
			echo "</div>";
		}else
		{
			
			header("Location: login.php");
			die;
		}
		
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$user_name = $_POST['user_name'];
		$gender = $_POST['gender'];
			
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
                <h2>Sign up</h2>
                <h3>Fill up for the form so you can register.</h3>
                <form method="post" action="signup.php">
                    <div class="inputBx">
                        <p>First name</p>
                        <input value = "<?php echo $first_name ?>" id="text" type="text" name="first_name" placeholder="Enter Firstname">
                    </div>
                    <div class="inputBx">
                        <p>Last name</p>
                        <input value = "<?php echo $last_name ?>" id="text" type="text" name="last_name" placeholder="Enter Lastname">
                    </div>
                    <div class="inputBx">
                        <p>Username</p>
                        <input value = "<?php echo $user_name ?>" id="text" type="text" name="user_name" placeholder="Enter Username">
                    </div>
					<span style="font-weight: normal;">Gender:</span><br>
					<select id="text" name="gender">
						<option><?php echo $gender ?></option>
						<option>Male</option>
						<option>Female</option>
					</select>
                    <div class="inputBx">
                        <p>Password</p>
                        <input id="text" type="password" name="password" placeholder="Enter Password">
                    </div>
                    <div class="inputBx">
                        <input style="background-color: #943131;" id="button" type="submit" value="Signup">
						<a href="login.php">Click to Login</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>