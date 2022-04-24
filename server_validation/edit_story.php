<?php
require_once 'classes/DBConnector.php';
require_once 'include/validate_story.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo "Process request!!";

  [$story, $errors] = story_validate($_POST);

  echo "<pre>\$_POST = ";
  print_r($_POST);
  echo "<pre>";

  echo "<pre>\$errors = ";
  print_r($errors);
  echo "<pre>";



  if (empty($errors)) {

    echo "<pre>\$story = ";
    print_r($story);
    echo "<pre>";
  
    echo "<pre>\$errors = ";
    print_r($errors);
    echo "<pre>";

    $story["id"] = $_POST['id'];

    try {

      $data = [
        'headline' => $story['headline'],
        'short_headline' => $story['short_headline'],
        'sub_heading' => $story['sub_heading'],
        'main_story' => $story['main_story'],
        'summary' => $story['summary'],
        'date' => $story['date'],
        'time' => $story['time'],
        'author_id' => $story['author_id'],
        'category_id' => $story['category_id']
      ];

      Post::edit('stories',  $story["id"], $data);

      header("Location: article.php");
    } 
    catch (Exception $e) {
      die("Exception: " . $e->getMessage());
    }
    // header("Location: article.php?id=" . $story["id"]);


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
    header("Location: edit_story_form.php");
  }
} else {
  //returns error page on GET request
  http_response_code(405);
}


  // $story["id"] = $_POST["id"];

  // try {
      
  //   $data = [
  //       'headline' => $_POST['headline'],
  //       'short_headline' => $_POST['short_headline'],
  //       'sub_heading' => $_POST['sub_heading'],
  //       'main_story' => $_POST['main_story'],
  //       'summary' => $_POST['summary'],
  //       'date' => $_POST['date'],
  //       'time' => $_POST['time'],
  //       'author_id' => $_POST['author_id'],
  //       'category_id' => $_POST['category_id']
  //     ];
      
  //     Post::edit('stories',  $story["id"], $data);

  //     header("Location: article.php?id=".$story["id"]);
      
  // } catch (Exception $e) {
  //   die("Exception: " . $e->getMessage());
  // }
