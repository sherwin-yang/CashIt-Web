const openModalButtons = document.querySelectorAll("[data-modal-target]");
const closeModalButtons = document.querySelectorAll("[close-button]");
const overlay = document.getElementById("overlay");

openModalButtons.forEach((button) => {
    button.addEventListener("click", () => {
        const modal = document.querySelector(button.dataset.modalTarget);
        openModal(modal);
    });
});

overlay.addEventListener("click", () => {
    const modals = document.querySelectorAll(".myModal.active");
    modals.forEach((modal) => {
        closeModal(modal);
    });
});

closeModalButtons.forEach((button) => {
    button.addEventListener("click", () => {
        const modal = button.closest(".myModal");
        closeModal(modal);
    });
});

function openModal(modal) {
    if (modal == null) return;
    modal.classList.add("active");
    overlay.classList.add("active");
}

function closeModal(modal) {
    if (modal == null) return;
    modal.classList.remove("active");
    overlay.classList.remove("active");
}

function updateCurrency(currencyName, sellPrice, buyPrice, currencyId) {
    document.getElementById("name").value = currencyName;
    document.getElementById("sellPrice").value = sellPrice;
    document.getElementById("buyPrice").value = buyPrice;
    document.getElementById("currencyId").value = currencyId;
}

function finishTransaction(appointmentId) {
    document.getElementById("appointmentId").value = appointmentId;
}
