document.addEventListener('DOMContentLoaded', () => {
    const menuButton = document.getElementById('mobile-menu-icon');
    const menuMobile = document.getElementById('menu2');

    if (!menuButton || !menuMobile) {
        console.error('Botão ou menu mobile não encontrado no HTML.');
        return;
    }

    menuButton.addEventListener('click', () => {
        menuMobile.hidden = !menuMobile.hidden;
    });

    const linksMenu = menuMobile.querySelectorAll('a');

    linksMenu.forEach((link) => {
        link.addEventListener('click', () => {
            menuMobile.hidden = true;
        });
    });
});