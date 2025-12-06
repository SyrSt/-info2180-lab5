window.onload = function () {
    const lookupCountry = document.querySelector("#lookup");
    const lookupCities = document.querySelector("#lookup-cities");
    const result = document.querySelector("#result");
    const input = document.querySelector("#country");

    // Lookup Countries
    lookupCountry.addEventListener("click", function () {
        let country = input.value.trim();

        fetch(`world.php?country=${encodeURIComponent(country)}`)
            .then(response => response.text())
            .then(data => result.innerHTML = data)
            .catch(error => console.error(error));
    });

    // Lookup Cities
    lookupCities.addEventListener("click", function () {
        let country = input.value.trim();

        fetch(`world.php?country=${encodeURIComponent(country)}&lookup=cities`)
            .then(response => response.text())
            .then(data => result.innerHTML = data)
            .catch(error => console.error(error));
    });
};
