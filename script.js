
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');

    form.addEventListener('submit', (event) => {
        const name = form.querySelector('input[name="name"]').value;
        const email = form.querySelector('input[name="email"]').value;
        const message = form.querySelector('textarea[name="message"]').value;

        if (!name || !email || !message) {
            alert('Lütfen tüm alanları doldurunuz.');
            event.preventDefault();
        } else if (!validateEmail(email)) {
            alert('Geçerli bir e-posta adresi giriniz.');
            event.preventDefault();
        }
    });

    function validateEmail(email) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }
});


document.addEventListener('DOMContentLoaded', () => {
    const projects = [
        {
            title: 'Proje 3',
            description: 'Kısa açıklama.',
            technologies: 'HTML, CSS, JavaScript',
            link: '#'
        },
        {
            title: 'Proje 4',
            description: 'Kısa açıklama.',
            technologies: 'PHP, MySQL',
            link: '#'
        }
        ,
        {
            title : 'Proje 5' ,
            description : 'Kısa açıklama.' ,
            technologies : 'React, Node.js' ,
            link : '#'
        }
    ];

    const projectsContainer = document.querySelector('.project-cards');

    projects.forEach(project => {
        const projectCard = document.createElement('div');
        projectCard.classList.add('project-card');
        
        projectCard.innerHTML = `
            <h3>${project.title}</h3>
            <p>${project.description}</p>
            <p><strong>Teknolojiler:</strong> ${project.technologies}</p>
            <a href="${project.link}" class="project-link">Detayları Gör</a>
        `;
        
        projectsContainer.appendChild(projectCard);
    });
});


document.addEventListener('DOMContentLoaded', () => {
    const navLinks = document.querySelectorAll('header nav a');

    navLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            const targetId = link.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            const scrollDuration = 800; 
            const startPosition = window.pageYOffset;
            const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset;
            const distance = targetPosition - startPosition;
            let startTime = null;

            function animation(currentTime) {
                if (startTime === null) startTime = currentTime;
                const timeElapsed = currentTime - startTime;
                const run = easeInOutQuad(timeElapsed, startPosition, distance, scrollDuration);
                window.scrollTo(0, run);
                if (timeElapsed < scrollDuration) requestAnimationFrame(animation);
            }

            function easeInOutQuad(t, b, c, d) {
                t /= d / 2;
                if (t < 1) return c / 2 * t * t + b;
                t--;
                return -c / 2 * (t * (t - 2) - 1) + b;
            }

            requestAnimationFrame(animation);
        });
    });
});



