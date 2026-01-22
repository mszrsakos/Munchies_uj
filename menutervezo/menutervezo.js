document.addEventListener("DOMContentLoaded", function () {
    const tableContainer = document.getElementById("tableContainer");
    const days = ["Hétfő", "Kedd", "Szerda", "Csütörtök", "Péntek", "Szombat", "Vasárnap"];
    const meals = ["Reggeli", "Ebéd", "Vacsora", "Egyéb"];
    let currentWeek = 0;

    function generateTable(weekOffset) {
        tableContainer.innerHTML = ""; // Töröljük az előző táblázatot
        const table = document.createElement("div");
        table.className = "tablazat";

        // Fejléc
        table.innerHTML += `<div class="cell"></div>`;
        meals.forEach(meal => {
            table.innerHTML += `<div class="cell">${meal}</div>`;
        });

        // Napok és cellák
        days.forEach(day => {
            table.innerHTML += `<div class="cell">${day}</div>`;
            for (let i = 0; i < meals.length; i++) {
                const cell = document.createElement("div");
                cell.className = "cell";

                const button = document.createElement("button");
                button.textContent = "+";
                button.addEventListener("click", function () {
                    const food = prompt("Mit szeretnél enni?");
                    if (food) {
                        button.textContent = food; // Frissítjük a gomb szövegét
                    }
                });

                cell.appendChild(button);
                table.appendChild(cell);
            }
        });

        // Hét száma
        const weekLabel = document.createElement("h2");
        weekLabel.textContent = `Hét: ${currentWeek + weekOffset}`;
        tableContainer.appendChild(weekLabel);
        tableContainer.appendChild(table);
    }

    // Navigációs gombok eseménykezelői
    document.getElementById("prevWeek").addEventListener("click", function () {
        currentWeek--;
        generateTable(0);
    });

    document.getElementById("nextWeek").addEventListener("click", function () {
        currentWeek++;
        generateTable(0);
    });

    // Alapértelmezett táblázat generálása
    generateTable(0);
});


