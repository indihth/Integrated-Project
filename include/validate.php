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

function validate_phone($phone) {
    $pattern = "/^\(?\s*\d{1,4}\s*\)?\s*[\d\s]{5,10}$/";
    return preg_match($pattern, $phone) === 1;
}

function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
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


function patient_validate($data) {

    $errors = [];           //to hold errors, initialise empty
    $patient = [];          //to hold validated patient data

    //-------------------------------------------------------------------
    //validate name
    //-------------------------------------------------------------------

    //CTRL + D to select next instance of highlighted word

    //checking if the name field is empty
    if (empty($data["name"])) {
        //use same name for error as the field being validated
        $errors["name"] = "The name field is requried.";
    } else {
        //to store value, good to match array names from above
        $patient["name"] = sanitize_input($data["name"]);
        if (!validate_name($patient["name"])) {
            $errors["name"] = "Only letters and spaces are allowed.";
        }
    }

    
    //-------------------------------------------------------------------
    //validate address
    //-------------------------------------------------------------------

    if (empty($data["address"])) {
        $errors["address"] = "The address field is requried.";
    } else {
        $patient["address"] = sanitize_input($data["address"]);
        if (!validate_address($patient["address"])) {
            $errors["address"] = "Only letters, numbers and spaces are allowed.";
        }
    }


    //-------------------------------------------------------------------
    //validate phone
    //-------------------------------------------------------------------

    if (empty($data["phone"])) {
        $errors["phone"] = "The phone field is requried.";
    } else {
        $patient["phone"] = sanitize_input($data["phone"]);
        if (!validate_phone($patient["phone"])) {
            $errors["phone"] = "Phone number should be (##) ####### format.";
        }
    }

    //-------------------------------------------------------------------
    //validate email
    //-------------------------------------------------------------------

    if (empty($data["email"])) {
        $errors["email"] = "The email field is requried.";
    } else {
        $patient["email"] = sanitize_input($data["email"]);
        if (!validate_email($patient["email"])) {
            $errors["email"] = "Invalid email format.";
        }
    }

    //-------------------------------------------------------------------
    //validate date of birth
    //-------------------------------------------------------------------

    if (empty($data["dob"])) {
        $errors["dob"] = "The date of birth field is requried.";
    } else {
        $patient["dob"] = sanitize_input($data["dob"]);
        if (!validate_date($patient["dob"])) {
            $errors["dob"] = "Invalid date of birth.";
        }
    }

    //-------------------------------------------------------------------
    //validate medical centre
    //-------------------------------------------------------------------

    // if (empty($data["centre"])) {
    //     $errors["centre"] = "The medical centre field is requried.";
    // } else {
        $patient["centre"] = sanitize_input($data["centre"]);

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
    //     if (!in_array($patient["centre"], $valid_centres)) {
    //         $errors["centre"] = "Invalid medical centre option";
    //     }
    // }    

    //-------------------------------------------------------------------
    //validate  insurance
    //-------------------------------------------------------------------

    if (empty($data["insurance"])) {
        $errors["insurance"] = "The insurance field is requried.";
    } else {
        $patient["insurance"] = sanitize_input($data["insurance"]);
        $valid_insurance = ["None", "VHI", "Laya", "Irish Life"];
        if (!in_array($patient["insurance"], $valid_insurance)) {
            $errors["insurance"] = "Invalid insurance option";
        }
    }

    //-------------------------------------------------------------------
    //validate preferences
    //-------------------------------------------------------------------

    if (empty($data["preferences"])) {
        $errors["preferences"] = "The preferences field is requried.";
    } else {
        $patient["preferences"] = [];

        //go through each array item in preferences and sanatize
        //otherwise error from trim function
        foreach ($data["preferences"] as $preference) {            //reference vid 4, 3:47
            $patient["preferences"][] = sanitize_input($preference);        
        }
        
        //more complicated because it needs to validate values within an array

        $valid_preferences = ["Email", "Phone", "Post"];
        //need to loop through all value of array to check
        foreach ($patient["preferences"] as $preference) {
            //if a value from $preference is NOT in $valid_preferences
            if (!in_array($preference, $valid_preferences)) {
                $errors["preferences"] = "Invalid perference option";
                break;      //stops loop from running
            }
        }
    }

    return [
        $patient,
        $errors
    ];
}
?>