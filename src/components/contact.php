<section id="contato" class="contact">
  <div class="container">
    <h1 class="titlecontact">Fale Conosco</h1>        
    <div class="grid">
    
      <div class="location">
        <div class="locationHeader">       
          <img 
            class="icon" 
            src="src/img/indicador(azul).png" 
            alt="" 
            style="width: 37px; height: 36px;"            
          />
          <h2 class="subtitle" style="font-size: 24px;">Localização</h2>
        </div>

        <iframe
          class="map"
          title="Mapa da Quality Engenharia e Consultoria"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3887.7960360583997!2d-38.453047024620766!3d-12.984893560077287!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7161b0f15eb0c95%3A0xe163a272ac5adaa3!2sQuality%20Engenharia%20e%20Consultoria%20Ltda.!5e0!3m2!1spt-BR!2sbr!4v1791288879543!5m2!1spt-BR!2sbr"
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>

        <address class="address">
          Rua Dr. José Peroba, 275 - Sl 409, Edifício Metrópolis Empresarial Stiep
          <br />
          Salvador - Bahia - Brasil - CEP: 41.770-235
          <br />
          Tel: (71) 3341-1414
        </address>
        
      </div>
     
      <div class="formArea">
        <p class="intro">
          Entre em contato conosco através do formulário abaixo.
          Teremos o maior prazer em lhe atender!
        </p>
           
        <form class="formcontact" method="POST"   id="formContato" action="enviar-contato.php" enctype="multipart/form-data">
          <input type="hidden" name="form_type" value="contato_geral">
          <div class="field">              
            <input class="inputcontact" type="text" id="name" name="name" placeholder="Nome" required />
          </div>

          <div class="field">               
            <input class="inputcontact" type="email" id="email" name="email" placeholder="Email" required />
          </div>

          <div class="field">           
            <input class="inputcontact" type="text" id="phone" name="phone" placeholder="Telefone" maxlength="15" required />
          </div>

          <div class="field">               
            <select class="selectcontact" id="time" name="time" required>
              <option value="">Melhor Horário de Contato</option>
              <option value="manha">Manhã</option>
              <option value="tarde">Tarde</option>
              <option value="noite">Noite</option>
            </select>
          </div>

          <div class="field">               
            <textarea class="textareacontact" id="message" name="message" placeholder="Mensagem" required></textarea>
          </div>

          <button class="button" type="submit" id="btnEnviar">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</section>