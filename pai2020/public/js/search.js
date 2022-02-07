const search = document.querySelector('input[placeholder="Rejon lub nazwa stoku"]');
const slopeContainer = document.querySelector(".slopes");

search.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();

        const data = {search: this.value};

        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (slopes) {
            slopeContainer.innerHTML = "";
            loadSlopes(slopes)
        });
    }
});

function loadSlopes(slopes) {
    slopes.forEach(slope => {
        console.log(slope);
        createSlope(slope);
    });
}

function createSlope(slope) {
    const template = document.querySelector("#slope-template");

    const clone = template.content.cloneNode(true);
    /*
    const div = clone.querySelector("div");
    div.id = slope.id;
    (ja w html nie mam id do div gdzie jest ten slope)
     */
    const image = clone.querySelector("img");
    image.src = `/public/uploads/${slope.image}`;
    const title = clone.querySelector("h2");
    title.innerHTML = slope.title;
    const description = clone.querySelector("p");
    description.innerHTML = slope.description;

    slopeContainer.appendChild(clone);
}
