const encenderCamara = async () => {
    navigator.mediaDevices
        .getUserMedia({ video: true })
        .then((stream) => {
            const modal = document.querySelector("#fotoModal");
            modal.classList.remove("hidden");
            const video = document.querySelector("#camara");
            video.srcObject = stream;
        })
        .catch((err) => {
            alert("Cámara no accesible al usuario");
        });
};

const btnTomarFoto = document.querySelector("#tomarFoto");
btnTomarFoto.addEventListener("click", (e) => {
    encenderCamara();
});
