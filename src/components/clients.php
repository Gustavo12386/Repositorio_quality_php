<?php
$pagina = isset($_GET['page']) ? (int) $_GET['page'] : 0;

if ($pagina < 0 || $pagina > 5) {
    $pagina = 0;
}


?>

<section id="clientes" class="clients">
    <div class="interfaceclients">

        <div class="divtitleclients">
            <h1 class="titleclients">Nossos Clientes</h1>
        </div>

        <div class="divcontentclients">
            <div class="navigationdiv">
                <div class="divinputs">

                    <div class="divinput1">

                        <input type="radio" name="page" id="page-0" value="0" <?= $pagina === 0 ? 'checked' : '' ?>>
                        <label for="page-0">Industrial</label>

                        <input type="radio" name="page" id="page-1" value="1" <?= $pagina === 1 ? 'checked' : '' ?>>
                        <label for="page-1">Estatal</label>

                        <input type="radio" name="page" id="page-2" value="2" <?= $pagina === 2 ? 'checked' : '' ?>>
                        <label for="page-2">Setor Privado</label>

                    </div>

                    <div class="divinput2">

                        <input type="radio" name="page" id="page-3" value="3" <?= $pagina === 3 ? 'checked' : '' ?>>                  
                        <label for="page-3">Construção</label>

                        <input type="radio" name="page" id="page-4" value="4" <?= $pagina === 4 ? 'checked' : '' ?>>
                        <label for="page-4">Adm. Pública</label>

                        <input type="radio" name="page" id="page-5" value="5" <?= $pagina === 5 ? 'checked' : '' ?>>
                        <label for="page-5">Outros</label>

                    </div>

                </div>
            </div>
        </div>
          <div class="clients-panels">           
            <div class="clients-panel" id="panel-0" data-page="0" style="<?= $pagina === 0 ? 'display: block;' : 'display: none;' ?>">
                <?php include './src/components/subcomponents/Industry.php'; ?>
            </div>

              <div class="clients-panel" id="panel-1" data-page="1" style="<?= $pagina === 1 ? 'display: block;' : 'display: none;' ?>">
                <?php include './src/components/subcomponents/Estatal.php'; ?>
            </div>

            <div class="clients-panel" id="panel-2" data-page="2" style="<?= $pagina === 2 ? 'display: block;' : 'display: none;' ?>">
                <?php include './src/components/subcomponents/Private.php'; ?>
            </div>

            <div class="clients-panel" id="panel-3" data-page="3" style="<?= $pagina === 3 ? 'display: block;' : 'display: none;' ?>">
                <?php include './src/components/subcomponents/Construction.php'; ?>
            </div>

            <div class="clients-panel" id="panel-4" data-page="4" style="<?= $pagina === 4 ? 'display: block;' : 'display: none;' ?>">
                <?php include './src/components/subcomponents/PublicAdm.php'; ?>
            </div>

            <div class="clients-panel" id="panel-5" data-page="5" style="<?= $pagina === 5 ? 'display: block;' : 'display: none;' ?>">
                <?php include './src/components/subcomponents/Others.php'; ?>
            </div>
        </div>

    </div>
</section>