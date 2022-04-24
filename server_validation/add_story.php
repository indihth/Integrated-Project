<?php
require_once 'classes/DBConnector.php';
require_once 'include/validate_story.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo "Process request!!";

  echo "<pre>\$_POST = ";
  print_r($_POST);
  echo "<pre>";

  [$story, $errors] = story_validate($_POST);

  if (empty($errors)) {
    echo "<pre>\$story = ";
    print_r($story);
    echo "<pre>";
  
    echo "<pre>\$errors = ";
    print_r($errors);
    echo "<pre>";
  }
  else {
    session_start();
    $_SESSION["data"] = $story;
    $_SESSION["errors"] = $errors;
    header("Location: add_story_form.php");
  }


} else {
  //returns error page on GET request
  http_response_code(405);
}



  // require_once 'classes/DBConnector.php';

  // try {
      
  //   $data = [
  //       'headline' => $_POST['headline'],
  //       'short_headline' => $_POST['short_headline'],
  //       'sub_heading' => $_POST['sub_heading'],
  //       'main_story' => $_POST['main_story'],
  //       'summary' => $_POST['summary'],
  //       'date' => $_POST['date'],
  //       'time' => $_POST['time'],
  //       'story_id' => $_POST['story_id'],
  //       'category_id' => $_POST['category_id']
  //     ];
      
  //     Post::create('stories', $data);

  //     header("Location: index.php");
      
  // } catch (Exception $e) {
  //   die("Exception: " . $e->getMessage());
  // }
