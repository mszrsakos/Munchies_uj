// Button1 (Személyes adatok módosítása) gomb kattintásának kezelése
document.addEventListener('DOMContentLoaded', function() {
    const button1 = document.querySelector('.button1');
    
    button1.addEventListener('click', function() {
        console.log('Személyes adatok módosítása gombra kattintott');
    });

    // Profilkép gomb kattintásának kezelése - Fájl Explorer megnyitása
    const profilkepGomb = document.querySelector('.profilkep_gomb');
    const profilKep = document.querySelector('.profil_kep');
    
    profilkepGomb.addEventListener('click', function() {
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.accept = 'image/*';
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    profilKep.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
        fileInput.click();
    });

    // Button2 (Változtatások mentése) gomb kattintásának kezelése
    const button2 = document.querySelector('.button2');
    const nevInput = document.querySelector('.display_input');
    const nevElement = document.querySelector('.nev');

    button2.addEventListener('click', function() {
        const ujNev = nevInput.value;
        if (ujNev.trim() !== '') {
            nevElement.textContent = ujNev;
        } else {
            alert('Kérjük, írjon be egy nevet!');
        }
    });
});
document.getElementById('profilePicInput').addEventListener('change', function () {
    if (this.files.length > 0) {
        document.getElementById('profilePicForm').submit();
    }
});
