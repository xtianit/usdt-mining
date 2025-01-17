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

$("#login-form").validate({
    rules: {
        username: {
            required: true,
        },
        password: {
            required: true,
        },
        message: {
            password: "Please enter password",
        },
    },

    submitHandler: function (form) {
        // Disable the submit button to prevent multiple clicks
        $(form).find('input[type="submit"]').prop("disabled", true);

        var username = document.getElementById("username").value;
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
                    alert(response.message);
                    sessionStorage.setItem("username", username);
                    $("#cover-spin").hide(0);
                    window.location.href = "./dashboard.php";
                } else {
                    alert(response.message);
                    $("#cover-spin").hide(0);
                }
            },
        });
    },
});

$("#add-expert-trader").validate({
    rules: {
        lastname: {
            required: true,
        },
        firstname: {
            required: true,
        },
        symbol: {
            required: true,
        },
        wp: {
            required: true,
        },
        file: {
            required: true,
        },
    },

    submitHandler: function (form) {
        $("#add-expert-trader").on("submit", function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "./controllers/trade/add-expert-trader.php",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $("#cover-spin").show(0);
                },
                success: function (response) {
                    alert(response.message);
                    window.location.href = "?add-trader";
                },
                complete: function () {
                    $("#cover-spin").hide(0);
                },
            });
        });
    },
});

// Attach event listener to the parent element of the table

$(document).on("click", "button.processButton", function () {
    var id = $(this).data("id");
    var amount = $(this).closest("tr").find("td:nth-child(2)>div").text(); // Get the value from the third column (Reference)
    var reference = $(this).closest("tr").find("td:nth-child(4)").text(); // Get the value from the third column (Reference)

    // Perform AJAX operation
    $.ajax({
        url: "./controllers/withdrawals/approve-withdraw.php",
        method: "POST",
        dataType: "json",
        data: { id: id, amount: amount, reference: reference },
        beforeSend: function () {
            $("#cover-spin").show(0);
        },
        success: function (response) {
            // Handle the AJAX response here
            alert(response.message);
            //window.location.href = "?withdrawal-requests";
        },
        error: function (xhr, status, error) {
            // Handle AJAX error here
            console.error(xhr, status, error);
        },
        complete: function () {
            $("#cover-spin").hide(0);
        },
    });
});
$(document).on("click", "button.declineWithdrawal", function () {
    var id = $(this).data("id");
    var amount = $(this).closest("tr").find("td:nth-child(2)").text(); // Get the value from the third column (Reference)
    var reference = $(this).closest("tr").find("td:nth-child(3)").text(); // Get the value from the third column (Reference)

    // Perform AJAX operation
    $.ajax({
        url: "./controllers/withdrawals/decline-withdraw.php",
        method: "POST",
        data: { id: id, amount: amount, reference: reference },
        success: function (response) {
            // Handle the AJAX response here
            alert("Withdrawal deckined!");
            window.location.href = "?withdrawal-requests";
        },
        error: function (xhr, status, error) {
            // Handle AJAX error here
            console.error(xhr, status, error);
        },
    });
});
