
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formContato');
    const btnEnviar = document.getElementById('btnEnviar');

    if (!form) {
        console.error(
            'Formulário não encontrado. Verifique o id="formContato" no HTML.'
        );
        return;
    }

    form.addEventListener('submit', async function (event) {
        event.preventDefault();

        if (!form.reportValidity()) return;

        if (btnEnviar) {
            btnEnviar.disabled = true;
            btnEnviar.value = 'Enviando...';
        }

        try {
            const resposta = await fetch(form.action, {
                method: 'POST',
                body: new FormData(form)
            });

            const resultado = await resposta.json();

            if (!resposta.ok || !resultado.sucesso) {
                throw new Error(
                    resultado.mensagem || 'Falha no envio.'
                );
            }

            form.reset();

            await Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: resultado.mensagem,
                confirmButtonColor: '#425F8C'
            });

        } catch (erro) {
            console.error('Erro no envio:', erro);

            await Swal.fire({
                icon: 'error',
                title: 'Ops! Algo deu errado',
                text: erro.message || 'Não foi possível enviar a mensagem.',
                confirmButtonColor: '#425F8C'
            });

        } finally {
            if (btnEnviar) {
                btnEnviar.disabled = false;
                btnEnviar.value = 'Enviar';
            }
        }
    });
});
