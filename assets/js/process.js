/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////\\
// Function to update the amount
$.validator.addMethod(
    "lettersonly",
    function (value, element) {
        return this.optional(element) || /^[a-z\s-a-záéíóúý]+$/i.test(value);
    },
    "Letter only"
);
$.validator.addMethod("pwcheck", function (value) {
    return (
        /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) && // consists of only these
        /[a-z]/.test(value) && // has a lowercase letter
        /\d/.test(value)
    ); // has a digit
});
$.validator.addMethod(
    "greaterThan",
    function (value, element, params) {
        var target = $(params).val();
        var isValueNumeric = !isNaN(parseFloat(value)) && isFinite(value);
        var isTargetNumeric = !isNaN(parseFloat(target)) && isFinite(target);
        if (isValueNumeric && isTargetNumeric) {
            return Number(value) > Number(target);
        }
        return false;
    },
    "Must be greater than {0}."
);
///////////////////////////////////Add new books function//////////////////////////////////////////
$("#create-account").validate({
    rules: {
        email: {
            email: true,
            required: true,
        },
        password: {
            minlength: 5,
            required: true,
        },
        cpassword: {
            minlength: 5,
            required: true,
            equalTo: "#password",
        },
        firstName: {
            required: true,
            lettersonly: true,
        },
        lastName: {
            required: true,
            lettersonly: true,
        },
        country: {
            required: true,
        },
        state: {
            required: true,
        },
        gender: {
            required: true,
        },
        phone: {
            required: true,
        },
        accept: {
            required: true,
        },
        massage: {
            required: "Missing password",
        },
    },
    submitHandler: function (form) {
        // Disable the submit button to prevent multiple clicks
        $(form).find('input[type="submit"]').prop("disabled", true);

        let email = document.getElementById("email").value;

        // Store session data in sessionStorage
        $.ajax({
            type: "POST",
            url: "./controllers/account/create-account.php",
            data: new FormData(form),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#cover-spin").show(0);
            },
            success: function (response) {
                $(".statusMsg").html("");
                if (response.status == 1) {
                    localStorage.setItem("email", email);
                    alert(response.message);
                    $("#cover-spin").hide(0);
                    window.location.href =
                        "./verify-email.php?current=" + email;
                } else {
                    alert(response.message);
                    $("#cover-spin").hide(0);
                }
            },
        });
    },
});

$("#verify-email").validate({
    rules: {
        vcode: {
            required: true,
            digits: true,
        },

        massage: {
            required: "Enter verification code!",
            digits: "Invalid verification code",
        },
    },
    submitHandler: function (form) {
        $("#verify-email").on("submit", function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "./controllers/account/verify-account.php",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $("#cover-spin").show(0);
                },
                success: function (response) {
                    $(".statusMsg").html("");
                    if (response.status == 1) {
                        alert(response.message);
                        $("#cover-spin").hide(0);
                        window.location.href = "./user";
                    } else {
                        alert(response.message);
                        $("#cover-spin").hide(0);
                    }
                },
            });
        });
    },
});
$("#login-form").validate({
    rules: {
        email: {
            required: true,
            email: true,
        },
        password: {
            required: true,
        },
    },

    submitHandler: function (form) {
        // Disable the submit button to prevent multiple clicks
        $(form).find('input[type="submit"]').prop("disabled", true);

        var email = document.getElementById("email").value;
        $.ajax({
            type: "POST",
            url: "./controllers/account/process-login.php",
            data: new FormData(form),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#cover-spin").show(0);
            },
            success: function (response) {
                $(".statusMsg").html("");
                if (response.status == 1) {
                    sessionStorage.setItem("email-login", email);
                    $("#cover-spin").hide(0);
                    window.location.href =
                        "./verify-login.php?current=" + email;
                } else {
                    alert(response.message);
                    $("#cover-spin").hide(0);
                }
            },
        });
    },
});

$("#verify-login").validate({
    rules: {
        vcode: {
            required: true,
            digits: true,
        },

        massage: {
            required: "Enter verification code!",
            digits: "Invalid verification code",
        },
    },
    submitHandler: function (form) {
        $("#verify-login").on("submit", function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "./controllers/account/verify-login.php",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $("#cover-spin").show(0);
                },
                success: function (response) {
                    $(".statusMsg").html("");
                    if (response.status == 1) {
                        alert(response.message);
                        $("#cover-spin").hide(0);
                        window.location.href = "./users";
                    } else {
                        alert(response.message);
                        $("#cover-spin").hide(0);
                    }
                },
            });
        });
    },
});

$("#deposit-form").validate({
    rules: {
        amount: {
            required: true,
            digits: true,
        },
        reference: {
            required: true,
        },
        crypto: {
            required: true,
        },
    },

    submitHandler: function (form) {
        $("#deposit-form").on("submit", function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "../controllers/account/deposit.php",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $("#cover-spin").show(0);
                },
                success: function (response) {
                    $(".statusMsg").html("");
                    if (response.status == 1) {
                        alert(response.message);
                        $("#cover-spin").hide(0);
                        window.location.href = ".";
                    } else {
                        alert(response.message);
                        $("#cover-spin").hide(0);
                    }
                },
            });
        });
    },
});

