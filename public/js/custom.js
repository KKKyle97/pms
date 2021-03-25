let patientFormValidation = [
    false,
    false,
    false,
    false,
    false,
    false,
    false,
    false,
    false,
    false,
    false,
    false,
    false,
    false,
];

let updateFormValidation = [
    true,
    true,
    true,
    true,
    true,
    true,
    true,
    true,
    true,
    true,
    true,
];

let registrationFormValidation = [
    false,
    false,
    false,
    false,
    false,
    false,
    false,
    false,
    false,
];

let profileFormValidation = [true, true, true, true];

let chgPasswordValidation = [false, false, false];

let validationArray = [
    patientFormValidation,
    updateFormValidation,
    registrationFormValidation,
    profileFormValidation,
    chgPasswordValidation,
];

function isNumberKey(evt) {
    var charCode = evt.which ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
    return true;
}

function moveToNextForm(val) {
    if (val == 1) {
        document.getElementById("guardian-profile-form").style.display =
            "block";
        document.getElementById("patient-profile-form").style.display = "none";
    } else if (val == 2) {
        document.getElementById("patient-acc-form").style.display = "block";
        document.getElementById("guardian-profile-form").style.display = "none";
    }
}

function moveToPreviousForm(val) {
    if (val == 1) {
        document.getElementById("guardian-profile-form").style.display = "none";
        document.getElementById("patient-profile-form").style.display = "block";
    } else if (val == 2) {
        document.getElementById("patient-acc-form").style.display = "none";
        document.getElementById("guardian-profile-form").style.display =
            "block";
    }
}

function validateRequiredField(errorId, inputId, formType, index) {
    var input = document.getElementById(inputId).value;
    if (input == "") {
        document.getElementById(errorId).style.display = "block";
        validationArray[formType][index] = false;
    } else {
        document.getElementById(errorId).style.display = "none";
        validationArray[formType][index] = true;
    }
}

function validateEmail() {
    var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if (document.getElementById("email").value.match(mailformat)) {
        document.getElementById("e1").style.display = "none";
        validationArray[2][0] = true;
    } else {
        if (document.getElementById("email").value.length == 0) {
            document.getElementById("e1").style.display = "none";
        } else {
            document.getElementById("e1").style.display = "block";
        }

        validationArray[2][0] = false;
    }
}

function validateDigitNum(errorId, inputId, type, formType, index) {
    var input = document.getElementById(inputId).value;
    if (type == "contact") {
        if (input.length < 10 && input.length > 0) {
            document.getElementById(errorId).style.display = "block";
            validationArray[formType][index] = false;
        } else {
            document.getElementById(errorId).style.display = "none";
            if (input.length != 0) {
                validationArray[formType][index] = true;
            }
        }
    } else if (type == "ic") {
        if (input.length < 12 && input.length > 0) {
            document.getElementById(errorId).style.display = "block";
            validationArray[formType][index] = false;
        } else {
            document.getElementById(errorId).style.display = "none";
            if (input.length != 0) {
                validationArray[formType][index] = true;
            }
        }
    } else if (type == "password") {
        if (input.length < 8 && input.length > 0) {
            document.getElementById(errorId).style.display = "block";
            validationArray[formType][index] = false;
        } else {
            document.getElementById(errorId).style.display = "none";
            if (input.length != 0) {
                validationArray[formType][index] = true;
            }
        }
    } else {
        if (input.length < 5 && input.length > 0) {
            document.getElementById(errorId).style.display = "block";
            validationArray[formType][index] = false;
        } else {
            document.getElementById(errorId).style.display = "none";
            if (input.length != 0) {
                validationArray[formType][index] = true;
            }
        }
    }
}

function validateMatchingPassword(formType, index) {
    var pass = document.getElementById("password").value;
    console.log(pass);
    if (
        document.getElementById("password").value !=
        document.getElementById("password-confirm").value
    ) {
        document.getElementById("a3").style.display = "block";
        validationArray[formType][index] = false;
    } else {
        document.getElementById("a3").style.display = "none";
        validationArray[formType][index] = true;
    }
}

function validateBeforeSubmit(formType) {
    let checker = (arr) => arr.every((v) => v === true);

    console.log(checker(validationArray[formType]));

    if (checker(validationArray[formType])) {
        if (formType == 0) {
            Swal.fire({
                title: "Confirmation",
                text: "Confirm Adding This Patient?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Confirm",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("create-patient-form").submit();
                }
            });
        } else if (formType == 1) {
            Swal.fire({
                title: "Confirmation",
                text: "Confirm Update Details?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Confirm",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("update-patient-form").submit();
                }
            });
        } else if (formType == 2) {
            Swal.fire({
                title: "Confirmation",
                text: "Confirm Registration?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Confirm",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("create-account-form").submit();
                }
            });
        } else if (formType == 3) {
            Swal.fire({
                icon: "warning",
                title: "Confirmation",
                text: "Confirm Update Details?",
                showCancelButton: true,
                confirmButtonText: `Save`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    document
                        .getElementById("update-user-profile-form")
                        .submit();
                }
            });
        } else {
            Swal.fire({
                icon: "warning",
                title: "Confirmation",
                text: "Confirm Update Password?",
                showCancelButton: true,
                confirmButtonText: `Save`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    document.getElementById("update-password-form").submit();
                }
            });
        }
    }
}
