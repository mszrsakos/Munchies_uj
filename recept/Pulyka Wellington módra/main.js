
// Hozzávalók mennyiségének dinamikus frissítése az adagok számának változtatásakor
const alapHozzavalok = [
    { alap: 800, egyseg: 'g', szoveg: 'pulykamell' },
    { alap: 500, egyseg: 'g', szoveg: ' csiperkegomba (lehetőleg barna csiperke vagy vegyes erdei gombát válasszunk)' },
    { alap: 1, egyseg: 'db', szoveg: 'nagy fej vöröshagyma' },
    { alap: 3, egyseg: 'db', szoveg: 'gerezd fokhagyma' },
    { alap: 200, egyseg: 'g', szoveg: 'prosciutto' },
    { alap: 400, egyseg: 'g', szoveg: 'leves tészta' },
    { alap: 1, egyseg: 'ek', szoveg: 'dijoni mustár' },
    { alap: 1, egyseg: null, szoveg: 'teáskanál kakukkfű' },
    { alap: 1, egyseg: null, szoveg: 'teáskanál rozmaring' },
    { alap: 1, egyseg: 'db', szoveg: 'tojás' },
    { alap: 2, egyseg: 'ek', szoveg: 'olívaolaj' },
    { alap: null, egyseg: null, szoveg: 'só ízlés szerint' },
    { alap: null, egyseg: null, szoveg: 'fekete bors ízlés szerint' },
    { alap: null, egyseg: null, szoveg: '1 ek konyak (opcionális)' }
];

let adag = 1;

function updateHozzavalok() {
    const ul = document.querySelector('.hozzavalok ul');
    if (!ul) return;
    ul.innerHTML = '';
    alapHozzavalok.forEach(h => {
        let mennyiseg = h.alap !== null ? h.alap * adag : '';
        let egyseg = h.egyseg ? h.egyseg + ' ' : '';
        let szoveg = mennyiseg ? `${mennyiseg} ${egyseg}${h.szoveg}` : `${h.szoveg}`;
        const li = document.createElement('li');
        li.textContent = szoveg;
        ul.appendChild(li);
    });
}

function increase() {
    adag++;
    document.getElementById('count').textContent = adag;
    updateHozzavalok();
}

function decrease() {
    if (adag > 1) {
        adag--;
        document.getElementById('count').textContent = adag;
        updateHozzavalok();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    updateHozzavalok();
});

