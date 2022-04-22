// Get input fields

// author
let submitBtn = document.getElementById('submit_btn');
let firstNameInput = document.getElementById('first_name');
let lastNameInput = document.getElementById('last_name');
let linkInput = document.getElementById('link');

// story
let short_headingInput = document.getElementById('short_heading');
let sub_headingInput = document.getElementById('sub_heading');
let summaryInput = document.getElementById('summary');
let main_storyInput = document.getElementById('main_story');
let dateInput = document.getElementById('date');
let timeInput = document.getElementById('time');
let author_idInput = document.getElementById('author_id');
let category_idInput = document.getElementById('category_id');



// Get error divs

// author
let nameError = document.getElementById('name_error');
let firstNameError = document.getElementById('first_name_error');
let lastNameError = document.getElementById('last_name_error');
let linkError = document.getElementById('link_error');

// story
let short_headingError = document.getElementById('short_heading_error');
let sub_headingError = document.getElementById('sub_heading_error');
let summaryError = document.getElementById('summary_error');
let main_storyError = document.getElementById('main_story_error');
let dateError = document.getElementById('date_error');
let timeError = document.getElementById('time_error');
let author_idError = document.getElementById('author_id_error');
let category_idError = document.getElementById('category_id_error');

/**
 * REGEX PATTERNS
 */
 const NAME_REGEX = /^[a-zA-Z-' ]*$/;
 const ADDRESS_REGEX = /^[0-9a-zA-Z-', ]*$/;
 const PHONE_REGEX = /^\(?\s*\d{1,4}\s*\)?\s*[\d\s]{5,10}$/;
 const EMAIL_REGEX = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
 const DATE_REGEX = /^([0-9]{4})-([0-9]{2})-([0-9]{2})$/;
 const URL_REGEX = /^(https?:\/\/)?[0-9a-z]+\.[-_0-9a-z]+\.[0-9a-z]+$/;


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

        
        short_headingError.innerHTML = "";
        sub_headingError.innerHTML = "";
        summaryError.innerHTML = "";
        main_storyError.innerHTML = "";
        dateError.innerHTML = "";
        timeError.innerHTML = "";
        author_idError.innerHTML = "";
        category_idError.innerHTML = "";

}

function onSubmitForm(evt) {

    resetValues();

    //validate first name
    if (firstNameInput.value === "") {
        showError(firstNameError, "JS The name field is required.");
    }
    else if (!regexValid(NAME_REGEX, firstNameInput.value)) {
        showError(firstNameError, "JS Only letters and spaces are allowed.");
    }

    //validate last name
    if (lastNameInput.value === "") {
        showError(lastNameError, "JS The address field is required.");
    }
    else if (!regexValid(NAME_REGEX, lastNameInput.value)) {
        showError(lastNameError, "JS Only letters and spaces are allowed.");
    }

    //validate link
    if (linkInput.value === "") {
        showError(linkError, "JS The link field is required.");
    }
    else if (!regexValid(URL_REGEX, linkInput.value)) {
        showError(linkError, "JS link should be a valid URL.");
    }

    //validate date
    if (dobInput.value === "") {
        showError(dobError, "JS The date field is required.");
    }
    else if (!regexValid(DATE_REGEX, dobInput.value)) {
        showError(dobError, "JS Invalid date format.");
    }

    
    if (short_headingInput.value === "") {
        showError(short_headingError, "JS The date field is required.");
    }
    else if (!regexValid(ADDRESS_REGEX, short_headingInput.value)) {
        showError(short_headingError, "JS Invalid date format.");
    }
    

    // //validate email
    // if (emailInput.value === "") {
    //     showError(emailError, "JS The email field is required.");
    // }
    // else if (!regexValid(EMAIL_REGEX, emailInput.value)) {
    //     showError(emailError, "JS Invalid email format.");
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