
// Hozzávalók mennyiségének dinamikus frissítése az adagok számának változtatásakor
const alapHozzavalok = [
    { alap: 50, egyseg: 'dkg', szoveg: 'folyami rák (20 db rákfarok)' },
    { alap: 20, egyseg: 'db', szoveg: 'shiitake gomba' },
    { alap: 25, egyseg: 'dkg', szoveg: 'fafülgomba' },
    { alap: 2, egyseg: 'db', szoveg: 'citromfű ízlés szerint' },
    { alap: 2, egyseg: 'lime', szoveg: 'lime-ból nyert limelé' },
    { alap: 2, egyseg: 'db', szoveg: 'chili' },
    { alap: 2, egyseg: 'ek', szoveg: 'szójaszósz' },
    { alap: 1, egyseg: 'ek', szoveg: 'halszósz' },
    { alap: 1, egyseg: 'db', szoveg: 'közepes újhagyma' },
    { alap: null, egyseg: '', szoveg: 'koriander ízlés szerint' },
    { alap: 1, egyseg: 'teáskanál', szoveg: 'cukor' },
    { alap: 1.5, egyseg: 'l', szoveg: 'hal alaplé' }
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

