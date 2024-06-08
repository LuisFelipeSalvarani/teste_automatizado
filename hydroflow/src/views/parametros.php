<main class="main">
    <?php
        renderTitle(
            "Parâmetros",
            "Controle os parâmetros de irrigações",
            "faders-horizontal"
        );

        include(TEMPLATE_PATH . "/messages.php")
    ?>
    <div class="content">
        <dialog class="modal" id="confirm-modal">
            <div class="modal-container">
                <button class="btn-close" id="close"><i class="ph-bold ph-x-circle"></i></button>
                <h2>Deseja carregar os parâmetros no dispositivo?</h2>
                <div class="btn-box">
                    <button class="btn-register" id="modal-carregar">Carregar</button>
                    <button class="btn-register gravar" id="modal-salvar">Apenas salvar</button>
                </div>
            </div>
        </dialog>
        <dialog class="modal" id="success-modal">
            <div class="modal-container">
                <h2></h2>
                <div class="loader-bar"></div>
            </div>
        </dialog>
        <dialog class="modal" id="error-modal">
            <div class="modal-container">
                <h2></h2>
                <div class="loader-bar"></div>
            </div>
        </dialog>
        <form action="#" method="post" class="register" id="register">
            <input type="hidden" name="id_parametros" id="id_parametros">
            <div class="form-group">
                <div class="input-field flex-10">
                    <label for="id_jardim">Jardim</label>
                    <select class="input" name="jardim" id="id_jardim" class="input">
                        <option value="" selected>Selecione um Jardim...</option>
                        <?php foreach($jardins as $jardim) : ?>
                            <option value="<?= $jardim->id ?>"><?= $jardim->nome_jardim ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="input-field">
                    <label for="id_area">Zona</label>
                    <select class="input" name="id_zona" id="id_area">
                        <option value="" id="zona" selected>Selecione uma Zona...</option>
                    </select>
                </div>
            </div>
            <div class="form-box">
                <div class="coluna-1">
                    <div class="form-group">
                        <div class="input-field">
                            <label for="hora_inicio">Hora de início</label>
                            <input type="time" class="input" name="hora_inicio" id="hora_inicio">
                        </div>
                        <div class="input-field">
                            <label for="duracao">Duração (min)</label>
                            <input type="time" class="input" name="duracao" id="duracao">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-field">
                            <label for="max_umidade">Úmidade máxima</label>
                            <input type="number" class="input" min="0" max="100" step="1" name="max_umidade" id="max_umidade">
                        </div>
                        <div class="input-field">
                            <label for="min_umidade">Úmidade mínima</label>
                            <input type="number" class="input" min="0" max="100" step="1" name="min_umidade" id="min_umidade">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-field">
                            <label for="max_temperatura">Temperatura máxima</label>
                            <input type="number" class="input" min="0" max="50" step="1" name="max_temperatura" id="max_temperatura">
                        </div>
                        <div class="input-field">
                            <label for="min_temperatura">Temperatura mínima</label>
                            <input type="number" class="input" min="0" max="50" step="1" name="min_temperatura" id="min_temperatura">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-field">
                            <label for="max_volume">Volume máxima</label>
                            <input type="number" class="input" min="0" max="500" step="1" name="max_volume" id="max_volume">
                        </div>
                        <div class="input-field">
                            <label for="min_volume">Volume mínima</label>
                            <input type="number" class="input" min="0" max="500" step="1" name="min_volume" id="min_volume">
                        </div>
                    </div>
                </div>
                <div class="coluna-2">
                    <div class="form-group checkbox">
                        <div class="input-field">
                            <input type="checkbox" class="input checkbox" name="segunda" id="segunda" checked>
                            <label for="segunda">Segunda-feira</label>
                        </div>
                        <div class="input-field">
                            <input type="checkbox" class="input checkbox" name="terca" id="terca" checked>
                            <label for="terca">Terça-feira</label>
                        </div>
                        <div class="input-field">
                            <input type="checkbox" class="input checkbox" name="quarta" id="quarta" checked>
                            <label for="quarta">Quarta-feira</label>
                        </div>
                        <div class="input-field">
                            <input type="checkbox" class="input checkbox" name="quinta" id="quinta" checked>
                            <label for="quinta">Quinta-feira</label>
                        </div>
                        <div class="input-field">
                            <input type="checkbox" class="input checkbox" name="sexta" id="sexta" checked>
                            <label for="sexta">Sexta-feira</label>
                        </div>
                        <div class="input-field">
                            <input type="checkbox" class="input checkbox" name="sabado" id="sabado" checked>
                            <label for="sabado">Sábado</label>
                        </div>
                        <div class="input-field">
                            <input type="checkbox" class="input checkbox" name="domingo" id="domingo" checked>
                            <label for="domingo">Domingo</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-box">
                <!-- <button type="submit" form="register" class="btn-register">
                    <i class="ph-bold ph-file-arrow-up"></i>Salvar
                </button> -->
                <button type="submit" form="register" class="btn-register">
                    <i class="ph-bold ph-cloud-arrow-up"></i>Gravar
                </button>
            </div>
        </form>
    </div>
</main>
<script src="/assets/js/parametros.js" defer></script>