
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formTrabalheConosco');

    if (!form) {
        return;
    }

    const botao = document.getElementById('btnEnviarCurriculo');

    form.addEventListener('submit', async function (event) {
        event.preventDefault();

        if (!form.reportValidity()) {
            return;
        }

        if (botao) {
            botao.disabled = true;
            botao.textContent = 'Enviando currículo...';
        }

        await new Promise(resolve => requestAnimationFrame(() => resolve()));

        try {
            const resposta = await fetch(form.action, {
                method: 'POST',
                body: new FormData(form)
            });

            const resultado = await resposta.json();

            if (!resposta.ok || !resultado.sucesso) {
                throw new Error(
                    resultado.mensagem || 'Falha ao enviar currículo.'
                );
            }

            form.reset();

            await Swal.fire({
                icon: 'success',
                title: 'Currículo enviado!',
                text: resultado.mensagem,
                confirmButtonColor: '#425F8C'
            });

        } catch (erro) {
            console.error('Erro ao enviar currículo:', erro);

            await Swal.fire({
                icon: 'error',
                title: 'Ops! Algo deu errado',
                text: erro.message ||
                    'Não foi possível enviar seu currículo.',
                confirmButtonColor: '#425F8C'
            });

        } finally {
            if (botao) {
                botao.disabled = false;
                botao.textContent = 'Enviar currículo';
            }
        }
    });
});
