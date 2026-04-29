//
/**
 * GiziSehat — Main JavaScript
 * File: public/js/app.js
 * (Atau: resources/js/app.js untuk Laravel Vite)
 */

// ── NAVBAR HAMBURGER ──────────────────────────────────────────
function toggleMenu() {
    const links = document.getElementById('navLinks');
    if (!links) return;

    const isOpen = links.classList.contains('mobile-open');

    if (isOpen) {
        links.classList.remove('mobile-open');
        Object.assign(links.style, { display: '', flexDirection: '', position: '', top: '', left: '', right: '', background: '', padding: '', borderBottom: '', zIndex: '' });
    } else {
        links.classList.add('mobile-open');
        Object.assign(links.style, {
            display: 'flex', flexDirection: 'column',
            position: 'absolute', top: '68px', left: '0', right: '0',
            background: 'white', padding: '1rem',
            borderBottom: '1.5px solid #E8EEF0', zIndex: '99',
        });
    }
}

function openVideo(id) {
    window.open(`https://www.youtube.com/watch?v=${id}`, '_blank');
}



// ── ACCORDION ────────────────────────────────────────────────
function toggleAccordion(key) {
    const item = document.getElementById('acc-' + key);
    if (!item) return;
    item.classList.toggle('open');
}

// ── TOAST NOTIFICATION ────────────────────────────────────────
function showToast(msg) {
    const t = document.getElementById('toast');
    if (!t) return;
    t.textContent = msg;
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 3000);
}

// ── CLOSE MOBILE MENU ON LINK CLICK ──────────────────────────
document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelectorAll('.nav-links a');
    links.forEach(link => {
        link.addEventListener('click', () => {
            const navLinks = document.getElementById('navLinks');
            if (navLinks && navLinks.classList.contains('mobile-open')) {
                toggleMenu();
            }
        });
    });
    console.log("JS jalan bro 🔥");
});