$("#change-password").validate({
    rules: {
        oldPass: {
            required: true,
        },
        newPass: {
            required: true,
        },
        confirmNewPass: {
            required: true,
            equalTo: "#newPass",
        },
    },

    submitHandler: function (form) {
        $("#change-password").on("submit", function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "../controllers/account/update-password.php",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $("#cover-spin").show(0);
                },
                success: function (response) {
                    if (response.status == 1) {
                        alert(response.message);
                        window.location.href = "../logout.php";
                    } else {
                        alert(response.message);
                        $("#cover-spin").hide(0);
                    }
                },
            });
        });
    },
});
$("#check-pin").validate({
    rules: {
        pin: {
            required: true,
            digits: true,
        },
    },

    submitHandler: function (form) {
        // Disable the submit button to prevent multiple clicks
        $(form).find('input[type="submit"]').prop("disabled", true);

        $.ajax({
            type: "POST",
            url: "../controllers/account/pin-check.php",
            data: new FormData(form),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#cover-spin").show(0);
            },
            success: function (response) {
                if (response.status == 1) {
                    alert(response.message);
                    window.location.href = "?create-amount";
                } else {
                    alert(response.message);
                    $("#cover-spin").hide(0);
                }
            },
        });
    },
});

$("#create-amount").validate({
    rules: {
        amount: {
            required: true,
            digits: true,
        },
        walletAddress: true,
        cryptoName: true,
    },

    submitHandler: function (form) {
        // Disable the submit button to prevent multiple clicks
        $(form).find('input[type="submit"]').prop("disabled", true);

        $.ajax({
            type: "POST",
            url: "../controllers/account/complete-withdrawal.php",
            data: new FormData(form),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#cover-spin").show(0);
            },
            success: function (response) {
                if (response.status == 1) {
                    alert(response.message);
                    window.location.href = ".";
                } else {
                    alert(response.message);
                    $("#cover-spin").hide(0);
                }
            },
        });
    },
});

$("#password-reset").validate({
    rules: {
        email: {
            required: true,
            email: true,
        },
    },

    submitHandler: function (form) {
        $("#password-reset").on("submit", function (e) {
            e.preventDefault();
            let email = document.getElementById("email").value;
            $.ajax({
                type: "POST",
                url: "./controllers/account/reset-password.php",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $("#cover-spin").show(0);
                },
                success: function (response) {
                    if (response.status == 1) {
                        alert(response.message);
                        window.location.href =
                            "./reset-code-verification.php?current=" + email;
                    } else {
                        alert(response.message);
                        $("#cover-spin").hide(0);
                    }
                },
            });
        });
    },
});

$("#complete-password-reset").validate({
    rules: {
        password: {
            required: true,
        },
        confirmPassword: {
            required: true,
            equalTo: "#password",
        },
    },

    submitHandler: function (form) {
        $("#complete-password-reset").on("submit", function (e) {
            e.preventDefault();
            let email = $("#email").val();
            $.ajax({
                type: "POST",
                url: "./controllers/account/complete-password-reset.php",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $("#cover-spin").show(0);
                },
                success: function (response) {
                    if (response.status == 1) {
                        alert(response.message);
                        window.location.href = "./signin.php";
                    } else {
                        alert(response.message);
                        $("#cover-spin").hide(0);
                    }
                },
            });
        });
    },
});

function process_payment(data_id) {
    $(data_id).validate({
        rules: {
            amount: {
                required: true,
                digits: true,
                greaterThan: "#package",
            },
            reference: {
                required: true,
            },
        },

        submitHandler: function (form) {
            // Disable the submit button to prevent multiple clicks
            $(form).find('input[type="submit"]').prop("disabled", true);

            $.ajax({
                type: "POST",
                url: "../controllers/account/process-payment.php",
                data: new FormData(form),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $("#cover-spin").show(0);
                },
                success: function (response) {
                    if (response.status == 1) {
                        alert(response.message);
                        window.location.href = "./market.php";
                    } else {
                        alert(response.message);
                        $("#cover-spin").hide(0);
                    }
                },
            });
        },
    });
}

//These are data sent for processing the various packages
process_payment("#pl_20_rrusdt_01");
process_payment("#pl_50_rrusdt_02");
process_payment("#pl_100_rrusdt_03");
process_payment("#pl_300_rrusdt_04");
process_payment("#pl_500_rrusdt_05");
process_payment("#pl_1000_rrusdt_06");
process_payment("#pl_3000_rrusdt_07");
process_payment("#pl_5000_rrusdt_08");
process_payment("#pl_10000_rrusdt_09");
process_payment("#pl_30000_rrusdt_10");

//Update amount every 24 hours

$(document).ready(function () {
    $("#uploadPhoto").submit(function (event) {
        event.preventDefault(); // Prevent default form submission

        // Create FormData object to store form data
        var formData = new FormData(this);

        // Perform Ajax request
        $.ajax({
            type: "POST",
            url: "../controllers/account/upload-passport.php", // Replace with the PHP file handling the upload
            data: formData,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#uploadButton").text("Please waid....");
            },
            success: function (response) {
                alert(response.message);
                window.location.href = "./profile";
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Handle any errors
                console.error("Upload error:", textStatus, errorThrown);
                alert(response.message);
            },
            complete: function () {
                $("#uploadButton").text("Upload file");
            },
        });
    });
});
