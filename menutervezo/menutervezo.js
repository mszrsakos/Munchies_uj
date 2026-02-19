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