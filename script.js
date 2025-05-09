// Dodavanje klase 'visible' kada se sekcija pojavi u vidljivom delu ekrana
document.addEventListener('DOMContentLoaded', () => {
    const sections = document.querySelectorAll('section');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    sections.forEach(section => {
        observer.observe(section);
    });
});

// Postavljanje osnovne boje pozadine ako nije definisana
document.body.style.backgroundColor = getComputedStyle(document.body).backgroundColor === 'rgb(255, 255, 255)'
    ? '#f8f9fa' // Svetlo siva pozadina ako je trenutno bela
    : document.body.style.backgroundColor;

// Dodavanje aktivne klase na navigacioni link
document.addEventListener('DOMContentLoaded', () => {
    const currentLocation = window.location.pathname;
    const navLinks = document.querySelectorAll('nav ul li a');

    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentLocation || currentLocation.includes(link.getAttribute('href'))) {
            link.classList.add('active'); // Dodaj klasu za aktivnu stranicu
        }
    });
});

// Dinamicki stil za aktivni link
const style = document.createElement('style');
style.innerHTML = `
    nav ul li a.active {
        font-weight: bold;
        text-decoration: underline;
        color: #ff7a18; /* Istakni aktivni link */
    }
`;
document.head.appendChild(style);