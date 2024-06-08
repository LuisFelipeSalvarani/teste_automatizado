<main class="main">
    <?php
        renderTitle(
            "Jardins",
            "Altere os dados do jardim e visualize e altere suas zonas",
            "potted-plant"
        );

        include (TEMPLATE_PATH . "/messages.php")
    ?>
    <div class="content">
        <form action="#" method="post" class="register" id="register">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="form-group">
                <div class="input-field flex-10">
                    <label for="nome_jardim">Nome do Jardim</label>
                    <input class="input" type="text" name="nome_jardim" id="nome_jardim"
                        placeholder="Digite o nome do jardim" value="<?= $nome_jardim ?>"/>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="input-field">
                    <label for="tamanho">Área (m²)</label>
                    <input class="input" type="text" name="tamanho" id="tamanho"
                        placeholder="Digite o tamanho do jardim" value="<?= $tamanho ?>"/>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label for="descricao_jardim">Descrição</label>
                    <textarea class="input textarea" name="descricao_jardim" id="descricao_jardim" cols="30"
                        rows="10"><?= $descricao_jardim ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label for="cep">CEP</label>
                    <input class="input" type="text" name="cep" id="cep" minlength="0" maxlength="9" placeholder="Digite o cep" value="<?= $cep ?>" onkeyup="cepreplace(event)"/>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="input-field flex-10">
                    <label for="logradouro">Endereço</label>
                    <input class="input" type="text" name="logradouro" id="logradouro"
                        placeholder="Digite o Endereço" value="<?= $logradouro ?>"/>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="input-field">
                    <label for="numero">Nº</label>
                    <input class="input" type="number" min="0" max="5000" name="numero" id="numero"
                        placeholder="Digite o Numero" value="<?= $numero ?>"/>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field flex-3">
                    <label for="bairro">Bairro</label>
                    <input class="input" type="text" name="bairro" id="bairro" placeholder="Digite o Bairro" value="<?= $bairro ?>"/>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="input-field flex-5">
                    <label for="cidade">Cidade</label>
                    <input class="input" type="text" name="cidade" id="cidade" placeholder="Digite a cidade" value="<?= $cidade ?>"/>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="input-field">
                    <label for="estado">Estado</label>
                    <input class="input" type="text" name="estado" id="estado"
                        placeholder="Digite o Estado" value="<?= $estado ?>"/>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <?php if(count($zonas) > 0) : ?>
                <h2 class="title secundario"><i class="ph-bold ph-flag"></i>Zonas</h2>
                <div class="items">
                    <div class="item-header">
                        <div class="item-cell header id">
                            Código
                        </div>
                        <div class="item-cell header">
                            Nome
                        </div>
                        <div class="item-cell header">
                            Descrição
                        </div>
                        <div class="item-cell header">
                            Tipo de Irrigação
                        </div>
                        <div class="item-cell header">
                            Tipo de Plantação
                        </div>
                    </div>
                    <?php foreach($zonas as $zona) : ?>
                        <a href="alterar_zona.php?update=<?= $zona->id ?>" class="item-row">
                            <div class="item-cell id"><span class="item"><?= str_pad($zona->id, 4, '0' , STR_PAD_LEFT) ?></span></div>
                            <div class="item-cell"><?= $zona->nome_zona ?></div>
                            <p class="item-cell descricao"><?= $zona->descricao_zona ?></p>
                            <div class="item-cell">
                                <?php foreach ($tipoIrrigacoes as $tipoIrrigacoe) : ?>
                                    <?= $zona->id_tipo_irrigacao == $tipoIrrigacoe->id ? "<span>{$tipoIrrigacoe->nome_tipo_irrigacao}</span>" : "" ?>
                                <?php endforeach ?>
                            </div>
                            <div class="item-cell">
                                <?php foreach ($tipoPlantas as $tipoPlanta) : ?>
                                    <?= $zona->id_tipo_planta == $tipoPlanta->id ? "<span>{$tipoPlanta->nome_tipo_planta}</span>" : "" ?>
                                <?php endforeach ?>
                            </div>
                        </a>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
            <div class="container-buttons">
                <div class="btn-box">
                    <button type="submit" form="register" class="btn-register">
                        <i class="ph-bold ph-check-fat"></i>Atualizar
                    </button>
                    <a href="registros_jardim.php" class="btn-register cancel">
                        <i class="ph-bold ph-x"></i>Cancelar
                    </a>
                </div>
                <a href="?delete=<?= $id ?>" class="btn-register trash"><i class="ph-bold ph-trash"></i></a>
            </div>
        </form>
    </div>
</main>
<script src="/assets/js/cep.js" defer></script>