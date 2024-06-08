<main class="main">
    <?php
        renderTitle(
            "Jardins",
            "Cadastre novos jardins e suas zonas",
            "potted-plant"
        );

        include (TEMPLATE_PATH . "/messages.php")
    ?>
    <div class="content">
        <form action="#" method="post" class="register" id="register">
            <div class="form-group">
                <div class="input-field flex-10">
                    <label for="nome_jardim">Nome do Jardim</label>
                    <input class="input" type="text" name="nome_jardim0" id="nome_jardim"
                        placeholder="Digite o nome do jardim" />
                    <div class="invalid-feedback"></div>
                </div>
                <div class="input-field">
                    <label for="tamanho">Área (m²)</label>
                    <input class="input" type="text" name="tamanho0" id="tamanho"
                        placeholder="Digite o tamanho do jardim" />
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label for="descricao_jardim">Descrição</label>
                    <textarea class="input textarea" name="descricao_jardim0" id="descricao_jardim" cols="30"
                        rows="10"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label for="cep">CEP</label>
                    <input class="input" type="text" name="cep0" id="cep" placeholder="Digite o cep" />
                    <div class="invalid-feedback"></div>
                </div>
                <div class="input-field flex-10">
                    <label for="logradouro">Endereço</label>
                    <input class="input" type="text" name="logradouro0" id="logradouro"
                        placeholder="Digite o Endereço" />
                    <div class="invalid-feedback"></div>
                </div>
                <div class="input-field">
                    <label for="numero">Nº</label>
                    <input class="input" type="number" min="0" max="5000" name="numero0" id="numero"
                        placeholder="Digite o Numero" />
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field flex-3">
                    <label for="bairro">Bairro</label>
                    <input class="input" type="text" name="bairro0" id="bairro" placeholder="Digite o Bairro" />
                    <div class="invalid-feedback"></div>
                </div>
                <div class="input-field flex-5">
                    <label for="cidade">Cidade</label>
                    <input class="input" type="text" name="cidade0" id="cidade" placeholder="Digite a cidade" />
                    <div class="invalid-feedback"></div>
                </div>
                <div class="input-field">
                    <label for="estado">Estado</label>
                    <input class="input" type="text" name="estado0" id="estado"
                        placeholder="Digite o Estado" />
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <h2 class="title secundario"><i class="ph-bold ph-flag"></i>Zona</h2>
            <div class="form-group">
                <div class="input-field duplo-select">
                    <label for="nome_zona">Nome da Zona</label>
                    <div class="duplo-select">
                        <select class="input" name="nome_zona_let1" id="nome_zona">
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                            <option value="e">E</option>
                            <option value="f">F</option>
                            <option value="g">G</option>
                            <option value="h">H</option>
                            <option value="i">I</option>
                            <option value="j">J</option>
                        </select>
                        <select class="input" name="nome_zona_num1" id="nome_zona">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </div>
                <div class="input-field flex-5">
                    <label for="tipo_planta">Tipo de Planta</label>
                    <select class="input" name="id_tipo_planta1" id="tipo_planta">
                        <?php foreach($tipoPlantas as $tipoPlanta) : ?>
                            <option value="<?= $tipoPlanta->id ?>"><?= $tipoPlanta->nome_tipo_planta ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="input-field flex-5">
                    <label for="tipo_irrigacao">Tipo Irrigação</label>
                    <select class="input" name="id_tipo_irrigacao1" id="tipo_irrigacao">
                        <?php foreach($tipoIrrigacoes as $tipoIrrigacao) : ?>
                            <option value="<?= $tipoIrrigacao->id ?>"><?= $tipoIrrigacao->nome_tipo_irrigacao ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label for="descricao_zona">Descrição</label>
                    <textarea class="input textarea" name="descricao_zona1" id="descricao_zona" cols="30"
                        rows="10"></textarea>
                </div>
            </div>
            <div class="btn-add">Adicionar Zona</div>
            <input type="hidden" name="contador" id="contador" value="1">
            <div class="btn-box">
                <button type="submit" form="register" class="btn-register">
                    <i class="ph-bold ph-check-fat"></i>Cadastrar
                </button>
                <a href="registros_jardim.php" class="btn-register cancel">
                    <i class="ph-bold ph-x"></i>Cancelar
                </a>
            </div>
        </form>
    </div>
</main>