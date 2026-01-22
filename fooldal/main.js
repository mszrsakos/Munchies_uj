// Menütervező gomb átirányítás
const menutervezoBtn = document.getElementById('menutervezo');
if (menutervezoBtn) {
    menutervezoBtn.addEventListener('click', function() {
        window.location.href = '../menutervezo/menutervezo.php';
    });
}
