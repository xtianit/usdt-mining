/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////\\
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
        city: {
            required: true,
        },
        zipcode: {
            required: true,
        },
        currency: {
            required: true,
        },
        accountType: {
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
        $("#create-account").on("submit", function (e) {
            e.preventDefault();
            let email = document.getElementById("email").value;

            // Store session data in sessionStorage
            $.ajax({
                type: "POST",
                url: "./controllers/account/create-account.php",
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
        $("#login-form").on("submit", function (e) {
            var email = document.getElementById("email").value;
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "./controllers/account/process-login.php",
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
                        sessionStorage.setItem("email", email);
                        $("#cover-spin").hide(0);
                        window.location.href = "./user/verify-login.php";
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
                        $("#cover-spin").hide(0);
                        window.location.href = ".";
                    } else {
                        alert(response.message);
                        $("#cover-spin").hide(0);
                    }
                },
                error: function () {
                    $("#cover-spin").hide(0);
                    window.location.href = "./deposit";
                },
            });
        });
    },
});
