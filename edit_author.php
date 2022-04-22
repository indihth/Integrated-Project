<?php
require_once 'classes/DBConnector.php';
require_once "include/validate_author.php";


[$author, $errors] = author_validate($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo "Process request!!";

  echo "<pre>\$_POST = ";
  print_r($_POST);
  echo "</pre>";

  [$author, $errors] = author_validate($_POST);

  if (empty($errors)) {

    echo "<pre>\$author = ";
    print_r($author);
    echo "<pre>";

    echo "<pre>\$errors = ";
    print_r($errors);
    echo "<pre>";

    try {

      $author["id"] = $_POST['id'];

      $data = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'link' => $_POST['link']
      ];

      Post::edit('authors',  $author["id"], $data);
    } catch (Exception $e) {
      die("Exception: " . $e->getMessage());
    }
    header("Location: author_view_all.php");
  } else {
    session_start();
    $_SESSION["data"] = $author;
    $_SESSION["errors"] = $errors;
    header("Location: edit_author_form.php");
  }
} else {
  //returns error page on GET request
  http_response_code(405);
}
