// Elek hivatkozása
const imageInput = document.getElementById("imageInput");
const uploadContent = document.getElementById("uploadContent");
const uploadArea = document.getElementById("uploadArea");

const prepTime = document.getElementById("prepTime").value;
const cost = document.getElementById("cost").value;
const difficulty = document.getElementById("difficulty").value;


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

        const oldImg = document.getElementById("previewImage");
        if (oldImg) oldImg.remove();

        const img = document.createElement("img");
        img.src = e.target.result;
        img.id = "previewImage";
        img.style.maxWidth = "700px";
        img.style.display = "block";
        img.style.margin = "20px auto";
        img.style.borderRadius = "10px";

        // EZ A FIX
        uploadArea.parentNode.insertBefore(img, uploadArea);
    };

    reader.readAsDataURL(file);
}

document.getElementById("imageInput").addEventListener("change", function () {
    const uploadArea = document.getElementById("uploadArea");
    if (this.files && this.files.length > 0) {
        uploadArea.style.display = "none"; // Rejtse el a feltöltési területet
    }
});

document.querySelector(".submit-button").addEventListener("click", function(e) {
    const ingredients = [];
    document.querySelectorAll("#ingredientList li").forEach(li => {
        ingredients.push(li.textContent);
    });

    const steps = [];
    document.querySelectorAll("#stepList li").forEach(li => {
        steps.push(li.textContent);
    });

    document.getElementById("ingredientsHidden").value = JSON.stringify(ingredients);
    document.getElementById("stepsHidden").value = JSON.stringify(steps);
});

document.querySelectorAll("input").forEach(input => {
    input.addEventListener("keypress", function(e) {
        if (e.key === "Enter") {
            e.preventDefault();
        }
    });
});

console.log(prepTime, cost, difficulty);