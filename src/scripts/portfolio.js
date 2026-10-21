
document.addEventListener('DOMContentLoaded', async () => {
    const enterpriseElement = document.getElementById('enterprise');
    const descriptionElement = document.getElementById('description');
    const previousButton = document.getElementById('previous');
    const nextButton = document.getElementById('next');

    let projects = [];
    let page = 0;

    try {
        const response = await fetch('jsonportfolio.json');

        if (!response.ok) {
            throw new Error('Não foi possível carregar os projetos.');
        }

        projects = await response.json();

        if (!Array.isArray(projects) || projects.length === 0) {
            throw new Error('Nenhum projeto foi encontrado.');
        }

        function renderProject() {
            const project = projects[page];

            enterpriseElement.textContent = project.enterprise;
            descriptionElement.textContent = project.description;

            previousButton.disabled = page === 0;
            nextButton.disabled = page === projects.length - 1;
        }

        previousButton.addEventListener('click', () => {
            if (page > 0) {
                page--;
                renderProject();
            }
        });

        nextButton.addEventListener('click', () => {
            if (page < projects.length - 1) {
                page++;
                renderProject();
            }
        });

        renderProject();

    } catch (error) {
        console.error('Erro ao carregar o portfólio:', error);

        enterpriseElement.textContent = 'Portfólio indisponível';
        descriptionElement.textContent =
            'Não foi possível carregar os projetos. Tente novamente mais tarde.';
    }
});
