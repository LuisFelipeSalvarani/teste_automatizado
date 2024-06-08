<main class="main">
    <?php
        renderTitle(
            "Zonas",
            "Altera as informações da zona",
            "flag"
        );

        include (TEMPLATE_PATH . "/messages.php")
    ?>
    <div class="content">
        <form action="#" method="post" class="register" id="register">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="form-group">
                <div class="input-field disabled">
                    <label for="id_jardim">Código do Jardim:</label>
                    <input class="input" type="text" name="id_jardim" id="id_jardim" value="<?= $id_jardim ?>"
                        readonly/>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="input-field flex-10 disabled">
                    <label for="nome_jardim">Nome do Jardim:</label>
                    <input class="input" type="text" id="nome_jardim" value="<?= $nome_jardim ?>"
                        disabled/>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field duplo-select">
                    <label for="nome_zona">Nome da Zona</label>
                    <div class="duplo-select">
                        <select class="input" name="nome_zona_let" id="nome_zona">
                            <option value="a" <?= substr($nome_zona, 0, 1) === 'a' ? 'selected' : '' ?>>A</option>
                            <option value="b" <?= substr($nome_zona, 0, 1) === 'b' ? 'selected' : '' ?>>B</option>
                            <option value="c" <?= substr($nome_zona, 0, 1) === 'c' ? 'selected' : '' ?>>C</option>
                            <option value="d" <?= substr($nome_zona, 0, 1) === 'd' ? 'selected' : '' ?>>D</option>
                            <option value="e" <?= substr($nome_zona, 0, 1) === 'f' ? 'selected' : '' ?>>E</option>
                            <option value="f" <?= substr($nome_zona, 0, 1) === 'g' ? 'selected' : '' ?>>F</option>
                            <option value="g" <?= substr($nome_zona, 0, 1) === 'h' ? 'selected' : '' ?>>G</option>
                            <option value="h" <?= substr($nome_zona, 0, 1) === 'i' ? 'selected' : '' ?>>H</option>
                            <option value="i" <?= substr($nome_zona, 0, 1) === 'j' ? 'selected' : '' ?>>I</option>
                            <option value="j" <?= substr($nome_zona, 0, 1) === 'k' ? 'selected' : '' ?>>J</option>
                        </select>
                        <select class="input" name="nome_zona_num" id="nome_zona">
                            <option value="1" <?= substr($nome_zona, 1, 1) === '1' ? 'selected' : '' ?>>1</option>
                            <option value="2" <?= substr($nome_zona, 1, 1) === '2' ? 'selected' : '' ?>>2</option>
                            <option value="3" <?= substr($nome_zona, 1, 1) === '3' ? 'selected' : '' ?>>3</option>
                            <option value="4" <?= substr($nome_zona, 1, 1) === '4' ? 'selected' : '' ?>>4</option>
                            <option value="5" <?= substr($nome_zona, 1, 1) === '5' ? 'selected' : '' ?>>5</option>
                            <option value="6" <?= substr($nome_zona, 1, 1) === '6' ? 'selected' : '' ?>>6</option>
                            <option value="7" <?= substr($nome_zona, 1, 1) === '7' ? 'selected' : '' ?>>7</option>
                            <option value="8" <?= substr($nome_zona, 1, 1) === '8' ? 'selected' : '' ?>>8</option>
                            <option value="9" <?= substr($nome_zona, 1, 1) === '9' ? 'selected' : '' ?>>9</option>
                            <option value="10" <?= substr($nome_zona, 1, 2) === '1' && substr($nome_zona, 2, 2) === '0' ? 'selected' : '' ?>>10</option>
                        </select>
                    </div>
                </div>
                <div class="input-field flex-5">
                    <label for="tipo_planta">Tipo de Planta</label>
                    <select class="input" name="id_tipo_planta" id="tipo_planta">
                        <option selected>Selecione um tipo de Planta</option>
                        <?php foreach($tipoPlantas as $tipoPlanta) : ?>
                            <option value="<?= $tipoPlanta->id ?>" <?= $tipoPlanta->id === $id_tipo_planta ? 'selected' : '' ?>><?= $tipoPlanta->nome_tipo_planta ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="input-field flex-5">
                    <label for="tipo_irrigacao">Tipo Irrigação</label>
                    <select class="input" name="id_tipo_irrigacao" id="tipo_irrigacao">
                        <option selected>Selecione um tipo de irrigação</option>
                        <?php foreach($tipoIrrigacoes as $tipoIrrigacao) : ?>
                            <option value="<?= $tipoIrrigacao->id ?>" <?= $tipoIrrigacao->id === $id_tipo_irrigacao ? 'selected' : '' ?>><?= $tipoIrrigacao->nome_tipo_irrigacao ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label for="descricao_zona">Descrição</label>
                    <textarea class="input textarea" name="descricao_zona" id="descricao_zona" cols="30"
                        rows="10"><?= $descricao_zona ?></textarea>
                </div>
            </div>
            <div class="container-buttons">
                <div class="btn-box">
                    <button type="submit" form="register" class="btn-register">
                        <i class="ph-bold ph-check-fat"></i>Atualizar
                    </button>
                    <a href="alterar_jardim.php?update=<?= $id_jardim ?>" class="btn-register cancel">
                        <i class="ph-bold ph-x"></i>Cancelar
                    </a>
                </div>
                <a href="?delete=<?= $id ?>&jardim=<?= $id_jardim ?>" class="btn-register trash"><i class="ph-bold ph-trash"></i></a>
            </div>
        </form>
    </div>
</main>