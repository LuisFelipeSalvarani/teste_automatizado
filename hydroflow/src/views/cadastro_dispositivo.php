<main class="main">
    <?php
        renderTitle(
            "Dispositivos",
            "preencha os campos com as informções do dispositivo",
            "circuitry"
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>
    <div class="content">
        <form action="#" method="post"class="register" id="register">
            <input type="hidden" name="id" value="<?= $id_dispositivo ?>">
            <div class="form-group">
                <div class="input-field flex-10">
                    <label for="jardim">Jardim</label>
                    <select class="input <?= $errors['jardim'] ? 'invalid' : '' ?>" name="id_jardim" id="id_jardim" class="input">
                        <option value="">Selecione um Jardim...</option>
                        <?php foreach($jardins as $jardim) : ?>
                            <option value="<?= $jardim->id ?>" <?= $jardim->id == $id_jardim ? 'selected' : '' ?>><?= $jardim->nome_jardim ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback"><?= $errors['jardim'] ?></div>
                </div>
                <div class="input-field">
                    <label for="id_zona">Zona</label>
                    <?php if(isset($id_zona)) {
                        echo "<input type='hidden' id='areaValor' value='{$id_zona}'>";
                    } ?>
                    <select class="input  <?= $errors['zona'] ? 'invalid' : '' ?>" name="id_zona" id="id_area">
                        <option value="">Selecione uma Zona...</option>
                    </select>
                    <div class="invalid-feedback"><?= $errors['zona'] ?></div>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label for="id_tipo_dispositivo">Tipo de Dispositivo</label>
                    <select class="input <?= $errors['tipo_dispositivo'] ? 'invalid' : '' ?>" name="id_tipo_dispositivo" id="id_tipo_dispositivo">
                        <option value="">Selecione um tipo...</option>
                        <?php foreach($tipoDispositivos as $tipoDispositivo) : ?>
                            <option value="<?= $tipoDispositivo->id ?>" <?= $tipoDispositivo->id == $id_tipo_dispositivo ? 'selected' : '' ?>><?= $tipoDispositivo->nome_tipo_dispositivo ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback"><?= $errors['tipo_dispositivo'] ?></div>
                </div>
                <div class="input-field">
                    <label for="nome_dispositivo">Nome do Dispositivo</label>
                    <input class="input  <?= $errors['nome_dispositivo'] ? 'invalid' : '' ?>" type="text" name="nome_dispositivo" id="nome_dispositivo" value="<?= $nome_dispositivo ?>" placeholder="Digite o nome do dispositivo"/>
                    <div class="invalid-feedback"><?= $errors['nome_dispositivo'] ?></div>
                </div>
                <div class="input-field">
                    <label for="modelo_dispositivo">Modelo do Dispositivo</label>
                    <input class="input  <?= $errors['modelo_dispositivo'] ? 'invalid' : '' ?>" type="text" name="modelo_dispositivo" id="modelo_dispositivo" value="<?= $modelo_dispositivo ?>" placeholder="Digite o modelo do dispositivo"/>
                    <div class="invalid-feedback"><?= $errors['modelo_dispositivo'] ?></div>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label for="descricao">Descrição</label>
                    <textarea class="input textarea" name="descricao" id="descricao" cols="30" rows="10"  placeholder="Adicione uma descrição para o dispositivo"><?= $descricao ?></textarea>
                </div>
            </div>
            <div class="container-buttons">
                <div class="btn-box">
                    <button type="submit" form="register" class="btn-register">
                        <i class="ph-bold ph-check-fat"></i><?= $id ? 'Alterar' : 'Cadastrar' ?>
                    </button>
                    <a href="registros_dispositivo.php" class="btn-register cancel">
                        <i class="ph-bold ph-x"></i>Cancelar
                    </a>
                </div>
                <a href="?delete=<?= $id_dispositivo ?>" class="btn-register trash"><i class="ph-bold ph-trash"></i></a>
            </div>
        </form>
    </div>
</main>