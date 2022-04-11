const error_message = document.querySelector(".error-message");
const send_url = document.querySelector(".send-url");
const url_name = document.querySelector("input.url-name");
const short_url = document.querySelector("div.short-url");
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
                body: JSON.stringify({ url: url_name.value }),
            })
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                if (data.status !== 200) {
                    short_url.classList.add("hidden");
                    short_url.querySelector("a").textContent = "";
                    short_url.querySelector("a").setAttribute("href", "");
                    error_message.textContent = data.errors.url;
                    error_message.classList.remove("hidden");
                } else if (data.status === 200) {
                    error_message.classList.add("hidden");
                    error_message.textContent = "";
                    short_url.querySelector("a").textContent = data.short_url;
                    short_url
                        .querySelector("a")
                        .setAttribute("href", "http://" + data.short_url);
                    short_url.classList.remove("hidden");
                }
            });
    });
}