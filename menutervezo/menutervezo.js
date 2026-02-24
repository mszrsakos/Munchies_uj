// nap etkezes kiiras
let valasztottEtkezesText = document.getElementById("valasztottEtkezesText");
document.querySelector(".grid-table").addEventListener("click", function (e) {
    if (e.target.tagName !== "BUTTON") return;

    const columns = 5;
    const cells = Array.from(this.children);

    const buttonCell = e.target.parentElement;
    const cellIndex = cells.indexOf(buttonCell);

    // Row calculations
    const rowIndex = Math.floor(cellIndex / columns);
    const rowStart = rowIndex * columns;

    // Column calculations
    const columnIndex = cellIndex % columns;

    const rowName = cells[rowStart].textContent.trim();
    const columnName = cells[columnIndex].textContent.trim();

    valasztottEtkezesText.textContent = `${rowName} – ${columnName}`;
  });

// no refresh
const form = document.getElementById("searchForm");
const input = document.getElementById("searchInput");
const results = document.getElementById("etelValasztasBottom");

form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const q = input.value.trim();

    const response = await fetch(
        `?ajax=1&q=${encodeURIComponent(q)}`
    );

    const html = await response.text();
    results.innerHTML = html;
});

let selectedSlot = null;

// When user clicks "+"
document.querySelectorAll(".add-recipe").forEach(btn => {
    btn.addEventListener("click", () => {
        selectedSlot = {
            day: btn.dataset.day,
            meal: btn.dataset.meal,
            button: btn
        };

        document.getElementById("etelValasztas").style.display = "block";
    });
});

document.addEventListener("click", async (e) => {
    const link = e.target.closest(".kepLink");
    if (!link || !selectedSlot) return;

    e.preventDefault();

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
        selectedSlot.button.textContent = "✓";
        selectedSlot.button.disabled = true;
        document.getElementById("etelValasztas").style.display = "none";
    } else {
        alert("Hiba mentés közben");
    }
});
