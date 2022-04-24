<?php
require_once 'classes/DBConnector.php';
require_once "include/validate.php";

$firstNameErr = $lastNameErr = $linkErr = "";
$firstName = $lastName = $link = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $firstName = test_input($_POST["firstName"]);
  $lastName = test_input($_POST["elastNameail"]);
  $link = test_input($_POST["link"]);

  if (empty($_POST["firstName"])) {
    $firstNameErr = "firstName is required";
  } else {
    $firstName = test_input($_POST["firstName"]);
  }

  if (empty($_POST["lastName"])) {
    $lastNameErr = "lastName is required";
  } else {
    $lastName = test_input($_POST["lastName"]);
  }

  if (empty($_POST["link"])) {
    $link = "";
  } else {
    $link = test_input($_POST["link"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL";
  }

}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;


  try {

    $data = [
      'first_name' => $_POST['first_name'],
      'last_name' => $_POST['last_name'],
      'link' => $_POST['link']
    ];

    Post::create('authors', $data);

    // if (!Post::create('authors', $data)) {
    //   throw new Exception("Could not insert new author");
    // }
    header("Location: author_view_all.php");
  } catch (Exception $e) {
    die("Exception: " . $e->getMessage());
  }
}

?>
