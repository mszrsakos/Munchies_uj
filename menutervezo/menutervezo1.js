/* =========================
   CELL CLICK → OPEN CHOOSER
========================= */

let selectedSlot = null;

const overlay = document.getElementById("etelOverlay");
const chooser = document.getElementById("etelValasztas");
const gridTable = document.querySelector(".grid-table");
const valasztottEtkezesText = document.getElementById("valasztottEtkezesText");

document.addEventListener("click", async (e) => {
    if (e.target.closest(".open-recipe-btn")) return;
    /* =========================
       REMOVE
    ========================= */
    const removeBtn = e.target.closest(".remove-btn");

    if (removeBtn) {

        e.preventDefault();
        e.stopPropagation();

        const wrapper = removeBtn.closest(".menu-img-wrapper");
        if (!wrapper) return;

        const day = wrapper.dataset.day;
        const meal = wrapper.dataset.meal;

        const res = await fetch("delete_menu.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ day, meal })
        });

        const data = await res.json();

        if (!data.success) return;

        document
            .querySelectorAll(`.cell[data-day="${day}"][data-meal="${meal}"]`)
            .forEach(cell => {
                cell.innerHTML = `
                    <button class="add-btn add-recipe"
                            data-day="${day}"
                            data-meal="${meal}">
                        +
                    </button>
                `;
            });

        return;
    }

    /* =========================
       OPEN OVERLAY / ADD
    ========================= */
    const addBtn = e.target.closest(".add-btn");
    const imgWrapper = e.target.closest(".menu-img-wrapper");

    if (!addBtn && !imgWrapper) return;
    if (isDragging) return;

    const cell = (addBtn || imgWrapper).closest(".cell");

    selectedSlot = {
        day: cell.dataset.day,
        meal: cell.dataset.meal,
        element: cell
    };

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


document.addEventListener("click", async (e) => {

    /* =========================
       RECIPE SELECT (OVERLAY)
    ========================= */
    const link = e.target.closest("#etelValasztasBottom .kepLink");

    if (link && selectedSlot) {

        e.preventDefault();

        const recipeId = new URL(link.href).searchParams.get("id");

        const res = await fetch("save_menu.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                day: selectedSlot.day,
                meal: selectedSlot.meal,
                recipe_id: recipeId
            })
        });

        const data = await res.json();

        if (!data.success) return;

        const img = link.querySelector("img");

        document
            .querySelectorAll(
                `.cell[data-day="${selectedSlot.day}"][data-meal="${selectedSlot.meal}"]`
            )
            .forEach(cell => {

                cell.innerHTML = `
                            <div class="menu-img-wrapper"
                                data-day="${selectedSlot.day}"
                                data-meal="${selectedSlot.meal}">

                                <img src="${img.src}" class="menu-img" alt="">

                                <button class="remove-btn">✕</button>

                                <a class="open-recipe-btn"
                                href="../recept_sema/recept.php?id=${recipeId}">
                                    ↗
                                </a>

                            </div>
                        `;
            });

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

const wrapper = document.querySelector(".table-wrapper");

let isDown = false;
let isDragging = false;
let startX;
let scrollLeft;

wrapper.addEventListener("mousedown", (e) => {

    isDown = true;
    isDragging = false;

    wrapper.classList.add("dragging");

    startX = e.pageX - wrapper.offsetLeft;
    scrollLeft = wrapper.scrollLeft;
});

wrapper.addEventListener("mouseleave", () => {

    isDown = false;

    wrapper.classList.remove("dragging");
});

wrapper.addEventListener("mouseup", () => {

    isDown = false;

    wrapper.classList.remove("dragging");

    setTimeout(() => {
        isDragging = false;
    }, 0);
});

wrapper.addEventListener("mousemove", (e) => {

    if (!isDown) return;

    e.preventDefault();

    const x = e.pageX - wrapper.offsetLeft;
    const walk = x - startX;

    if (Math.abs(walk) > 5) {
        isDragging = true;
    }

    wrapper.scrollLeft = scrollLeft - walk;
});

document.addEventListener("DOMContentLoaded", () => {

    const daySelect = document.getElementById("daySelect");

    
    function updateMobileTable() {

        if (window.innerWidth > 700) {

            document.querySelectorAll(".day-slot").forEach(slot => {
                slot.style.display = "";
            });

            return;
        }

        const selectedDay = daySelect.value;

        document.querySelectorAll(".day-slot").forEach(slot => {

            if (slot.dataset.day === selectedDay) {

                slot.style.display = "flex";

            } else {

                slot.style.display = "none";
            }
        });
    }



    daySelect.addEventListener("change", updateMobileTable);

    window.addEventListener("resize", updateMobileTable);

    updateMobileTable();
});
