$(document).ready(function () {
    function updateEmail() {
        var email = $("#getEmail").text();
        $.ajax({
            url: "../controllers/investment/generate-profit.php",
            method: "POST",
            data: {
                email: email,
            },
        });
        // Set a flag in local storage to indicate that the update has been performed
        localStorage.setItem("emailUpdatePerformed", "true");
    }

    // Check if the update has already been performed
    var emailUpdatePerformed = localStorage.getItem("emailUpdatePerformed");
    if (!emailUpdatePerformed) {
        // Perform the initial update
        updateEmail();
    }

    // Schedule the automatic update every 1 minute
    setInterval(updateEmail, 10000); // 60000 milliseconds = 1 minute
});
