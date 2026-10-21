document.addEventListener('DOMContentLoaded', function () {
        const radios = document.querySelectorAll('input[name="page"]');
        const panels = document.querySelectorAll('.clients-panel');

        // Função que esconde todos e mostra só o escolhido
        function changePage(pageNumber) {
            panels.forEach(function(panel) {
                if (panel.getAttribute('data-page') === String(pageNumber)) {
                    panel.style.display = 'block'; 
                } else {
                    panel.style.display = 'none';  
                }
            });
        }

        // Escuta o clique nos botões
        radios.forEach(function(radio) {
            radio.addEventListener('change', function () {
                if (this.checked) {
                    changePage(this.value);

                    // Atualiza a URL sem recarregar
                    const url = new URL(window.location.href);
                    url.searchParams.set('page', this.value);
                    window.history.pushState({}, '', url);
                }
            });
        });
    });