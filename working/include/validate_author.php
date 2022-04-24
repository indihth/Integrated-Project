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

// function validate_email($email) {
//     return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
// }

// function validate_date($date) {
//     $pattern = "/^([0-9]{4})\\-([0-9]{2})\\-([0-9]{2})$/";
//     $matches = array();
//     $valid = (preg_match($pattern, $date, $matches) === 1);
//     if ($valid) {
//         $valid = (checkdate($matches[2], $matches[3], $matches[1]));
//     }
//     return $valid;
// }


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

    //-------------------------------------------------------------------
    //validate email
    //-------------------------------------------------------------------

    // if (empty($data["email"])) {
    //     $errors["email"] = "The email field is requried.";
    // } else {
    //     $author["email"] = sanitize_input($data["email"]);
    //     if (!validate_email($author["email"])) {
    //         $errors["email"] = "Invalid email format.";
    //     }
    // }

    //-------------------------------------------------------------------
    //validate date of birth
    //-------------------------------------------------------------------

    // if (empty($data["dob"])) {
    //     $errors["dob"] = "The date of birth field is requried.";
    // } else {
    //     $author["dob"] = sanitize_input($data["dob"]);
    //     if (!validate_date($author["dob"])) {
    //         $errors["dob"] = "Invalid date of birth.";
    //     }
    // }

    //-------------------------------------------------------------------
    //validate medical centre
    //-------------------------------------------------------------------

    // if (empty($data["centre"])) {
    //     $errors["centre"] = "The medical centre field is requried.";
    // } else {
        // $author["centre"] = sanitize_input($data["centre"]);

    //     //creating array with the valid options to use to validate below
    //     //if submitted option doesn't match array, submit an error
    //     $valid_centres = [
    //         "Talbot St Medical Centre",
    //         "Highfield Alzheimer’s Care Centre",
    //         "Swords Health Centre",
    //         "Greystones Medical Centre",
    //         "Bray Medical Centre",
    //         "Merrion Fertility Clinic"
    //     ];
    //     if (!in_array($author["centre"], $valid_centres)) {
    //         $errors["centre"] = "Invalid medical centre option";
    //     }
    // }    

    //-------------------------------------------------------------------
    //validate  insurance
    //-------------------------------------------------------------------

    // if (empty($data["insurance"])) {
    //     $errors["insurance"] = "The insurance field is requried.";
    // } else {
    //     $author["insurance"] = sanitize_input($data["insurance"]);
    //     $valid_insurance = ["None", "VHI", "Laya", "Irish Life"];
    //     if (!in_array($author["insurance"], $valid_insurance)) {
    //         $errors["insurance"] = "Invalid insurance option";
    //     }
    // }

    return [
        $author,
        $errors
    ];
}
