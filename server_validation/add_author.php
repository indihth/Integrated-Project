<?php
require_once 'classes/DBConnector.php';
require_once "include/validate_author.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo "Process request!!";

  [$author, $errors] = author_validate($_POST);

  // echo "<pre>\$_POST = ";
  // print_r($_POST);
  // echo "<pre>";

  // echo "<pre>\$author = ";
  // print_r($author);
  // echo "<pre>";

  // echo "<pre>\$errors = ";
  // print_r($errors);
  // echo "<pre>";


  if (empty($errors)) {

    try {

      $data = [
      'first_name' => $author['first_name'],
      'last_name' => $author['last_name'],
      'link' => $author['link']
      ];
      
      Post::create('authors', $data);
      
      } catch (Exception $e) {
      die("Exception: " . $e->getMessage());
      }
      header("Location: author_view_all.php");

    // echo "<pre>\$author = ";
    // print_r($author);
    // echo "<pre>";
  
    // echo "<pre>\$errors = ";
    // print_r($errors);
    // echo "<pre>";
  }
  else {
    session_start();
    $_SESSION["data"] = $author;
    $_SESSION["errors"] = $errors;
    header("Location: add_author_form.php");
  }

} else {
  //returns error page on GET request
  http_response_code(405);
}




// if ($_SERVER["REQUEST_METHOD"] == "POST") {
// echo "Process request!!";

// [$author, $errors] = author_validate($_POST);

// if (empty($errors)) {

// try {

// $data = [
// 'first_name' => $_POST['first_name'],
// 'last_name' => $_POST['last_name'],
// 'link' => $_POST['link']
// ];

// Post::create('authors', $data);

// } catch (Exception $e) {
// die("Exception: " . $e->getMessage());
// }
// header("Location: author_view_all.php");
// } else {
// session_start();
// $_SESSION["data"] = $author;
// $_SESSION["errors"] = $errors;
// header("Location: add_author_form.php");
// }
// } else {
// //returns error page on GET request
// http_response_code(405);
// }


?>