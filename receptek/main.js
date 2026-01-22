console.log("Js betoltve")
let count = 1;
const countEl = document.getElementById("count");

document.getElementById("plus").addEventListener("click", () => {
    count++;
    countEl.textContent = count;
});

document.getElementById("minus").addEventListener("click", () => {
    if (count > 1) {
        count--;
        countEl.textContent = count;
    }
});

function increase() {
    console.log("PLUSZ KATT");
    count++;
    document.getElementById("count").textContent = count;
}
function decrease() {
    if (count > 0) {
        count--;
        document.getElementById("count").textContent = count;
    }
}

