<?php
require_once 'classes/DBConnector.php';


function sanitize_input($data)
{
  $data = trim($data);                //removes white space at beginning and end
  $data = stripslashes($data);        //remove any backslashes
  $data = htmlspecialchars($data);    //remove any html special characters and make into html entities

  return $data;
}

function validate_text($text) {
  $pattern = "/^[0-9a-zA-Z-', ]*$/";
  return preg_match($pattern, $text) === 1;
}

function validate_num($num) {
$pattern = "/^[0-9{3}]*$/";            // assuming there won't ever be more than 999 author ids in db
  return preg_match($pattern, $num) === 1;
}

function validate_date($date) {
  $pattern = "/^([0-9]{4})\\-([0-9]{2})\\-([0-9]{2})$/";
  $matches = array();
  $valid = (preg_match($pattern, $date, $matches) === 1);
  if ($valid) {
      $valid = (checkdate($matches[2], $matches[3], $matches[1]));
  }
  return $valid;
}


//-------------------------------------------------------------------
//validate request
//-------------------------------------------------------------------


function story_validate($data)
{

    // returns all story ids currently in db
    $authors = Get::all('authors');
    $author_ids = [];

    foreach ($authors as $author) {
        array_push($author_ids, $author->id);
    }

    // returns all category ids currently in db
    $categories = Get::all('categories');
    $category_ids = [];

    foreach ($categories as $category) {
        array_push($category_ids, $category->id);
    }


    $errors = [];
    $story = [];

    //-------------------------------------------------------------------
    // NOTES ON TEXT VALIDATION
    //-------------------------------------------------------------------
    // RegEx validation was removed from text fields.
    // Woulddn't have made sense to limit article heading and body to 
    // letters and numbers only.
    //-------------------------------------------------------------------

    //-------------------------------------------------------------------
    //validate headline
    //-------------------------------------------------------------------


    if (empty($data["headline"])) {
        $errors["headline"] = "The headline field is required.";
    } 
    else {
        $story["headline"] = sanitize_input($data["headline"]);
        // if (!validate_text($story["headline"])) {
        //     $errors["headline"] = "Only letters, numbers and spaces are allowed.";
        // }
    }

    //-------------------------------------------------------------------
    //validate short_headline
    //-------------------------------------------------------------------

    if (empty($data["short_headline"])) {
        $errors["short_headline"] = "The short_headline field is required.";
    } else {
        $story["short_headline"] = sanitize_input($data["short_headline"]);
        // if (!validate_text($story["short_headline"])) {
        //     $errors["short_headline"] = "Only letters, numbers and spaces are allowed.";
        // }
    }

    //-------------------------------------------------------------------
    //validate sub_heading
    //-------------------------------------------------------------------

    if (empty($data["sub_heading"])) {
        $errors["sub_heading"] = "The sub_heading field is required.";
    } else {
        $story["sub_heading"] = sanitize_input($data["sub_heading"]);
        // if (!validate_text($story["sub_heading"])) {
        //     $errors["sub_heading"] = "Only letters, numbers and spaces are allowed.";
        // }
    }
    //-------------------------------------------------------------------
    //validate summary
    //-------------------------------------------------------------------

    if (empty($data["summary"])) {
        $errors["summary"] = "The summary field is required.";
    } else {
        $story["summary"] = sanitize_input($data["summary"]);
        // if (!validate_text($story["summary"])) {
        //     $errors["summary"] = "Only letters, numbers and spaces are allowed.";
        // }
    }

    //-------------------------------------------------------------------
    //validate main_story
    //-------------------------------------------------------------------

    if (empty($data["main_story"])) {
        $errors["main_story"] = "The main_story field is required.";
    } else {
        $story["main_story"] = sanitize_input($data["main_story"]);
        // if (!validate_text($story["main_story"])) {
        //     $errors["main_story"] = "Only letters, numbers and spaces are allowed.";
        // }
    }

    //-------------------------------------------------------------------
    //validate date
    //-------------------------------------------------------------------

    if (empty($data["date"])) {
        $errors["date"] = "The date field is required.";
    } else {
        $story["date"] = sanitize_input($data["date"]);
    }

    //-------------------------------------------------------------------
    //validate time
    //-------------------------------------------------------------------

    if (empty($data["time"])) {
        $errors["time"] = "The time field is required.";
    } else {
        $story["time"] = sanitize_input($data["time"]);
    }

    //-------------------------------------------------------------------
    //validate author_id
    //-------------------------------------------------------------------

    if (empty($data["author_id"])) {
        $errors["author_id"] = "The author_id field is required.";
    } else {
        $story["author_id"] = sanitize_input($data["author_id"]);
        if (!in_array($story["author_id"], $author_ids)) {
            $errors["author_id"] = "Invalid author id option.";
        }
    }

    //-------------------------------------------------------------------
    //validate category_id
    //-------------------------------------------------------------------

    if (empty($data["category_id"])) {
        $errors["category_id"] = "The category_id field is required.";
    } else {
        $story["category_id"] = sanitize_input($data["category_id"]);
        if (!in_array($story["category_id"], $category_ids)) {
            $errors["category_id"] = "Invalid author id option.";
        }
    }

    //-------------------------------------------------------------------
    //validate story id
    //-------------------------------------------------------------------

    // if (empty($data["id"])) {
    //     $errors["id"] = "The id field is required.";
    // } else {
        // $story["id"] = sanitize_input($data["id"]);
    // }

    return [
        $story,
        $errors
    ];
}
