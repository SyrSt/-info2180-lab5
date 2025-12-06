window.onload = function () {
    const button = document.querySelector("#lookup");
    const result = document.querySelector("#result");
    const countryInput = document.querySelector("#country");

    button.addEventListener("click", function () {
        const country = countryInput.value.trim();

        fetch("world.php?country=" + encodeURIComponent(country))
            .then(response => response.text())
            .then(data => {
                result.innerHTML = data;
            })
            .catch(error => {
                result.innerHTML = "Error fetching data.";
                console.error(error);
            });
    });
};
