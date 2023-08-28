const formulario = document.getElementById('formulario');
const respuesta = document.getElementById('resultado');
formulario.addEventListener("submit", function (e) {
    e.preventDefault();
    var datos = new FormData(formulario);

    fetch("generaPassword.php", {
        method: "POST",
        body: datos
    })
        .then(res => res.json())
        .then(data => {
            respuesta.innerHTML = `<div class="col s10" id="copiar">${data.message}</div><a class="btn-floating pulse" onclick="myFunction()"><i class="material-icons">content_copy</i></a>`;
        })
});

function myFunction() {
    str = document.getElementById('copiar').innerHTML;
    const el = document.createElement('textarea');
    el.value = str;
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
    // alert('Copied the text:' + el.value);
    M.toast({html: 'Se ha copiado al portapapeles!'})
}