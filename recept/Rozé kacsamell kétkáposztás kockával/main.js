
// Hozzávalók mennyiségének dinamikus frissítése az adagok számának változtatásakor
const alapHozzavalok = [
    { alap: 1, egyseg: 'db', szoveg: 'kacsamell (2 fél)' },
    { alap: null, egyseg: '', szoveg: 'só ízlés szerint' },
    { alap: null, egyseg: '', szoveg: 'bors ízlés szerint' },
    { alap: 1, egyseg: 'db', szoveg: 'lilahagyma' },
    { alap: null, egyseg: '', szoveg: 'só ízlés szerint' },
    { alap: null, egyseg: '', szoveg: 'bors ízlés szerint' },
    { alap: null, egyseg: '', szoveg: 'őrölt fűszerkömény ízlés szerint' },
    { alap: null, egyseg: '', szoveg: 'nádcukor' },
    { alap: 3, egyseg: 'ek', szoveg: 'közepes fej vöröskáposzta' },
    { alap: 0.5, egyseg: '', szoveg: 'közepes fej káposzta' },
    { alap: 3, egyseg: 'ek', szoveg: 'kacsazsír' },
    { alap: 2.5, egyseg: 'dl', szoveg: 'vörösbor' },
    { alap: 45, egyseg: 'dkg', szoveg: 'tészta (főtt)' }
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

