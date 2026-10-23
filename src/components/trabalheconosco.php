<section id="trabalheconosco" class="trabalheconosco">
    <div class="interfacetrabalheconosco">
        <div class="divcontent">
            <h1 class="titletrabalheconosco">Trabalhe Conosco</h1>
            <p class="subtitle">
                Se você se identificou com a nossa empresa e deseja enviar seu currículo,
                preencha o formulario abaixo.
            </p>          
            <form class="form" id="formTrabalheConosco" method="POST" action="enviar-trabalheconosco.php" enctype="multipart/form-data">
                 <input type="hidden" name="form_type" value="trabalhe_conosco">
                <div class="divinput">
                    <input class="input" type="text" name="name" id="name" placeholder="Nome" />
                </div>
                <div class="divinput">
                    <input class="input" type="email" name="email" id="email" placeholder="Email" />
                </div>
                <div class="divinput">
                    <input class="input" type="text" name="phone" id="phone" placeholder="Telefone" maxlength="15"/>
                </div>
                <div class="divinput">
                    <input class="input" type="file" accept=".pdf, .png, .jpg, .jpeg" name="file" id="file" />
                </div>
                <div class="divinput">
                    <select class="select" name="position" id="position">
                        <option value="">Área de Atuação</option>
                        <option value="administrativo">Administrativo</option>
                        <option value="engenharia">Engenharia</option>
                    </select>
                </div>
                <div class="divinput">
                    <textarea class="textarea" name="message" id="message" placeholder="Mensagem"></textarea>
                </div>
                <div class="divinput">
                    <input class="button" id="btnEnviarCurriculo" type="submit" value="Enviar" />
                </div>
            </form>
        </div>
    </div>
</section>