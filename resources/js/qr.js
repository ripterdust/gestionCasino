const escaneado = (res) => {
    const { usuario, id } = JSON.parse(window.atob(res));
    const url = URLQR.replace("__usuario", usuario).replace("__id", id);
    location.href = url;
};

const error = (error) => {
    if (error.includes("No MultiFormat Readers")) return;
};

const escaner = new Html5QrcodeScanner("reader", {
    fps: 10,
    qrbox: 250,
});

escaner.render(escaneado, error);
