<main class="main">
    <?php
    renderTitle(
        "Painel de Controle",
        "Gerencie",
        "faders"
    );
    ?>
    <div class="content control">
        <div class="form-group">
            <div class="input-field flex-5">
                <label for="id_jardim">Jardim</label>
                <select class="input" name="jardim" id="id_jardim">
                    <option value="" selected>Selecione um Jardim...</option>
                    <?php foreach ($jardins as $jardim): ?>
                        <option value="<?= $jardim->id ?>"><?= $jardim->nome_jardim ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="input-field">
                <label for="id_zona">Zona</label>
                <select class="input" name="id_zona" id="id_area">
                    <option value="" id="zona" selected>Selecione uma Zona...</option>
                </select>
            </div>
        </div>
        <div class="control-box">
            <div class="control-column">
                <div class="control-switches">
                    <div class="control-switch">
                        <sapn class="control-label"><i class="icon ph-bold ph-gear-six"></i>Automático</sapn>
                        <div class="switch">
                            <input type="checkbox" class="switch-input" id="automatico" onchange="enviarComandos();">
                            <label for="automatico" class="switch-label"></label>
                        </div>
                    </div>
                    <div class="control-switch">
                        <sapn class="control-label"><i class="icon ph-bold ph-funnel"></i>Válvula</sapn>
                        <div class="switch">
                            <input type="checkbox" class="switch-input" id="valvula" onchange="enviarComandos();">
                            <label for="valvula" class="switch-label"></label>
                        </div>
                    </div>
                    <div class="control-switch">
                        <sapn class="control-label"><i class="icon ph-bold ph-engine"></i>Bomba</sapn>
                        <div class="switch">
                            <input type="checkbox" class="switch-input" id="motor" onchange="enviarComandos();">
                            <label for="motor" class="switch-label"></label>
                        </div>
                    </div>
                    <div class="control-switch">
                        <sapn class="control-label"><i class="icon ph-bold ph-thermometer"></i>Temperatura</sapn>
                        <div class="switch">
                            <input type="checkbox" class="switch-input" id="controle_temperatura"
                                onchange="enviarComandos();">
                            <label for="controle_temperatura" class="switch-label"></label>
                        </div>
                    </div>
                    <div class="control-switch">
                        <sapn class="control-label"><i class="icon ph-bold ph-drop"></i>Umidade</sapn>
                        <div class="switch">
                            <input type="checkbox" class="switch-input" id="controle_umidade"
                                onchange="enviarComandos();">
                            <label for="controle_umidade" class="switch-label"></label>
                        </div>
                    </div>
                    <div class="control-switch">
                        <sapn class="control-label"><i class="icon ph-bold ph-cube-transparent"></i>Volume</sapn>
                        <div class="switch">
                            <input type="checkbox" class="switch-input" id="controle_consumo"
                                onchange="enviarComandos();">
                            <label for="controle_consumo" class="switch-label"></label>
                        </div>
                    </div>
                </div>
                <div class="error-display">
                    <i class="icon ph-bold ph-monitor"></i>
                    <ul class="detalhes">
                        <li>Dispositivo: <span>147258</span></li>
                        <li>Status: <span class="status">Funcionando</span></li>
                        <li>Log: <span>Sem erro</span></li>
                    </ul>
                </div>
            </div>
            <div class="info">
                <div class="info-row">
                    <div class="info-item">
                        <div class="info-label">
                            <span>Úmidade do solo</span>
                        </div>
                        <div class="progress solo" role="progressbar" id='umidadeSolo'>
                            <div class="progress-inner">
                                <div class="progress-indicator"></div>
                            </div>
                            <span class="progress-label">
                                <p><i class="ph-bold ph-drop"></i></p>
                                <strong id="umidadeSoloLabel">0</strong>
                                <span>%</span>
                            </span>
                        </div>
                        <input type="hidden" min="0" max="50" step="1">
                    </div>
                    <div class="info-item">
                        <div class="info-label">
                            <span>Úmidade do ar</span>
                        </div>
                        <div class="progress" role="progressbar" id='umidadeAr'>
                            <div class="progress-inner">
                                <div class="progress-indicator"></div>
                            </div>
                            <span class="progress-label">
                                <p><i class="ph-bold ph-drop"></i></p>
                                <strong id="umidadeArLabel">0</strong>
                                <span>%</span>
                            </span>
                        </div>
                        <input type="hidden" min="0" max="50" step="1">
                    </div>
                    <div class="info-item">
                        <div class="info-label">
                            <span>Temperatura</span>
                        </div>
                        <div class="progress thermometer" role="progressbar" id="temperatura">
                            <div class="progress-inner">
                                <div class="progress-indicator"></div>
                            </div>
                            <span class="progress-label">
                                <p><i class="ph-bold ph-thermometer"></i></p>
                                <strong id="temperaturaLabel">0</strong>
                                <span>°C</span>
                            </span>
                        </div>
                        <input id="thermometer" type="hidden" min="0" max="50" step="1" data-value="20">
                    </div>

                </div>
                <div class="info-row">
                    <div class="info-item">
                        <div class="info-label vazao">
                            <span>Vazão</span>
                        </div>
                        <div class="vazao-container">
                            <input type="checkbox" id="agua" class="vazao-input">
                            <div class="indicator">
                                <div class="detalhe"></div>
                                <label for="agua" class="corpo">
                                    <div class="fill"></div>
                                </label>
                                <div class="detalhe right"></div>
                            </div>
                            <span class="vazao-label">
                                <p>
                                    <i class="icon ph-boldel ph-wind"></i>
                                </p>
                                <strong class="vazao" id="vazaoLabel">0</strong>
                                <span class="unit-vazao">m/s</span>
                            </span>
                        </div>
                        <input id="vazao" type="hidden" min="0" max="500" step="1">
                    </div>
                    <div class="info-item svg">
                        <div class="info-label">Motor</div>
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            x="0px" y="0px" viewBox="0 0 256 256" enable-background="new 0 0 256 256"
                            xml:space="preserve">
                            <metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon </metadata>
                            <g>
                                <g>
                                    <path fill="#3ca6a6"
                                        d="M246,105.3c-2.8,4.8-5.9,6.6-9.8,5.6c-4.2-1.1-6-4.1-6-10c0-13.1,0.1-26.3-0.1-39.4c-0.1-4.8,1.4-8.3,5.9-10.3c1.4,0,2.8,0,4.2,0c2.6,1.2,4.5,3.2,5.8,5.8C246,73.1,246,89.2,246,105.3z" />
                                    <path fill="#3ca6a6"
                                        d="M10,150.7c2.8-4.8,5.9-6.6,9.8-5.6c4.2,1.1,6,4.1,6,10c0,13.1-0.1,26.3,0.1,39.4c0.1,4.8-1.4,8.3-5.9,10.3c-1.4,0-2.8,0-4.2,0c-2.6-1.2-4.6-3.2-5.8-5.8C10,182.9,10,166.8,10,150.7z" />
                                    <path fill="#024959"
                                        d="M58.6,150.7c-1-5.2-2.4-10.1-2.7-15.1c-2.2-28.4,8.4-50.8,31.9-67c11.7-8,24.9-11.6,39-11.7c25.5-0.1,51.1,0,76.6,0c13,0,22.1,9.1,22,22.1c0,3.7,0,7.4-0.8,11c-2.1,9.3-10.2,15.7-19.8,15.9c-3.3,0.1-6.7,0-10.3,0c0.7,2.8,1.4,5.4,1.9,8c6.1,28.6-6.2,58-30.7,74.1c-11.9,7.8-25.1,11.6-39.3,11.7c-24.5,0.1-49,0-73.5,0c-13.5,0-22.5-9-22.4-22.5c0-3.5,0-7.1,0.8-10.4c2.1-9.4,10.3-15.8,20-16C53.8,150.6,56.2,150.7,58.6,150.7z M60.6,128.2c0,36.5,29.6,66.2,66.1,66.2c36.3,0,66-29.5,66.1-65.6c0.1-36.8-29.4-66.5-66-66.6C90.3,62.1,60.6,91.7,60.6,128.2z M154.4,62.2c0.7,0.5,0.8,0.7,0.9,0.7c16.8,7.6,29,19.7,36.6,36.4c0.3,0.6,1.4,1.2,2.2,1.3c3.6,0.1,7.2,0.1,10.8,0c7.1-0.2,13.3-5.1,14.7-12c0.6-3.1,0.5-6.5,0.5-9.7c0-10-6.7-16.7-16.6-16.7c-14.4,0-28.8,0-43.1,0C158.6,62.2,156.7,62.2,154.4,62.2z M98.5,194.4c0-0.1,0.1-0.3,0.1-0.4c-0.6-0.3-1.2-0.6-1.8-0.9c-13.8-6.5-24.6-16.3-32.2-29.6c-1.4-2.5-2.4-6-4.6-7.2c-2.3-1.3-5.8-0.3-8.8-0.3c-7.2,0.1-13.5,5.1-14.9,12.1c-0.6,3.1-0.5,6.3-0.5,9.4c0,10.2,6.6,16.9,16.7,16.9c14.6,0,29.1,0,43.7,0C97,194.4,97.7,194.4,98.5,194.4z" />
                                    <path fill="#cecece"
                                        d="M118.2,128.1c0-5,4.1-9.1,9.1-9.1c5,0,9.1,4.1,9.1,9.1c0,5-4.1,9.1-9.1,9.1C122.3,137.2,118.2,133.2,118.2,128.1L118.2,128.1z M159.2,92.7l-17.8,18.3c-3.2-2.6-7.1-4.4-11.3-4.9V79.1c-30.9,0-38.2,17.2-38.2,17.2l18,17.5c-2.8,3.3-4.6,7.5-5.2,12H78.3c0,30.9,17.2,38.2,17.2,38.2l17.6-18c3.3,2.6,7.4,4.4,11.9,4.8v26.5c30.9,0,38.2-17.2,38.2-17.2l-18.3-17.9c2.5-3.2,4.1-7,4.6-11.3h27C176.4,100,159.2,92.7,159.2,92.7z M127.3,141.8c-7.5,0-13.7-6.1-13.7-13.7c0-7.5,6.1-13.7,13.7-13.7c7.5,0,13.7,6.1,13.7,13.7C141,135.7,134.9,141.8,127.3,141.8z M149.8,135.4h3.2v9.9h-3.2V135.4z M155.7,134.2h3.6v12.4h-3.6V134.2z M162.6,132.6h4.7v15.6h-4.7V132.6z M170.5,132.1h4.8v16.6h-4.8V132.1z M109.9,150.8h9.9v3.2h-9.9V150.8z M108.6,156.7H121v3.6h-12.4V156.7z M107,163.6h15.6v4.7H107V163.6z M106.5,171.5h16.6v4.8h-16.6V171.5z M101.1,110.9h3.2v9.9h-3.2V110.9L101.1,110.9z M94.8,109.7h3.6v12.4h-3.6V109.7L94.8,109.7z M86.9,108.1h4.7v15.6h-4.7V108.1z M78.9,107.6h4.8v16.6h-4.8V107.6z M135.4,103.2h9.9v3.2h-9.9V103.2z M134.1,96.9h12.4v3.6h-12.4V96.9L134.1,96.9z M132.5,88.9h15.6v4.7h-15.6V88.9L132.5,88.9z M132,80.9h16.6v4.8H132V80.9L132,80.9z" />
                                </g>
                            </g>
                        </svg>
                        <span id='motor_status'>Ligado</span>
                    </div>
                    <div class="info-item svg">
                        <div class="info-label">Válvula</div>
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            x="0px" y="0px" viewBox="0 0 256 256" enable-background="new 0 0 256 256"
                            xml:space="preserve">
                            <metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon </metadata>
                            <g>
                                <g>
                                    <path fill="#cecece"
                                        d="M203.5,44.9c-1.3-9.2-9.1-16.3-18.5-16.3s-17.2,7.1-18.5,16.3h-21.3c-1.4-6.1-6.8-10.9-13.1-10.9H127c-6.4,0-11.8,4.6-13,10.9H86.9c-1.3-9.2-9.1-16.3-18.5-16.3c-10.3,0-18.7,8.5-18.7,18.9c0,1.1,0.1,2.1,0.3,3.1v21.2h63.8V96h31.9V71.9h58.1v-27H203.5L203.5,44.9z" />
                                    <path fill="#024959"
                                        d="M246,125.5c-17.1,0-32.1,8.6-40.4,21.5h-30.2c-3.6-6.3-8.4-11.7-14.2-16.1v-21.5H97.7V131c-5.7,4.4-10.5,9.8-14.1,16.1H48.3c-8-12.9-22.2-21.5-38.3-21.5c1,0.5-0.3,92.3,0,91.3c11,0,21.1-4,28.9-10.6h48.3c9.7,12.9,25,21.3,42.1,21.3c17.3,0,32.7-8.3,42.4-21.3h45c8.1,6,18.2,9.6,29.2,9.6C246,215,245,126,246,125.5z" />
                                </g>
                            </g>
                        </svg>
                        <span id='valvula_status'>Ligado</span>
                    </div>
                </div>
            </div>
        </div>
</main>
<script src="/assets/js/progressBar.js"></script>
<script src="/assets/js/dispositivos_valor_atual.js"></script>
<script src="/assets/js/status.js"></script>