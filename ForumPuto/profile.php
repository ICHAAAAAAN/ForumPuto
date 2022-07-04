<?php

include("classes/autoload.php");

$login = new Login();
$user_data = $login->check_login($_SESSION['user_id']);

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $profile = new Profile();
  $profile_data = $profile->get_profile($_GET['id']);

  if (is_array($profile_data)) {
    $user_data = $profile_data[0];
  }
}
//posting starts here

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $post = new Post();
  $id = $_SESSION['user_id'];
  $result = $post->create_post($id, $_POST);

  if ($result == "") {
    header("Location: profile.php");
    die;
  } else {
    echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
    echo "<br>The following error occured<br><br>";
    echo $result;
    echo "</div>";
  }
}

//collect post
$post = new Post();
$id = $user_data['user_id'];

$posts = $post->get_posts($id);

//collect friends
$user = new User();

$friends = $user->get_friends($id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Profile</title>

  <link rel="stylesheet" href="./profile-page.css">
</head>

<body>
  <nav>
    <div class="container">
      <h2 class="log">
        <img src="./pics/logos.png">
      </h2>
      <!--Search Bar-->
      <div class="search-bar">
        <i class="uil uil-search"></i>
        <input type="search" placeholder="Anything you want to search?">
      </div>
      <!--Logout Button-->
      <div class="create">
        <input type="button">
        <label class="btn btn-primary" for="create-post"><a href="index.php">Home</a></label>
        <div class="profile-photo">
          <?php

          $image = "./pics/dp17.jpg";
          if ($user_data['gender'] == "Female") {
            $image = "./pics/dp16.jfif";
          } else

          ?>
          <img src="<?php echo $image ?>">
        </div>
      </div>
    </div>
  </nav>

  <body style="font-family: 'Poppins', sans-serif; background-color: #d0d8e4;">

    <br>

    <div style="width: 800px;margin:auto;min-height: 400px;">

      <div style="background-color: white;text-align: center;color: #405d9b">

        <img src="./pics/storytest6.jpg" style="width:100%; margin-bottom: -5.5rem;">
        <?php

        $image = "./pics/dp17.jpg";
        if ($user_data['gender'] == "Female") {
          $image = "./pics/dp16.jfif";
        } else

        ?>
        <img id="profile_pic" src="<?php echo $image ?>"><br />
        <br>
        <div style="font-size: 20px;color: black; margin-top: 0.5rem;">
          <a href="profile.php">
            <br><span
              style="font-size:32px;"><?php echo $user_data['first_name'] . " " . $user_data['last_name'] ?></span>
          </a>
          <br>
        </div>
        <?php
        $mylikes = "";
        if ($user_data['followers'] > 0) {

          $mylikes = "(" . $user_data['followers'] . " Followers)";
        }

        ?>
        <!-- <a href="like.php?type=user&id=<?php echo $user_data['user_id'] ?>"> -->
        <input id="post_button" class="follow-btn" type="button" value="Follow <?php echo $mylikes ?>"
          style="margin-right:10px; width:auto;"
          onclick="updateFollow(<?php echo $_SESSION['user_id'] ?>, <?php echo $user_data['user_id'] ?>)">
        <!-- </a> -->
        <br>
        <a href="index.php">
          <div id="menu_buttons">Timeline</div>
        </a>
        <a href="profile.php?section=about">
          <div id="menu_buttons">About</div>
        </a>
        <!-- <a href="profile.php?section=followers&id=<?php echo $_GET['id'] ?>">
          <div id="menu_buttons">Followers</div>
        </a> -->
        <a href="profile.php?section=following">
          <div id="menu_buttons">Following</div>
        </a>
        <a href="profile.php?section=photos">
          <div id="menu_buttons">Photos</div>
        </a>
        <a href="profile.php?section=settings">
          <div id="menu_buttons">Settings</div>
        </a>
      </div>

      <!--below cover area-->

      <?php
      $section = "default";
      if (isset($_GET['section'])) {
        $section = $_GET['section'];
      }

      if ($section == "default") {
        include("profile_content_default.php");
      } elseif ($section == "followers") {
        include("profile_content_followers.php");
      }



      ?>


    </div>
  </body>

</html>
<!-- 73976035890283707 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
const updateFollow = (userID, followingID) => {
  const params = $.param({
    user_id: userID,
    id: followingID,
  })

  $.get("API/follow.php?" + params)
    .done(res => {
      let followers = JSON.parse(res);
      $(".follow-btn").val(`Follow (${followers['followers']} Followers)`);
      console.log(res)
    })
}
</script>