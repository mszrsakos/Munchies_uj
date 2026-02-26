// Elek hivatkozása
const imageInput = document.getElementById("imageInput");
const uploadContent = document.getElementById("uploadContent");
const uploadArea = document.getElementById("uploadArea");

// Kattintásra file picker megnyitása
uploadContent.addEventListener("click", () => {
    imageInput.click();
});

// Drag & drop események
uploadArea.addEventListener("dragover", e => e.preventDefault());
uploadArea.addEventListener("drop", e => {
    e.preventDefault();
    const file = e.dataTransfer.files[0];
    if (file) handleImage(file);
});

// Hagyományos file input
imageInput.addEventListener("change", function() {
    const file = this.files[0];
    if (file) handleImage(file);
});

// Kép kezelése
function handleImage(file) {
    const reader = new FileReader();

    reader.onload = function(e) {
        // Régi kép törlése, ha van
        const oldImg = document.getElementById("previewImage");
        if (oldImg) oldImg.remove();

        // Upload-area eltüntetése
        uploadArea.style.display = "none";

        // Új kép létrehozása
        const img = document.createElement("img");
        img.src = e.target.result;
        img.id = "previewImage";
        img.style.maxWidth = "700px";
        img.style.display = "block";
        img.style.margin = "20px auto";
        img.style.borderRadius = "10px";

        // Beszúrás a section-title és uploadArea közé
        const sectionTitle = document.querySelector(".section-title");
        sectionTitle.parentNode.insertBefore(img, uploadArea);
    };

    reader.readAsDataURL(file);
}