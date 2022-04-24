<?php

//function to sanatize the data being entered
//security so code isn't sent to the database
function sanitize_input($data) {
    $data = trim($data);                //removes white space at beginning and end
    $data = stripslashes($data);        //remove any backslashes
    $data = htmlspecialchars($data);    //remove any html special characters and make into html entities

    return $data;
}

function validate_name($name) {
    $pattern = "/^[a-zA-Z-' ]*$/";
    return preg_match($pattern, $name) === 1;
}

function validate_address($address) {
    $pattern = "/^[0-9a-zA-Z-', ]*$/";
    return preg_match($pattern, $address) === 1;
}

function validate_url($url) {
    $pattern = "/^(https?:\/\/)?[0-9a-z]+\.[-_0-9a-z]+\.[0-9a-z]+$/";
    return preg_match($pattern, $url) === 1;
}


//-------------------------------------------------------------------
//validate request
//-------------------------------------------------------------------


function author_validate($data) {

    $errors = [];           //to hold errors, initialise empty
    $author = [];          //to hold validated author data

    //-------------------------------------------------------------------
    //validate first name
    //-------------------------------------------------------------------

    //checking if the name field is empty
    if (empty($data["first_name"])) {
        //use same name for error as the field being validated
        $errors["first_name"] = "The first name field is requried.";
    } else {
        //to store value, good to match array names from above
        $author["first_name"] = sanitize_input($data["first_name"]);
        if (!validate_name($author["first_name"])) {
            $errors["first_name"] = "Only letters and spaces are allowed.";
        }
    }

    //-------------------------------------------------------------------
    //validate last name
    //-------------------------------------------------------------------

    //checking if the name field is empty
    if (empty($data["last_name"])) {
        //use same name for error as the field being validated
        $errors["last_name"] = "The last name field is requried.";
    } else {
        //to store value, good to match array names from above
        $author["last_name"] = sanitize_input($data["last_name"]);
        if (!validate_name($author["last_name"])) {
            $errors["last_name"] = "Only letters and spaces are allowed.";
        }
    }

    
    //-------------------------------------------------------------------
    //validate url
    //-------------------------------------------------------------------

    if (empty($data["link"])) {
        $errors["link"] = "The link field is requried.";
    } else {
        $author["link"] = sanitize_input($data["link"]);
        if (!validate_url($author["link"])) {
            $errors["link"] = "Invalide URL format.";
        }
    }


    return [
        $author,
        $errors
    ];
}
