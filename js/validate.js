// Get input fields
let submitBtn = document.getElementById('submit_btn');
let firstNameInput = document.getElementById('first_name');
let lastNameInput = document.getElementById('last_name');
let linkInput = document.getElementById('link');



// Get error divs
let nameError = document.getElementById('name_error');
let firstNameError = document.getElementById('first_name_error');
let lastNameError = document.getElementById('last_name_error');
let linkError = document.getElementById('link_error');

/**
 * REGEX PATTERNS
 */
 const NAME_REGEX = /^[a-zA-Z-' ]*$/;
 const ADDRESS_REGEX = /^[0-9a-zA-Z-', ]*$/;
 const PHONE_REGEX = /^\(?\s*\d{1,4}\s*\)?\s*[\d\s]{5,10}$/;
 const EMAIL_REGEX = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
 const DATE_REGEX = /^([0-9]{4})-([0-9]{2})-([0-9]{2})$/;
 const URL_REGEX = /[(http(s)?):\/\/(www\.)?a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/;


submitBtn.addEventListener('click', onSubmitForm);

let errorExists = false;

function showError(errorField, errorMessage) {
    errorExists = true;
    errorField.innerHTML = errorMessage;
}

function regexValid(regex, str) {
    return regex.test(str);
}

function isSelected(inputField) {
    let selected = false;
    for (let i = 0; i != inputField.length; i++) {
        if (inputField[i].checked) {          
            selected = true;
            break;
        }
    }
    return selected;
}

function resetValues() {
        //resets fields to blank
        errorExists = false;
        firstNameError.innerHTML = "";
        lastNameError.innerHTML = "";
        linkError.innerHTML = "";

}

function onSubmitForm(evt) {

    resetValues();

    //validate first name
    if (firstNameInput.value === "") {
        showError(firstNameError, "The name field is required.");
    }
    else if (!regexValid(NAME_REGEX, firstNameInput.value)) {
        showError(firstNameError, "Only letters and spaces are allowed.");
    }

    //validate last name
    if (lastNameInput.value === "") {
        showError(lastNameError, "The address field is required.");
    }
    else if (!regexValid(NAME_REGEX, lastNameInput.value)) {
        showError(lastNameError, "Only letters and spaces are allowed.");
    }

    //validate link
    if (linkInput.value === "") {
        showError(linkError, "The link field is required.");
    }
    else if (!regexValid(URL_REGEX, linkInput.value)) {
        showError(linkError, "link should be a valid URL.");
    }


    // //validate email
    // if (emailInput.value === "") {
    //     showError(emailError, "JS The email field is required.");
    // }
    // else if (!regexValid(EMAIL_REGEX, emailInput.value)) {
    //     showError(emailError, "JS Invalid email format.");
    // }


    // //validate dob
    // if (dobInput.value === "") {
    //     showError(dobError, "JS The date of birth field is required.");
    // }
    // else if (!regexValid(DATE_REGEX, dobInput.value)) {
    //     showError(dobError, "JS Invalid date of birth format.");
    // }
    

    // //validate centre
    // if (centreInput.value === "") {
    //     showError(centreError, "JS The centre field is required.");
    // }

    // //validate insurance
    // if (!isSelected(insuranceInput)) {
    //     showError(insuranceError, "JS The insurance field is required.");
    // }

    // //validate preference
    // if (!isSelected(preferenceInput)) {
    //     showError(preferenceError, "JS The preference field is required.");
    // }

    // prevents going to create script if errors exist
    if (errorExists) {
        evt.preventDefault();
    }
}