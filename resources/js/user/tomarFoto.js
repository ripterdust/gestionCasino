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

const modalFoto = document.querySelector("#tomarFoto");
modalFoto.addEventListener("click", (e) => {
    encenderCamara();
});

const tomarFoto = () => {
    const video = document.querySelector("#camara");
    const canvas = document.querySelector("#canvasFoto");
    const ctx = canvas.getContext("2d");
    ctx.canvas.width = video.videoWidth;
    ctx.canvas.height = video.videoHeight;
    ctx.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
    canvas.toBlob((blob) => {
        const imagen = blob;
        imagen.name = "profile.jpg";
        const input = document.querySelector("#archivoImagen");
        const reader = new FileReader();

        reader.readAsDataURL(imagen);

        reader.onloadend = () => {
            const base64Data = reader.result;
            fetch(`/api/img`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    img: base64Data,
                    id,
                }),
            })
                .then((res) => res.json())
                .catch((err) => console.log(err))
                .then((res) => {
                    const { done } = res;
                    console.log(res);
                    if (done) {
                        const modal = document.querySelector("#fotoModal");
                        modal.classList.add("hidden");
                        return;
                    }

                    alert("Ha ocurrido un error, por favor intenta de nuevo");
                });
        };
    });
};

const btnTomarFoto = document.querySelector("#capturar");
btnTomarFoto.addEventListener("click", () => {
    tomarFoto();
});
console.log(URLGuardar);
