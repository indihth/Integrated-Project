// Get input fields
let submitBtn = document.getElementById('submit_btn');

let headlineInput = document.getElementById('headline');
let short_headlineInput = document.getElementById('short_headline');
let sub_headingInput = document.getElementById('sub_heading');
let summaryInput = document.getElementById('summary');
let main_storyInput = document.getElementById('main_story');
let dateInput = document.getElementById('date');
let timeInput = document.getElementById('time');
let author_idInput = document.getElementById('author_id');
let category_idInput = document.getElementById('category_id');



// Get error divs

let headlineError = document.getElementById('headline_error');
let short_headlineError = document.getElementById('short_headline_error');
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


        headlineError.innerHTML = "";
        short_headlineError.innerHTML = "";
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
    if (headlineInput.value === "") {
        showError(headlineError, "JS The headline field is required.");
    }
    else if (!regexValid(NAME_REGEX, headlineInput.value)) {
        showError(headlineError, "JS Only letters and spaces are allowed.");
    }

    // //validate date
    // if (dobInput.value === "") {
    //     showError(dobError, "JS The date field is required.");
    // }
    // else if (!regexValid(DATE_REGEX, dobInput.value)) {
    //     showError(dobError, "JS Invalid date format.");
    // }

    
    if (short_headlineInput.value === "") {
        showError(short_headlineError, "JS The short-heading field is required.");
    }
    else if (!regexValid(ADDRESS_REGEX, short_headlineInput.value)) {
        showError(short_headlineError, "JS Only letters and spaces are allowed");
    }

    if (sub_headingInput.value === "") {
        showError(sub_headingError, "JS The sub-heading field is required.");
    }
    else if (!regexValid(NAME_REGEX, sub_headingInput.value)) {
        showError(sub_headingError, "JS Only letters and spaces are allowed.");
    }
    
    if (summaryInput.value === "") {
        showError(summaryError, "JS The summary field is required.");
    }
    else if (!regexValid(NAME_REGEX, summaryInput.value)) {
        showError(summaryError, "JS Only letters and spaces are allowed.");
    }

    if (main_storyInput.value === "") {
        showError(main_storyError, "JS The main-story field is required.");
    }
    else if (!regexValid(NAME_REGEX, main_storyInput.value)) {
        showError(main_storyError, "JS Only letters and spaces are allowed.");
    }

    if (dateInput.value === "") {
        showError(dateError, "JS The date field is required.");
    }
    // else if (!regexValid(DATE_REGEX, dateInput.value)) {
    //     showError(dateError, "JS Only letters and spaces are allowed.");
    // }

    if (timeInput.value === "") {
        showError(timeError, "JS The time field is required.");
    }
    // else if (!regexValid(DATE_REGEX, timeInput.value)) {
    //     showError(timeError, "JS Only letters and spaces are allowed.");
    // }

    if (author_idInput.value === "") {
        showError(author_idError, "JS The main-story field is required.");
    }
    // else if (!regexValid(PHONE_REGEX, author_idInput.value)) {
    //     showError(author_idError, "JS Only letters and spaces are allowed.");
    // }

    if (category_idInput.value === "") {
        showError(category_idError, "JS The main-story field is required.");
    }
    // else if (!regexValid(PHONE_REGEX, category_idInput.value)) {
    //     showError(category_idError, "JS Only letters and spaces are allowed.");
    // }

    // //validate email
    // if (emailInput.value === "") {
    //     showError(emailError, "JS The email field is required.");
    // }
    // else if (!regexValid(EMAIL_REGEX, emailInput.value)) {
    //     showError(emailError, "JS Invalid email format.");
    // }

    // prevents going to create script if errors exist
    if (errorExists) {
        evt.preventDefault();
    }
}