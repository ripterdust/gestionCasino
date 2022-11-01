const changePage = (value) => {
    window.location.pathname = `cliente/${value}`;
};

const barcodeInput = document.querySelector("#inputBarcode");

barcodeInput.addEventListener("keyup", (e) => {
    if (e.key === "Enter" || e.keyCode === 13) changePage(e.target.value);
});

const detectBarcode = (data) => {
    changePage(data.codeResult.code);
};
Quagga.init(
    {
        inputStream: {
            name: "Live",
            type: "LiveStream",
            target: document.querySelector("#reader"), // Or '#yourElement' (optional)
        },
        decoder: {
            readers: ["code_128_reader", "upc_reader", "upc_e_reader"],
        },
    },
    (err) => {
        if (err) {
            return console.log(err);
        }

        Quagga.start();
        Quagga.onDetected(detectBarcode);
    },
    Quagga.onDetected(detectBarcode)
);
