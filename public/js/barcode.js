const changePage = (value) => {
    window.location.pathname = `cliente/${value}`;
};

const barcodeInput = document.querySelector("#inputBarcode");

barcodeInput.addEventListener("keyup", (e) => {
    if (e.key === "Enter" || e.keyCode === 13) changePage(e.target.value);
});
