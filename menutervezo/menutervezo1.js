/* =========================
   CELL CLICK → OPEN CHOOSER
========================= */

let selectedSlot = null;

const overlay = document.getElementById("etelOverlay");
const chooser = document.getElementById("etelValasztas");
const gridTable = document.querySelector(".grid-table");
const valasztottEtkezesText = document.getElementById("valasztottEtkezesText");

gridTable.addEventListener("click", async (e) => {
    const removeBtn = e.target.closest(".remove-btn");
    if (!removeBtn) return;

    e.stopPropagation(); // prevent chooser opening

    const wrapper = removeBtn.closest(".menu-img-wrapper");
    const day = wrapper.dataset.day;
    const meal = wrapper.dataset.meal;

    const response = await fetch("delete_menu.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ day, meal })
    });

    const result = await response.json();

    if (result.success) {
        const cell = wrapper.closest(".cell");
        cell.innerHTML = `
            <button class="add-btn add-recipe"
                    data-day="${day}"
                    data-meal="${meal}">
                +
            </button>
        `;
    }
});


gridTable.addEventListener("click", (e) => {
    console.log("GRID CLICK", e.target);

    const btn = e.target.closest(".add-btn");
    const img = e.target.closest(".menu-img");

    if (!btn && !img) {
        console.log("Not a button or image");
        return;
    }

    const source = btn || img;

    console.log("SOURCE:", source.dataset);

    selectedSlot = {
        day: source.dataset.day,
        meal: source.dataset.meal,
        element: source
    };

    if (!selectedSlot.day || !selectedSlot.meal) {
        console.error("Missing day/meal on clicked element");
        return;
    }

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
        const recipeImg = link.querySelector("img");
    
        const wrapper = document.createElement("div");
        wrapper.className = "menu-img-wrapper";
        wrapper.dataset.day = selectedSlot.day;
        wrapper.dataset.meal = selectedSlot.meal;
    
        const img = recipeImg.cloneNode(true);
        img.classList.add("menu-img");
    
        const removeBtn = document.createElement("button");
        removeBtn.className = "remove-btn";
        removeBtn.textContent = "✕";
    
        wrapper.appendChild(img);
        wrapper.appendChild(removeBtn);
    
        const cell = selectedSlot.element.closest(".cell");
        cell.innerHTML = "";
        cell.appendChild(wrapper);
    
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