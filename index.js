// Contact Form in PHP
const form = document.querySelector("form"),
statusTxt = form.querySelector(".button-area span");

// On form submission event
form.onsubmit = (e) => {
    e.preventDefault();
    statusTxt.style.color = "#0D6EFD";
    statusTxt.style.display = "block";
    statusTxt.innerText = "Sending your message...";
    form.classList.add("disabled");

    // Create XMLHttpRequest object
    let xhr = new XMLHttpRequest();

    // Configure the request
    xhr.open("POST", "message.php", true);

    // Onload event
    xhr.onload = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
        let response = xhr.response;

        // Check for error messages in response
        if (
            response.indexOf("required") != -1 ||
            response.indexOf("valid") != -1 ||
            response.indexOf("failed") != -1
        ) {
            statusTxt.style.color = "red";
        } else {
            // Reset the form and hide status message after 3 seconds
            form.reset();
            setTimeout(() => {
                statusTxt.style.display = "none";
            }, 3000);
        }
        statusTxt.innerText = response;
        form.classList.remove("disabled");
        }
    };

    // Create FormData object and send the request
    let formData = new FormData(form);
    xhr.send(formData);
};
