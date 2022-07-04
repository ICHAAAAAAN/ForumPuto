<?php
include "../classes/connect.php";
$id = $_REQUEST["id"];
$user_id = $_REQUEST["user_id"];

$DB = new Database();



//save likes deatils
$sql = "SELECT following FROM likes WHERE type = 'user' && content_id = '$user_id' limit 1";
$result = $DB->read($sql);


if (isset($result[0]["following"])) {

  $following = json_decode($result[0]['following'], true);
  // [{userid: "002309320"}, {userid : "039249"}]

  $following_list = array();
  foreach ($following as $key => $val) {
    $following_list["$key"] = $val["userid"];
  }
  // $following_list = array_column($following, "userid");

  if (!in_array($id, $following_list)) {

    $arr["userid"] = $id;
    $arr["date"] = date("Y-m-d H:i:s");

    $following[] = $arr;

    $following_string = json_encode($following);
    $sql = "update likes set following = '$following_string' where type = 'user' && content_id = '$user_id' limit 1";
    $DB->save($sql);


    $sql = "UPDATE users SET followers = followers + 1 WHERE user_id = '$id'";
    $DB->save($sql);
  } else {

    $key = array_search($id, $following_list);
    unset($following[$key]);

    $following_string = json_encode($following);
    $sql = "UPDATE likes SET following = '$following_string' WHERE type = 'user' AND content_id = '$user_id' limit 1";
    $DB->save($sql);

    $sql = "UPDATE users SET followers = followers - 1 
            WHERE user_id = '$id'";
    $DB->save($sql);
  }
} else {
  $arr["userid"] = $id;
  $arr["date"] = date("Y-m-d H:i:s");

  // [{"userid": $id, "date" : current_date }]
  $new_user_followers_data[] = $arr;

  $followers_data = json_encode($new_user_followers_data);

  $sql = "INSERT INTO likes (type, content_id, following) 
  			VALUES ('user','$user_id','$followers_data')";
  $DB->save($sql);

  $sql = "UPDATE users SET followers = followers + 1 
        WHERE user_id = '$id'";

  $DB->save($sql);
}

$sql = "SELECT followers FROM users WHERE user_id = $id";
$result = $DB->read($sql);

echo json_encode($result[0]);