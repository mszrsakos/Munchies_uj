/* =========================
   CELL CLICK → OPEN CHOOSER
========================= */

let selectedSlot = null;

const overlay = document.getElementById("etelOverlay");
const chooser = document.getElementById("etelValasztas");
const gridTable = document.querySelector(".grid-table");
const valasztottEtkezesText = document.getElementById("valasztottEtkezesText");

gridTable.addEventListener("click", (e) => {
    const btn = e.target.closest(".add-btn");
    if (!btn) return;

    selectedSlot = {
        day: btn.dataset.day,
        meal: btn.dataset.meal,
        button: btn
    };

    // ✅ SET TEXT HERE
    valasztottEtkezesText.textContent =
        `${selectedSlot.day} – ${selectedSlot.meal}`;

    overlay.style.display = "flex";
});


/* =========================
   SEARCH (AJAX, NO REFRESH)
========================= */

const form = document.getElementById("searchForm");
const input = document.getElementById("searchInput");
const results = document.getElementById("etelValasztasBottom");

form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const q = input.value.trim();
    const response = await fetch(`?ajax=1&q=${encodeURIComponent(q)}`);
    const html = await response.text();

    results.innerHTML = html;
});


/* =========================
   RECIPE CLICK → SAVE TO DB
========================= */

results.addEventListener("click", async (e) => {
    const link = e.target.closest(".kepLink");
    if (!link || !selectedSlot) return;

    e.preventDefault(); // 🚫 stop navigation

    const recipeId = new URL(link.href).searchParams.get("id");

    const response = await fetch("save_menu.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            day: selectedSlot.day,
            meal: selectedSlot.meal,
            recipe_id: recipeId
        })
    });

    const result = await response.json();

    if (result.success) {
        // get clicked recipe image
        const recipeImg = link.querySelector("img");
        const imgClone = recipeImg.cloneNode(true);
    
        imgClone.classList.add("menu-img");
    
        // clear the cell and insert image
        const cell = selectedSlot.button.parentElement;
        cell.innerHTML = "";
        cell.appendChild(imgClone);
    
        overlay.style.display = "none";
        selectedSlot = null;
    }
});

overlay.addEventListener("click", (e) => {
    if (e.target === overlay) {
        overlay.style.display = "none";
        selectedSlot = null;
    }
});