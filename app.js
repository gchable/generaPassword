var formulario = document.querySelector('#formulario');
var respuesta = document.querySelector('#resultado');

formulario.addEventListener("submit", function (e) {
    e.preventDefault();
    var datos = new FormData(formulario);

    fetch("generaPassword.php", {
        method: "POST",
        body: datos
    })
        .then(res => res.json())
        .then(data => {
            if (data === "error") {
                respuesta.innerHTML = `
                    <div class="col s12 m6 section" id="valorResultado">
                        Error...
                    </div>
                `;
            } else {
                respuesta.innerHTML = `${data}`;
            }
        })
});