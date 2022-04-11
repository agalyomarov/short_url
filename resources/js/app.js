const error_message = document.querySelector(".error-message");
const send_url = document.querySelector(".send-url");
const url_name = document.querySelector("input.url-name").value;
const csrf_token = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");
if (send_url) {
    send_url.addEventListener("click", (event) => {
        fetch("/", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrf_token,
                },
                body: JSON.stringify({ url: url_name }),
            })
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
            });
    });
}