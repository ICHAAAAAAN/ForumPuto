<?php
include "../classes/connect.php";
$type = $_REQUEST["type"];
$id = $_REQUEST["id"];
$user_id = $_REQUEST["user_id"];


$DB = new Database();



//save likes deatils
$sql = "SELECT likes FROM likes WHERE type = '$type' AND content_id = '$id' LIMIT 1";

$result = $DB->read($sql);

if (isset($result[0]["likes"])) {

  $likes = json_decode($result[0]['likes'], true);

  $user_ids = array();
  foreach ($likes as $key => $val) {
    $user_ids["$key"] = $val["userid"];
  }

  if (!in_array($user_id, $user_ids)) {

    $arr["userid"] = $user_id;
    $arr["date"] = date("Y-m-d H:i:s");

    $likes[] = $arr;
    print_r($likes);

    $likes_string = json_encode($likes);
    $sql = "update likes set likes = '$likes_string' where type ='$type' && content_id = '$id' limit 1";
    $DB->save($sql);

    //increment posts table
    $sql = "update {$type}s set likes = likes + 1 where {$type}_id = '$id' limit 1";
    $DB->save($sql);
  } else {

    $key = array_search($user_id, $user_ids);

    unset($likes[$key]);
    print_r($likes);

    $likes_string = json_encode($likes);
    $sql = "update likes set likes = '$likes_string' where type ='$type' && content_id = '$id' limit 1";
    $DB->save($sql);

    //decrement right table
    $sql = "update {$type}s set likes = likes - 1 where {$type}_id = '$id' limit 1";
    $DB->save($sql);
  }
} else {
  $arr["userid"] = $user_id;
  $arr["date"] = date("Y-m-d H:i:s");

  $arr2[] = $arr; // [{userid=>$user_id, date=> now()}]

  $likes = json_encode($arr2);

  $sql = "insert into likes (type,content_id,likes) values ('$type','$id','$likes')";
  $DB->save($sql);

  //increment right table
  $sql = "update {$type}s set likes = likes + 1 where {$type}_id = '$id' limit 1";
  $DB->save($sql);
}